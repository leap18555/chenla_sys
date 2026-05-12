<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer; // <-- import the model

class CustomersController extends Controller
{
    public function index()
    {
        $customers = Customer::all(); // fetch all customers
        return view('customers.index', compact('customers'));
    }

        public function create()
    {
        return view('customers.create');
    }
public function store(Request $request)
{
    try {
        // Handle Image 1
        $idPhotoPath = $request->hasFile('id_photo') 
            ? $request->file('id_photo')->store('customers', 'public') 
            : null;

        // Handle Image 2
        $familyPhotoPath = $request->hasFile('family_photo') 
            ? $request->file('family_photo')->store('customers', 'public') 
            : null;

        Customer::create([
            'name'         => $request->name,
            'email'        => $request->email,
            'phone'        => $request->phone,
            'id_number'    => $request->id_number,
            'dob'          => $request->dob,
            'pob'          => $request->pob,
            'house_no'     => $request->house_no,
            'street'       => $request->street,
            'district'     => $request->district,
            'id_photo'     => $idPhotoPath,
            'family_photo' => $familyPhotoPath,
        ]);

        return redirect()->route('customers.index')->with('success', 'Saved!');

    } catch (\Exception $e) {
        // This will print the exact error message if the save fails
        return $e->getMessage(); 
    }
}
     public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('customers.edit', compact('customer'));
    }
       // 5️⃣ Update customer ✅ FIXED
    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email,' . $id,
            'phone' => 'required'
        ]);

        $customer->update($request->all());

        return redirect()->route('customers.index')
            ->with('success', 'Customer updated successfully');
    }
      // 6️⃣ Delete customer
    public function destroy($id)
    {
        Customer::findOrFail($id)->delete();

        return redirect()->route('customers.index')
            ->with('success', 'Customer deleted successfully');
    }
    // app/Http/Controllers/CustomerController.php

public function show($id)
    {
        // Fetch the specific customer or 404
        $item = Customer::findOrFail($id);

        // Pass it to the detail view as 'item'
        return view('customers.detail', compact('item'));
    }
}
