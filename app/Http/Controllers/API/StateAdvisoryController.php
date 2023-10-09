<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StateAdvisory;
use Illuminate\Validation\ValidationException;

class StateAdvisoryController extends Controller
{
    //
    public function index()
    {
        //
        $stateadvisory = StateAdvisory :: all();
        return response()->json($stateadvisory);
    }
    public function store(Request $request)
    {
        //
       
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'designation' => 'required|string|max:255',
            ]);
    
            $stateadvisory = StateAdvisory::create($validatedData);
            return response()->json($stateadvisory, 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422); // 422 Unprocessable Entity status code for validation errors
        }
    }
    public function show(string $id)
    {
        //
        $stateadvisory = StateAdvisory::findOrFail($id);
        $stateadvisory->update($requet->all());
        return response()->json($stateadvisory,200);
    }
    public function destroy(string $id)
    {
        //
        $stateadvisory= StateAdvisory::findOrFail($id);
        $stateadvisory->delete();
        return response()->json(null,204);
    }

}
