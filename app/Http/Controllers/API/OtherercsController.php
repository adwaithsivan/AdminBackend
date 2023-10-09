<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Otherercs;
use Illuminate\Validation\ValidationException;

class OtherercsController extends Controller
{
    
    //
    public function index()
    {
        //
        $otherercs = Otherercs :: all();
        return response()->json($otherercs);
    }
    public function store(Request $request)
    {
        //
       
        try {
            $validatedData = $request->validate([
                'title' => 'required',
                'link' => 'required',
               
            ]);
    
            $otherercs = Otherercs::create($validatedData);
            return response()->json($otherercs, 201);
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
        $otherercs = Otherercs::findOrFail($id);
        $otherercs->update($requet->all());
        return response()->json($otherercs,200);
    }
    public function destroy(string $id)
    {
        //
        $otherercs= Otherercs::findOrFail($id);
        $otherercs->delete();
        return response()->json(null,204);
    }

}
