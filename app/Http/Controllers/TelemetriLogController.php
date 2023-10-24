<?php

namespace App\Http\Controllers;

use App\Events\MessageCreated;
use App\Http\Requests\StoreTelemetriLogRequest;
use App\Http\Requests\UpdateTelemetriLogRequest;
use App\Models\TelemetriLog;

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
        $telemetriLog = TelemetriLog::create($request->all());

        MessageCreated::dispatch($telemetriLog);

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
}
