<?php

namespace App\Http\Controllers;

use App\Models\SalesMan;
use Illuminate\Http\Request;
use DataTables;

class SalesManController extends Controller
{
    // Display a list of all salesman
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // Fetch the salesmen and filter by the logged-in user's ID
            $salesMen = SalesMan::select(['id', 'name', 'number', 'email', 'address', 'image', 'email', 'salary', 'created_at'])
                ->where('user_id', auth()->id())  // Filter by user_id
                ->get();

            return DataTables::of($salesMen)
                ->addIndexColumn()  // Automatically adds row index
                ->addColumn('actions', function ($salesMan) {
                    return '
                        <a href="' . route('salesman.edit', ['salesman' => $salesMan->id, 'user_id' => auth()->id()]) . '" class="btn btn-sm btn-warning">Edit</a>
                        <form action="' . route('salesman.destroy', ['salesman' => $salesMan->id, 'user_id' => auth()->id()]) . '" method="POST" style="display:inline-block;">
                            <input type="hidden" name="_token" value="' . csrf_token() . '">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    ';
                })
                ->rawColumns(['actions'])  // Enable raw HTML rendering for the actions column
                ->make(true);
        }

        return view('admin.salesman.index');
    }

    

    // Show the form to create a new salesman
    public function create()
    {
        return view('admin.salesman.create');
    }

    // Store a new salesman
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|max:255',
            'number' => 'required|max:15',
            'email' => 'nullable|email',
            'address' => 'nullable|string',
            'salary' => 'nullable|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',  // Validate image
        ]);
    
        // Create a new SalesMan instance
        $salesMan = new SalesMan();
        $salesMan->name = $request->name;
        $salesMan->number = $request->number;
        $salesMan->email = $request->email;
        $salesMan->address = $request->address;
        $salesMan->salary = $request->salary;
        $salesMan->user_id = auth()->id(); // Assign the logged-in user ID
    
        // Handle image upload if provided
        if ($request->hasFile('image')) {
            // Generate a unique name for the image
            $imageName = time() . '.' . $request->image->extension();
    
            // Move the uploaded image to a directory
            $request->image->move(public_path('img/salesman'), $imageName);
    
            // Save the image path to the database
            $salesMan->image = 'salesman/' . $imageName;
        }
    
        // Save the salesman record
        $salesMan->save();
    
        // Redirect with success message
        return redirect()->route('salesman.index', ['user_id' => auth()->id()])->with('success', 'Salesman created successfully!');
    }
    
    




    // Show the form to edit an existing salesman
    public function edit($user_id, $id)
    {
        $salesMan = SalesMan::findOrFail($id);

        // Ensure the salesman belongs to the current user
        if ($salesMan->user_id !== auth()->id()) {
            return redirect()->route('salesman.index', ['user_id' => auth()->id()])->with('error', 'Unauthorized');
        }

        return view('admin.salesman.edit', compact('salesMan'));
    }

    // Update an existing salesman
    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|max:255',
            'number' => 'required|max:15',
            'email' => 'nullable|email',
            'address' => 'nullable|string',
            'salary' => 'nullable|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',  // Image validation
        ]);

        $salesMan = SalesMan::findOrFail($id);

        // Ensure the logged-in user owns this salesman
        if ($salesMan->user_id !== auth()->id()) {
            return redirect()->route('salesman.index', ['user_id' => auth()->id()])->with('error', 'Unauthorized');
        }

        // Handle the image upload if a new image is provided
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($salesMan->image && file_exists(public_path('storage/' . $salesMan->image))) {
                unlink(public_path('storage/' . $salesMan->image));
            }

            // Store the new image
            $imagePath = $request->file('image')->store('salesman_images', 'public');
            $salesMan->image = $imagePath;
        }

        // Update the salesman fields
        $salesMan->update([
            'name' => $request->name,
            'number' => $request->number,
            'email' => $request->email,
            'address' => $request->address,
            'salary' => $request->salary,
        ]);

        return redirect()->route('salesman.index', ['user_id' => auth()->id()])->with('success', 'Salesman updated successfully!');
    }


    // Delete a salesman
    public function destroy($user_id, $id)
    {
        $salesMan = SalesMan::findOrFail($id);

        // Ensure the logged-in user owns this salesman
        if ($salesMan->user_id !== auth()->id()) {
            return redirect()->route('salesman.index')->with('error', 'Unauthorized');
        }

        $salesMan->delete();

        return redirect()->route('salesman.index', ['user_id' => auth()->id()])->with('success', 'Salesman deleted successfully!');
    }
}
