<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Otherlinks;
use Illuminate\Validation\ValidationException;

class OtherlinksController extends Controller
{
    //
    public function index()
    {
        //
        $otherlinks = Otherlinks::all();
        return response()->json($otherlinks);
    }

    public function store(Request $request)
    {
        //
        $request->validate([
            'title' => 'required',
            'link' => 'required',
            'logo_upload' => 'required|mimes:jpeg,png,jpg|max:1024',
           
        ]);
        if($request->hasFile('logo_upload')){
            $file = $request->file('logo_upload');
            $path = $file->store('logo');
            $request->merge(['logo_upload' => $path]);
        }
        $otherlinks = Otherlinks::create($request->all());
        return response()->json($otherlinks,201);
    }

    public function show(string $id)
    {
        //
        $otherlinks = Otherlinks::findOrFail($id);
       
        return response()->json($otherlinks,200);
    }

    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'title' => 'required',
            'link' => 'required',
            'logo_upload' => 'required|mimes:jpeg,png,jpg|max:1024',
        ]);

        $otherlinks = Otherlinks::findOrFail($id);

        if($request->hasFile('logo_upload')){
            $file = $request->file('logo_upload');
            $path = $file->store('logo');
            $request->merge(['logo_upload' => $path]);
        }
        $otherlinks->update($request->all());
        return response()->json($otherlinks,200);
    }

    public function destroy(string $id)
    {
        //
        $otherlinks= Otherlinks::findOrFail($id);
        $otherlinks->delete();
        return response()->json(null,204);
    }
}
