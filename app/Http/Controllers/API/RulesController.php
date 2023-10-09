<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rules;
use Illuminate\Validation\ValidationException;

class RulesController extends Controller
{
    //
    public function index()
    {
        //
        $rules = Rules::all();
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
        if($request->hasFile('file_upload')){
            $file = $request->file('file_upload');
            $path = $file->store('rules');
            $request->merge(['file_upload' => $path]);
        }
        $rules = Rules::create($request->all());
        return response()->json($rules,201);
    }

    public function show(string $id)
    {
        //
        $rules = Rules::findOrFail($id);
       
        return response()->json($rules,200);
    }

    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'title' => 'required',
            'added_on' => 'required',
            'file_upload' => 'required|mimes:pdf|max:1024',
        ]);

        $rules = Rules::findOrFail($id);

        if($request->hasFile('file_upload')){
            $file = $request->file('file_upload');
            $path = $file->store('rules');
            $request->merge(['file_upload' => $path]);
        }
        $rules->update($request->all());
        return response()->json($rules,200);
    }

    public function destroy(string $id)
    {
        //
        $rules= Rules::findOrFail($id);
        $rules->delete();
        return response()->json(null,204);
    }
}
