<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TourTheme;

class TourThemeController extends Controller
{
    public function index()
    {
        $items = TourTheme::paginate(20);
        return view('backend.tour_themes.index', compact('items'));
    }

    public function create()
    {
        return view('backend.tour_themes.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate(['theme_name' => 'required|string|max:255','status'=>'nullable|in:0,1']);
        TourTheme::create($data);
        return redirect()->route('admin.tour-themes.index')->with('success','Theme created');
    }

    public function edit(TourTheme $tourTheme)
    {
        return view('backend.tour_themes.edit', ['item' => $tourTheme]);
    }

    public function update(Request $request, TourTheme $tourTheme)
    {
        $data = $request->validate(['theme_name' => 'required|string|max:255','status'=>'nullable|in:0,1']);
        $tourTheme->update($data);
        return redirect()->route('admin.tour-themes.index')->with('success','Theme updated');
    }

    public function destroy(TourTheme $tourTheme)
    {
        $tourTheme->delete();
        return redirect()->route('admin.tour-themes.index')->with('success','Theme removed');
    }
}

