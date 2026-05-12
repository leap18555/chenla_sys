<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Deposit | FinanceApp</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --bg-warm: #fdfcfb;
            --card-bg: #ffffff;
            --primary-coral: #f43f5e;
            --text-main: #334155;
            --text-muted: #64748b;
            --input-bg: #f8fafc;
        }

        body { 
            font-family: 'Outfit', sans-serif; 
            background-color: var(--bg-warm); 
            color: var(--text-main);
            /* Subtle soft background shapes */
            background-image: radial-gradient(at 0% 0%, rgba(244, 63, 94, 0.05) 0px, transparent 50%),
                              radial-gradient(at 100% 100%, rgba(99, 102, 241, 0.05) 0px, transparent 50%);
        }

        .container {
            max-width: 500px;
        }

        /* The "Bento" Card */
        .card { 
            border: none; 
            border-radius: 30px; 
            background-color: var(--card-bg);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.02), 0 10px 10px -5px rgba(0, 0, 0, 0.01);
            padding: 1.5rem;
        }

        /* Soft Form Elements */
        .form-label {
            font-weight: 500;
            margin-left: 0.5rem;
            color: var(--text-main);
        }

        .form-control, .form-select { 
            background-color: var(--input-bg);
            border: 2px solid transparent; 
            border-radius: 18px; 
            padding: 0.8rem 1.2rem;
            transition: all 0.25s ease;
        }

        .form-control:focus, .form-select:focus { 
            background-color: #fff;
            border-color: #ffe4e6; /* Soft coral tint */
            box-shadow: 0 0 0 4px rgba(244, 63, 94, 0.1);
            outline: none;
        }

        .input-group-text {
            background-color: var(--input-bg);
            border: none;
            border-radius: 18px 0 0 18px !important;
            padding-left: 1.2rem;
            color: var(--primary-coral);
            font-weight: 600;
        }

        .input-group .form-control {
            border-radius: 0 18px 18px 0 !important;
        }

        /* Approachable Button */
        .btn-primary { 
            background-color: var(--primary-coral); 
            border: none; 
            font-weight: 600; 
            border-radius: 18px; 
            padding: 1rem; 
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .btn-primary:hover { 
            background-color: #e11d48;
            transform: scale(1.02);
        }

        .back-btn {
            color: var(--text-muted);
            text-decoration: none;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: color 0.2s;
        }

        .back-btn:hover {
            color: var(--primary-coral);
        }

        header h2 {
            font-weight: 600;
            letter-spacing: -0.5px;
        }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="mb-4">
        <a href="{{ route('deposits.index') }}" class="back-btn small">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
            Back to list
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <header class="text-center mb-5">
                <h2 class="mb-2">New Deposit</h2>
                <p class="text-muted">Fill in the details to add funds</p>
            </header>
            
            <form action="{{ route('deposits.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="customer_id" class="form-label">Customer</label>
                    <select name="customer_id" id="customer_id" class="form-select @error('customer_id') is-invalid @enderror">
                        <option value="" selected disabled>Select a customer</option>
                        @foreach($customers as $customer)
                            <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                {{ $customer->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="amount" class="form-label">How much?</label>
                    <div class="input-group">
                        <span class="input-group-text">$</span>
                        <input type="number" step="0.01" name="amount" id="amount" 
                               class="form-control" 
                               placeholder="0.00" value="{{ old('amount') }}" required>
                    </div>
                </div>

                <div class="mb-5">
                    <label for="deposit_date" class="form-label">Date</label>
                    <input type="date" name="deposit_date" id="deposit_date" 
                           class="form-control" 
                           value="{{ old('deposit_date', date('Y-m-d')) }}">
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">
                        Add to Balance
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <footer class="mt-5 text-center">
        <span class="badge rounded-pill bg-light text-muted p-2 px-3">
            ✨ Verified Deposit Entry
        </span>
    </footer>
</div>

</body>
</html>