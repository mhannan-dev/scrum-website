<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        // $data['categories'] = Category::pluck('title', 'id');
        $data['trainers'] = User::where('type', 'trainer')->pluck('name', 'id');
        $data['categories'] = Category::whereNull('parent_id')->get();
        $data['buttonText'] = "Save";
        return view('admin.courses.create', $data);
    }




    public function show(Course $course)
    {
        return view('admin.courses.show', compact('course'));
    }

    public function edit(Course $course)
    {
        $data['course'] = $course;
        $data['pageTitle'] = "Edit course";
        $data['categories'] = Category::whereNull('parent_id')->get();
        $data['trainers'] = User::where('type', 'trainer')->pluck('name', 'id');
        $data['buttonText'] = "Update";
        return view('admin.courses.edit', $data);
    }



    public function store(Request $request)
    {
        $validated = $this->validateCourse($request);

        $validated['slug'] = $this->slugGenerate();

        if ($request->hasFile('image')) {
            $validated['image'] = $this->uploadImage($request);
        }

        Course::create($validated);

        return redirect()->route('dashboard.courses.index')->with('success', 'Course created successfully.');
    }

    public function update(Request $request, Course $course)
    {
        $validated = $this->validateCourse($request, $course->id);

        $validated['slug'] = $this->slugGenerate($course->id);

        if ($request->hasFile('image')) {
            $this->deleteImage($course->image);
            $validated['image'] = $this->uploadImage($request);
        }

        $course->update($validated);

        return redirect()->route('dashboard.courses.index')->with('success', 'Course updated successfully.');
    }

    /**
     * Validate course request data.
     */
    protected function validateCourse(Request $request, $courseId = null): array
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'short_description' => 'nullable|string',
            'sub_title' => 'nullable|string',
            'price' => 'required|numeric',
            'special_price' => 'nullable|numeric',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
            'image' => $courseId ? 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048' : 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    }

    /**
     * Handle image upload.
     */
    protected function uploadImage(Request $request): string
    {
        return $request->file('image')->store('courses', 'public');
    }

    /**
     * Delete existing image if it exists.
     */
    protected function deleteImage(?string $imagePath): void
    {
        if ($imagePath && Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }
    }


    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('dashboard.courses.index')->with('success', 'Course deleted successfully.');
    }


    private function slugGenerate($id = null)
    {
        $slug = Str::slug(request()->name);
        $counts = Course::where('slug', $slug)->when($id, function ($q) use ($id) {
            $q->where('id', '<>', $id);
        })->count();
        if (!empty($counts)) {
            $slug += "-" . $counts;
        }
        return $slug;
    }
}
