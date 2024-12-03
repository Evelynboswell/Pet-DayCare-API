<?php

namespace App\Http\Controllers;

use App\Models\Boarding;
use Illuminate\Http\Request;

class BoardingController extends Controller
{
    public function index()
    {
        $boardings = Boarding::all();

        return response()->json($boardings, 200);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'boarding_name' => 'required|string|max:255',
            'boarding_type' => 'required|string|max:255',
            'boarding_description' => 'required|string|max:500',
            'price' => 'required|integer|min:0',
            'current_stock' => 'required|integer|min:0',
        ]);

        $boarding = Boarding::create($validatedData);

        return response()->json([
            'message' => 'Boarding service created successfully.',
            'boarding' => $boarding,
        ], 201);
    }

    public function show($boarding_id)
    {
        $boarding = Boarding::findOrFail($boarding_id);

        return response()->json($boarding, 200);
    }
}
