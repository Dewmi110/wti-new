<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TourType;

class TourTypeController extends Controller
{
    public function index()
    {
        $items = TourType::paginate(20);
        return view('backend.tour_types.index', compact('items'));
    }

    public function create()
    {
        return view('backend.tour_types.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate(['type_name' => 'required|string|max:255','status'=>'nullable|in:0,1']);
        TourType::create($data);
        return redirect()->route('admin.tour-types.index')->with('success','Type created');
    }

    public function edit(TourType $tourType)
    {
        return view('backend.tour_types.edit', ['item' => $tourType]);
    }

    public function update(Request $request, TourType $tourType)
    {
        $data = $request->validate(['type_name' => 'required|string|max:255','status'=>'nullable|in:0,1']);
        $tourType->update($data);
        return redirect()->route('admin.tour-types.index')->with('success','Type updated');
    }

    public function destroy(TourType $tourType)
    {
        $tourType->delete();
        return redirect()->route('admin.tour-types.index')->with('success','Type removed');
    }
}

