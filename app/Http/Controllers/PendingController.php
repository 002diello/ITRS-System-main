<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RequestForm;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PendingController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Prevent IT Staff from accessing this page
        if ($user->isITStaff()) {
            abort(403, 'Unauthorized access. This section is for BPO/HOD verification only.');
        }

        $query = RequestForm::with(['user', 'assignedUser'])
            ->where('status', 'pending');

        // HOD and HOD IT can only see requests from their department
        if ($user->isHOD() || $user->isHODIT()) {
            if ($user->department) {
                $query->where('department', $user->department->name);
            }
        }

        $pendingRequests = $query->latest()->get();

        \Log::info('Pending Requests Debug', [
            'user_id' => $user->id,
            'user_role' => $user->role,
            'user_department' => $user->department,
            'is_hod' => $user->isHOD(),
            'total_requests' => $pendingRequests->count(),
            'all_pending' => RequestForm::where('status', 'pending')->count(),
        ]);

        return view('pending', compact('pendingRequests'));
    }

    public function pendingApproval($formCode)
    {
        $user = Auth::user();

        // Redirect admins to the in-process page
        if ($user->isAdmin()) {
            return redirect()->route('in.process');
        }

        // Only allow HOD IT to access this page
        if (!$user->isHODIT()) {
            abort(403, 'Unauthorized access. This section is for IT HOD only.');
        }

        $query = RequestForm::with(['user', 'assignedUser'])
            ->where('form_code', $formCode)
            ->where('status', 'verified_hod')
            ->whereNull('approved_at');

        // Filter by department if HOD has a department assigned
        if ($user->department) {
            $query->where('department', $user->department->name);
        }

        $pendingRequests = $query->latest()->get();

        return view('pending.approval', [
            'pendingRequests' => $pendingRequests,
            'formCode' => $formCode,
            'formTitle' => $this->getFormTitle($formCode)
        ]);
    }

    protected function getFormTitle($formCode)
    {
        $forms = [
            'ITF001' => 'User ID Creation / Amendment / Deactivation',
            'ITF002' => 'Doctor Registration'
        ];

        return $forms[$formCode] ?? 'Request';
    }

    public function view($id)
    {
        $request = RequestForm::with(['user', 'assignedUser'])->findOrFail($id);
        $user = Auth::user();

        // Prevent IT Staff from accessing this page
        // if ($user->isITStaff()) {
        //     abort(403, 'Unauthorized access. This section is for BPO/HOD verification only.');
        // };
        
        // Prevent IT Staff from accessing pending verification, but allow viewing approved or assigned requests
        if ($user->isITStaff() && !($request->status === 'approved' || $request->assigned_to === $user->id)) {
            abort(403, 'Unauthorized access. This section is for BPO/HOD verification only.');
        }

        // Check department access for HOD and HOD IT, but allow HOD IT to view verified_hod requests from any department for approval purposes
        if ($user->isHOD() || $user->isHODIT()) {
            $allowed = false;
            if ($user->isHODIT()) {
                // HOD IT can view verified_hod requests from any department for approval, but only pending IT requests
                $allowed = ($request->status === 'verified_hod') || in_array($request->department, ['IT', 'Information Technology']);
            } else {
                $allowed = $user->department && ($request->department === $user->department->name);
            }
            if (!$allowed) {
                abort(403, 'Unauthorized access');
            }
        }

        return view('requests.view', compact('request'));
    }

    public function verify($id)
    {
        $request = RequestForm::findOrFail($id);
        $user = Auth::user();

        // Check department access for HOD and HOD IT
        if ($user->isHOD() || $user->isHODIT()) {
            $allowed = false;
            if ($user->isHODIT()) {
                $allowed = in_array($request->department, ['IT', 'Information Technology']);
            } else {
                $allowed = $user->department && ($request->department === $user->department->name);
            }
            if (!$allowed) {
                abort(403, 'Unauthorized access');
            }
        }

        if ($request->status === 'pending') {
            // HODs and HOD IT send to HOD IT for final approval, Admin can verify
            if ($user->isHOD() || $user->isHODIT() || $user->isAdmin()) {
                $request->update([
                    'status' => 'verified_hod',
                    'hod_verified_at' => now(),
                    'hod_verified_by' => $user->id,
                ]);

                return redirect()
                    ->route('pending')
                    ->with('success', 'Request verified successfully. Sent to HOD IT for approval.');
            }
        }

        return redirect()->back()->with('error', 'Unable to verify this request.');
    }

    public function reject($id, Request $request)
    {
        $requestForm = RequestForm::findOrFail($id);
        $user = Auth::user();

        // Prevent IT Staff from accessing this action
        if ($user->isITStaff()) {
            abort(403, 'Unauthorized access. This section is for BPO/HOD verification only.');
        }

        // Check department access for HOD and HOD IT
        if ($user->isHOD() || $user->isHODIT()) {
            $allowed = false;
            if ($user->isHODIT()) {
                $allowed = in_array($requestForm->department, ['IT', 'Information Technology']);
            } else {
                $allowed = $user->department && ($requestForm->department === $user->department->name);
            }
            if (!$allowed) {
                abort(403, 'Unauthorized access');
            }
        }

        $requestForm->update([
            'status' => 'rejected',
            'rejected_at' => now(),
            'rejected_by' => $user->id,
            'rejection_reason' => $request->input('reason', 'No reason provided'),
        ]);

        return redirect()
            ->route('pending')
            ->with('success', 'Request rejected successfully.');
    }
}
