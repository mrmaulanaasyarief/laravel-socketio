<?php

namespace App\Http\Controllers;

use App\Models\CenterPoint;
use Illuminate\Http\Request;

class MapController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $centerPoint = CenterPoint::get()->first();
        return view('map.index', compact('centerPoint'));
    }

}
