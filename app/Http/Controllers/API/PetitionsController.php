<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Petitions;
use Illuminate\Validation\ValidationException;

class PetitionsController extends Controller
{
    //
    public function index()
    {
        //
        $petition = Petitions::all();
        return response()->json($petition);
    }

    public function store(Request $request)
    {
        //
        $request->validate([
            'title' => 'required',
            'opno' => 'required',
            'file_upload' => 'required|mimes:pdf|max:2048',
        ]);

       if($request ->hasFile('file_upload')){
        $file = $request->file('file_upload');
        $path = $file->store('petitions');
        $request->merge(['file_upload' => $path]);
       }
       $petition = Petitions ::create($request->all());
       return response()->json($petition,201);
    }

    public function show(string $id)
    {
        //
        $petition = Petitions ::findOrFail($id);
      
        return response()->json($petition,200);
    }

    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'title' => 'required',
            'opno' => 'required',
            'file_upload' => 'mimes:pdf|max:2048',
        ]);

        $petition = Petitions::findOrFail($id);

        if($request->hasFile('file_upload')){
            $file = $request->file('file_upload');
            $path = $file->store('petitions');
            $request->merge(['file_upload' => $path]);
        }
        $petition->update($request->all());
        return response()->json($petition,200);
    }

    public function destroy(string $id)
    {
        //
        $petition = Petitions::findOrFail($id);
        $petition->delete();
        return response()->json(['message' => 'Deleted successfully'], 204);
    }
}
