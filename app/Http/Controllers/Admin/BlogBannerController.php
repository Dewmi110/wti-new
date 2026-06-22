<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogBanners = BlogBanner::latest()->get();

        return view('backend.image_slider.index', compact('blogBanners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.image_slider.create_blog_banner');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
        ]);

        $imagePath = $request->file('image')->store('blog_banners', 'public');

        BlogBanner::create([
            'banner_image' => $imagePath,
        ]);

        return redirect()->route('admin.blog_banners.index')
            ->with('success', 'Blog banner created successfully.');
    }

    public function edit(BlogBanner $blogBanner)
    {
        return view('backend.image_slider.edit_blog_banner', compact('blogBanner'));
    }

    public function update(Request $request, BlogBanner $blogBanner)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
        ]);

        // Delete the old image before storing the new one
        if ($blogBanner->banner_image) {
            Storage::disk('public')->delete($blogBanner->banner_image);
        }

        $imagePath = $request->file('image')->store('blog_banners', 'public');

        $blogBanner->update([
            'banner_image' => $imagePath,
        ]);

        return redirect()->route('admin.blog_banners.index')
            ->with('success', 'Blog banner updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BlogBanner $blogBanner)
    {
        if ($blogBanner->banner_image) {
            Storage::disk('public')->delete($blogBanner->banner_image);
        }

        $blogBanner->delete();

        return redirect()->route('admin.blog_banners.index')
            ->with('success', 'Blog banner deleted successfully.');
    }
}
