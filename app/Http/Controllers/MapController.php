<?php

namespace App\Http\Controllers;

use App\Models\CenterPoint;
use App\Models\FlightCode;
use App\Models\GardenProfile;
use App\Models\TelemetriLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MapController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $selectedFlightCode = Session::get('selectedFlightCode');

        $centerPoint = CenterPoint::get()->first();
        $gardenProfiles = GardenProfile::orderBy('id', 'asc')->get()->all();

        if(empty($selectedFlightCode)){
            $telemetriLogs = TelemetriLog::orderBy('created_at', 'asc')->get()->all();
            $telemetriLog = TelemetriLog::orderBy('created_at', 'desc')->first();
            $jarakTempuh = TelemetriLog::all()->sum('haversine');
        }else{
            $telemetriLogs = TelemetriLog::where('flight_code_id', $selectedFlightCode)->orderBy('created_at', 'asc')->get()->all();
            $telemetriLog = TelemetriLog::where('flight_code_id', $selectedFlightCode)->orderBy('created_at', 'desc')->first();
            $jarakTempuh = TelemetriLog::where('flight_code_id', $selectedFlightCode)->sum('haversine');
        }

        if(count($telemetriLogs) != 0){
            $jarakAwalAkhir = $this->haversineGreatCircleDistance($telemetriLogs[0]->lat, $telemetriLogs[0]->long, $telemetriLog->lat, $telemetriLog->long);
        }else{
            $jarakAwalAkhir = [];
        }

        $flightCode = FlightCode::orderBy('created_at', 'asc')->get()->all();

        return view('map.index', compact('centerPoint', 'telemetriLogs', 'gardenProfiles', 'jarakTempuh', 'jarakAwalAkhir', 'flightCode', 'selectedFlightCode'));
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

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) + cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
        return $angle * $earthRadius;
    }

}
