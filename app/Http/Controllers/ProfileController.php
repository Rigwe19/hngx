<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $persons = Profile::all();

        return response()->json(['persons' => $persons]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->input();


        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'unique:profiles,name'],
            'age' => ['required', 'string']
        ]);
        if ($validator->fails()) {
            return response()->json(["error" => $validator->errors(), "success" => false], 422);
        }

        $input['name'] = htmlspecialchars($input['name']);
        $input['age'] = htmlspecialchars($input['age']);

        Profile::create($input);

        return response()->json(['success' => true, 'message' => 'person details has been saved successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (is_numeric($id)) {
            $person = Profile::findOrFail($id);
        } else {
            $person = Profile::where('name', $id)->firstOrFail();
        }

        return response()->json(['success' => true, 'person' => $person]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $input = $request->input();
        if (is_numeric($id)) {
            $person = Profile::findOrFail($id);
        } else {
            $person = Profile::where('name', $id)->firstOrFail();
        }

        $input['name'] = htmlspecialchars($input['name']);
        $input['age'] = htmlspecialchars($input['age']);

        $person->update($input);

        return response()->json(['success' => true, 'message' => "person details with id/name($id) has been updated successfully"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (is_numeric($id)) {
            $person = Profile::findOrFail($id);
        } else {
            $person = Profile::where('name', $id)->firstOrFail();
        }

        $person->delete();

        return response()->json(['success' => true, 'message' => "person details with id/name($id) has been deleted successfully"]);
    }
}
