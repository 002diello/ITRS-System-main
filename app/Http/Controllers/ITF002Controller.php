<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RequestForm;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ITF002Controller extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return view('forms.itf002');
        }
        return view('forms.itf002-public');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nric' => 'required|string',
            'date_of_birth' => 'nullable|date',
            'mobile_number' => 'nullable|string',
            'email' => 'nullable|email',
            'Gender' => 'nullable|string',
            'Nationality' => 'nullable|string',
            'MMC Number' => 'nullable|string',
            'effective_date' => 'nullable|date',
            'Speciality' => 'nullable|string',
            'Grade Type' => 'nullable|string',
            'Clinic Room Number' => 'nullable|string',
            'new_min' => 'nullable|integer',
            'new_max' => 'nullable|integer',
            'new_default' => 'nullable|integer',
            'followup_min' => 'nullable|integer',
            'followup_max' => 'nullable|integer',
            'followup_default' => 'nullable|integer',
            'Remarks/Other' => 'nullable|string',
        ]);

        $user = Auth::user();
        $referenceNumber = 'ITF002-' . strtoupper(Str::random(8));

        // ITF002 Doctor Registration is always under Doctor department
        $department = 'Doctor';

        $requestForm = RequestForm::create([
            'reference_number' => $referenceNumber,
            'form_code' => 'ITF002',
            'form_title' => 'Doctor Registration',
            'user_id' => $user ? $user->id : null,
            'name' => $validated['name'],
            'department' => $department,
            'email' => $validated['email'] ?? null,
            'phone' => $validated['mobile_number'] ?? null,
            'nric' => $validated['NRIC / Passport No'] ?? null,
            'request_data' => $validated,
            'status' => 'pending',
        ]);

        // Debug information
        \Log::info('ITF002 Request Created', [
            'reference_number' => $referenceNumber,
            'request_id' => $requestForm->id,
            'user_id' => $user ? $user->id : null,
            'user_department' => $user ? $user->department : null,
            'request_department' => $department,
            'status' => $requestForm->status,
        ]);

        if ($user) {
            return redirect()->route('dashboard')->with('success', 'Request submitted successfully. Reference: ' . $referenceNumber);
        } else {
            return redirect()->route('home')->with('success', 'Request submitted successfully. Your reference number is: ' . $referenceNumber . '. Please save this for tracking.');
        }
    }
}
