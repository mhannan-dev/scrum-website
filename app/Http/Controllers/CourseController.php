<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Trainer;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $data['pageTitle'] = "Courses";
        $data['courses'] = Course::with(['category', 'trainer'])->latest()->paginate(10);
        return view('admin.courses.index', $data);
    }

    public function create()
    {
        $data['pageTitle'] = "Create Course";
        $data['categories'] = Category::pluck('title', 'id');
        $data['trainers'] = User::where('type', 'trainer')->pluck('name', 'id');
        $data['parentCategories'] = Category::whereNull('parent_id')->get();
        $data['buttonText'] = "Save";
        return view('admin.courses.create', $data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'details' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        Course::create($validated);

        return redirect()->route('dashboard.courses.index')->with('success', 'Course created successfully.');
    }

    public function show(Course $course)
    {
        return view('admin.courses.show', compact('course'));
    }

    public function edit(Course $course)
    {
        $data['course'] = $course;
        $data['pageTitle'] = "Edit course";
        $data['categories'] = Category::pluck('title', 'id');
        $data['trainers'] = User::where('type', 'trainer')->pluck('name', 'id');
        $data['buttonText'] = "Update";
        return view('admin.courses.edit', $data);
    }

    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'details' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        $course->update($validated);

        return redirect()->route('dashboard.courses.index')->with('success', 'Course updated successfully.');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('dashboard.courses.index')->with('success', 'Course deleted successfully.');
    }
}
