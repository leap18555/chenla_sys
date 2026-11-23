<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Repayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RepaymentController extends Controller
{
    /**
     * Display the repayment dashboard interface and history list.
     */
    public function index(Request $request)
    {
        $query = Repayment::with(['loan.customer'])->latest('payment_date');

        if ($request->filled('loan_id')) {
            $query->where('loan_id', $request->input('loan_id'));
        }

        $repayments = $query->get();
        $activeLoansCount = Loan::where('status', 'active')->count();

        return view('repayments.index', compact('repayments', 'activeLoansCount'));
    }

    /**
     * Show the form for creating/recording a new repayment.
     */
    public function create(Request $request)
    {
        // Fetch active loans with customer details
        $loans = Loan::with('customer')
            ->where('status', 'active')
            ->get();

        $selectedLoanId = $request->query('loan_id', '');
        $defaultAmount = $request->query('amount', '');

        return view('repayments.create', compact('loans', 'selectedLoanId', 'defaultAmount'));
    }

    /**
     * Store a newly created repayment transaction log in the database.
     */
    public function store(Request $request)
    {
        // 1. Validate the form inputs strictly
        $validated = $request->validate([
            'loan_id'        => 'required|exists:loans,id',
            'payment_date'   => 'required|date',
            'amount_paid'    => 'required|numeric|min:0.01',
            'penalty_amount' => 'nullable|numeric|min:0',
            'payment_method' => 'required|string',
            'notes'          => 'nullable|string',
        ]);

        // 2. Auto-generate a secure transaction code (e.g., Receipt RC-492)
        $validated['receipt_code'] = 'Receipt RC-' . str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT);
        
        // Ensure penalty defaults safely to 0 if left empty
        $validated['penalty_amount'] = $request->input('penalty_amount') ?? 0.00;

        // 3. Optional Bonus Business Logic: Deduct the paid amount from the loan balance
        DB::transaction(function () use ($validated) {
            // Save the repayment log
            Repayment::create($validated);

            // Find the loan object and subtract the incoming payment from total_payable
            $loan = Loan::findOrFail($validated['loan_id']);
            $loan->total_payable -= $validated['amount_paid'];

            // If the customer fully cleared the debt, flip status to closed automatically
            if ($loan->total_payable <= 0) {
                $loan->total_payable = 0;
                $loan->status = 'closed';
            }
            $loan->save();
        });

        // 4. Redirect back or to specified route with a success banner notice
        $redirectUrl = $request->input('redirect_to', route('repayments.index'));

        return redirect($redirectUrl)
            ->with('success', 'ការសងប្រាក់ត្រូវបានរក្សាទុកដោយជោគជ័យ!');
    }
}