<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $forms = [
            [
                'code' => 'ITF001',
                'label' => 'User ID Creation / Amendment / Deactivation',
                'pending_bpo_hod' => 0,
                'pending_it_hod' => 0,
                'approved_unassigned' => 0
            ],
            [
                'code' => 'ITF002',
                'label' => 'Doctor Registration',
                'pending_bpo_hod' => 0,
                'pending_it_hod' => 0,
                'approved_unassigned' => 0
            ]
        ];

        // Get counts for each form
        foreach ($forms as &$form) {
            try {
                // Debug: Get all requests for this form code
                $allRequests = \App\Models\RequestForm::where('form_code', $form['code'])->get();
                \Log::info("All requests for form {$form['code']}:", $allRequests->toArray());

                $form['pending_bpo_hod'] = \App\Models\RequestForm::where('form_code', $form['code'])
                    ->where('status', 'Pending')
                    ->whereNull('hod_verified_at')
                    ->count();

                // Match the exact query from InProcessController
                $pendingIT = \App\Models\RequestForm::with(['user', 'hodVerifier', 'assignedUser'])
                    ->where('form_code', $form['code'])
                    ->where('status', 'verified_hod')
                    ->latest()
                    ->get();

                \Log::info("Pending IT HOD requests for form {$form['code']}:", $pendingIT->toArray());
                $form['pending_it_hod'] = $pendingIT->count();

                $form['approved_unassigned'] = \App\Models\RequestForm::where('form_code', $form['code'])
                    ->where('status', 'Approved')
                    ->whereNull('assigned_to')
                    ->count();
            } catch (\Exception $e) {
                // Log error but don't break the page
                \Log::error('Error loading dashboard stats: ' . $e->getMessage());
            }
        }

        return view('dashboard', compact('forms'));
    }
}
