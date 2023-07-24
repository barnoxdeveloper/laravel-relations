<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Product, ProductGallery};

class ProductGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galleries = ProductGallery::all();
        $i = 1;
        return view('pages.galleries.index', compact('galleries', 'i'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        return view('pages.galleries.index', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'sub_category_id' => 'required|exists:sub_categories,id',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|boolean',
        ]);

        $photoPath = $request->file('photo')->store('gallery', 'public');

        ProductGallery::create([
            'product_id' => $request->product_id,
            'photo' => $photoPath,
            'status' => true, // Set the status to true by default
        ]);

        return redirect()->route('galleries.index')->with('success', 'Photo added to the gallery successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductGallery $productGallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductGallery $productGallery)
    {
        return view('galleries.edit', compact('product', 'gallery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductGallery $productGallery)
    {
        $request->validate([
            'sub_category_id' => 'required|exists:sub_categories,id',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|boolean',
        ]);

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('gallery', 'public');
            $productGallery->update(['photo' => $photoPath]);
        }

        // You can add additional fields to update if needed, e.g., 'status'

        return redirect()->route('galleries.index', $productGallery->id)->with('success', 'Photo updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductGallery $productGallery)
    {
        $productGallery->delete();

        return redirect()->route('galleries.index', $productGallery->id)->with('success', 'Photo deleted from the gallery successfully.');
    }
}
