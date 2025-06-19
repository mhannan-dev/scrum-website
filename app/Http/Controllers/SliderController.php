<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index()
    {
        $data['pageTitle'] = "Sliders";
        $data['items'] = Slider::latest()->paginate(3);
        return view('admin.sliders.index', $data);
    }

    public function create()
    {
        $data['pageTitle'] = "Create Slider";
        $data['buttonText'] = "Save";
        return view('admin.sliders.create', $data);
    }


    public function show(Slider $slider)
    {
        return view('admin.sliders.show', compact('slider'));
    }

    public function edit(Slider $slider)
    {
        $data['slider'] = $slider;
        $data['pageTitle'] = "Edit slider";
        $data['buttonText'] = "Update";
        return view('admin.sliders.edit', $data);
    }

    public function store(Request $request)
    {
        $validated = $this->validateSlider($request);

        if ($request->hasFile('image')) {
            $validated['image'] = $this->uploadImage($request);
        }

        Slider::create($validated);

        return redirect()->route('dashboard.slider.index')->with('success', 'Slider created successfully.');
    }

    public function update(Request $request, Slider $slider)
    {
        $validated = $this->validateSlider($request, $slider->id);

        if ($request->hasFile('image')) {
            $this->deleteImage($slider->image);
            $validated['image'] = $this->uploadImage($request);
        }

        $slider->update($validated);

        return redirect()->route('dashboard.slider.index')->with('success', 'Slider updated successfully.');
    }

    /**
     * Validate slider request data.
     */
    protected function validateSlider(Request $request, $sliderId = null): array
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'top_button_text' => 'nullable|string|max:255',
            // 'big_button' => 'nullable|string|max:255',
            'main_button_text' => 'nullable|string|max:255',
            'main_button_link' => 'nullable|url|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:0,1',
            'image' => $sliderId
                ? 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
                : 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);
    }



    /**
     * Handle image upload.
     */
    protected function uploadImage(Request $request): string
    {
        return $request->file('image')->store('items', 'public');
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


    public function destroy(Slider $slider)
    {
        $slider->delete();
        return redirect()->route('dashboard.slider.index')->with('success', 'Slider deleted successfully.');
    }


    private function slugGenerate($id = null)
    {
        $slug = Str::slug(request()->name);
        $counts = Slider::where('slug', $slug)->when($id, function ($q) use ($id) {
            $q->where('id', '<>', $id);
        })->count();
        if (!empty($counts)) {
            $slug += "-" . $counts;
        }
        return $slug;
    }
}
