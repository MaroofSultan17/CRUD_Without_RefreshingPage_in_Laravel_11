<?php

namespace App\Http\Controllers;

use App\Models\DataModel;
use Illuminate\Http\Request;

class DataController extends Controller
{
    //uploading data in DB
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);
        $data = DataModel::create([
            'email' => $request->email
        ]);
        return response()->json($data);
    }

    //Deleting data from DB
    public function destroy(Request $request)
    {
        $data = DataModel::findOrFail($request->id);
        $data->delete();
        return response()->json(['id' => $request->id]);
    }

    //Updating data from DB
    public function update(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);
        $data = DataModel::findOrFail($request->id);
        $data->update([
            'email' => $request->email
        ]);

        return response()->json(['id' => $data->id, 'email' => $data->email]);
    }

}
