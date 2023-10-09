<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Careers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CareersController extends Controller
{
    //
    public function index()
    {
        //
        $careers=Careers::all();
        return response()->json(['careers' => $careers],200);
    }
    public function store(Request $request)
    {
        //
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'last_date' => 'required|date',
            'file_upload' => 'required|mimes:pdf|max:2048',
        ]);

       if($request ->hasFile('file_upload')){
        $file = $request->file('file_upload');
        $path = $file->store('careers');
        $request->merge(['file_upload' => $path]);
       }
       $careers = Careers::create($request->all());
       return response()->json($careers,201);
    }
    public function show(string $id)
    {
        //
        $careers = Careers::findOrFail($id);
      
        return response()->json($careers,200);
    }
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'last_date' => 'required|date',
            'file_upload' => 'mimes:pdf|max:2048',
        ]);

        $careers = Careers::findOrFail($id);

        if($request->hasFile('file_upload')){
            $file = $request->file('file_upload');
            $path = $file->store('careers');
            $request->merge(['file_upload' => $path]);
        }
        $careers->update($request->all());
        return response()->json($careers,200);
    }

    public function destroy(string $id)
    {
        $careers = Careers::findOrFail($id);
        $careers->delete();
        return response()->json(['message' => 'Deleted successfully'], 204);
    }
}
