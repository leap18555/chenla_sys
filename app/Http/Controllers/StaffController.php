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
    public function index(Request $request)
    {
        $query = Staff::query();

        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('position', 'like', "%{$search}%")
                  ->orWhere('department', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        if ($request->filled('department') && $request->department !== 'all') {
            $query->where('department', $request->department);
        }

        $departments = Staff::whereNotNull('department')->where('department', '!=', '')->distinct()->pluck('department');
        $staff = $query->latest()->paginate(10);

        return view('staff.index', compact('staff', 'departments'));
    }

    /**
     * Show the form for creating a new staff member.
     */
    public function create()
    {
        $departments = Staff::whereNotNull('department')->where('department', '!=', '')->distinct()->pluck('department');
        return view('staff.create', compact('departments'));
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
            'status'     => 'required|string|in:active,leave,inactive',
            'email'      => 'nullable|email|unique:staff,email',
            'password'   => 'nullable|string|min:8',
            'role'       => 'nullable',
        ]);

        // Map textual role input to integers if applicable
        if (isset($validated['role'])) {
            $roleMap = ['admin' => 1, 'manager' => 2, 'staff' => 3, 'cashier' => 3];
            $validated['role'] = $roleMap[$validated['role']] ?? (int)$validated['role'];
        }

        // Create Staff Record
        $staff = Staff::create($validated);

        // Optional: Also create a User login account if email & password are provided
        if (!empty($validated['email']) && !empty($validated['password'])) {
            User::updateOrCreate(
                ['email' => $validated['email']],
                [
                    'name'     => $validated['name'],
                    'password' => Hash::make($validated['password']),
                    'role'     => $validated['role'] ?? 3,
                ]
            );
        }

        return redirect()->route('staff.index')
            ->with('success', 'បានបន្ថែមបុគ្គលិកដោយជោគជ័យ។ (Staff added successfully)');
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
        $departments = Staff::whereNotNull('department')->where('department', '!=', '')->distinct()->pluck('department');
        return view('staff.edit', compact('staff', 'departments'));
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
            'status'     => 'required|string|in:active,leave,inactive',
            'email'      => 'nullable|email|unique:staff,email,' . $staff->id,
            'role'       => 'nullable',
        ]);

        if (isset($validated['role'])) {
            $roleMap = ['admin' => 1, 'manager' => 2, 'staff' => 3, 'cashier' => 3];
            $validated['role'] = $roleMap[$validated['role']] ?? (int)$validated['role'];
        }

        $staff->update($validated);

        return redirect()->route('staff.show', $staff->id)
            ->with('success', 'បានធ្វើបច្ចុប្បន្នភាពព័ត៌មានបុគ្គលិកដោយជោគជ័យ។ (Staff updated successfully)');
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