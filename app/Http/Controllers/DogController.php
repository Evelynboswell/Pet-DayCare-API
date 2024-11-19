<?php

namespace App\Http\Controllers;

use App\Models\Dog;
use Illuminate\Http\Request;

class DogController extends Controller
{
    public function index(Request $request)
    {
        $dogs = $request->user()->dogs()->get();

        return response()->json($dogs, 200);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|string|max:255',
            'weight' => 'required|string|max:255',
            'breed' => 'required|string|max:255',
            'color' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'medical_condition' => 'nullable|string|max:255'
        ]);

        $dog = Dog::create(array_merge($validatedData, [
            'customer_id' => $request->user()->customer_id,
        ]));

        return response()->json(['message' => 'Dog profile created successfully.', 'dog' => $dog], 201);
    }

    public function show(Request $request, $dog_id)
    {
        $dog = Dog::where('customer_id', $request->user()->customer_id)
                  ->where('dog_id', $dog_id)
                  ->firstOrFail();

        return response()->json($dog, 200);
    }

    public function update(Request $request, $dog_id)
    {
        $dog = Dog::where('customer_id', $request->user()->customer_id)
                  ->where('dog_id', $dog_id)
                  ->firstOrFail();

        $validatedData = $request->validate([
            'name' => 'sometimes|string|max:255',
            'age' => 'sometimes|string|max:255',
            'weight' => 'sometimes|string|max:255',
            'breed' => 'sometimes|string|max:255',
            'color' => 'sometimes|string|max:255',
            'gender' => 'sometimes|string|max:255',
            'medical_condition' => 'nullable|string|max:255'
        ]);

        $dog->update($validatedData);

        return response()->json(['message' => 'Dog profile updated successfully.', 'dog' => $dog], 200);
    }

    public function destroy(Request $request, $dog_id)
    {
        $dog = Dog::where('customer_id', $request->user()->customer_id)
                  ->where('dog_id', $dog_id)
                  ->firstOrFail();

        $dog->delete();

        return response()->json(['message' => 'Dog profile deleted successfully.'], 200);
    }
}
