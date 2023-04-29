<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    private static $product, $productId,$productColor, $productSize, $files, $file, $productSubImage;
    public static $imageNewName, $imageUrl, $directory;
    public static function saveProduct($request)
    {
       self::$product = new Product();

       self::$product->category_id = $request->category_id;
       self::$product->sub_category_id = $request->sub_category_id;
       self::$product->brand_id = $request->brand_id;
       self::$product->supplier_id = $request->supplier_id;
       self::$product->product_name = $request->product_name;
       self::$product->product_code = $request->product_code;
       self::$product->price = $request->price;
       self::$product->dis_amount = $request->dis_amount;
       self::$product->dis_price = $request->dis_price;
       self::$product->main_image = $request->main_image;
       self::$product->secondary_image = $request->secondary_image;
       self::$product->save();

       self::$productId = self::$product->id;
       return self::$productId;
    }

    public static function uploadImage($request, $productId)
    {
        if (self::$files = $request->file('sub_image'))
        {
            foreach (self::$files as self::$file)
            {
                self::$imageNewName = rand().'.'.self::$file->getClientOriginalExtension();
                self::$directory = 'admin-asset/upload-image/sub_image/';
                self::$imageUrl = self::$directory.self::$imageNewName;
                self::$file->move(self::$directory,self::$imageNewName);

                self::$productSubImage = new ProductSubImage();

                self::$productSubImage->product_id = $productId;
                self::$productSubImage->sub_image = self::$imageUrl;
                self::$productSubImage->save();
            }
        }
    }
    public static function color($request,$productId,$colors)
    {
        if ($colors > 0)
        {
            for ($i=0; $i<$colors;$i++)
            {
                self::$productColor = new ProductColor();
                self::$productColor->product_id = $productId;
                self::$productColor->color_id = $request->color_id[$i];
                self::$productColor->save();
            }
        }
    }

    public static function size($request,$productId,$sizes)
    {
        if ($sizes > 0)
        {
            for ($i=0; $i<$sizes; $i++)
            {
                self::$productSize = new ProductSize();
                self::$productSize->product_id = $productId;
                self::$productSize->size_id =$request->size_id[$i];
                self::$productSize->save();
            }
        }
    }
    public function getSupplierName()
    {
        return $this->belongsTo(Supplier::class,'supplier_id');
    }
    public static function updateProduct($request,$id)
    {
        self::$product = Product::find($id);

        self::$product->category_id = $request->category_id;
        self::$product->sub_category_id = $request->sub_category_id;
        self::$product->brand_id = $request->brand_id;
        self::$product->supplier_id = $request->supplier_id;
        self::$product->product_name = $request->product_name;
        self::$product->product_code = $request->product_code;
        self::$product->price = $request->price;
        self::$product->dis_amount = $request->dis_amount;
        self::$product->dis_price = $request->dis_price;
        self::$product->main_image = $request->main_image;
        self::$product->secondary_image = $request->secondary_image;
        self::$product->save();

        self::$productId = self::$product->id;
        return self::$productId;
    }
    public static function updateUploadImage($request,$productId)
    {
        self::$product = ProductSubImage::where('product_id',$productId)->get();

        foreach (self::$product as $item)
        {
            if (file_exists($item->sub_image))
            {
                unlink($item->sub_image);
                $item->delete();
            }
        }
        self::$files = $request->file('sub_image');
        if (self::$files)
        {
            foreach (self::$files as self::$file)
            {
                self::$imageNewName = rand().'.'.self::$file->getClientOriginalExtension();
                self::$directory = 'admin-asset/upload-image/sub_image/';
                self::$imageUrl = self::$directory.self::$imageNewName;
                self::$file->move(self::$directory,self::$imageNewName);

                self::$productSubImage = new ProductSubImage();

                self::$productSubImage->product_id = $productId;
                self::$productSubImage->sub_image = self::$imageUrl;
                self::$productSubImage->save();
            }
        }
    }
    public static function updateColor($request,$productId,$colors)
    {
        self::$product = ProductColor::where('product_id',$productId)->get();
        foreach (self::$product as $item)
        {
            $item->delete();
        }
        if ($colors > 0)
        {
            for ($i=0; $i<$colors;$i++)
            {
                self::$productColor = new ProductColor();
                self::$productColor->product_id = $productId;
                self::$productColor->color_id = $request->color_id[$i];
                self::$productColor->save();
            }
        }
    }
    public static function updateSize($request,$productId,$sizes)
    {
        self::$product = ProductSize::where('product_id',$productId)->get();

        foreach (self::$product as $item)
        {
            $item->delete();
        }
        if ($sizes > 0)
        {
            for ($i=0; $i<$sizes; $i++)
            {
                self::$productSize = new ProductSize();
                self::$productSize->product_id = $productId;
                self::$productSize->size_id =$request->size_id[$i];
                self::$productSize->save();
            }
        }
    }


}
