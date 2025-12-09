<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RequestForm;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Mail\RequestNotification;
use Illuminate\Support\Facades\Mail;

// class PendingController extends Controller
// {
//     public function index()
//     {
//         $user = Auth::user();

//         // Prevent IT Staff from accessing this page
//         if ($user->isITStaff()) {
//             abort(403, 'Unauthorized access. This section is for BPO/HOD verification only.');
//         }

//         $query = RequestForm::with(['user', 'assignedUser'])
//             ->where('status', 'pending');

//         // HOD and HOD IT can only see requests from their department
//         if ($user->isHOD() || $user->isHODIT()) {
//             if ($user->department) {
//                 $query->where('department', $user->department->name);
//             }
//         }

//         $pendingRequests = $query->latest()->get();

//         \Log::info('Pending Requests Debug', [
//             'user_id' => $user->id,
//             'user_role' => $user->role,
//             'user_department' => $user->department,
//             'is_hod' => $user->isHOD(),
//             'total_requests' => $pendingRequests->count(),
//             'all_pending' => RequestForm::where('status', 'pending')->count(),
//         ]);

//         return view('pending', compact('pendingRequests'));
//     }

//     public function pendingApproval($formCode)
//     {
//         $user = Auth::user();

//         // Redirect admins to the in-process page
//         if ($user->isAdmin()) {
//             return redirect()->route('in.process');
//         }

//         // Only allow HOD IT to access this page
//         if (!$user->isHODIT()) {
//             abort(403, 'Unauthorized access. This section is for IT HOD only.');
//         }

//         $query = RequestForm::with(['user', 'assignedUser'])
//             ->where('form_code', $formCode)
//             ->where('status', 'verified_hod')
//             ->whereNull('approved_at');

//         // Filter by department if HOD has a department assigned
//         if ($user->department) {
//             $query->where('department', $user->department->name);
//         }

//         $pendingRequests = $query->latest()->get();

//         return view('pending.approval', [
//             'pendingRequests' => $pendingRequests,
//             'formCode' => $formCode,
//             'formTitle' => $this->getFormTitle($formCode)
//         ]);
//     }

//     protected function getFormTitle($formCode)
//     {
//         $forms = [
//             'ITF001' => 'User ID Creation / Amendment / Deactivation',
//             'ITF002' => 'Doctor Registration'
//         ];

//         return $forms[$formCode] ?? 'Request';
//     }

//     public function view($id)
//     {
//         $request = RequestForm::with(['user', 'assignedUser'])->findOrFail($id);
//         $user = Auth::user();

//         // Prevent IT Staff from accessing this page
//         // if ($user->isITStaff()) {
//         //     abort(403, 'Unauthorized access. This section is for BPO/HOD verification only.');
//         // };
        
//         // Prevent IT Staff from accessing pending verification, but allow viewing approved or assigned requests
//         if ($user->isITStaff() && !($request->status === 'approved' || $request->assigned_to === $user->id)) {
//             abort(403, 'Unauthorized access. This section is for BPO/HOD verification only.');
//         }

//         // Check department access for HOD and HOD IT, but allow HOD IT to view verified_hod requests from any department for approval purposes
//         if ($user->isHOD() || $user->isHODIT()) {
//             $allowed = false;
//             if ($user->isHODIT()) {
//                 // HOD IT can view verified_hod requests from any department for approval, but only pending IT requests
//                 $allowed = ($request->status === 'verified_hod') || in_array($request->department, ['IT', 'Information Technology']);
//             } else {
//                 $allowed = $user->department && ($request->department === $user->department->name);
//             }
//             if (!$allowed) {
//                 abort(403, 'Unauthorized access');
//             }
//         }

//         return view('requests.view', compact('request'));
//     }

//     public function verify($id)
//     {
//         $request = RequestForm::findOrFail($id);
//         $user = Auth::user();

//         // Check department access for HOD and HOD IT
//         if ($user->isHOD() || $user->isHODIT()) {
//             $allowed = false;
//             if ($user->isHODIT()) {
//                 $allowed = in_array($request->department, ['IT', 'Information Technology']);
//             } else {
//                 $allowed = $user->department && ($request->department === $user->department->name);
//             }
//             if (!$allowed) {
//                 abort(403, 'Unauthorized access');
//             }
//         }

//         if ($request->status === 'pending') {
//             // HODs and HOD IT send to HOD IT for final approval, Admin can verify
//             if ($user->isHOD() || $user->isHODIT() || $user->isAdmin()) {
//                 $request->update([
//                     'status' => 'verified_hod',
//                     'hod_verified_at' => now(),
//                     'hod_verified_by' => $user->id,
//                 ]);

//                 return redirect()
//                     ->route('pending')
//                     ->with('success', 'Request verified successfully. Sent to HOD IT for approval.');
//             }
//         }

//         return redirect()->back()->with('error', 'Unable to verify this request.');
//     }

//     public function reject($id, Request $request)
//     {
//         $requestForm = RequestForm::with('user')->findOrFail($id);
//         $user = Auth::user();
//         $rejectionReason = $request->input('reason', 'No reason provided');

//         // Prevent IT Staff from accessing this action
//         if ($user->isITStaff()) {
//             abort(403, 'Unauthorized access. This section is for BPO/HOD verification only.');
//         }

//         // Check department access for HOD and HOD IT
//         if ($user->isHOD() || $user->isHODIT()) {
//             $allowed = false;
//             if ($user->isHODIT()) {
//                 $allowed = in_array($requestForm->department, ['IT', 'Information Technology']);
//             } else {
//                 $allowed = $user->department && ($requestForm->department === $user->department->name);
//             }
//             if (!$allowed) {
//                 abort(403, 'Unauthorized access');
//             }
//         }

//         DB::beginTransaction();
//         try {
//             $requestForm->update([
//                 'status' => 'rejected',
//                 'rejected_at' => now(),
//                 'rejected_by' => $user->id,
//                 'rejection_reason' => $rejectionReason,
//             ]);

//             // Send notification to requester
//             if ($requestForm->user && $requestForm->user->email) {
//                 Mail::to($requestForm->user->email)->send(
//                     new RequestNotification($requestForm, 'rejected', $rejectionReason)
//                 );
//             }

//             // If there's an email field in the form data, send to that as well
//             if (!empty($requestForm->data['email'] ?? null)) {
//                 Mail::to($requestForm->data['email'])->send(
//                     new RequestNotification($requestForm, 'rejected', $rejectionReason)
//                 );
//             }

//             DB::commit();
            
//             return redirect()
//                 ->route('pending')
//                 ->with('success', 'Request rejected successfully. Notification sent to requester.');
                
//         } catch (\Exception $e) {
//             DB::rollBack();
//             Log::error('Error rejecting request: ' . $e->getMessage());
            
//             return redirect()
//                 ->back()
//                 ->with('error', 'Failed to reject request. Please try again.');
//         }
//     }
// }


//second version
// class PendingController extends Controller
// {
//     public function index()
//     {
//         $user = Auth::user();

//         if ($user->isITStaff()) {
//             abort(403, 'Unauthorized access. This section is for BPO/HOD verification only.');
//         }

//         $query = RequestForm::with(['user', 'assignedUser'])
//             ->where('status', 'pending');

//         if ($user->isHOD() || $user->isHODIT()) {
//             if ($user->department) {
//                 $query->where('department', $user->department->name);
//             }
//         }

//         $pendingRequests = $query->latest()->get();

//         Log::info('Pending Requests Debug', [
//             'user_id' => $user->id,
//             'user_role' => $user->role?->name ?? 'unknown',
//             'user_department' => $user->department?->name ?? null,
//             'is_hod' => $user->isHOD(),
//             'total_requests' => $pendingRequests->count(),
//             'all_pending' => RequestForm::where('status', 'pending')->count(),
//         ]);

//         return view('pending', compact('pendingRequests'));
//     }

//     public function pendingApproval($formCode)
//     {
//         $user = Auth::user();

//         if ($user->isAdmin()) {
//             return redirect()->route('in.process');
//         }

//         if (!$user->isHODIT()) {
//             abort(403, 'Unauthorized access. This section is for IT HOD only.');
//         }

//         $query = RequestForm::with(['user', 'assignedUser'])
//             ->where('form_code', $formCode)
//             ->where('status', 'verified_hod')
//             ->whereNull('approved_at');

//         if ($user->department) {
//             $query->where('department', $user->department->name);
//         }

//         $pendingRequests = $query->latest()->get();

//         return view('pending.approval', [
//             'pendingRequests' => $pendingRequests,
//             'formCode' => $formCode,
//             'formTitle' => $this->getFormTitle($formCode)
//         ]);
//     }

//     protected function getFormTitle($formCode)
//     {
//         $forms = [
//             'ITF001' => 'User ID Creation / Amendment / Deactivation',
//             'ITF002' => 'Doctor Registration'
//         ];

//         return $forms[$formCode] ?? 'Request';
//     }

//     public function view($id)
//     {
//         $request = RequestForm::with(['user', 'assignedUser'])->findOrFail($id);
//         $user = Auth::user();

//         if ($user->isITStaff() && !in_array($request->status, ['approved', 'in_progress', 'completed']) && $request->assigned_to !== $user->id) {
//             abort(403, 'You are not authorized to view this pending request.');
//         }

//         if ($user->isHOD() || $user->isHODIT()) {
//             $allowed = false;
//             if ($user->isHODIT() && $request->status === 'verified_hod') {
//                 $allowed = true;
//             } elseif ($user->department && $request->department === $user->department->name) {
//                 $allowed = true;
//             }
//             if (!$allowed) {
//                 abort(403, 'You can only view requests from your department.');
//             }
//         }

//         return view('requests.view', compact('request'));
//     }

//     // HOD VERIFIES (Department Approval)
//     public function verify($id)
//     {
//         $requestForm = RequestForm::findOrFail($id);
//         $user = Auth::user();

//         // Authorization
//         if ($user->isHOD() || $user->isHODIT()) {
//             $allowed = false;
//             if ($user->isHODIT()) {
//                 $allowed = in_array($requestForm->department, ['IT', 'Information Technology']);
//             } else {
//                 $allowed = $user->department && ($requestForm->department === $user->department->name);
//             }
//             if (!$allowed) {
//                 abort(403, 'Unauthorized access');
//             }
//         }

//         if ($requestForm->status !== 'pending') {
//             return back()->with('error', 'This request is no longer pending.');
//         }

//         $requestForm->update([
//             'status' => 'verified_hod',
//             'hod_verified_at' => now(),
//             'hod_verified_by' => $user->id,
//         ]);

//         // EMAIL TO REQUESTER — "Approved by HOD"
//         if ($requestForm->email) {
//             Mail::to($requestForm->email)->queue(
//                 new RequestNotification(
//                     $requestForm,
//                     'approved',
//                     "Your request has been approved by your Department HOD and is now awaiting final IT approval."
//                 )
//             );
//         }

//         // Notify IT Team
//         $itEmails = User::whereHas('role', fn($q) => $q->where('slug', 'it'))
//             ->pluck('email')
//             ->filter()
//             ->toArray();

//         if ($itEmails) {
//             Mail::to($itEmails)->queue(
//                 new RequestNotification($requestForm, 'verified', "Request #{$requestForm->reference_number} has been verified by HOD and is awaiting IT approval.")
//             );
//         }

//         return redirect()
//             ->route('pending')
//             ->with('success', 'Request verified successfully and sent to IT for final approval.');
//     }

//     // HOD OR IT REJECTS
//     public function reject($id, Request $request)
//     {
//         $requestForm = RequestForm::findOrFail($id);
//         $user = Auth::user();

//         $validated = $request->validate([
//             'reason' => 'required|string|max:1000',
//         ]);

//         $reason = $validated['reason'];

//         // Authorization
//         if ($user->isITStaff()) {
//             abort(403, 'IT Staff cannot reject requests here.');
//         }

//         if ($user->isHOD() || $user->isHODIT()) {
//             $allowed = false;
//             if ($user->isHODIT()) {
//                 $allowed = in_array($requestForm->department, ['IT', 'Information Technology']);
//             } else {
//                 $allowed = $user->department && ($requestForm->department === $user->department->name);
//             }
//             if (!$allowed) {
//                 abort(403, 'You can only reject requests from your department.');
//             }
//         }

//         DB::beginTransaction();
//         try {
//             $requestForm->update([
//                 'status' => 'rejected',
//                 'rejected_at' => now(),
//                 'rejected_by' => $user->id,
//                 'rejection_reason' => $reason,
//             ]);

//             // SEND REJECT EMAIL — NOW WORKS 100%
//             if ($requestForm->email) {
//                 Mail::to($requestForm->email)->queue(
//                     new RequestNotification(
//                         $requestForm,
//                         'rejected',
//                         "Your request has been rejected.\n\nReason: {$reason}"
//                     )
//                 );
//             }

//             DB::commit();

//             return redirect()
//                 ->route('pending')
//                 ->with('success', 'Request rejected. Requester has been notified via email.');

//         } catch (\Exception $e) {
//             DB::rollBack();
//             Log::error('Reject failed: ' . $e->getMessage(), ['id' => $id]);

//             return back()->with('error', 'Failed to reject request.');
//         }
//     }
// }


class PendingController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->isITStaff()) {
            abort(403, 'Unauthorized access.');
        }

        $query = RequestForm::with(['user', 'assignedUser'])
            ->where('status', 'pending');

        // HOD sees only their department (using string column)
        if ($user->isHOD() || $user->isHODIT()) {
            if ($user->department) {
                $query->where('department', $user->department->name);
            }
        }

        $pendingRequests = $query->latest()->get();

        return view('pending', compact('pendingRequests'));
    }

    public function pendingApproval($formCode)
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            return redirect()->route('in.process');
        }

        if (!$user->isHODIT()) {
            abort(403);
        }

        $query = RequestForm::with(['user', 'assignedUser'])
            ->where('form_code', $formCode)
            ->where('status', 'verified_hod');

        $pendingRequests = $query->latest()->get();

        return view('pending.approval', [
            'pendingRequests' => $pendingRequests,
            'formCode'        => $formCode,
            'formTitle'       => $this->getFormTitle($formCode)
        ]);
    }

    protected function getFormTitle($formCode)
    {
        return [
            'ITF001' => 'User ID Creation / Amendment / Deactivation',
            'ITF002' => 'Doctor Registration'
        ][$formCode] ?? 'Request';
    }

        public function view($id)
        {
            $requestForm = RequestForm::with(['user', 'assignedUser'])->findOrFail($id);
            $user = Auth::user();

            if ($user->isITStaff() && !in_array($requestForm->status, ['approved', 'in_progress', 'completed']) && $requestForm->assigned_to !== $user->id) {
                abort(403);
            }

            if ($user->isHOD() || $user->isHODIT()) {
                $allowed = false;
                if ($user->isHODIT() && $requestForm->status === 'verified_hod') {
                    $allowed = true;
                } elseif ($user->department && $requestForm->department === $user->department->name) {
                    $allowed = true;
                }
                if (!$allowed) {
                    abort(403);
                }
            }

            return view('requests.view', [
                'requestForm' => $requestForm,  // Make sure this is named correctly
                'user' => $user
            ]);
        }

        // HOD VERIFY → Requester + IT HOD only
            public function verify($id)
        {
            $requestForm = RequestForm::findOrFail($id);
            $user = Auth::user();

            if ($user->isHOD() && $requestForm->department !== $user->department?->name) {
                abort(403);
            }

            if ($requestForm->status !== 'pending') {
                return back()->with('error', 'Not pending.');
            }

            $requestForm->update([
                'status' => 'verified_hod',
                'hod_verified_at' => now(),
                'hod_verified_by' => $user->id,
            ]);

            // 1. Notify requester
            Mail::to($requestForm->email)->queue(new RequestNotification(
                $requestForm,
                'approved',
                "Your request has been approved by your HOD and sent to IT HOD for final approval.\n\n" .
                "Reference: {$requestForm->reference_number}"
            ));

            // 2. Notify IT HOD
            $itHodEmails = User::whereHas('role', function($q) {
                    $q->where('slug', 'hod');
                })
                ->whereHas('department', function($q) {
                    $q->where('name', 'Information Technology');
                })
                ->pluck('email')
                ->toArray();

            if (!empty($itHodEmails)) {
                Mail::to($itHodEmails)->queue(new RequestNotification(
                    $requestForm,
                    'pending_approval',
                    "New request requires your approval.\n\n" .
                    "Reference: {$requestForm->reference_number}\n" .
                    "Department: {$requestForm->department}\n" .
                    "Request Type: {$requestForm->form_title}\n\n" .
                    "Please review in the system."
                ));
            }

            return back()->with('success', 'Request verified and IT HOD has been notified.');
        }

    public function reject($id, Request $request)
    {
        $requestForm = RequestForm::findOrFail($id);
        $user = Auth::user();

        $reason = $request->validate(['reason' => 'required|string|max:1000'])['reason'];

        if ($user->isHOD() && $requestForm->department !== $user->department?->name) {
            abort(403);
        }

        $requestForm->update([
            'status'           => 'rejected',
            'rejected_at'      => now(),
            'rejected_by'      => $user->id,
            'rejection_reason' => $reason,
        ]);

        Mail::to($requestForm->email)->queue(new RequestNotification(
            $requestForm,
            'rejected',
            "Your request was rejected by HOD.\n\nReason: {$reason}"
        ));

        return back()->with('success', 'Rejected. Requester notified.');
    }
}