<?php

namespace App\Http\Controllers;

use App\Models\Collateral;
use App\Models\Customer;
use App\Models\Loan;
use Illuminate\Http\Request;

class CollateralController extends Controller
{
    public function index()
    {
        $collaterals = Collateral::with(['customer', 'loan'])->latest()->get();
        $customers = Customer::all();
        $loans = Loan::all();

        return view('collaterals.index', compact('collaterals', 'customers', 'loans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'loan_id' => 'required|exists:loans,id',
            'type' => 'required|string',
            'description' => 'nullable|string',
            'document_number' => 'nullable|string',
            'value' => 'required|numeric|min:0',
            'received_date' => 'required|date',
            'status' => 'required|string',
            'reference_document' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
        ]);

        if ($request->hasFile('reference_document')) {
            $path = $request->file('reference_document')->store('collaterals', 'public');
            $validated['reference_document'] = $path;
        }

        Collateral::create($validated);

        return redirect()->back()->with('success', 'Collateral saved successfully.');
    }

    public function destroy($id)
    {
        $collateral = Collateral::findOrFail($id);
        $collateral->delete();

        return redirect()->back()->with('success', 'Collateral deleted successfully.');
    }
}