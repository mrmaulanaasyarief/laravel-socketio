<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCenterPointRequest;
use App\Http\Requests\UpdateCenterPointRequest;
use App\Models\CenterPoint;

class CenterPointController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('center-point.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCenterPointRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CenterPoint $centerPoint)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CenterPoint $centerPoint)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCenterPointRequest $request, CenterPoint $centerPoint)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CenterPoint $centerPoint)
    {
        //
    }

    // Display data for Datatables
    public function data()
    {
        $centrepoint = CenterPoint::orderBy('created_at', 'DESC');
        return datatable()->of($centrepoint)
            ->addColumn('action', 'centrepoint.action')
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->toJson();
    }
}
