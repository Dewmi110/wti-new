<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogSlider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogSliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = BlogSlider::all();

        return view('backend.image_slider.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.image_slider.create_blog_slider');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
        'image'       => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    if ($request->hasFile('image')) {
        $validated['image_path'] = $request->file('image')->store('sliders', 'public');
    }

    BlogSlider::create($validated);

    return redirect()->route('admin.blog_sliders.index')  // was: admin.blog-sliders.index
        ->with('success', 'Blog slider created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BlogSlider $blogSlider)
    {
        return view('backend.image_slider.edit_blog_slider', compact('blogSlider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BlogSlider $blogSlider)
    {
        $validated = $request->validate([
        'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    if ($request->hasFile('image')) {
        if ($blogSlider->image_path && \Storage::disk('public')->exists($blogSlider->image_path)) {
            \Storage::disk('public')->delete($blogSlider->image_path);
        }
        $validated['image_path'] = $request->file('image')->store('sliders', 'public');
    }

    $blogSlider->update($validated);

    return redirect()->route('admin.blog_sliders.index')  // was: admin.blog-sliders.index
        ->with('success', 'Blog slider updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BlogSlider $blogSlider)
    {
         if ($blogSlider->image_path && \Storage::disk('public')->exists($blogSlider->image_path)) {
        \Storage::disk('public')->delete($blogSlider->image_path);
    }

    $blogSlider->delete();

    return redirect()->route('admin.blog_sliders.index')  // was: admin.blog-sliders.index
        ->with('success', 'Blog slider deleted successfully.');
    }
}
