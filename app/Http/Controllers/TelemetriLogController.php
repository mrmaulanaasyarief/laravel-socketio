<?php

namespace App\Http\Controllers;

use App\Events\MessageCreated;
use App\Http\Requests\StoreTelemetriLogRequest;
use App\Http\Requests\UpdateTelemetriLogRequest;
use App\Models\FlightCode;
use App\Models\GardenProfile;
use App\Models\TelemetriLog;
use Illuminate\Support\Facades\Session;

class TelemetriLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TelemetriLog::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTelemetriLogRequest $request)
    {
        $selectedFlightCode = FlightCode::where('selected', 1)->first()->id;
        $request['flight_code_id'] = $selectedFlightCode;

        $selectedFlightCodeSession = Session::get('selectedFlightCode');

        if(empty($selectedFlightCodeSession)){
            $telemetriLogs = TelemetriLog::orderBy('created_at', 'asc')->get()->all();
            $telemetriLog = TelemetriLog::orderBy('created_at', 'desc')->first();
        }else{
            $telemetriLogs = TelemetriLog::where('flight_code_id', $selectedFlightCodeSession)->orderBy('created_at', 'asc')->get()->all();
            $telemetriLog = TelemetriLog::where('flight_code_id', $selectedFlightCodeSession)->orderBy('created_at', 'desc')->first();
        }
        if(count($telemetriLogs) != 0){
            $request['haversine'] = $this->haversineGreatCircleDistance(
                $telemetriLog->lat,
                $telemetriLog->long,
                $request['lat'],
                $request['long'],
            );
            $diff = end($telemetriLogs)->tPayload - $telemetriLogs[0]->tPayload;
            $totalWaktu = date('H:i:s', $diff);
            $jarakAwalAkhir = $this->haversineGreatCircleDistance($telemetriLogs[0]->lat, $telemetriLogs[0]->long, $request['lat'], $request['long']);
        }else{
            $request['haversine'] = 0;
            $totalWaktu = 0;
            $jarakAwalAkhir = 0;
        }

        $gardenProfiles = GardenProfile::orderBy('id', 'asc')->get()->all();

        $longitudes = [];// x-coordinates
        $latitudes = []; // y-coordinates
        $longitude_x = $request['long']; // x-coordinate of the point to test
        $latitude_y = $request['lat']; // y-coordinate of the point to test
        $isInPolygon = 0;
        $gardenId = "";
        $gardenName = "";

        foreach ($gardenProfiles as $gardenProfile) {
            foreach ($gardenProfile->polygon as $polygon) {
                $latitudes[] = $polygon['lat'];
                $longitudes[] = $polygon['lng'];
            }

            $points_polygon = count($longitudes); // number vertices
            if ($this->is_in_polygon($points_polygon, $longitudes, $latitudes, $longitude_x, $latitude_y)){
                $isInPolygon = 1;
                $gardenId = $gardenProfile->id;
                $gardenName = $gardenProfile->name;
                break;
            }
            $latitudes = [];
            $longitudes = [];
        }
        if ($isInPolygon != 0) {
            $telemetriLog = TelemetriLog::create(array_merge($request->all(), ['garden_profile_id' => $gardenId]));
        }else{
            $telemetriLog = TelemetriLog::create($request->all());
        }

        if(!empty($selectedFlightCodeSession) && $selectedFlightCodeSession == $selectedFlightCode){
            MessageCreated::dispatch([
                'telemetriLog' => $telemetriLog,
                'totalWaktu' => $totalWaktu,
                'jarakTempuh' => TelemetriLog::where('flight_code_id', $selectedFlightCodeSession)->sum('haversine'),
                'jarakAwalAkhir' => $jarakAwalAkhir,
                'selectedFlightCode' => $selectedFlightCode
            ]);
        }

        return response()->json($telemetriLog, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(TelemetriLog $telemetriLog)
    {
        return $telemetriLog;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTelemetriLogRequest $request, TelemetriLog $telemetriLog)
    {
        $telemetriLog->update($request->all());

        return response()->json($telemetriLog, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TelemetriLog $telemetriLog)
    {
        $telemetriLog->delete();

        return response()->json(null, 204);
    }



    // Display data for Datatables
    public function data()
    {
        $telemetriLogs = TelemetriLog::orderBy('created_at', 'DESC');

        return datatables()->of($telemetriLogs)
            ->addIndexColumn()
            ->toJson();
    }

    /**
     * Calculates the great-circle distance between two points, with
     * the Haversine formula.
     * @param float $latitudeFrom Latitude of start point in [deg decimal]
     * @param float $longitudeFrom Longitude of start point in [deg decimal]
     * @param float $latitudeTo Latitude of target point in [deg decimal]
     * @param float $longitudeTo Longitude of target point in [deg decimal]
     * @param float $earthRadius Mean earth radius in [m]
     * @return float Distance between points in [m] (same as earthRadius)
     */
    private function haversineGreatCircleDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000)
    {
        // convert from degrees to radians
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
        cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
        return $angle * $earthRadius;
    }

    private function is_in_polygon($points_polygon, $vertices_x, $vertices_y, $longitude_x, $latitude_y)
    {
        $i = $j = $c = 0;
        for ($i = 0, $j = $points_polygon-1 ; $i < $points_polygon; $j = $i++) {
            if ( (($vertices_y[$i] > $latitude_y != ($vertices_y[$j] > $latitude_y)) &&
            ($longitude_x < ($vertices_x[$j] - $vertices_x[$i]) * ($latitude_y - $vertices_y[$i]) / ($vertices_y[$j] - $vertices_y[$i]) + $vertices_x[$i]) ) )
                $c = !$c;
        }
        return $c;
    }
}
