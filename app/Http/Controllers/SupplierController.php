<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.supplier.manage-supplier',[
            'suppliers'=>Supplier::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.supplier.supplier');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Supplier::saveSupplier($request);
        return redirect(route('admin.supplier.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        Supplier::updateStatus($id);
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('admin.supplier.supplier',[
            'supplier' => Supplier::find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Supplier::updateSupplier($request,$id);
        return redirect(route('admin.supplier.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Supplier::deleteSupplier($id);
        return back();
    }
}
