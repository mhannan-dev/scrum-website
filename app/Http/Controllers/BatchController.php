<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Course;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\RegistrationMessage;

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
        $data['courses'] = Course::pluck('name', 'id');
        $data['parentCategories'] = Category::whereNull('parent_id')->get();
        return view('admin.batches.create', $data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_id'         => 'required|exists:courses,id',
            'start_date'        => 'required|date',
            'end_date'          => 'required|date|after_or_equal:start_date',
            'title'             => 'required',
            'start_time'        => 'nullable',
            'duration'        => 'nullable',
            'schedule'        => 'nullable',
            'end_time'          => 'nullable',
            'timezone'          => 'nullable|string|max:100',
            'location'          => 'nullable|string|max:255',
            'price'             => 'required|numeric|min:0',
            'discounted_price'  => 'nullable|numeric|min:0|lte:price',
        ]);

        // Fetch the Course and get its user_id
        $course = \App\Models\Course::findOrFail($validated['course_id']);
        $validated['user_id'] = $course->user_id;

        // Create the Batch
        \App\Models\Batch::create($validated);

        return redirect()->route('dashboard.batches.index')->with('success', 'Batch created successfully.');
    }


    public function edit(Batch $batch)
    {
        $data['batch'] = $batch;
        $data['buttonText'] = "Update";
        $data['pageTitle'] = "Batch update";
        $data['courses'] = Course::pluck('name', 'id');
        $data['parentCategories'] = Category::whereNull('parent_id')->get();
        return view('admin.batches.edit', $data);
    }

    public function update(Request $request, Batch $batch)
    {
        $validated = $request->validate([
            'course_id'         => 'required|exists:courses,id',
            'start_date'        => 'required|date',
            'end_date'          => 'required|date|after_or_equal:start_date',
            'title'             => 'required',
            'start_time'        => 'nullable',
            'end_time'          => 'nullable',
            'duration'        => 'nullable',
            'schedule'        => 'nullable',
            'timezone'          => 'nullable|string|max:100',
            'location'          => 'nullable|string|max:255',
            'price'             => 'required|numeric|min:0',
            'discounted_price'  => 'nullable|numeric|min:0|lte:price',
        ]);

        // Set status based on checkbox (checkbox value = "on" if checked)
        $validated['status'] = $request->boolean('status');

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
