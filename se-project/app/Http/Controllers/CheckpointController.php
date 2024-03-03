<?php

namespace App\Http\Controllers;

use App\Models\checkpoint;
use App\Http\Requests\StorecheckpointRequest;
use App\Http\Requests\UpdatecheckpointRequest;

class CheckpointController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StorecheckpointRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(checkpoint $checkpoint)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(checkpoint $checkpoint)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatecheckpointRequest $request, checkpoint $checkpoint)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(checkpoint $checkpoint)
    {
        //
    }
}
