<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Department;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;

class UserManagementController extends Controller
{
    /**
     * Display a listing of users
     */
    public function index()
    {
        // Only admin can access
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized access');
        }

        $users = User::with(['role', 'department'])
            ->latest()
            ->paginate(15);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user
     */
    public function create()
    {
        // Only admin can access
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized access');
        }

        $roles = Role::all();
        $departments = Department::all();

        return view('admin.users.create', compact('roles', 'departments'));
    }

    /**
     * Store a newly created user
     */
    public function store(Request $request)
    {
        // Only admin can access
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized access');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'employee_id' => ['nullable', 'string', 'max:255', 'unique:users'],
            'role_id' => ['required', 'exists:roles,id'],
            'department_id' => ['nullable', 'exists:departments,id'],
            'phone' => ['nullable', 'string', 'max:255'],
            'position' => ['nullable', 'string', 'max:255'],
            'is_active' => ['boolean'],
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['is_active'] = $request->has('is_active');
        $validated['email_verified_at'] = now();

        User::create($validated);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User created successfully.');
    }

    /**
     * Show the form for editing a user
     */
    public function edit(User $user)
    {
        // Only admin can access
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized access');
        }

        $roles = Role::all();
        $departments = Department::all();

        return view('admin.users.edit', compact('user', 'roles', 'departments'));
    }

    /**
     * Update the specified user
     */
    public function update(Request $request, User $user)
    {
        // Only admin can access
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized access');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'employee_id' => ['nullable', 'string', 'max:255', 'unique:users,employee_id,' . $user->id],
            'role_id' => ['required', 'exists:roles,id'],
            'department_id' => ['nullable', 'exists:departments,id'],
            'phone' => ['nullable', 'string', 'max:255'],
            'position' => ['nullable', 'string', 'max:255'],
            'is_active' => ['boolean'],
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $validated['is_active'] = $request->has('is_active');

        $user->update($validated);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified user
     */
    public function destroy(User $user)
    {
        // Only admin can access
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized access');
        }

        // Prevent deleting yourself
        if ($user->id === Auth::id()) {
            return redirect()
                ->back()
                ->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User deleted successfully.');
    }
}
