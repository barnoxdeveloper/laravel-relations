<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\{Product, ProductGallery};

class ProductGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galleries = ProductGallery::with('product')->get();
        $i = 1;
        return view('pages.galleries.index', compact('galleries', 'i'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        return view('pages.galleries.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|boolean',
        ]);

        $photoPath = $request->file('photo')->store('gallery', 'public');

        ProductGallery::create([
            'product_id' => $request->product_id,
            'photo' => $photoPath,
            'status' => $request->status,
        ]);

        return redirect()->route('galleries.index')->with('success', 'Photo added to the gallery successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductGallery $gallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductGallery $gallery)
    {
        $products = Product::all();
        return view('pages.galleries.edit', compact('products', 'gallery'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, ProductGallery $gallery)
    {
        $request->validate([
            'product_id' => 'required|exists:sub_categories,id',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|boolean',
        ]);

        // Store the old photo path
        $oldPhotoPath = $gallery->photo;

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('gallery', 'public');
            $gallery->update(['photo' => $photoPath]);

            // Delete the old photo
            if (Storage::disk('public')->exists($oldPhotoPath)) {
                Storage::disk('public')->delete($oldPhotoPath);
            }
        } else {
            // If no new photo is uploaded, only update product_id and status
            $gallery->update([
                'product_id' => $request->product_id,
                'status' => $request->status,
            ]);
        }

        return redirect()->route('galleries.index')->with('success', 'Photo updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductGallery $gallery)
    {
        // Store the photo path before deleting the gallery item
        $photoPath = $gallery->photo;

        // Delete the gallery item
        $gallery->delete();

        // Delete the photo file from storage
        if (Storage::disk('public')->exists($photoPath)) {
            Storage::disk('public')->delete($photoPath);
        }

        return redirect()->route('galleries.index')->with('success', 'Photo deleted from the gallery successfully.');
    }
}
