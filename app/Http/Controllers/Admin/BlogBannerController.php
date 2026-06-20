<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogBannerController extends Controller
{
    /**
     * Show the form for selecting a blog and uploading its banner.
     */
    public function create()
    {
        $blogs = Blog::orderBy('title')->get();

        return view('backend.image_slider.create_blog_banner', compact('blogs'));
    }

    /**
     * Store (update) the banner_image on the selected blog.
     */
    public function store(Request $request)
    {
        $request->validate([
            'blog_id' => 'required|exists:blogs,id',
            'image'   => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
        ]);

        $blog = Blog::findOrFail($request->blog_id);

        // Delete old banner image if one exists
        if ($blog->banner_image) {
            Storage::disk('public')->delete($blog->banner_image);
        }

        $imagePath = $request->file('image')->store('blog_banners', 'public');

        $blog->update([
            'banner_image' => $imagePath,
        ]);

        return redirect()->route('admin.image-sliders.index')
            ->with('success', 'Blog banner saved successfully.');
    }
}
