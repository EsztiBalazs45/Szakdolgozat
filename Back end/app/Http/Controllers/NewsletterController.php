<?php

namespace App\Http\Controllers;

use App\Models\newsletter;
use App\Http\Requests\StorenewsletterRequest;
use App\Http\Requests\UpdatenewsletterRequest;

class NewsletterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $newsletters = Newsletter::all();

        if ($newsletters->isEmpty()) {
            return response()->json(['message' => 'No newsletters found'], 404);
        }

        return response()->json($newsletters, 200);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StorenewsletterRequest $request)
    {
        try {
            $newsletter = Newsletter::create($request->validated());
            return response()->json($newsletter, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create newsletter'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(newsletter $newsletter)
    {
        return response()->json($newsletter, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatenewsletterRequest $request, newsletter $newsletter)
    {
        try {
            $newsletter->update($request->validated());
            return response()->json($newsletter, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update newsletter'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(newsletter $newsletter)
    {
        try {
            $newsletter->delete();
            return response()->json(['message' => 'Newsletter deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete newsletter'], 500);
        }
    }
}
