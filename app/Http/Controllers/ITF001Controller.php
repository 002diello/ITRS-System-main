<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RequestForm;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ITF001Controller extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return view('forms.itf001');
        }
        return view('forms.itf001-public');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'nric' => 'required|string',
            'date_of_birth' => 'nullable|date',
            'Gender' => 'nullable|string',
            'Nationality' => 'nullable|string',
            'Position' => 'nullable|string',
            'request_type' => 'nullable|array',
            'Add Access' => 'nullable|string',
            'Remarks/Other' => 'nullable|string',
        ]);

        $user = Auth::user();
        $referenceNumber = 'ITF001-' . strtoupper(Str::random(8));

        // Get department from form or user's department
        $department = $validated['department'] ?? (($user && $user->department) ? $user->department : 'IT');

        $requestForm = RequestForm::create([
            'reference_number' => $referenceNumber,
            'form_code' => 'ITF001',
            'form_title' => 'User ID Creation / Amendment / Deactivation',
            'user_id' => $user ? $user->id : null,
            'name' => $validated['name'],
            'department' => $department,
            'email' => $user ? $user->email : null,
            'phone' => null,
            'nric' => $validated['NRIC / Passport No'] ?? null,
            'request_data' => $validated,
            'status' => 'pending',
        ]);

        if ($user) {
            return redirect()->route('dashboard')->with('success', 'Request submitted successfully. Reference: ' . $referenceNumber);
        } else {
            return redirect()->route('home')->with('success', 'Request submitted successfully. Your reference number is: ' . $referenceNumber . '. Please save this for tracking.');
        }
    }
}
