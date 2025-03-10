<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Unit;
use App\Models\Category;
use App\Models\Godown;
use Illuminate\Http\Request;
use DataTables;

class ProductController extends Controller
{
    // Display a list of products
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // Fetch the products and eager load the relationships
            $products = Product::with(['unit', 'category', 'godown', 'user'])
                ->where('user_id', auth()->id())  // Filter by the logged-in user
                ->get();

            return DataTables::of($products)
                ->addIndexColumn()  // Automatically adds row index (DT_RowIndex)
                ->addColumn('actions', function ($product) {
                    return '
                        <a href="' . route('products.edit', ['product' => $product->id, 'user_id' => auth()->id()]) . '" class="btn btn-sm btn-warning">Edit</a>
                        <form action="' . route('products.destroy', ['product' => $product->id, 'user_id' => auth()->id()]) . '" method="POST" style="display:inline-block;">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    ';
                })
                ->rawColumns(['actions'])  // Enable raw HTML rendering for the actions column
                ->make(true);
        }

        return view('admin.products.index');
    }



    // Show the form to create a new product
    public function create()
    {
        $units = Unit::all();
        $categories = Category::all();
        $godowns = Godown::all();
        
        return view('admin.products.create', compact('units', 'categories', 'godowns'));
    }

    // Store a new product
    public function store(Request $request)
    {
        $request->validate([
            'item_name' => 'required|string|max:255',
            'item_part' => 'nullable|string|max:255',
            'unit_id' => 'required|exists:units,id',
            'category_id' => 'required|exists:categories,id',
            'purchase_price' => 'required|numeric',
            'sales_price' => 'required|numeric',
            'godown_id' => 'required|exists:godowns,id',
            'previous_stock' => 'required|integer',
            'total_previous_stock' => 'nullable|integer',
            'description' => 'nullable|string',
        ]);

        Product::create([
            'item_name' => $request->item_name,
            'item_part' => $request->item_part,
            'unit_id' => $request->unit_id,
            'category_id' => $request->category_id,
            'purchase_price' => $request->purchase_price,
            'sales_price' => $request->sales_price,
            'godown_id' => $request->godown_id,
            'previous_stock' => $request->previous_stock,
            'total_previous_stock' => $request->total_previous_stock,
            'description' => $request->description,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('products.index',['user_id' => auth()->id()])->with('success', 'Product created successfully!');
    }

    // Show the form to edit an existing product
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $units = Unit::all();
        $categories = Category::all();
        $godowns = Godown::all();

        return view('admin.products.edit', compact('product', 'units', 'categories', 'godowns'));
    }

    // Update an existing product
    public function update(Request $request, $id)
    {
        $request->validate([
            'item_name' => 'required|string|max:255',
            'item_part' => 'nullable|string|max:255',
            'unit_id' => 'required|exists:units,id',
            'category_id' => 'required|exists:categories,id',
            'purchase_price' => 'required|numeric',
            'sales_price' => 'required|numeric',
            'godown_id' => 'required|exists:godowns,id',
            'previous_stock' => 'required|integer',
            'total_previous_stock' => 'nullable|integer',
            'description' => 'nullable|string',
        ]);

        $product = Product::findOrFail($id);
        
        $product->update([
            'item_name' => $request->item_name,
            'item_part' => $request->item_part,
            'unit_id' => $request->unit_id,
            'category_id' => $request->category_id,
            'purchase_price' => $request->purchase_price,
            'sales_price' => $request->sales_price,
            'godown_id' => $request->godown_id,
            'previous_stock' => $request->previous_stock,
            'total_previous_stock' => $request->total_previous_stock,
            'description' => $request->description,
        ]);

        return redirect()->route('products.index', ['user_id' => auth()->id()])->with('success', 'Product updated successfully!');
    }

    // Delete a product
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index', ['user_id' => auth()->id()])->with('success', 'Product deleted successfully!');
    }
}
