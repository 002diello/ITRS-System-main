<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function __construct()
    {
        // Ensure only admin can access user management
        $this->middleware(function ($request, $next) {
            if (!Auth::user()->isAdmin()) {
                abort(403, 'Only administrators can manage users.');
            }
            return $next($request);
        });
    }

    // Display list of users
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('admin.users.index', compact('users'));
    }

    // Show form to create new user
    public function create()
    {
        return view('admin.users.create');
    }

    // Store new user
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'role' => 'required|string|in:admin,hod,hod_it,it_staff,user',
            'department' => 'nullable|string|max:255'
        ]);

        $department = $request->department;

        // Admin, HOD IT, and IT Staff must always be in IT department
        if (in_array($request->role, ['admin', 'hod_it', 'it_staff'])) {
            $department = 'IT';
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'department' => $department
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    // Show form to edit existing user
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    // Update user
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'role' => 'required|string|in:admin,hod,hod_it,it_staff,user',
            'department' => 'nullable|string|max:255'
        ]);

        $data = $request->only(['name', 'email', 'role', 'department']);

        // Admin users must always be in IT department
        if ($data['role'] === 'admin') {
            $data['department'] = 'IT';
        }

        // HOD IT must always be in IT department
        if ($data['role'] === 'hod_it') {
            $data['department'] = 'IT';
        }

        // IT Staff must always be in IT department
        if ($data['role'] === 'it_staff') {
            $data['department'] = 'IT';
        }

        $user->update($data);

        if ($request->filled('password')) {
            $user->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    // Delete user
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
