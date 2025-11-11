<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RequestForm;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ApprovedController extends Controller
{
    // HOD IT views requests that need second level approval
    public function index()
    {
        $user = Auth::user();
        $query = RequestForm::with(['user', 'assignedUser']);

        // HOD IT sees requests verified by HOD
        if ($user->isHODIT()) {
            $query->where('status', 'verified_hod');
        }

        $requests = $query->latest()->get();

        return view('approved.index', compact('requests'));
    }

    // HOD IT or Admin approves request (second level)
    public function approve($id)
    {
        $request = RequestForm::findOrFail($id);
        $user = Auth::user();

        if (!$user->isHODIT() && !$user->isAdmin()) {
            abort(403, 'Only HOD IT or Admin can approve requests');
        }

        if ($request->status === 'verified_hod') {
            $request->update([
                'status' => 'approved',
                'approved_at' => now(),
                'approved_by' => $user->id,
            ]);

            return redirect()->back()->with('success', 'Request approved successfully.');
        }

        return redirect()->back()->with('error', 'Unable to approve this request.');
    }

    // View unassigned approved requests
    public function unassign()
    {
        $user = Auth::user();

        // IT Staff and HOD IT can view unassigned requests
        if (!$user->isITStaff() && !$user->isHODIT() && !$user->isAdmin()) {
            abort(403, 'Unauthorized access');
        }

        $requests = RequestForm::with(['user'])
            ->where('status', 'approved')
            ->whereNull('assigned_to')
            ->latest()
            ->get();

        $itStaff = User::whereHas('role', function($query) {
            $query->where('slug', 'it-staff');
        })->get();

        //return view('approved.unassign', compact('requests', 'itStaff'));
        return view('unassign', compact('requests', 'itStaff'));
    }

    // View requests assigned to current user
    public function assignToMe()
    {
        $user = Auth::user();

        if (!$user->isITStaff()) {
            abort(403, 'Only IT Staff can view their assignments');
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
            abort(403, 'Unauthorized access');
        }

        $requests = RequestForm::with(['user', 'assignedUser'])
            ->where('status', 'approved')
            ->whereNotNull('assigned_to')
            ->latest()
            ->get();

        return view('approved.assign-to-others', compact('requests'));
    }

    // Assign request to IT staff (individual - keep for backward compatibility)
    public function assign(Request $request, $id)
    {
        $user = Auth::user();
        $requestForm = RequestForm::findOrFail($id);

        // IT Staff can assign to themselves, HOD IT can assign to anyone
        if (!$user->isITStaff() && !$user->isHODIT() && !$user->isAdmin()) {
            abort(403, 'Unauthorized access');
        }

        $assignToId = $request->input('assign_to');

        // IT Staff can only assign to themselves
        if ($user->isITStaff() && $assignToId != $user->id) {
            abort(403, 'IT Staff can only assign requests to themselves');
        }

$requestForm->update([
            'assigned_to' => $assignToId,
            'assigned_at' => now(),
        ]);

        // Redirect based on assignment
        if ($assignToId == $user->id) {
            // If assigned to self, go to "Assign to Me" page
            return redirect()->route('approved.assign.to.me')->with('success', 'Request assigned to you successfully.');
        } else {
            // If assigned to someone else, go to "Assign to Others" page
            return redirect()->route('approved.assign.to.others')->with('success', 'Request assigned successfully.');
        }
    }

    // Bulk assign multiple requests to IT staff
    public function bulkAssign(Request $request)
    {
        $user = Auth::user();

        // Only HOD IT and Admin can do bulk assignment
        if (!$user->isHODIT() && !$user->isAdmin()) {
            abort(403, 'Unauthorized access');
        }

        $requestIds = $request->input('request_ids', []);
        $assignToId = $request->input('assign_to');

        if (empty($requestIds) || empty($assignToId)) {
            return redirect()->back()->with('error', 'Please select requests and an IT staff member.');
        }

        $updatedCount = RequestForm::whereIn('id', $requestIds)
            ->where('status', 'approved')
            ->whereNull('assigned_to')
            ->update([
                'assigned_to' => $assignToId,
                'assigned_at' => now(),
            ]);

        if ($updatedCount > 0) {
            return redirect()->back()->with('success', "Successfully assigned {$updatedCount} request(s).");
        }

        //return redirect()->back()->with('error', 'No requests were assigned.');
        // No redirect
    }

    // Complete request
    public function complete($id, Request $request)
    {
        $user = Auth::user();
        $requestForm = RequestForm::findOrFail($id);

        // Only assigned IT staff can complete
        if ($requestForm->assigned_to != $user->id && !$user->isAdmin()) {
            abort(403, 'Only assigned IT staff can complete this request');
        }

        $requestForm->update([
            'status' => 'completed',
            'completed_at' => now(),
            'completion_notes' => $request->input('notes', ''),
        ]);

        return redirect()->back()->with('success', 'Request marked as completed.');
    }
}
