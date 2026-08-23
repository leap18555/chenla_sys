<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    /**
     * Display a listing of staff members.
     */
    public function index()
    {
        $staff = Staff::latest()->paginate(10);
        return view('staff.index', compact('staff'));
    }

    /**
     * Show the form for creating a new staff member.
     */
    public function create()
    {
        return view('staff.create');
    }

    /**
     * Store a newly created staff member in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'position'   => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'status'     => 'required|string|in:active,inactive',
            'email'      => 'nullable|email|unique:users,email',
            'password'   => 'nullable|string|min:8',
            'role'       => 'nullable|in:1,2,3,admin,manager,staff',
        ]);

        // Map textual role input to integers if applicable
        if (isset($validated['role'])) {
            $roleMap = ['admin' => 1, 'manager' => 2, 'staff' => 3];
            $validated['role'] = $roleMap[$validated['role']] ?? (int)$validated['role'];
        }

        // Create Staff Record
        $staff = Staff::create($validated);

        // Optional: Also create a User login account if email & password are provided
        if (!empty($validated['email']) && !empty($validated['password'])) {
            User::create([
                'name'     => $validated['name'],
                'email'    => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role'     => $validated['role'] ?? 3, // Default to Staff (3)
            ]);
        }

        return redirect()->route('staff.index')
            ->with('success', 'Staff added successfully.');
    }

    /**
     * Display the specified staff member.
     */
    public function show(Staff $staff)
    {
        return view('staff.show', compact('staff'));
    }

    /**
     * Show the form for editing the specified staff member.
     */
    public function edit(Staff $staff)
    {
        return view('staff.edit', compact('staff'));
    }

    /**
     * Update the specified staff member in storage.
     */
    public function update(Request $request, Staff $staff)
    {
        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'position'   => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'status'     => 'required|string|in:active,inactive',
        ]);

        $staff->update($validated);

        return redirect()->route('staff.index')
            ->with('success', 'Staff updated successfully.');
    }

    /**
     * Remove the specified staff member from storage.
     */
    public function destroy(Staff $staff)
    {
        $staff->delete();

        return redirect()->route('staff.index')
            ->with('success', 'Staff deleted successfully.');
    }
}