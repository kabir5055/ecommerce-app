<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public static $category,$image, $imageNewName, $imageUrl, $directory;
    public static function saveCategory($request)
    {
        self::$category = new Category();

        self::$category->category_name = $request->category_name;
        self::$category->image = self::saveImage($request);
        self::$category->save();
    }
    private static function saveImage($request)
    {
        self::$image = $request->file('image');
        if (self::$image)
        {
            if (self::$category->image)
            {
                if (file_exists(self::$category->image))
                {
                    unlink(self::$category->image);
                }
            }
            self::$imageNewName = $request->category_name.'-'.rand().'.'.self::$image->getClientOriginalExtension();
            self::$directory = 'admin-asset/upload-image/category/';
            self::$imageUrl = self::$directory.self::$imageNewName;
            self::$image->move(self::$directory,self::$imageNewName);
        }
        else
        {
            self::$imageUrl = self::$category->image;
        }
        return self::$imageUrl;
    }
    public static function updateStatus($id)
    {
        self::$category = Category::findorfail($id);
        if (self::$category->status ==1)
        {
            self::$category->status = 0;
        }
        else
        {
            self::$category->status = 1;
        }
        self::$category->save();
    }
    public static function updateCategory($request,$id)
    {
        self::$category = Category::findorFail($id);
        self::$category->category_name = $request->category_name;
        self::$category->image = self::saveImage($request);
        self::$category->status = $request->status;
        self::$category->save();

    }
    public static function deleteCategory($id)
    {
        self::$category = Category::findorFail($id);
        if (self::$category->image)
        {
            if (file_exists(self::$category->image))
            {
                unlink(self::$category->image);
            }
        }
        self::$category->delete();
    }
}
