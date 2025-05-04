<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\RegistrationMessage;
use Illuminate\Http\Request;

class BatchController extends Controller
{
    public function index()
    {
        $data['pageTitle'] = "Batches";
        $data['batches'] = Batch::with('course')->latest()->paginate(10);
        return view('admin.batches.index', $data);
    }

    public function create()
    {
        $data['pageTitle'] = "Batch Create";
        $data['buttonText'] = "Save";
        // Assuming you have a Course model to list courses
        $data['courses'] = \App\Models\Course::pluck('title', 'id');
        return view('admin.batches.create', $data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_id'         => 'required|exists:courses,id',
            'start_date'        => 'required|date',
            'end_date'          => 'required|date|after_or_equal:start_date',
            'start_time'        => 'required',
            'end_time'          => 'required',
            'timezone'          => 'required|string|max:100',
            'location'          => 'nullable|string|max:255',
            'price'             => 'required|numeric|min:0',
            'discounted_price'  => 'nullable|numeric|min:0|lte:price',
        ]);

        Batch::create($validated);

        return redirect()->route('dashboard.batches.index')->with('success', 'Batch created successfully.');
    }

    public function edit(Batch $batch)
    {
        $data['batch'] = $batch;
        $data['buttonText'] = "Update";
        $data['courses'] = \App\Models\Course::pluck('title', 'id');
        return view('admin.batches.edit', $data);
    }

    public function update(Request $request, Batch $batch)
    {
        $validated = $request->validate([
            'course_id'         => 'required|exists:courses,id',
            'start_date'        => 'required|date',
            'end_date'          => 'required|date|after_or_equal:start_date',
            'start_time'        => 'required',
            'end_time'          => 'required',
            'timezone'          => 'required|string|max:100',
            'location'          => 'nullable|string|max:255',
            'price'             => 'required|numeric|min:0',
            'discounted_price'  => 'nullable|numeric|min:0|lte:price',
        ]);

        $batch->update($validated);

        return redirect()->route('dashboard.batches.index')->with('success', 'Batch updated successfully.');
    }

    public function destroy(Batch $batch)
    {
        $batch->delete();
        return redirect()->route('dashboard.batches.index')->with('success', 'Batch deleted successfully.');
    }


    public function messages()
    {
        $data['pageTitle'] = "Messages";
        $data['messages'] = RegistrationMessage::with(['user'])->get();
        return view('admin.batches.messages', $data);
    }
}
