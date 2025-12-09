<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RequestForm;
use App\Models\User;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\RequestNotification;

// class ITF002Controller extends Controller
// {
//     public function index()
//     {
//         return Auth::check()
//             ? view('forms.itf002')
//             : view('forms.itf002-public');
//     }

//     public function store(Request $request)
//     {
//         $validated = $request->validate([
//             'name'               => 'required|string|max:255',
//             'email'              => 'required|email|max:255',
//             'nric'               => 'required|string',
//             'date_of_birth'      => 'nullable|date',
//             'mobile_number'      => 'nullable|string',
//             'Gender'             => 'nullable|string',
//             'Nationality'        => 'nullable|string',
//             'MMC Number'         => 'nullable|string',
//             'effective_date'     => 'nullable|date',
//             'Speciality'         => 'nullable|string',
//             'Grade Type'         => 'nullable|string',
//             'Clinic Room Number' => 'nullable|string',
//             'Remarks/Other'      => 'nullable|string',
//         ]);

//         $user = Auth::user();
//         $referenceNumber = 'ITF002-' . strtoupper(Str::random(8));

//         $dept = Department::where('name', 'Doctor')->firstOrFail();

//         $requestForm = RequestForm::create([
//             'reference_number' => $referenceNumber,
//             'form_code'        => 'ITF002',
//             'form_title'       => 'Doctor Registration',
//             'user_id'          => $user?->id,
//             'name'             => $validated['name'],
//             'department_id'    => $dept->id,
//             'department'       => 'Doctor',
//             'email'            => $validated['email'],
//             'phone'            => $validated['mobile_number'] ?? null,
//             'nric'             => $validated['nric'],
//             'request_data'     => $validated,
//             'status'           => 'pending',
//         ]);

//         // 1. ONLY Doctor HOD(s) get notified
//         $hodEmails = User::whereHas('role', fn($q) => $q->where('slug', 'hod'))
//             ->where('department_id', $dept->id)
//             ->pluck('email')
//             ->filter()
//             ->toArray();

//         if ($hodEmails) {
//             Mail::to($hodEmails)->queue(new RequestNotification(
//                 $requestForm,
//                 'pending',
//                 "New Doctor Registration needs your approval.\n\n" .
//                 "Name: {$requestForm->name}\n" .
//                 "Speciality: {$validated['Speciality'] ?? 'N/A'}\n" .
//                 "Reference: {$referenceNumber}\n\n" .
//                 "Please review in the system."
//             ));
//         }

//         // 2. Requester gets confirmation
//         Mail::to($requestForm->email)->queue(new RequestNotification(
//             $requestForm,
//             'submitted',
//             "Your Doctor Registration has been submitted successfully!\n\n" .
//             "Reference: {$referenceNumber}\n" .
//             "Your HOD has been notified for approval."
//         ));

//         return redirect()
//             ->route($user ? 'dashboard' : 'home')
//             ->with('success', "Doctor registration submitted! Reference: {$referenceNumber}");
//     }
// }

//version 2
// class ITF002Controller extends Controller
// {
//     public function index()
//     {
//         return Auth::check()
//             ? view('forms.itf002')
//             : view('forms.itf002-public');
//     }

//     public function store(Request $request)
//     {
//         $validated = $request->validate([
//             'name' => 'required|string|max:255',
//             'email' => 'required|email|max:255',
//             'nric' => 'required|string',
//             'date_of_birth' => 'nullable|date',
//             'mobile_number' => 'nullable|string',
//             'Gender' => 'nullable|string',
//             'Nationality' => 'nullable|string',
//             'MMC Number' => 'nullable|string',
//             'effective_date' => 'nullable|date',
//             'Speciality' => 'nullable|string',
//             'Grade Type' => 'nullable|string',
//             'Clinic Room Number' => 'nullable|string',
//             'Remarks/Other' => 'nullable|string',
//         ]);

//         $user = Auth::user();
//         $referenceNumber = 'ITF002-' . strtoupper(Str::random(8));
//         $department = Department::where('name', 'Doctor')->firstOrFail();

//         $requestForm = RequestForm::create([
//             'reference_number' => $referenceNumber,
//             'form_code' => 'ITF002',
//             'form_title' => 'Doctor Registration',
//             'user_id' => $user ? $user->id : null,
//             'name' => $validated['name'],
//             'department_id' => $department->id,
//             'department' => $department->name,
//             'email' => $validated['email'],
//             'phone' => $validated['mobile_number'] ?? null,
//             'nric' => $validated['nric'] ?? null,
//             'request_data' => $validated,
//             'status' => 'pending',
//         ]);

//         // Notify HODs of the Doctor department
//         $hodEmails = User::whereHas('role', function($q) {
//                 $q->where('slug', 'hod');
//             })
//             ->where('department_id', $department->id)
//             ->pluck('email')
//             ->toArray();

//         if (!empty($hodEmails)) {
//             Mail::to($hodEmails)->queue(new RequestNotification(
//                 $requestForm,
//                 'new_request',
//                 "New Doctor Registration requires your approval.\n\n" .
//                 "Reference: {$referenceNumber}\n" .
//                 "Doctor: {$validated['name']}\n" .
//                 "Speciality: " . ($validated['Speciality'] ?? 'N/A') . "\n\n" .
//                 "Please review in the system."
//             ));
//         }

//         // Notify requester
//         Mail::to($validated['email'])->queue(new RequestNotification(
//             $requestForm,
//             'submitted',
//             "Your Doctor Registration has been submitted successfully!\n\n" .
//             "Reference: {$referenceNumber}\n" .
//             "The HOD has been notified and will review your registration shortly."
//         ));

//         return redirect()
//             ->route($user ? 'dashboard' : 'home')
//             ->with('success', "Doctor registration submitted! Reference: {$referenceNumber}");
//     }
// }


class ITF002Controller extends Controller
{
    public function index()
    {
        return Auth::check()
            ? view('forms.itf002')
            : view('forms.itf002-public');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'nric' => 'required|string',
            'date_of_birth' => 'nullable|date',
            'mobile_number' => 'nullable|string',
            'Gender' => 'nullable|string',
            'Nationality' => 'nullable|string',
            'MMC Number' => 'nullable|string',
            'effective_date' => 'nullable|date',
            'Speciality' => 'nullable|string',
            'Grade Type' => 'nullable|string',
            'Clinic Room Number' => 'nullable|string',
            'Remarks/Other' => 'nullable|string',
        ]);

        $user = Auth::user();
        $referenceNumber = 'ITF002-' . strtoupper(Str::random(8));
        $department = Department::where('name', 'Doctor')->firstOrFail();

        $requestForm = RequestForm::create([
            'reference_number' => $referenceNumber,
            'form_code' => 'ITF002',
            'form_title' => 'Doctor Registration',
            'user_id' => $user ? $user->id : null,
            'name' => $validated['name'],
            'department_id' => $department->id,
            'department' => $department->name,
            'email' => $validated['email'],
            'phone' => $validated['mobile_number'] ?? null,
            'nric' => $validated['nric'] ?? null,
            'request_data' => $validated,
            'status' => 'pending',
        ]);

        // 1. Notify HODs of the Doctor department
        $hodEmails = User::whereHas('role', function($q) {
                $q->where('slug', 'hod');
            })
            ->where('department_id', $department->id)
            ->pluck('email')
            ->toArray();

        if (!empty($hodEmails)) {
            \Log::info('Sending new doctor registration to HODs', ['emails' => $hodEmails]);
            
            Mail::to($hodEmails)->queue(new RequestNotification(
                $requestForm,
                'new_request',
                "New Doctor Registration requires your approval.\n\n" .
                "Reference: {$referenceNumber}\n" .
                "Doctor: {$validated['name']}\n" .
                "Speciality: " . ($validated['Speciality'] ?? 'N/A') . "\n\n" .
                "Please review in the system."
            ));
        }

        // 2. Notify requester
        Mail::to($validated['email'])->queue(new RequestNotification(
            $requestForm,
            'submitted',
            "Your Doctor Registration has been submitted successfully!\n\n" .
            "Reference: {$referenceNumber}\n" .
            "The HOD has been notified and will review your registration shortly."
        ));

        return redirect()
            ->route($user ? 'dashboard' : 'home')
            ->with('success', "Doctor registration submitted! Reference: {$referenceNumber}");
    }
}