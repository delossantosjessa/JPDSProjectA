<?php

namespace App\Http\Controllers;

use App\Models\Degree;
use Illuminate\Http\Request;

class DegreeController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index()
    {
        $degrees = Degree::withCount('students')
            ->orderBy('degree_title')
            ->paginate(1);

        return view('degree')->with('degrees', $degrees);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('add_degree');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'degree_title' => 'required|string|max:255|unique:degrees,degree_title',
        ]);

        Degree::create([
            'degree_title' => $request->input('degree_title')
        ]);

        return redirect()->route('degree.index')->with('success', 'Degree added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $degree = Degree::withCount('students')->findOrFail($id);

        return view('viewDegreeDetails')->with('degree', $degree);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $degree = Degree::findOrFail($id);

        return view('edit_degree')->with('degree', $degree);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'degree_title' => 'required|string|max:255|unique:degrees,degree_title,' . $id,
        ]);

        $degree = Degree::findOrFail($id);

        $degree->update([
            'degree_title' => $request->input('degree_title')
        ]);

        return redirect()->route('degree.index')->with('success', 'Degree updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $degree = Degree::findOrFail($id);
        $degree->delete();

        return redirect()->route('degree.index')->with('success', 'Degree deleted successfully!');
    }
}
