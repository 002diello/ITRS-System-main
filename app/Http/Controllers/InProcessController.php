<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RequestForm;
use Illuminate\Support\Facades\Auth;

class InProcessController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Only IT HOD and Admin can access in-process requests
        if (!$user->isHODIT() && !$user->isAdmin()) {
            abort(403, 'Only IT HOD can access this page');
        }

        // Show requests that are verified by HOD but not yet approved by HOD IT
        $requests = RequestForm::with(['user', 'hodVerifier', 'assignedUser'])
            ->where('status', 'verified_hod')
            ->latest()
            ->get();

        return view('in-process', compact('requests'));
    }

    public function approve($id)
    {
        $request = RequestForm::findOrFail($id);
        /** @var \App\Models\User $user */
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

            return redirect()
                ->route('in.process')
                ->with('success', 'Request approved successfully.');
        }

        return redirect()->back()->with('error', 'Unable to approve this request.');
    }

    public function reject($id, Request $request)
    {
        $requestForm = RequestForm::findOrFail($id);
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (!$user->isHODIT() && !$user->isAdmin()) {
            abort(403, 'Only HOD IT or Admin can reject requests');
        }

        $requestForm->update([
            'status' => 'rejected',
            'rejected_at' => now(),
            'rejected_by' => $user->id,
            'rejection_reason' => $request->input('reason', 'No reason provided'),
        ]);

        return redirect()
            ->route('in.process')
            ->with('success', 'Request rejected successfully.');
    }
}
