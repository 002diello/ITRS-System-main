<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RequestForm;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Mail\RequestNotification;

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
            'email' => 'required|email',
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
        $department = 'Doctor';

        try {
            $requestForm = RequestForm::create([
                'reference_number' => $referenceNumber,
                'form_code' => 'ITF002',
                'form_title' => 'Doctor Registration',
                'user_id' => $user ? $user->id : null,
                'name' => $validated['name'],
                'department' => $department,
                'email' => $validated['email'],
                'phone' => $validated['mobile_number'] ?? null,
                'nric' => $validated['nric'] ?? null,
                'request_data' => $validated,
                'status' => 'pending',
            ]);

            // Send email notification to requester
            if ($requestForm->email) {
                Mail::to($requestForm->email)->send(
                    new RequestNotification($requestForm, 'submitted', 'Your doctor registration request has been submitted successfully.')
                );
            }

            // Send notification to HOD
            $hodEmails = User::whereHas('roles', function($query) {
                    $query->where('name', 'HOD');
                })
                ->where('department', $department)
                ->pluck('email')
                ->toArray();

            if (!empty($hodEmails)) {
                Mail::to($hodEmails)->send(
                    new RequestNotification($requestForm, 'pending', 'New doctor registration request requires your verification.')
                );
            }

            if ($user) {
                return redirect()->route('dashboard')->with('success', 'Doctor registration request submitted successfully. Reference: ' . $referenceNumber);
            } else {
                return redirect()->route('home')->with('success', 'Doctor registration request submitted successfully. Your reference number is: ' . $referenceNumber . '. Please save this for tracking.');
            }

        } catch (\Exception $e) {
            Log::error('Error in ITF002 form submission: ' . $e->getMessage(), [
                'exception' => $e,
                'trace' => $e->getTraceAsString()
            ]);

            return back()
                ->withInput()
                ->with('error', 'An error occurred while processing your request. Please try again.');
        }
    }
}