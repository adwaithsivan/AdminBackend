<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Events;
use Illuminate\Validation\ValidationException;

class EventsController extends Controller
{
    //
    public function index()
    {
        //
        $events = Events::all();
        return response()->json($events);
    }

    public function store(Request $request)
    {
        //
        $request->validate([
            'title' => 'required',
            'caption' => 'required',
            'description' => 'required',
            'image_upload' => 'required|mimes:jpeg,png,jpg|max:1024',
           
        ]);
        if($request->hasFile('image_upload')){
            $file = $request->file('image_upload');
            $path = $file->store('events');
            $request->merge(['image_upload' => $path]);
        }
        $events = Events::create($request->all());
        return response()->json($events,201);
    }

    public function show(string $id)
    {
        //
        $events = Events::findOrFail($id);
       
        return response()->json($events,200);
    }

    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'title' => 'required',
            'caption' => 'required',
            'description' => 'required',
            'image_upload' => 'required|mimes:jpeg,png,jpg|max:1024',
        ]);

        $events = Events::findOrFail($id);

        if($request->hasFile('image_upload')){
            $file = $request->file('image_upload');
            $path = $file->store('events');
            $request->merge(['image_upload' => $path]);
        }
        $events->update($request->all());
        return response()->json($events,200);
    }

    public function destroy(string $id)
    {
        //
        $events= Events::findOrFail($id);
        $events->delete();
        return response()->json(null,204);
    }
}
