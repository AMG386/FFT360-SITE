<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{


    public function create()
{
    // You can pass brand colors, logo path, etc. if you want
    return view('registrations.create');
}

    public function store(Request $request)
{
    $validated = $request->validate([
        'first_name' => 'required|string|max:100',
        'last_name'  => 'required|string|max:100',
        'address'    => 'required|string|max:255',
        'mobile_number' => [
            'required','string','max:32',
            'regex:/^[0-9+\-\s()]{7,32}$/'
        ],
        'email'   => 'required|email|max:255',
        'gender'  => 'required|string|max:20',
        'dob'     => 'required|date',
        'height'  => 'nullable|numeric|min:0|max:500',
        'weight'  => 'nullable|numeric|min:0|max:1000',
        'has_insurance' => 'nullable|in:Yes,No',
        'has_health_issue' => 'nullable|in:Yes,No',
        'health_issue_details' => 'nullable|string',
        'profession_type' => 'nullable|string|max:50',
        'referred_by' => 'nullable|string|max:100',
        'profession_description' => 'nullable|string|max:255',
        'business_name' => 'nullable|string|max:100',
        'business_details' => 'nullable|string',
        'registration_type' => 'required|string|in:Gym Membership,Online Training App Subscription',
        'terms' => 'accepted',
    ]);

    // Normalize some fields:
    $validated['terms'] = $request->boolean('terms');  // "on" -> true/1
    // Optional: turn lone "?" into null if your form sometimes sends it
    if (($validated['health_issue_details'] ?? null) === '?') {
        $validated['health_issue_details'] = null;
    }

    \App\Models\Registration::create($validated);

    return redirect()->route('index')
        ->with('ok', 'Registration submitted successfully!');
}
}