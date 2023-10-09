<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdviceGOK;
use Illuminate\Validation\ValidationException;

class AdviceGOKController extends Controller
{
    //
    public function index()
    {
        //
        $adviceGOK = AdviceGOK::all();
        return response()->json($otherlinks);
    }

    public function store(Request $request)
    {
        //
        $request->validate([
            'title' => 'required',
            'added_on' => 'required',
            'file_upload' => 'required|mimes:pdf|max:1024',
           
        ]);
        if($request->hasFile('logo_upload')){
            $file = $request->file('logo_upload');
            $path = $file->store('adviceGOK');
            $request->merge(['file_upload' => $path]);
        }
        $adviceGOK = AdviceGOK::create($request->all());
        return response()->json($adviceGOK,201);
    }

    public function show(string $id)
    {
        //
        $adviceGOK = AdviceGOK::findOrFail($id);
       
        return response()->json($adviceGOK,200);
    }

    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'title' => 'required',
            'added_on' => 'required',
            'file_upload' => 'required|mimes:pdf|max:1024',
        ]);

        $adviceGOK = AdviceGOK::findOrFail($id);

        if($request->hasFile('file_upload')){
            $file = $request->file('file_upload');
            $path = $file->store('adviceGOK');
            $request->merge(['file_upload' => $path]);
        }
        $adviceGOK->update($request->all());
        return response()->json($adviceGOK,200);
    }

    public function destroy(string $id)
    {
        //
        $adviceGOK= AdviceGOK::findOrFail($id);
        $adviceGOK->delete();
        return response()->json(null,204);
    }
}
