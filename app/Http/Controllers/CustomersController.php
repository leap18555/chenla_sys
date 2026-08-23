<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Storage;

class CustomersController extends Controller
{
    // LIST
    public function index()
    {
        $customers = Customer::all();
        return view('customers.index', compact('customers'));
    }

    // CREATE PAGE (កែសម្រួលត្រង់នេះ)
    public function create()
    {
        // ទាញយកបញ្ជីអតិថិជនទាំងអស់ដើម្បីបោះទៅឱ្យ Dropdown <select>
        $customers = Customer::all();
        return view('customers.create', compact('customers'));
    }

    // STORE
    public function store(Request $request)
    {
        // 1. Validate all incoming form fields matching your Blade names exactly
        $validatedData = $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => 'required|email|unique:customers,email',
            'phone'        => 'required|string|max:50',
            'gender'       => 'required|string|in:Male,Female,Other', 
            'job'          => 'required|string|max:255',              
            'id_number'    => 'nullable|string|max:50',
            'dob'          => 'nullable|date',
            'pob'          => 'nullable|string|max:255',
            'house_no'     => 'nullable|string|max:50',
            'street'       => 'nullable|string|max:50',
            'district'     => 'nullable|string|max:255',
            'id_photo'     => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'family_photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
        ]);

        try {
            // 2. Process Identity Photo Upload
            if ($request->hasFile('id_photo')) {
                $validatedData['id_photo'] = $request
                    ->file('id_photo')
                    ->store('customers', 'public');
            } else {
                $validatedData['id_photo'] = null;
            }

            // 3. Process Family Photo Upload
            if ($request->hasFile('family_photo')) {
                $validatedData['family_photo'] = $request
                    ->file('family_photo')
                    ->store('customers', 'public');
            } else {
                $validatedData['family_photo'] = null;
            }

            // 4. Filter only keys allowed by your Model's $fillable array
            $allowedFields = (new Customer())->getFillable();
            $filteredData = array_intersect_key($validatedData, array_flip($allowedFields));

            // 5. Secure Database Mass Creation using matching fields
            Customer::create($filteredData);

            return redirect()
                ->route('customers.index')
                ->with('success', 'Customer profile registered safely!');

        } catch (\Exception $e) {
            return back()
                ->with('error', 'Database Error: ' . $e->getMessage())
                ->withInput();
        }
    }

    // SHOW
    public function show($id)
    {
        $item = Customer::findOrFail($id);
        return view('customers.detail', compact('item'));
    }

    // EDIT PAGE (កែសម្រួលត្រង់នេះ)
    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        // ទាញយកបញ្ជីអតិថិជនទាំងអស់ក្នុងករណីយក Dropdown ទៅប្រើក្នុងទំព័រ Edit ដែរ
        $customers = Customer::all();
        
        return view('customers.edit', compact('customer', 'customers'));
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);

        $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => 'required|email|unique:customers,email,' . $id,
            'phone'        => 'required|string|max:50',
            'gender'       => 'required|string|in:Male,Female,Other', 
            'job'          => 'required|string|max:255',              
            'id_number'    => 'nullable|string|max:50',
            'dob'          => 'nullable|date',
            'pob'          => 'nullable|string|max:255',
            'house_no'     => 'nullable|string|max:50',
            'street'       => 'nullable|string|max:50',
            'district'     => 'nullable|string|max:255',
            'id_photo'     => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'family_photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
        ]);

        // Update ID Photo
        if ($request->hasFile('id_photo')) {
            if ($customer->id_photo) {
                Storage::disk('public')->delete($customer->id_photo);
            }
            $customer->id_photo = $request->file('id_photo')->store('customers', 'public');
        }

        // Update Family Photo
        if ($request->hasFile('family_photo')) {
            if ($customer->family_photo) {
                Storage::disk('public')->delete($customer->family_photo);
            }
            $customer->family_photo = $request->file('family_photo')->store('customers', 'public');
        }

        // Update other fields
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->gender = $request->gender; 
        $customer->job = $request->job;       
        $customer->id_number = $request->id_number;
        $customer->dob = $request->dob;
        $customer->pob = $request->pob;
        $customer->house_no = $request->house_no;
        $customer->street = $request->street;
        $customer->district = $request->district;

        $customer->save();

        return redirect()
            ->route('customers.index')
            ->with('success', 'Customer updated successfully');
    }

    // DELETE
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);

        if ($customer->id_photo) {
            Storage::disk('public')->delete($customer->id_photo);
        }

        if ($customer->family_photo) {
            Storage::disk('public')->delete($customer->family_photo);
        }

        $customer->delete();

        return redirect()
            ->route('customers.index')
            ->with('success', 'Customer deleted successfully');
    }
}