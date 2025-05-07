<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TrainerController extends Controller
{
    /**
     * Display a listing of the trainers.
     */
    public function index()
    {
        $data['pageTitle'] = "Trainers";
        $data['trainers'] = User::with(['category'])->where('type', 'trainer')->latest()->paginate(10);
        return view('admin.trainers.index', $data);
    }

    /**
     * Show the form for creating a new trainer.
     */
    public function create()
    {
        $data['pageTitle'] = "Create User";
        $data['buttonText'] = "Save";
        $data['parentCategories'] = Category::orderBy('title','asc')->get();
        return view('admin.trainers.create', $data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|string|max:255',
            'social_links' => 'nullable|array',
            'category_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // Handle image upload with UUID
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $filename = Str::uuid() . '.' . $extension;
            $path = $image->storeAs('trainers', $filename, 'public');
            $validated['image'] = $path;
        }
        $validated['type'] = "trainer";
        User::create($validated);
        return redirect()->route('dashboard.trainers.index')->with('success', 'Trainer created successfully.');
    }


    /**
     * Display the specified trainer.
     */
    public function show(User $trainer)
    {
        return view('admin.trainers.show', compact('trainer'));
    }

    /**
     * Show the form for editing the specified trainer.
     */
    public function edit(User $trainer)
    {
        $data['buttonText'] = "Update";
        $data['trainer'] = $trainer;
        $data['pageTitle'] = "Edit User";
        $data['parentCategories'] = Category::orderBy('title','asc')->get();
        return view('admin.trainers.edit', $data);
    }



    public function update(Request $request, User $trainer)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:users,email,' . $trainer->id,
            'social_links' => 'nullable|array',
            'category_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'status' => 'nullable',
        ]);

        // Handle social_links if stored as JSON
        if ($request->has('social_links')) {
            $validated['social_links'] = json_encode($request->social_links);
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($trainer->image && Storage::disk('public')->exists($trainer->image)) {
                Storage::disk('public')->delete($trainer->image);
            }

            $image = $request->file('image');
            $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('trainers', $filename, 'public');
            $validated['image'] = $path;
        }

        // Checkbox handling
        $validated['status'] = $request->has('status') ? 1 : 0;

        // Update trainer
        $trainer->fill($validated)->save();

        return redirect()->route('dashboard.trainers.index')->with('success', 'Trainer updated successfully.');
    }


    /**
     * Remove the specified trainer from storage.
     */
    public function destroy(User $trainer)
    {
        $trainer->delete();
        return redirect()->route('dashboard.trainers.index')->with('success', 'Trainer deleted successfully.');
    }
}
