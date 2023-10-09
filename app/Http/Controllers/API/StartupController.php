<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Startup;
use Illuminate\Validation\ValidationException;

class StartupController extends Controller
{
    //
    public function index()
    {
        //
        $startup = Startup::all();
        return response()->json(['startup' => $startup],200);
    }

    public function store(Request $request)
    {
        //
        $request->validate([
            'heading' => 'required',
            'description' => 'required',
            'caption' => 'required',
            'file_upload' => 'required|mimes:pdf|max:2048',
        ]);

       if($request ->hasFile('file_upload')){
        $file = $request->file('file_upload');
        $path = $file->store('startup');
        $request->merge(['file_upload' => $path]);
       }
       $startup = Startup::create($request->all());
       return response()->json($startup,201);
    }
    public function show(string $id)
    {
        //
        $startup = Startup::findOrFail($id);
      
        return response()->json($startup,200);
    }

    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'heading' => 'required',
            'description' => 'required',
            'caption' => 'required',
            'file_upload' => 'mimes:pdf|max:2048',
        ]);

        $startup = Startup::findOrFail($id);

        if($request->hasFile('file_upload')){
            $file = $request->file('file_upload');
            $path = $file->store('startup');
            $request->merge(['file_upload' => $path]);
        }
        $startup->update($request->all());
        return response()->json($startup,200);
    }

    public function destroy(string $id)
    {
        //
        $startup = Stratup::findOrFail($id);
        $startup->delete();
        return response()->json(['message' => 'Deleted successfully'], 204);
    }


}
