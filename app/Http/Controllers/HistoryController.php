<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RequestForm;

class HistoryController extends Controller
{
    public function index()
    {
        $requests = RequestForm::with(['user', 'assignedUser'])
            ->whereIn('status', ['completed', 'rejected'])
            ->latest()
            ->get();

        return view('history', compact('requests'));
    }
}
