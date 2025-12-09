<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RequestForm;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\RequestNotification;
use App\Models\User;

// class InProcessController extends Controller
// {
//     public function index()
//     {
//         /** @var \App\Models\User $user */
//         $user = Auth::user();

//         // Only IT HOD and Admin can access in-process requests
//         if (!$user->isHODIT() && !$user->isAdmin()) {
//             abort(403, 'Only IT HOD can access this page');
//         }

//         // Show requests that are verified by HOD but not yet approved by HOD IT
//         $requests = RequestForm::with(['user', 'hodVerifier', 'assignedUser'])
//             ->where('status', 'verified_hod')
//             ->latest()
//             ->get();

//         return view('in-process', compact('requests'));
//     }

//     public function approve($id)
//     {
//         $request = RequestForm::findOrFail($id);
//         /** @var \App\Models\User $user */
//         $user = Auth::user();

//         if (!$user->isHODIT() && !$user->isAdmin()) {
//             abort(403, 'Only HOD IT or Admin can approve requests');
//         }

//         if ($request->status === 'verified_hod') {
//             $request->update([
//                 'status' => 'approved',
//                 'approved_at' => now(),
//                 'approved_by' => $user->id,
//             ]);

//             return redirect()
//                 ->route('in.process')
//                 ->with('success', 'Request approved successfully.');
//         }

//         return redirect()->back()->with('error', 'Unable to approve this request.');
//     }

//     public function reject($id, Request $request)
//     {
//         $requestForm = RequestForm::findOrFail($id);
//         /** @var \App\Models\User $user */
//         $user = Auth::user();

//         if (!$user->isHODIT() && !$user->isAdmin()) {
//             abort(403, 'Only HOD IT or Admin can reject requests');
//         }

//         $requestForm->update([
//             'status' => 'rejected',
//             'rejected_at' => now(),
//             'rejected_by' => $user->id,
//             'rejection_reason' => $request->input('reason', 'No reason provided'),
//         ]);

//         return redirect()
//             ->route('in.process')
//             ->with('success', 'Request rejected successfully.');
//     }
// }


//second version

// class InProcessController extends Controller
// {
//     public function index()
//     {
//         $user = Auth::user();

//         if (!$user->isHODIT() && !$user->isAdmin()) {
//             abort(403, 'Only IT HOD can access this page');
//         }

//         $requests = RequestForm::with(['user', 'hodVerifier', 'assignedUser'])
//             ->where('status', 'verified_hod')
//             ->latest()
//             ->get();

//         return view('in-process', compact('requests'));
//     }

//     public function approve($id)
//     {
//         $requestForm = RequestForm::findOrFail($id);
//         $user = Auth::user();

//         if (!$user->isHODIT() && !$user->isAdmin()) {
//             abort(403);
//         }

//         $requestForm->update([
//             'status'      => 'approved',
//             'approved_at' => now(),
//             'approved_by' => $user->id,
//         ]);

//         // THIS WILL WORK — SAME AS TINKER
//         if ($requestForm->email) {
//             Mail::to($requestForm->email)->queue(new RequestNotification(
//                 $requestForm,
//                 'approved',
//                 "Great news! Your request has been fully approved by IT and will be processed soon.\n\nReference: {$requestForm->reference_number}"
//             ));
//         }

//         return back()->with('success', 'Request approved. Email sent to requester.');
//     }

//     public function reject($id, Request $request)
//     {
//         $requestForm = RequestForm::findOrFail($id);
//         $user = Auth::user();

//         if (!$user->isHODIT() && !$user->isAdmin()) {
//             abort(403);
//         }

//         $reason = $request->validate(['reason' => 'required|string|max:1000'])['reason'];

//         $requestForm->update([
//             'status'           => 'rejected',
//             'rejected_at'      => now(),
//             'rejected_by'      => $user->id,
//             'rejection_reason' => $reason,
//         ]);

//         if ($requestForm->email) {
//             Mail::to($requestForm->email)->queue(new RequestNotification(
//                 $requestForm,
//                 'rejected',
//                 "Your request was rejected by IT.\n\nReason: {$reason}"
//             ));
//         }

//         return back()->with('success', 'Request rejected. Email sent to requester.');
//     }
// }


class InProcessController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user->isHODIT() && !$user->isAdmin()) {
            abort(403, 'Only IT HOD can access this page');
        }

        $requests = RequestForm::with(['user', 'hodVerifier', 'assignedUser'])
            ->where('status', 'verified_hod')
            ->latest()
            ->get();

        return view('in-process', compact('requests'));
    }

    // IT HOD APPROVES → Requester + ALL IT Staff
    public function approve($id)
    {
        $requestForm = RequestForm::findOrFail($id);
        $user = Auth::user();

        if (!$user->isHODIT() && !$user->isAdmin()) {
            abort(403);
        }

        $requestForm->update([
            'status'      => 'approved',
            'approved_at' => now(),
            'approved_by' => $user->id,
        ]);

        // Notify requester
        Mail::to($requestForm->email)->queue(new RequestNotification(
            $requestForm,
            'approved',
            "Your request has been approved by IT HOD and is now in the queue for processing.\n\n" .
            "Reference: {$requestForm->reference_number}"
        ));

        // Notify all IT staff
        $itStaffEmails = User::whereHas('role', function($q) {
                $q->where('slug', 'it-staff');
            })
            ->pluck('email')
            ->toArray();

        if (!empty($itStaffEmails)) {
            Mail::to($itStaffEmails)->queue(new RequestNotification(
                $requestForm,
                'new_assignment',
                "New approved request requires assignment.\n\n" .
                "Reference: {$requestForm->reference_number}\n" .
                "Request Type: {$requestForm->form_title}\n" .
                "Department: {$requestForm->department}\n\n" .
                "Please assign or take action in the system."
            ));
        }

        return back()->with('success', 'Request approved and IT staff have been notified.');
    }

    // IT HOD REJECTS → Requester only
    public function reject($id, Request $request)
    {
        $requestForm = RequestForm::findOrFail($id);
        $user = Auth::user();

        if (!$user->isHODIT() && !$user->isAdmin()) {
            abort(403);
        }

        $reason = $request->validate(['reason' => 'required|string|max:1000'])['reason'];

        $requestForm->update([
            'status'           => 'rejected',
            'rejected_at'      => now(),
            'rejected_by'      => $user->id,
            'rejection_reason' => $reason,
        ]);

        // Only requester gets email
        Mail::to($requestForm->email)->queue(new RequestNotification(
            $requestForm,
            'rejected',
            "Your request was rejected by IT HOD.\n\nReason: {$reason}"
        ));

        return back()->with('success', 'Request rejected. Requester notified.');
    }
}