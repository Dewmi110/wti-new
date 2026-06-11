<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class BlogController extends Controller
{
    public function index()
    {
        $items = Blog::orderByDesc('id')->paginate(20);

        return view('backend.blogs.index', compact('items'));
    }

    public function create()
    {
        return view('backend.blogs.create');
    }

    public function edit(Blog $blog)
    {
        return view('backend.blogs.edit', ['item' => $blog]);
    }

    public function store(Request $request)
    {
        Log::info('Blog store request', [
            'hasFile' => $request->hasFile('image'),
            'file_size' => $request->hasFile('image') ? $request->file('image')->getSize() : null,
            'file_original_name' => $request->hasFile('image') ? $request->file('image')->getClientOriginalName() : null,
        ]);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            // max is in kilobytes: 10240 KB = 10 MB
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
            'content' => 'nullable|string',
        ]);
        $data['status'] = $request->has('status') ? 1 : 0;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('blogs', 'public');
            $data['image'] = $path;
            Log::info('Blog image stored', ['path' => $path, 'action' => 'store']);
        }

        Blog::create($data);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog created successfully');
    }

    public function update(Request $request, Blog $blog)
    {
        Log::info('Blog update request', [
            'hasFile' => $request->hasFile('image'),
            'file_size' => $request->hasFile('image') ? $request->file('image')->getSize() : null,
            'file_original_name' => $request->hasFile('image') ? $request->file('image')->getClientOriginalName() : null,
        ]);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            // max is in kilobytes: 10240 KB = 10 MB
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
            'content' => 'nullable|string',
            'status' => 'nullable|in:0,1',
        ]);

        $data['status'] = $request->has('status') ? 1 : 0;

        if ($request->hasFile('image')) {
            // delete old image if present
            if ($blog->image) {
                Storage::disk('public')->delete($blog->image);
            }
            $data['image'] = $request->file('image')->store('blogs', 'public');
            Log::info('Blog image stored', ['path' => $data['image'], 'action' => 'update']);
        }

        $blog->update($data);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog updated successfully');
    }

    public function destroy(Blog $blog)
    {
        if ($blog->image) {
            Storage::disk('public')->delete($blog->image);
        }

        $blog->delete();

        return redirect()->route('admin.blogs.index')->with('success', 'Blog deleted successfully');
    }
}
