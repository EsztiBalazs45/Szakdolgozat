<?php

namespace App\Http\Controllers;

use App\Models\data;
use App\Http\Requests\StoredataRequest;
use App\Http\Requests\UpdatedataRequest;
use App\Models\Dowloaddata;

class DataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dolloaddata = Dowloaddata::all();
        return response()->json($dolloaddata);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoredataRequest $request)
    {
        $validated = $request->validated();
        $dolloaddata = Dowloaddata::create($validated);
        return response()->json($dolloaddata, 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(Dowloaddata $data)
    {
        return response()->json($data, 200);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatedataRequest $request, Dowloaddata $data)
    {
        $validated = $request->validated();
        $data->update($validated);
        return response()->json($data, 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dowloaddata $data)
    {
        $data->delete();
        return response()->json(['message' => 'Service deleted successfully'], 200);

    }
}
