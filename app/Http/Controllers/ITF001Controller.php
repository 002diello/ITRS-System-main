<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RequestForm;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\RequestNotification;

class ITF001Controller extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return view('forms.itf001');
        }
        return view('forms.itf001-public');
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

        // Get department from form or user's department
        $department = $validated['department'] ?? (($user && $user->department) ? $user->department : 'IT');

        $requestForm = RequestForm::create([
            'reference_number' => $referenceNumber,
            'form_code' => 'ITF001',
            'form_title' => 'User ID Creation / Amendment / Deactivation',
            'user_id' => $user ? $user->id : null,
            'name' => $validated['name'],
            'department' => $department,
            'email' => $validated['email'] ?? ($user ? $user->email : null),
            'phone' => null,
            'nric' => $validated['nric'] ?? null,
            'request_data' => $validated,
            'status' => 'pending',
        ]);

        try {
            // Log the start of email sending
            \Log::info('Starting to send email notifications for request #' . $requestForm->id);
            
            // Send email notification to requester
            $recipientEmail = $validated['email'] ?? ($user ? $user->email : null);
            \Log::info('Recipient email: ' . ($recipientEmail ?? 'No recipient email found'));
            
            if ($recipientEmail) {
                \Log::info('Sending submission confirmation to: ' . $recipientEmail);
                Mail::to($recipientEmail)->send(
                    new RequestNotification($requestForm, 'submitted', 'Your request has been submitted successfully.')
                );
                \Log::info('Submission confirmation sent to: ' . $recipientEmail);
            }

            // Send notification to HOD
            $hodEmails = User::whereHas('role', function($query) {
                    $query->where('slug', 'hod');
                })
                ->where('department', $department)
                ->pluck('email')
                ->toArray();

            \Log::info('HOD emails to notify: ' . json_encode($hodEmails));

            if (!empty($hodEmails)) {
                \Log::info('Sending HOD notification to: ' . implode(', ', $hodEmails));
                Mail::to($hodEmails)->send(
                    new RequestNotification($requestForm, 'pending', 'New request requires your verification.')
                );
                \Log::info('HOD notifications sent successfully');
            } else {
                \Log::warning('No HOD emails found for department: ' . $department);
            }
        } catch (\Exception $e) {
            // Log the error but don't break the user experience
            \Log::error('Failed to send email notification: ' . $e->getMessage());
        }

        if ($user) {
            return redirect()->route('dashboard')->with('success', 'Request submitted successfully. Reference: ' . $referenceNumber);
        } else {
            return redirect()->route('home')->with('success', 'Request submitted successfully. Your reference number is: ' . $referenceNumber . '. Please save this for tracking.');
        }
    }

    public function verifyHod(Request $request, $id)
    {
        $requestForm = RequestForm::findOrFail($id);
        $user = Auth::user();

        // Check if user is HOD of the same department
        if (!$user->hasRole('hod') || $user->department !== $requestForm->department) {
            return back()->with('error', 'You are not authorized to verify this request.');
        }

        $requestForm->update([
            'status' => 'verified',
            'hod_verified_by' => $user->id,
            'hod_verified_at' => now(),
        ]);

        // Notify IT staff
        $itEmails = User::whereHas('role', function($query) {
                $query->where('slug', 'it');
            })
            ->pluck('email')
            ->toArray();

        if (!empty($itEmails)) {
            Mail::to($itEmails)->send(
                new RequestNotification($requestForm, 'verified', 'Request has been verified by HOD and requires IT action.')
            );
        }

        return back()->with('success', 'Request verified successfully.');
    }

    public function approve(Request $request, $id)
    {
        $requestForm = RequestForm::findOrFail($id);
        $user = Auth::user();

        // Check if user is authorized to approve
        if (!$user->hasRole('admin') && !$user->hasRole('it')) {
            return back()->with('error', 'You are not authorized to approve this request.');
        }

        $requestForm->update([
            'status' => 'approved',
            'approved_by' => $user->id,
            'approved_at' => now(),
        ]);

        // Notify requester
        if ($requestForm->email) {
            Mail::to($requestForm->email)->send(
                new RequestNotification($requestForm, 'approved', 'Your request has been approved and is being processed.')
            );
        }

        return back()->with('success', 'Request approved successfully.');
    }

    public function reject(Request $request, $id)
    {
        $requestForm = RequestForm::findOrFail($id);
        $user = Auth::user();
        
        $validated = $request->validate([
            'rejection_reason' => 'required|string|max:1000',
        ]);

        // Check if user is authorized to reject
        if (!$user->hasRole('admin') && !$user->hasRole('it') && !$user->hasRole('hod')) {
            return back()->with('error', 'You are not authorized to reject this request.');
        }

        $requestForm->update([
            'status' => 'rejected',
            'rejected_by' => $user->id,
            'rejected_at' => now(),
            'rejection_reason' => $validated['rejection_reason'],
        ]);

        // Notify requester
        if ($requestForm->email) {
            Mail::to($requestForm->email)->send(
                new RequestNotification($requestForm, 'rejected', 'Your request has been rejected. Reason: ' . $validated['rejection_reason'])
            );
        }

        return back()->with('success', 'Request rejected successfully.');
    }

    public function complete(Request $request, $id)
    {
        $requestForm = RequestForm::findOrFail($id);
        $user = Auth::user();

        // Check if user is IT staff
        if (!$user->hasRole('it')) {
            return back()->with('error', 'You are not authorized to complete this request.');
        }

        $requestForm->update([
            'status' => 'completed',
            'completed_by' => $user->id,
            'completed_at' => now(),
        ]);

        // Notify requester
        if ($requestForm->email) {
            Mail::to($requestForm->email)->send(
                new RequestNotification($requestForm, 'completed', 'Your request has been completed.')
            );
        }

        return back()->with('success', 'Request marked as completed.');
    }

    public function assignToMe(Request $request, $id)
    {
        $requestForm = RequestForm::findOrFail($id);
        $user = Auth::user();

        if (!$user->hasRole('it')) {
            return back()->with('error', 'Only IT staff can assign requests to themselves.');
        }

        $requestForm->update([
            'assigned_to' => $user->id,
            'assigned_at' => now(),
            'status' => 'in_progress',
        ]);

        // Notify requester
        if ($requestForm->email) {
            Mail::to($requestForm->email)->send(
                new RequestNotification($requestForm, 'assigned', 'Your request has been assigned to an IT staff member.')
            );
        }

        return back()->with('success', 'Request assigned to you successfully.');
    }

    public function view($id)
    {
        $requestForm = RequestForm::findOrFail($id);
        $user = Auth::user();

        // Check if user is authorized to view this request
        if (!$user->hasRole('admin') && 
            !$user->hasRole('it') && 
            !$user->hasRole('hod') && 
            $requestForm->user_id !== $user->id) {
            return back()->with('error', 'You are not authorized to view this request.');
        }

        return view('requests.view', compact('requestForm'));
    }
}