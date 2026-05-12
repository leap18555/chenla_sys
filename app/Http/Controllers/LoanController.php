<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loan;

class LoanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $loans = Loan::latest()->paginate(10);

        // Filter totals by currency if needed, or sum them as is
        $activeTotal  = Loan::where('status', 'active')->sum('amount');
        $pendingTotal = Loan::where('status', 'pending')->sum('amount');
        $paidTotal    = Loan::where('status', 'paid')->sum('amount');

        return view('loans.index', compact('loans', 'activeTotal', 'pendingTotal', 'paidTotal'));
    }

    public function create()
    {
        return view('loans.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateLoan($request);
        
        $data = array_merge($validated, $this->calculateLoanDetails($validated));
        $data['user_id'] = auth()->id();
        $data['status'] = 'active';

        Loan::create($data);

        return redirect()->route('loans.index')->with('success', 'Loan created successfully.');
    }

    public function update(Request $request, Loan $loan)
    {
        $validated = $this->validateLoan($request, true);
        $data = array_merge($validated, $this->calculateLoanDetails($validated));

        $loan->update($data);

        return redirect()->route('loans.index')->with('success', 'Loan updated successfully.');
    }

    protected function validateLoan(Request $request, $isUpdate = false)
    {
        $rules = [
            'customer_name' => 'required|string|max:255',
            'type'          => 'required|string|max:255',
            'currency'      => 'required|in:USD,KHR', // Added currency validation
            'amount'        => 'required|numeric|min:1',
            'interest_rate' => 'required|numeric|min:0',
            // Changed 'integer' to 'numeric' and 'min:1' to 'min:0.5' to allow 2 weeks
            'duration'      => 'required|numeric|min:0.5', 
        ];

        if ($isUpdate) {
            $rules['status'] = 'required|in:active,pending,paid';
        }

        return $request->validate($rules);
    }

    protected function calculateLoanDetails(array $data)
    {
        $principal = $data['amount'];
        $rate      = $data['interest_rate'] / 100;
        $months    = (float) $data['duration']; // Ensure this is a float for 0.5 calculation

        $totalInterest = $principal * $rate * ($months / 12);
        $totalPayable  = $principal + $totalInterest;
        
        // Prevent division by zero, though validation min:0.5 prevents this
        $monthlyPay = $months > 0 ? ($totalPayable / $months) : $totalPayable;

        return [
            'total_interest'  => $totalInterest,
            'total_payable'   => $totalPayable,
            'monthly_payment' => $monthlyPay,
        ];
    }


        public function show(Loan $loan)
    {
        return view('loans.show', compact('loan'));
    }
}