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
        'address'    => 'nullable|string|max:255',
        'country'    => 'required|string|max:100',
        'state'      => 'required_if:country,India|nullable|string|max:100',
        'city'       => 'required|string|max:100',
        'pincode'    => 'required|string|max:20',
        'mobile_number' => [
            'required','string','max:32',
            'regex:/^[0-9+\-\s()]{7,32}$/'
        ],
        'email'   => 'required|email|max:255',
        'gender'  => 'required|string|max:20',
        'marital_status' => 'nullable|string|max:30',
        'dob'     => 'required|date',
        'height'  => 'nullable|numeric|min:0|max:500',
        'weight'  => 'nullable|numeric|min:0|max:1000',
        'has_insurance' => 'nullable|in:Yes,No',
        'insurance_name' => 'required_if:has_insurance,Yes|nullable|string|max:100',
        'has_health_issue' => 'nullable|in:Yes,No',
        'health_issue_details' => 'nullable|string',
        'profession_type' => 'nullable|string|max:50',
        'referred_by' => 'nullable|string|max:100',
        'profession_description' => 'nullable|string|max:255',
        'business_name' => 'required_if:profession_type,Business|nullable|string|max:100',
        'business_details' => 'required_if:profession_type,Business|nullable|string',
        'registration_type' => 'required|string|in:Gym Membership,Online Training App Subscription',
        'terms' => 'accepted',
        'photo' => 'required|image|mimes:jpeg,png|max:5120',
    ]);

    // Normalize some fields:
    $validated['terms'] = $request->boolean('terms');  // "on" -> true/1

    // Clear state field if country is not India
    if ($validated['country'] !== 'India') {
        $validated['state'] = null;
    }

    // Clear insurance name if insurance is not "Yes"
    if ($validated['has_insurance'] !== 'Yes') {
        $validated['insurance_name'] = null;
    }

    // Clear business fields if profession is not "Business"
    if ($validated['profession_type'] !== 'Business') {
        $validated['business_name'] = null;
        $validated['business_details'] = null;
    }

    // Optional: turn lone "?" into null if your form sometimes sends it
    if (($validated['health_issue_details'] ?? null) === '?') {
        $validated['health_issue_details'] = null;
    }

    // Handle photo upload
    if ($request->hasFile('photo')) {
        $photo = $request->file('photo');
        $filename = uniqid('photo_').'.'.$photo->getClientOriginalExtension();
        $path = $photo->storeAs('photos', $filename, 'public');
        $validated['picture'] = $path;
    }

    \App\Models\Registration::create($validated);

    return redirect()->route('index')
        ->with('ok', 'Registration submitted successfully!');
}
}