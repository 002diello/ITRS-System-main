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

// class ITF001Controller extends Controller
// {
//     public function index()
//     {
//         return Auth::check()
//             ? view('forms.itf001')
//             : view('forms.itf001-public');
//     }

//     public function store(Request $request)
//     {
//         $validated = $request->validate([
//             'name'               => 'required|string|max:255',
//             'email'              => 'required|email|max:255',
//             'department'         => 'required|string|max:255',
//             'nric'               => 'required|string',
//             'date_of_birth'      => 'nullable|date',
//             'Gender'             => 'nullable|string',
//             'Nationality'        => 'nullable|string',
//             'Position'           => 'nullable|string',
//             'request_type'       => 'nullable|array',
//             'Add Access'         => 'nullable|string',
//             'Remarks/Other'      => 'nullable|string',
//         ]);

//         $user = Auth::user();
//         $referenceNumber = 'ITF001-' . strtoupper(Str::random(8));

//         // Get department from form name
//         $dept = Department::where('name', $validated['department'])->firstOrFail();

//         $requestForm = RequestForm::create([
//             'reference_number' => $referenceNumber,
//             'form_code'        => 'ITF001',
//             'form_title'       => 'User ID Creation / Amendment / Deactivation',
//             'user_id'          => $user?->id,
//             'name'             => $validated['name'],
//             'department_id'    => $dept->id,
//             'department'       => $dept->name,           // keeps old column happy
//             'email'            => $validated['email'],
//             'request_data'     => $validated,
//             'status'           => 'pending',
//         ]);

//         // 1. ONLY HOD(s) of the selected department get email
//         $hodEmails = User::whereHas('role', fn($q) => $q->where('slug', 'hod'))
//             ->where('department_id', $dept->id)
//             ->pluck('email')
//             ->filter()
//             ->toArray();

//         if ($hodEmails) {
//             Mail::to($hodEmails)->queue(new RequestNotification(
//                 $requestForm,
//                 'pending',
//                 "New User ID Request needs your approval.\n\n" .
//                 "Name: {$requestForm->name}\n" .
//                 "Department: {$dept->name}\n" .
//                 "Reference: {$referenceNumber}\n\n" .
//                 "Please review and verify in the system."
//             ));
//         }

//         // 2. Requester gets confirmation (recommended)
//         Mail::to($requestForm->email)->queue(new RequestNotification(
//             $requestForm,
//             'submitted',
//             "Your User ID request has been submitted successfully!\n\n" .
//             "Reference: {$referenceNumber}\n" .
//             "Your HOD has been notified and will review it shortly."
//         ));

//         return redirect()
//             ->route($user ? 'dashboard' : 'home')
//             ->with('success', "Request submitted! Reference: {$referenceNumber}");
//     }
// }

//version 3
// class ITF001Controller extends Controller
// {
//     public function index()
//     {
//         return Auth::check()
//             ? view('forms.itf001')
//             : view('forms.itf001-public');
//     }

//     public function store(Request $request)
//     {
//         $validated = $request->validate([
//             'name' => 'required|string|max:255',
//             'email' => 'required|email|max:255',
//             'department' => 'required|string|max:255',
//             'nric' => 'required|string',
//             'date_of_birth' => 'nullable|date',
//             'Gender' => 'nullable|string',
//             'Nationality' => 'nullable|string',
//             'Position' => 'nullable|string',
//             'request_type' => 'nullable|array',
//             'Add Access' => 'nullable|string',
//             'Remarks/Other' => 'nullable|string',
//         ]);

//         $user = Auth::user();
//         $referenceNumber = 'ITF001-' . strtoupper(Str::random(8));
//         $department = Department::where('name', $validated['department'])->firstOrFail();

//         $requestForm = RequestForm::create([
//             'reference_number' => $referenceNumber,
//             'form_code' => 'ITF001',
//             'form_title' => 'User ID Creation / Amendment / Deactivation',
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

//         // Notify HODs of the department
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
//                 "New User ID request requires your approval.\n\n" .
//                 "Reference: {$referenceNumber}\n" .
//                 "Requester: {$validated['name']}\n" .
//                 "Department: {$department->name}\n\n" .
//                 "Please review in the system."
//             ));
//         }

//         // Notify requester
//         Mail::to($validated['email'])->queue(new RequestNotification(
//             $requestForm,
//             'submitted',
//             "Your User ID request has been submitted successfully!\n\n" .
//             "Reference: {$referenceNumber}\n" .
//             "Your HOD has been notified and will review it shortly."
//         ));

//         return redirect()
//             ->route($user ? 'dashboard' : 'home')
//             ->with('success', "Request submitted! Reference: {$referenceNumber}");
//     }
// }


class ITF001Controller extends Controller
{
    public function index()
    {
        return Auth::check()
            ? view('forms.itf001')
            : view('forms.itf001-public');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
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
        
        // Handle department (could be array or string)
        $departmentName = is_array($validated['department']) 
            ? $validated['department'][0] 
            : $validated['department'];
            
        $department = Department::where('name', $departmentName)->firstOrFail();

        $requestForm = RequestForm::create([
            'reference_number' => $referenceNumber,
            'form_code' => 'ITF001',
            'form_title' => 'User ID Creation / Amendment / Deactivation',
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

        // 1. Notify HODs of the department
        $hodEmails = User::whereHas('role', function($q) {
                $q->where('slug', 'hod');
            })
            ->where('department_id', $department->id)
            ->pluck('email')
            ->toArray();

        if (!empty($hodEmails)) {
            \Log::info('Sending new request notification to HODs', ['emails' => $hodEmails]);
            
            Mail::to($hodEmails)->queue(new RequestNotification(
                $requestForm,
                'new_request',
                "New User ID request requires your approval.\n\n" .
                "Reference: {$referenceNumber}\n" .
                "Requester: {$validated['name']}\n" .
                "Department: {$department->name}\n\n" .
                "Please review in the system."
            ));
        }

        // 2. Notify requester
        Mail::to($validated['email'])->queue(new RequestNotification(
            $requestForm,
            'submitted',
            "Your User ID request has been submitted successfully!\n\n" .
            "Reference: {$referenceNumber}\n" .
            "Your HOD has been notified and will review it shortly."
        ));

        return redirect()
            ->route($user ? 'dashboard' : 'home')
            ->with('success', "Request submitted! Reference: {$referenceNumber}");
    }
}