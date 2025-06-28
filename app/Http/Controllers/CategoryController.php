<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the categories.
     */
    public function index()
    {
        $data['pageTitle'] = "Categories";
        $data['categories'] = Category::with('parent')->latest()->paginate(10);
        return view('admin.categories.index', $data);
    }

    /**
     * Show the form for creating a new category.
     */
    public function create()
    {
        $data['pageTitle'] = "Category create";
        $data['parentCategories'] = Category::whereNull('parent_id')->get();
        $data['buttonText'] = "Save";
        return view('admin.categories.create', $data);
    }

    /**
     * Store a newly created category in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string'
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        Category::create($validated);

        return redirect()->route('dashboard.categories.index')->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified category.
     */
    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified category.
     */
    public function edit(Category $category)
    {
        $data['parentCategories'] = Category::whereNull('parent_id')->where('id', '!=', $category->id)->get();
        $data['buttonText'] = "Update";
        $data['category'] =  $category;
        return view('admin.categories.edit', $data);
    }

    /**
     * Update the specified category in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'status' => 'nullable',
        ]);

        // Normalize the status to a boolean (1 or 0)
        $validated['status'] = $request->has('status') ? 1 : 0;

        $category->update($validated);

        return redirect()->route('dashboard.categories.index')->with('success', 'Category updated successfully.');
    }


    /**
     * Remove the specified category from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('dashboard.categories.index')->with('success', 'Category deleted successfully.');
    }
}
