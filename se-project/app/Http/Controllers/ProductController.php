<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware(['permission:product-list|product-create|product-edit|product-delete'], ['only' => ['index', 'show', 'create', 'store', 'edit', 'update', 'destroy']]);
        $this->middleware(['permission:product-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:product-edit'], ['only' => ['edit', 'update', 'show']]);
        $this->middleware(['permission:product-delete'], ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$products = Inventory::latest()->paginate(7);
        $products = Inventory::orderBy('id', 'ASC')->get();
        $title = 'Delete Product!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('name', 'name')->all();
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'nullable',
            'remain' => 'nullable|numeric|min:0',
            'minimum' => 'required|numeric|min:0',
            'categories' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $inventory = new Inventory();
        $inventory->name = $request->name;
        if ($request->hasAny('description')) {
            $inventory->description = $request->description;
        }
        if ($request->hasAny('remain')) {
            $inventory->remain = $request->remain;
        }
        $inventory->minimum = $request->minimum;
        $inventory->category_id = Category::where('name', $request->categories)->first()->id;
        if ($request->has('image')) {
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = 'images/products/';
            $image->move($path, $filename);
            $inventory->image =  $path . $filename;
        }

        $inventory->save();
        return redirect()->route('products.index')
            ->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Inventory::find($id);
        $categories = Category::pluck('name', 'name')->all();
        return view('products.show', compact('product', 'categories'));
    }

    /* public function add(Request $request, $id)
    {
        $this->validate($request,[
            'add' => 'nullable',
        ]);

        $inventory = Inventory::findOrFail($id);
        if ($request->hasAny('add')) {
            $inventory->remain += $request->add;
        }

        $inventory->save();
        
        return redirect()->route('products.index')
        ->with('success', 'Product add successfully');
    }*/

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Inventory::find($id);
        $categories = Category::pluck('name', 'name')->all();
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        // Find the inventory item
        $inventory = Inventory::findOrFail($id);

        // Check if 'add' parameter is present in the request
        if ($request->has('add')) {
            // Validate additional fields
            $this->validate($request, [
                'add' => 'required|numeric|min:0',
            ]);

            // Increase the remaining quantity
            $inventory->remain += $request->add;

            // Save the changes
            $inventory->save();

            return redirect()->route('products.index')
                ->with('success', 'Product quantity added successfully');
        } else {
            // Validate common fields
            $this->validate($request, [
                'name' => 'required',
                'description' => 'nullable',
                'remain' => 'nullable|numeric|min:0',
                'minimum' => 'required|numeric|min:0',
                'categories' => 'required',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            ]);
            // Update the inventory item with the provided data
            $inventory->name = $request->name;
            $inventory->description = $request->description;
            $inventory->remain = $request->remain;
            $inventory->minimum = $request->minimum;
            $inventory->category_id = Category::where('name', $request->categories)->first()->id;

            // Handle image upload if provided
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $extension = $image->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $path = 'images/products/';
                $image->move($path, $filename);
                $inventory->image =  $path . $filename;
            }

            // Save the changes
            $inventory->save();

            return redirect()->route('products.index')
                ->with('success', 'Product updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Inventory::find($id)->delete();
        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully');
    }
}
