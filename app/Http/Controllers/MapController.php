<?php

namespace App\Http\Controllers;

use App\Models\CenterPoint;
use App\Models\TelemetriLog;
use Illuminate\Http\Request;

class MapController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $centerPoint = CenterPoint::get()->first();
        $telemetriLogs = TelemetriLog::orderBy('created_at', 'asc')->get()->all();
        return view('map.index', compact('centerPoint', 'telemetriLogs'));
    }

}
