<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loan;
use App\Models\Customer;

class LoanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the loans.
     */
    public function index()
    {
        $loans = Loan::latest()->paginate(10);

        $activeTotal  = Loan::where('status', 'active')->sum('amount');
        $pendingTotal = Loan::where('status', 'pending')->sum('amount');
        $paidTotal    = Loan::where('status', 'paid')->sum('amount');

        return view('loans.index', compact('loans', 'activeTotal', 'pendingTotal', 'paidTotal'));
    }

    /**
     * Show the form for creating a new loan.
     */
    public function create()
    {
        // Fetch all customers from the database sorted by name
        $customers = Customer::orderBy('name', 'asc')->get();

        // Dynamically calculate sequential Loan numbers matching Blade fallbacks
        $nextId = Loan::max('id') + 1;
        $loanNumber = 'LN-' . date('Y') . '-' . str_pad($nextId, 3, '0', STR_PAD_LEFT);

        return view('loans.create', compact('customers', 'loanNumber'));
    }

    /**
     * Store a newly created loan in storage.
     */
    public function store(Request $request)
    {
        // 1. Validate based on your exact Blade form properties
        $validated = $this->validateLoan($request);
        
        // 2. Perform backend calculations based on interest formulas
        $calculations = $this->calculateLoanDetails($validated);
        $data = array_merge($validated, $calculations);
        
        // 3. Inject system fields & missing DB columns safely
        $data['user_id'] = auth()->id();
        $data['type'] = 'Personal';
        $data['currency'] = 'USD';

        Loan::create($data);

        return redirect()->route('loans.index')->with('success', 'Loan created successfully.');
    }

    /**
     * Display the specified loan.
     */
    public function show(Loan $loan)
    {
        return view('loans.show', compact('loan'));
    }

    /**
     * Show the form for editing the specified loan.
     */
    public function edit(Loan $loan)
    {
        $customers = Customer::orderBy('name', 'asc')->get();
        return view('loans.edit', compact('loan', 'customers'));
    }

    /**
     * Update the specified loan in storage.
     */
    public function update(Request $request, Loan $loan)
    {
        $validated = $this->validateLoan($request, true);
        
        $calculations = $this->calculateLoanDetails($validated);
        $data = array_merge($validated, $calculations);
        
        $data['type'] = $loan->type ?? 'Personal';
        $data['currency'] = $loan->currency ?? 'USD';

        $loan->update($data);

        return redirect()->route('loans.index')->with('success', 'Loan updated successfully.');
    }

    /**
     * Remove the specified loan from storage.
     */
    public function destroy(Loan $loan)
    {
        $loan->delete();
        return redirect()->route('loans.index')->with('success', 'Loan deleted successfully.');
    }

    /**
     * Centralized validation logic with custom attribute mapping.
     */
    protected function validateLoan(Request $request, $isUpdate = false)
    {
        $rules = [
            'customer_id'   => 'required|exists:customers,id',
            'loan_number'   => 'required|string|max:255',
            'purpose'       => 'nullable|string|max:255',
            'amount'        => 'required|numeric|min:0.01',
            'interest_rate' => 'required|numeric|min:0',
            'duration'      => 'required|numeric|min:1', 
            'frequency'     => 'required|string|in:Monthly,Weekly',
            'start_date'    => 'required|date',
            'method'        => 'required|string|in:Declining,Fixed',
            'status'        => 'required|string|in:Active,Pending,Paid',
        ];

        // Custom validation attribute names
        $customAttributes = [
            'customer_id' => 'customer name',
        ];

        // $request->validate(rules, customMessages, customAttributes)
        return $request->validate($rules, [], $customAttributes);
    }

    /**
     * Handle financial computations for interest and payments.
     */
    protected function calculateLoanDetails(array $data)
    {
        $principal = $data['amount'];
        $rate      = $data['interest_rate'] / 100;
        $months    = (float) $data['duration'];

        // Core calculation formula
        $totalInterest = $principal * $rate * ($months / 12);
        $totalPayable  = $principal + $totalInterest;
        
        $monthlyPay = $months > 0 ? ($totalPayable / $months) : $totalPayable;

        return [
            'total_interest'  => $totalInterest,
            'total_payable'   => $totalPayable,
            'monthly_payment' => $monthlyPay,
        ];
    }
}