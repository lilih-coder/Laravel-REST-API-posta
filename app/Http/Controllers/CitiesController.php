<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CitiesController extends Controller
{
    public function index()
    {
        $cities = City::all();
        
        return response()->json([
            'cities' => $cities
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'zip_code' => 'nullable|string|max:10',
            'population' => 'nullable|integer',
            'county_id' => 'required|exists:counties,id',
        ]);

        $city = City::create($request->all());

        return response()->json([
            'city' => $city
        ]);
    }

    public function update(Request $request, $id)
    {
        $city = City::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'zip_code' => 'nullable|string|max:10',
            'population' => 'nullable|integer',
            'county_id' => 'required|exists:counties,id',
        ]);

        $city->update($request->all());

        return response()->json([
            'city' => $city
        ]);
    }

    public function destroy($id)
    {
        $city = City::findOrFail($id);
        $city->delete();

        return response()->json([
            'message' => 'City deleted successfully',
            'id' => $id
        ]);
    }
}
