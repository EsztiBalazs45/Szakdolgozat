<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Http\Requests\StoreserviceRequest;
use App\Http\Requests\UpdateserviceRequest;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::all();

        if ($services->isEmpty()) {
            return response()->json(['message' => 'No services found'], 404);
        }

        return response()->json($services, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreserviceRequest $request)
    {
        try {
            $service = Service::create($request->validated());
            return response()->json($service, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create service'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        return response()->json($service, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateserviceRequest $request, Service $service)
    {
        try {
            $service->update($request->validated());
            return response()->json($service, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update service'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        try {
            $service->delete();
            return response()->json(['message' => 'Service deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete service'], 500);
        }
    }
}
