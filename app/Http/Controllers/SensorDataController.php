<?php

namespace App\Http\Controllers;
use App\Models\SensorData;

use Illuminate\Http\Request;

class SensorDataController extends Controller
{
    public function receive_from_esp(Request $request)
    {
        $validatedData = $request->validate([
            'before_kf' => 'required|numeric',
            'after_kf' => 'required|numeric',
        ]);

        SensorData::create($validatedData);

        return response()->json(['message' => 'Data successfully received and stored'], 201);
    }

    public function show()
    {
        $sensorData = SensorData::latest()->take(31)->get();
        return view('dashboard', ['sensorData' => $sensorData]);
    }

    public function update_chart()
    {
        $sensorData = SensorData::latest()->take(31)->get();
        return response()->json($sensorData);
    }
}
