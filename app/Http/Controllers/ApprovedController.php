<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RequestForm;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\RequestNotification;

// class ApprovedController extends Controller
// {
//     // HOD IT views requests that need second level approval
//     public function index()
//     {
//         $user = Auth::user();
//         $query = RequestForm::with(['user', 'assignedUser']);

//         // HOD IT sees requests verified by HOD
//         if ($user->isHODIT()) {
//             $query->where('status', 'verified_hod');
//         }

//         $requests = $query->latest()->get();

//         return view('approved.index', compact('requests'));
//     }

//     // HOD IT or Admin approves request (second level)
//     public function approve($id)
//     {
//         $request = RequestForm::findOrFail($id);
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

//             return redirect()->back()->with('success', 'Request approved successfully.');
//         }

//         return redirect()->back()->with('error', 'Unable to approve this request.');
//     }

//     // View unassigned approved requests
//     public function unassign()
//     {
//         $user = Auth::user();

//         // IT Staff and HOD IT can view unassigned requests
//         if (!$user->isITStaff() && !$user->isHODIT() && !$user->isAdmin()) {
//             abort(403, 'Unauthorized access');
//         }

//         $requests = RequestForm::with(['user'])
//             ->where('status', 'approved')
//             ->whereNull('assigned_to')
//             ->latest()
//             ->get();

//         $itStaff = User::whereHas('role', function($query) {
//             $query->where('slug', 'it-staff');
//         })->get();

//         //return view('approved.unassign', compact('requests', 'itStaff'));
//         return view('unassign', compact('requests', 'itStaff'));
//     }

//     // View requests assigned to current user
//     public function assignToMe()
//     {
//         $user = Auth::user();

//         if (!$user->isITStaff()) {
//             abort(403, 'Only IT Staff can view their assignments');
//         }

//         $requests = RequestForm::with(['user'])
//             ->where('assigned_to', $user->id)
//             ->latest()
//             ->get();

//         return view('approved.assign-to-me', compact('requests'));
//     }

// public function assignToOthers()
//     {
//         $user = Auth::user();

//         if (!$user->isITStaff() && !$user->isHODIT() && !$user->isAdmin()) {
//             abort(403, 'Unauthorized access');
//         }

//         $requests = RequestForm::with(['user', 'assignedUser'])
//             ->where('status', 'approved')
//             ->whereNotNull('assigned_to')
//             ->latest()
//             ->get();

//         return view('approved.assign-to-others', compact('requests'));
//     }

//     // Assign request to IT staff (individual - keep for backward compatibility)
//     public function assign(Request $request, $id)
//     {
//         $user = Auth::user();
//         $requestForm = RequestForm::findOrFail($id);

//         // IT Staff can assign to themselves, HOD IT can assign to anyone
//         if (!$user->isITStaff() && !$user->isHODIT() && !$user->isAdmin()) {
//             abort(403, 'Unauthorized access');
//         }

//         $assignToId = $request->input('assign_to');

//         // IT Staff can only assign to themselves
//         if ($user->isITStaff() && $assignToId != $user->id) {
//             abort(403, 'IT Staff can only assign requests to themselves');
//         }

// $requestForm->update([
//             'assigned_to' => $assignToId,
//             'assigned_at' => now(),
//         ]);

//         // Redirect based on assignment
//         if ($assignToId == $user->id) {
//             // If assigned to self, go to "Assign to Me" page
//             return redirect()->route('approved.assign.to.me')->with('success', 'Request assigned to you successfully.');
//         } else {
//             // If assigned to someone else, go to "Assign to Others" page
//             return redirect()->route('approved.assign.to.others')->with('success', 'Request assigned successfully.');
//         }
//     }

//     // Bulk assign multiple requests to IT staff
//     public function bulkAssign(Request $request)
//     {
//         $user = Auth::user();

//         // Only HOD IT and Admin can do bulk assignment
//         if (!$user->isHODIT() && !$user->isAdmin()) {
//             abort(403, 'Unauthorized access');
//         }

//         $requestIds = $request->input('request_ids', []);
//         $assignToId = $request->input('assign_to');

//         if (empty($requestIds) || empty($assignToId)) {
//             return redirect()->back()->with('error', 'Please select requests and an IT staff member.');
//         }

//         $updatedCount = RequestForm::whereIn('id', $requestIds)
//             ->where('status', 'approved')
//             ->whereNull('assigned_to')
//             ->update([
//                 'assigned_to' => $assignToId,
//                 'assigned_at' => now(),
//             ]);

//         if ($updatedCount > 0) {
//             return redirect()->back()->with('success', "Successfully assigned {$updatedCount} request(s).");
//         }

//         //return redirect()->back()->with('error', 'No requests were assigned.');
//         // No redirect
//     }

//     // Complete request
//     public function complete($id, Request $request)
//     {
//         $user = Auth::user();
//         $requestForm = RequestForm::findOrFail($id);

//         // Only assigned IT staff can complete
//         if ($requestForm->assigned_to != $user->id && !$user->isAdmin()) {
//             abort(403, 'Only assigned IT staff can complete this request');
//         }

//         $requestForm->update([
//             'status' => 'completed',
//             'completed_at' => now(),
//             'completion_notes' => $request->input('notes', ''),
//         ]);

//         return redirect()->back()->with('success', 'Request marked as completed.');
//     }
// }


//second version
// class ApprovedController extends Controller
// {
//     public function index()
//     {
//         $user = Auth::user();

//         $query = RequestForm::with(['user', 'assignedUser']);

//         if ($user->isHODIT()) {
//             $query->where('status', 'verified_hod');
//         }

//         $requests = $query->latest()->get();

//         return view('approved.index', compact('requests'));
//     }

//     // FINAL APPROVAL BY IT HOD / ADMIN
//     public function approve($id)
//     {
//         $requestForm = RequestForm::findOrFail($id);
//         $user = Auth::user();

//         if (!$user->isHODIT() && !$user->isAdmin()) {
//             abort(403, 'Only HOD IT or Admin can approve requests');
//         }

//         if ($requestForm->status !== 'verified_hod') {
//             return back()->with('error', 'This request is not ready for final approval.');
//         }

//         $requestForm->update([
//             'status'       => 'approved',
//             'approved_at'  => now(),
//             'approved_by'  => $user->id,
//         ]);

//         // EMAIL TO REQUESTER — FULLY APPROVED
//         if ($requestForm->email) {
//             Mail::to($requestForm->email)->queue(
//                 new RequestNotification(
//                     $requestForm,
//                     'approved',
//                     "Congratulations! Your request has been fully approved by IT and is now ready for processing.\n\nReference: {$requestForm->reference_number}"
//                 )
//             );
//         }

//         return back()->with('success', 'Request fully approved. Requester has been notified.');
//     }

//     public function unassign()
//     {
//         $user = Auth::user();

//         if (!$user->isITStaff() && !$user->isHODIT() && !$user->isAdmin()) {
//             abort(403, 'Unauthorized access');
//         }

//         $requests = RequestForm::with(['user'])
//             ->where('status', 'approved')
//             ->whereNull('assigned_to')
//             ->latest()
//             ->get();

//         $itStaff = User::whereHas('role', fn($q) => $q->where('slug', 'it-staff'))->get();

//         return view('unassign', compact('requests', 'itStaff'));
//     }

//     public function assignToMe()
//     {
//         $user = Auth::user();

//         if (!$user->isITStaff()) {
//             abort(403, 'Only IT Staff can view their assignments');
//         }

//         $requests = RequestForm::with(['user'])
//             ->where('assigned_to', $user->id)
//             ->latest()
//             ->get();

//         return view('approved.assign-to-me', compact('requests'));
//     }

//     public function assignToOthers()
//     {
//         $user = Auth::user();

//         if (!$user->isITStaff() && !$user->isHODIT() && !$user->isAdmin()) {
//             abort(403, 'Unauthorized access');
//         }

//         $requests = RequestForm::with(['user', 'assignedUser'])
//             ->where('status', 'approved')
//             ->whereNotNull('assigned_to')
//             ->latest()
//             ->get();

//         return view('approved.assign-to-others', compact('requests'));
//     }

//     // ASSIGN REQUEST TO IT STAFF
//     public function assign(Request $request, $id)
//     {
//         $user = Auth::user();
//         $requestForm = RequestForm::findOrFail($id);

//         if (!$user->isITStaff() && !$user->isHODIT() && !$user->isAdmin()) {
//             abort(403, 'Unauthorized access');
//         }

//         $assignToId = $request->input('assign_to');

//         // IT Staff can only assign to themselves
//         if ($user->isITStaff() && $assignToId != $user->id) {
//             abort(403, 'IT Staff can only assign requests to themselves');
//         }

//         $assignedUser = User::findOrFail($assignToId);

//         $requestForm->update([
//             'assigned_to' => $assignToId,
//             'assigned_at' => now(),
//             'status'      => 'in_progress', // optional: mark as in progress
//         ]);

//         // EMAIL TO REQUESTER — ASSIGNED
//         if ($requestForm->email) {
//             Mail::to($requestForm->email)->queue(
//                 new RequestNotification(
//                     $requestForm,
//                     'assigned',
//                     "Your request has been assigned to {$assignedUser->name} and is now in progress.\n\nReference: {$requestForm->reference_number}"
//                 )
//             );
//         }

//         $route = ($assignToId == $user->id)
//             ? 'approved.assign.to.me'
//             : 'approved.assign.to.others';

//         return redirect()->route($route)
//             ->with('success', "Request successfully assigned to {$assignedUser->name}. Requester notified.");
//     }

//     public function bulkAssign(Request $request)
//     {
//         $user = Auth::user();

//         if (!$user->isHODIT() && !$user->isAdmin()) {
//             abort(403, 'Unauthorized access');
//         }

//         $requestIds = $request->input('request_ids', []);
//         $assignToId = $request->input('assign_to');

//         if (empty($requestIds) || empty($assignToId)) {
//             return back()->with('error', 'Please select requests and an IT staff member.');
//         }

//         $assignedUser = User::findOrFail($assignToId);

//         $updatedCount = RequestForm::whereIn('id', $requestIds)
//             ->where('status', 'approved')
//             ->whereNull('assigned_to')
//             ->update([
//                 'assigned_to' => $assignToId,
//                 'assigned_at' => now(),
//                 'status'      => 'in_progress',
//             ]);

//         if ($updatedCount > 0) {
//             // Optional: send one email per request
//             $assignedRequests = RequestForm::whereIn('id', $requestIds)->get();
//             foreach ($assignedRequests as $req) {
//                 if ($req->email) {
//                     Mail::to($req->email)->queue(
//                         new RequestNotification($req, 'assigned', "Your request has been assigned to {$assignedUser->name}.")
//                     );
//                 }
//             }

//             return back()->with('success', "Successfully assigned {$updatedCount} request(s). Requesters notified.");
//         }

//         return back()->with('error', 'No valid requests were assigned.');
//     }

//     // MARK AS COMPLETED
//     public function complete($id, Request $request)
//     {
//         $user = Auth::user();
//         $requestForm = RequestForm::findOrFail($id);

//         if ($requestForm->assigned_to != $user->id && !$user->isAdmin()) {
//             abort(403, 'Only the assigned IT staff can complete this request');
//         }

//         $requestForm->update([
//             'status'           => 'completed',
//             'completed_at'     => now(),
//             'completed_by'     => $user->id,
//             'completion_notes' => $request->input('notes', ''),
//         ]);

//         // EMAIL TO REQUESTER — COMPLETED
//         if ($requestForm->email) {
//             Mail::to($requestForm->email)->queue(
//                 new RequestNotification(
//                     $requestForm,
//                     'completed',
//                     "Great news! Your request has been successfully completed by the IT team.\n\nReference: {$requestForm->reference_number}\n\nThank you!"
//                 )
//             );
//         }

//         return back()->with('success', 'Request marked as completed. Requester has been notified.');
//     }
// }


class ApprovedController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $query = RequestForm::with(['user', 'assignedUser']);

        if ($user->isHODIT()) {
            $query->where('status', 'verified_hod');
        }

        $requests = $query->latest()->get();

        return view('approved.index', compact('requests'));
    }

    // IT HOD FINAL APPROVAL → Requester + ALL IT Staff
    public function approve($id)
    {
        $requestForm = RequestForm::findOrFail($id);
        $user = Auth::user();

        if (!$user->isHODIT() && !$user->isAdmin()) {
            abort(403, 'Only IT HOD or Admin can approve');
        }

        if ($requestForm->status !== 'verified_hod') {
            return back()->with('error', 'Not ready for approval.');
        }

        $requestForm->update([
            'status'       => 'approved',
            'approved_at'  => now(),
            'approved_by'  => $user->id,
        ]);

        // 1. Notify requester
        Mail::to($requestForm->email)->queue(new RequestNotification(
            $requestForm,
            'approved',
            "Congratulations! Your request has been fully approved by IT HOD.\n\nReference: {$requestForm->reference_number}\nIt will now be assigned to an IT staff member."
        ));

        // 2. Notify ALL IT Staff
        $itStaffEmails = User::whereHas('role', fn($q) => $q->where('slug', 'it'))
            ->orWhereHas('role', fn($q) => $q->where('slug', 'it-staff'))
            ->pluck('email')
            ->filter()
            ->toArray();

        if ($itStaffEmails) {
            Mail::to($itStaffEmails)->queue(new RequestNotification(
                $requestForm,
                'approved',
                "New approved request ready for assignment!\n\nReference: {$requestForm->reference_number}\nName: {$requestForm->name}\nDepartment: {$requestForm->department}"
            ));
        }

        return back()->with('success', 'Request approved. Requester and IT staff notified.');
    }

    public function unassign()
    {
        $user = Auth::user();

        if (!$user->isITStaff() && !$user->isHODIT() && !$user->isAdmin()) {
            abort(403);
        }

        $requests = RequestForm::with(['user'])
            ->where('status', 'approved')
            ->whereNull('assigned_to')
            ->latest()
            ->get();

        $itStaff = User::whereHas('role', fn($q) => $q->whereIn('slug', ['it', 'it-staff']))->get();

        return view('unassign', compact('requests', 'itStaff'));
    }

    public function assignToMe()
    {
        $user = Auth::user();

        if (!$user->isITStaff()) {
            abort(403);
        }

        $requests = RequestForm::with(['user'])
            ->where('assigned_to', $user->id)
            ->latest()
            ->get();

        return view('approved.assign-to-me', compact('requests'));
    }

    public function assignToOthers()
    {
        $user = Auth::user();

        if (!$user->isITStaff() && !$user->isHODIT() && !$user->isAdmin()) {
            abort(403);
        }

        $requests = RequestForm::with(['user', 'assignedUser'])
            ->where('status', 'approved')
            ->whereNotNull('assigned_to')
            ->latest()
            ->get();

        return view('approved.assign-to-others', compact('requests'));
    }

    // ASSIGN → ONLY THE ASSIGNED IT STAFF GETS EMAIL
    public function assign(Request $request, $id)
    {
        $user = Auth::user();
        $requestForm = RequestForm::findOrFail($id);

        if (!$user->isITStaff() && !$user->isHODIT() && !$user->isAdmin()) {
            abort(403);
        }

        $assignToId = $request->input('assign_to');

        if ($user->isITStaff() && $assignToId != $user->id) {
            abort(403, 'You can only assign to yourself');
        }

        $assignedUser = User::findOrFail($assignToId);

        $requestForm->update([
            'assigned_to' => $assignToId,
            'assigned_at' => now(),
            'status'      => 'in_progress',
        ]);

        // ONLY ASSIGNED IT STAFF GETS EMAIL
        Mail::to($assignedUser->email)->queue(new RequestNotification(
            $requestForm,
            'assigned',
            "You have been assigned a new request!\n\nReference: {$requestForm->reference_number}\nName: {$requestForm->name}\nPlease complete it as soon as possible."
        ));

        // Also notify requester
        Mail::to($requestForm->email)->queue(new RequestNotification(
            $requestForm,
            'assigned',
            "Your request has been assigned to {$assignedUser->name} and is now in progress."
        ));

        return redirect()->route($assignToId == $user->id ? 'approved.assign.to.me' : 'approved.assign.to.others')
            ->with('success', "Assigned to {$assignedUser->name}");
    }

    public function bulkAssign(Request $request)
    {
        $user = Auth::user();

        if (!$user->isHODIT() && !$user->isAdmin()) {
            abort(403);
        }

        $requestIds = $request->input('request_ids', []);
        $assignToId = $request->input('assign_to');

        if (empty($requestIds) || empty($assignToId)) {
            return back()->with('error', 'Select requests and IT staff');
        }

        $assignedUser = User::findOrFail($assignToId);

        $updatedCount = RequestForm::whereIn('id', $requestIds)
            ->where('status', 'approved')
            ->whereNull('assigned_to')
            ->update([
                'assigned_to' => $assignToId,
                'assigned_at' => now(),
                'status'      => 'in_progress',
            ]);

        if ($updatedCount > 0) {
            $assignedRequests = RequestForm::whereIn('id', $requestIds)->get();
            foreach ($assignedRequests as $req) {
                // Notify each requester
                Mail::to($req->email)->queue(new RequestNotification($req, 'assigned', "Your request has been assigned to {$assignedUser->name}."));

                // Notify the assigned IT staff (only once)
                if ($req->wasChanged()) {
                    Mail::to($assignedUser->email)->queue(new RequestNotification($req, 'assigned', "You have been assigned a new request!\nRef: {$req->reference_number}"));
                }
            }

            return back()->with('success', "Assigned {$updatedCount} request(s)");
        }

        return back()->with('error', 'No requests assigned');
    }

    // COMPLETE → ONLY REQUESTER GETS EMAIL
    public function complete($id, Request $request)
    {
        $user = Auth::user();
        $requestForm = RequestForm::findOrFail($id);

        if ($requestForm->assigned_to != $user->id && !$user->isAdmin()) {
            abort(403);
        }

        $requestForm->update([
            'status'         => 'completed',
            'completed_at'   => now(),
            'completed_by'   => $user->id,
            'completion_notes'=> $request->input('notes', ''),
        ]);

        // ONLY REQUESTER
        Mail::to($requestForm->email)->queue(new RequestNotification(
            $requestForm,
            'completed',
            "Your request has been successfully completed!\n\nReference: {$requestForm->reference_number}\n\nThank you!"
        ));

        return back()->with('success', 'Completed. Requester notified.');
    }
}