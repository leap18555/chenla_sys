<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Deposit;
use App\Models\Customer;

class DepositsController extends Controller
{
    // Show all deposits
    public function index()
    {
        $deposits = Deposit::with('customer')->get(); // Eager load customer
        return view('deposits.index', compact('deposits'));
    }

    // Show form to create a new deposit
  public function create()
{
    $customers = Customer::all(); // Fetch customers to populate the dropdown
    return view('deposits.create', compact('customers'));
}

    // Store new deposit
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'amount' => 'required|numeric|min:0',
        ]);

        Deposit::create($request->all());

        return redirect()->route('deposits.index')->with('success', 'Deposit added successfully!');
    }
}
