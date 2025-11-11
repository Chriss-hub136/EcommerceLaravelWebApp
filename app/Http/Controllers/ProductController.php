<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    // OLD:
    // $products = Product::latest()->paginate(10); 

    // NEW (Eager Loading):
    $products = Product::with('category')->latest()->paginate(10);

    return view('admin.products.index', compact('products'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    $categories = Category::all();
    return view('admin.products.create', compact('categories'));

    }

    public function shop()
    {
        // We eager load 'category' to show it on the shop page
        $products = Product::with('category')->latest()->paginate(12);

        return view('shop.index', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // 1. Validate the incoming request data
    $request->validate([
        'name' => 'required|string|max:255',
        'category_id' => 'nullable|exists:categories,id',
        'price' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'description' => 'nullable|string',
        // Validation for the image file
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // 2MB max
    ]);

    // Get all data *except* the image, to handle it separately
    $data = $request->except('image'); 

    // 2. Handle File Upload
    if ($request->hasFile('image')) {
        // Store the file in the 'products' folder inside 'storage/app/public'
        // The 'public' disk ensures it's accessible via the 'public/storage' link
        $path = $request->file('image')->store('products', 'public');
        
        // Add the file path (e.g., 'products/randomfilename.jpg') to the data array
        $data['image'] = $path; 
    }

    // 3. Create Product using the prepared data array
    // (Ensure you have 'Product' model imported at the top: use App\Models\Product;)
    Product::create($data);

    // 4. Redirect back to the index page with a success message
    return redirect()->route('admin.products.index')
        ->with('success', 'Product created successfully.');
}
    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
       // 'Product $product' is Route-Model Binding.
    // Laravel automatically finds the Product with the ID from the URL.
    return view('products.show', compact('product'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
         $categories = Category::all();
    return view('admin.products.edit', compact('product', 'categories'));


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
{
    // 1. Validate the incoming request data
    $request->validate([
        'name' => 'required|string|max:255',
        'category_id' => 'nullable|exists:categories,id',
        'price' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'description' => 'nullable|string',
        // Validation for the image file
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // 2MB max
    ]);

    // Get all data *except* the image, to handle it separately
    $data = $request->except('image');

    // 2. Handle File Upload (only runs if a new file was selected)
    if ($request->hasFile('image')) {
        
        // **CRITICAL STEP: Delete the old image if it exists**
        if ($product->image) {
            // Use the Storage Facade with the 'public' disk to delete the file path stored in the database
            Storage::disk('public')->delete($product->image);
        }

        // Store the new image in 'products' folder inside 'storage/app/public'
        $path = $request->file('image')->store('products', 'public');
        
        // Add the new file path to the data array for database update
        $data['image'] = $path;
    }

    // 3. Update the existing Product model instance with the prepared data
    $product->update($data);

    // 4. Redirect back to the index page with a success message
    return redirect()->route('admin.products.index')
        ->with('success', 'Product updated successfully.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
       // Delete the product from the database
    $product->delete();

    // Redirect back with a success message
    return redirect()->route('admin.products.index')
                     ->with('success', 'Product deleted successfully.');

    }
}
