<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['pageTitle'] = "Testimonials";
        $data['items'] = Testimonial::with('user')->latest()->paginate(10);
        return view('admin.testimonials.index', $data);
    }

    public function create()
    {
        return view('admin.testimonials.create', [
            'pageTitle' => 'Create Testimonial',
            'buttonText' => 'Save',
            'users' => User::where('type', 'participant')->get(),
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'comment' => 'nullable|string',
            'designation' => 'nullable|string|max:255',
            'status' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('testimonials', $filename, 'public');
            $validated['image'] = $path;
        }

        $validated['status'] = $request->has('status') ? 1 : 0;

        Testimonial::create($validated);

        return redirect()->route('dashboard.testimonials.index')->with('success', 'Testimonial added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Testimonial $testimonial)
    {
        $data['testimonial'] = $testimonial;
        $data['users'] = User::where('type', 'participant')->get();
        $data['pageTitle'] = "Edit Testimonial";
        return view('admin.testimonials.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Testimonial $testimonial)
    {
        $validated = $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'comment' => 'nullable|string',
            'designation' => 'nullable|string|max:255',
            'status' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('testimonials', $filename, 'public');
            $validated['image'] = $path;
        }

        $validated['status'] = $request->has('status') ? 1 : 0;

        $testimonial->update($validated);

        return redirect()->route('dashboard.testimonials.index')->with('success', 'Testimonial updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();
        return redirect()->route('dashboard.testimonials.index')->with('success', 'Testimonial deleted successfully.');
    }
}
