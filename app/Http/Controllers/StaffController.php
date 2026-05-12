<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;

class StaffController extends Controller
{
    // Display list
    public function index()
    {
        $staff = Staff::paginate(10); // optional pagination
        return view('staff.index', compact('staff'));
    }

    // Show create form
    public function create()
    {
        return view('staff.create');
    }

    // Store new staff
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'position' => 'required',
            'department' => 'required',
            'status' => 'required',
        ]);

        Staff::create($request->all());

        return redirect()->route('staff.index')
            ->with('success','Staff added successfully');
    }

    // Show edit form
    public function edit(Staff $staff)
    {
        return view('staff.edit', compact('staff'));
    }

    // Update staff
    public function update(Request $request, Staff $staff) // Use Staff $staff
    {
        $request->validate([
            'name' => 'required',
            'position' => 'required',
            'department' => 'required',
            'status' => 'required',
        ]);

        $staff->update($request->all());

        return redirect()->route('staff.index')
            ->with('success', 'Staff updated successfully');
    }

    // Show staff (optional)
    public function show(Staff $staff)
    {
        return view('staff.show', compact('staff'));
    }

    // Delete staff
    public function destroy(Staff $staff)
    {
        $staff->delete();
        return redirect()->route('staff.index')
            ->with('success', 'Staff deleted successfully');
    }
}
