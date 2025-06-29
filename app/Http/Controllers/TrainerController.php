<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use App\Models\UserSocial;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    public function create()
    {
        $data['pageTitle'] = "Create trainer";
        $data['buttonText'] = "Save";
        $data['parentCategories'] = Category::orderBy('title', 'asc')->get();
        $data['trainer'] = [];
        $data['trainerSocialLinks'] = [];
        return view('admin.trainers.create', $data);
    }


    public function edit(User $trainer)
    {
        $trainer->load(['category'])->toArray();

        $data['buttonText'] = "Update";
        $data['trainer'] = $trainer;
        $data['pageTitle'] = "Edit User";
        $data['parentCategories'] = Category::orderBy('title', 'asc')->get();
        $data['trainerSocialLinks'] = $trainer->load(['social_links'])->toArray();
        return view('admin.trainers.edit', $data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'position' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',

            'social_name' => 'nullable|array',
            'social_name.*' => 'nullable|string|max:255',
            'link' => 'nullable|array',
            'link.*' => 'nullable|url|max:2048',
        ]);

        DB::beginTransaction();

        try {
            // Handle image upload with UUID
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $extension = $image->getClientOriginalExtension();
                $filename = Str::uuid() . '.' . $extension;
                $path = $image->storeAs('trainers', $filename, 'public');
                $validated['image'] = $path;
            }

            $validated['type'] = 'trainer';

            // Create the trainer
            $trainer = User::create($validated);

            // Save social links
            $platforms = $request->input('social_name', []);
            $urls = $request->input('link', []);
            foreach ($platforms as $index => $platform) {
                $url = $urls[$index] ?? null;

                if (!empty($platform) && !empty($url)) {
                    UserSocial::create([
                        'user_id' => $trainer->id,
                        'social_name' => $platform,
                        'link' => $url,
                    ]);
                }
            }

            DB::commit();

            return redirect()
                ->route('dashboard.trainers.index')
                ->with('success', 'Trainer created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            // Optionally delete uploaded image if rollback
            if (!empty($path)) {
                Storage::disk('public')->delete($path);
            }

            return redirect()
                ->back()
                ->withErrors(['error' => 'Something went wrong: ' . $e->getMessage()])
                ->withInput();
        }
    }

    /**
     * Display the specified trainer.
     */
    public function show(User $trainer)
    {
        return view('admin.trainers.show', compact('trainer'));
    }


    public function update(Request $request, User $trainer)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:users,email,' . $trainer->id,
            'position' => 'required|string|max:255',
            'social_name.*' => 'nullable|string',
            'link.*' => 'nullable|url',
            'category_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'status' => 'nullable|boolean',
        ]);

        // Process social links: combine social_name and link arrays
        $socialLinks = [];
        if ($request->has('social_name') && is_array($request->social_name)) {
            foreach ($request->social_name as $key => $socialName) {
                if (!empty($socialName) && !empty($request->link[$key])) {
                    $socialLinks[] = [
                        'name' => $socialName,
                        'link' => $request->link[$key],
                    ];
                }
            }
        }
        $validated['social_links'] = json_encode($socialLinks);


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
        $validated['status'] = $request->has('status');
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
