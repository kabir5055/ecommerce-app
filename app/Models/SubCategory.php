<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    public static $sub_category;

    public static function saveSubcategory($request)
    {
        self::$sub_category = new SubCategory();
        self::$sub_category->category_id = $request->category_id;
        self::$sub_category->sub_category =$request->sub_category;
        self::$sub_category->save();
    }
    public static function updateStatus($id)
    {
        self::$sub_category = SubCategory::findorfail($id);

        if (self::$sub_category->status == 1)
        {
            self::$sub_category->status = 0;
        }
        else
        {
            self::$sub_category->status = 1;
        }
        self::$sub_category->save();
    }
    public static function updateSubCategory($request,$id)
    {
        self::$sub_category = SubCategory::findorfail($id);
        self::$sub_category->category_id = $request->category_id;
        self::$sub_category->sub_category =$request->sub_category;
        self::$sub_category->status =$request->status;
        self::$sub_category->save();
    }
    public static function deleteSubCategory($id){
        self::$sub_category = SubCategory::findOrFail($id);
        if (self::$sub_category->image)
        {
            if (file_exists(self::$sub_category->image))
            {
                unlink(self::$sub_category->image);
            }
        }
        self::$sub_category->delete();
    }
}
