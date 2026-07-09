<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactDetail;
use Illuminate\Http\Request;

class ContactDetailController extends Controller
{
    /**
     * Show the edit form. Auto-creates the single row on first visit
     * so there's always exactly one record to edit.
     */
    public function edit()
    {
        $contactDetail = ContactDetail::first();

        if (!$contactDetail) {
            $contactDetail = ContactDetail::create([
                'location'         => '',
                'phone'            => '',
                'whatsapp_number'  => '',
                'email'            => '',
            ]);
        }

        return view('backend.contact.edit', compact('contactDetail'));
    }

    public function update(Request $request)
    {
        $contactDetail = ContactDetail::firstOrFail();

        $validated = $request->validate([
            'location'        => 'required|string|max:500',
            'phone'           => 'required|string|max:30',
            'whatsapp_number' => 'nullable|string|max:30',
            'email'           => 'required|email|max:255',
        ]);

        $contactDetail->update($validated);

        return redirect()
            ->route('admin.contact_details.edit')
            ->with('success', 'Contact details updated successfully.');
    }
}