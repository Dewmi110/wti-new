<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TourCategory;

class TourCategoryController extends Controller
{
    public function index()
    {
        $items = TourCategory::paginate(20);
        return view('backend.tour_categories.index', compact('items'));
    }

    public function create()
    {
        return view('backend.tour_categories.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate(['category_name' => 'required|string|max:255','status'=>'nullable|in:0,1']);
        TourCategory::create($data);
        return redirect()->route('admin.tour-categories.index')->with('success','Category created');
    }

    public function edit(TourCategory $tourCategory)
    {
        return view('backend.tour_categories.edit', ['item' => $tourCategory]);
    }

    public function update(Request $request, TourCategory $tourCategory)
    {
        $data = $request->validate(['category_name' => 'required|string|max:255','status'=>'nullable|in:0,1']);
        $tourCategory->update($data);
        return redirect()->route('admin.tour-categories.index')->with('success','Category updated');
    }

    public function destroy(TourCategory $tourCategory)
    {
        $tourCategory->delete();
        return redirect()->route('admin.tour-categories.index')->with('success','Category removed');
    }
}

