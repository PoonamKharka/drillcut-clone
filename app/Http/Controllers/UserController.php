<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Yajra\DataTables\DataTables;

class UserController extends Controller
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
            ])->get('https://api.drillcut.com.au/api/listallusers');
        
            
            if ($response->successful()) {
                $data = $response->json();
            } else {
                return $response->body();
            }
            
            if (!empty($data)) {
                $resolvedData = collect($data['data'])->map(function ($item) {
                    return [
                           'customer_name' => $item['firstname'] . ' ' . $item['lastname'],
                           'status' => $item['lock_status'] ?? 'Undefined',
                           'location' => $item['city'] ?? 'Undefined' . ' ' . $item['country'] ?? 'Undefined',
                        ];
                });
            }
            
            return DataTables::of($resolvedData)->make(true);
        }
        return view('users.index');
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
