<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    private static $brand,$image,$imageNewName,$directory,$imageUrl;

    public static function saveBrand($request)
    {
        self::$brand = new Brand();
        self::$brand->brand_name = $request->brand_name;
        self::$brand->image = self::saveImage($request);
        self::$brand->save();

    }
    private static function saveImage($request)
    {
        self::$image = $request->file('image');
        if (self::$image)
        {
            if (self::$brand->image)
            {
                if (file_exists(self::$brand->image))
                {
                    unlink(self::$brand->image);
                }
            }
            self::$imageNewName = $request->category_name.'-'.rand().'.'.self::$image->getClientOriginalExtension();
            self::$directory = 'admin-asset/upload-image/brand/';
            self::$imageUrl = self::$directory.self::$imageNewName;
            self::$image->move(self::$directory,self::$imageNewName);
        }
        else
        {
            self::$imageUrl = self::$brand->image;
        }
        return self::$imageUrl;
    }
    public static function updateStatus($id)
    {
        self::$brand = Brand::find($id);
        if (self::$brand->status == 1)
        {
            self::$brand->status = 0;
        }
        else
        {
            self::$brand->status = 1;
        }
        self::$brand->save();
    }
    public static function brandUpdate($request,$id)
    {
        self::$brand = Brand::find($id);
        self::$brand->brand_name = $request->brand_name;
        self::$brand->image = self::saveImage($request);
        self::$brand->status = $request->status;
        self::$brand->save();
    }
    public static function deleteBrand($id)
    {
        self::$brand = Brand::findorfail($id);
        if (self::$brand->image)
        {
            if (file_exists(self::$brand->image))
            {
                unlink(self::$brand->image);
            }
        }
        self::$brand->delete();
    }
}
