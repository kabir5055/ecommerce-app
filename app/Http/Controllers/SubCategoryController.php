<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use App\Models\Category;
use Illuminate\Http\Request;
use DB;
use function Symfony\Component\Console\Style\table;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subCategory = DB::table('sub_categories')
        ->join('categories','sub_categories.category_id','=','categories.id')
        ->select('sub_categories.*','categories.category_name')
        ->get();
        return view('admin.sub-category.manage-sub-category',[
            'sub_categories' => $subCategory,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.sub-category.sub-category',[
            'categories' => Category::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        SubCategory::saveSubcategory($request);
        return redirect(route('admin.sub-category.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        SubCategory::updateStatus($id);
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('admin.sub-category.sub-category',[
            'sub_category' => SubCategory::find($id),
            'categories' => Category::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        SubCategory::updateSubCategory($request,$id);
        return redirect(route('admin.sub-category.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        SubCategory::deleteSubCategory($id);
        return back();
    }
}
