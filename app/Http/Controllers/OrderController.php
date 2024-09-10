<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
            $currentAuth = config('app.api_token');
            // Concatenate the values with a separator (space or comma based on API requirements)
            $authorizationValue = "Bearer $currentAuth";  // Example using comma
            
            $response = Http::withHeaders([
                'Authorization' => $authorizationValue,
                'Content-Type' => 'application/ecmascript',
                'Accept' => 'application/json',  
            ])->get('https://api.drillcut.com.au/api/order');
        
            
            if ($response->successful()) {
                $data = $response->json();
            } else {
                return $response->body();
            }
            
            $processedData = collect($data)->map(function($item) {
                $i = 0;                     
                return [
                    'order' => $item[$i]['name'],
                    'status' => $item[$i]['order_status']['value'] ?? null,
                    'date' => Carbon::parse($item[$i]['createdAt'])->toDayDateTimeString(),
                    'customer' => $item[$i]['customer']['displayName'] ?? null,
                    'price' => $item[$i]['totalPrice'] ?? null,
                ];
            });
            
            return DataTables::of($processedData)->make(true);
        }
        return view('oders.index');
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
