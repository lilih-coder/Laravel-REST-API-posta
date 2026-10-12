<?php

namespace App\Http\Controllers;

use App\Models\County;
use Illuminate\Http\Request;

class CountiesController extends Controller
{
    public function index()
    {
        return response()->json([
            'counties' => County::all(),
        ]);
    }

    public function store(Request $request)
    {
        $county = County::create($request->all());

        return response()->json(['county' => $county]);
    }

    public function update(Request $request, $id)
    {
        $county = County::findOrFail($id);
        $county->update($request->all());

        return response()->json(['county' => $county]);
    }

    public function destroy($id)
    {
        $county = County::findOrFail($id);
        $county->delete();

        return response()->json([
            'message' => 'County deleted successfully',
            'id' => $id,
        ]);
    }
}
