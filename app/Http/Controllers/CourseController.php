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
        $data['categories'] = Category::whereNotNull('parent_id')->get();
        $data['buttonText'] = "Save";
        return view('admin.courses.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
        ]);
        $course = new Course();
        $fillableData = $request->only($course->getFillable());
        $fillableData['slug'] = $this->slugGenerate();
        $course->create($fillableData);
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
        $request->validate([
            'name' => 'required|string|max:255',
            'details' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
        ]);
        $fillableData = $request->only($course->getFillable());
        $fillableData['slug'] = $this->slugGenerate($course->id);
        $course->update($fillableData);
        return redirect()->route('dashboard.courses.index')->with('success', 'Course updated successfully.');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('dashboard.courses.index')->with('success', 'Course deleted successfully.');
    }


    private function slugGenerate($id = null){
        $slug = Str::slug(request()->name);
        $counts = Course::where('slug',$slug)->when($id,function($q) use($id) {
            $q->where('id','<>', $id);
        })->count();
        if(!empty($counts)){
            $slug += "-".$counts;
        }
        return $slug;
    }
}
