<?php

namespace App\Http\Controllers;

use App\Models\client;
use App\Http\Requests\StoreclientRequest;
use App\Http\Requests\UpdateclientRequest;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::all();

        if ($clients->isEmpty()) {
            return response()->json(['message' => 'No clients found'], 404);
        }
    
        return response()->json($clients);    }

    

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreclientRequest $request)
    {
        try {
            $client = Client::create($request->validated());
            return response()->json($client, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create client'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(client $client)
    {
        return response()->json($client, 200);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateclientRequest $request, client $client)
    {
        try {
            $client->update($request->validated());
            return response()->json($client, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update client'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(client $client)
    {
        $client->delete();
        return response()->json(['message' => 'Service deleted successfully'], 200);
    }
}
