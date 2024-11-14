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

    public function show($boarding_id)
    {
        $boarding = Boarding::findOrFail($boarding_id);

        return response()->json($boarding, 200);
    }
}
