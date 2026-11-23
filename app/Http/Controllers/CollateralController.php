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
        $customers = Customer::orderBy('name')->get();
        $loans = Loan::with('customer')->latest()->get();

        return view('collaterals.index', compact('collaterals', 'customers', 'loans'));
    }

    public function create()
    {
        $customers = Customer::orderBy('name')->get();
        $loans = Loan::with('customer')->latest()->get();

        return view('collaterals.create', compact('customers', 'loans'));
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

        return redirect()->route('collaterals.index')->with('success', 'ទ្រព្យបញ្ចាំថ្មីត្រូវបានរក្សាទុកដោយជោគជ័យ (Collateral saved successfully).');
    }

    public function update(Request $request, $id)
    {
        $collateral = Collateral::findOrFail($id);

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

        $collateral->update($validated);

        return redirect()->route('collaterals.index')->with('success', 'ព័ត៌មានទ្រព្យបញ្ចាំត្រូវបានកែប្រែដោយជោគជ័យ (Collateral updated successfully).');
    }

    public function destroy($id)
    {
        $collateral = Collateral::findOrFail($id);
        $collateral->delete();

        return redirect()->route('collaterals.index')->with('success', 'ទ្រព្យបញ្ចាំត្រូវបានលុបដោយជោគជ័យ (Collateral deleted successfully).');
    }
}