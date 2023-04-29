<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    private static $supplier,$image,$imageNewName,$directory,$imageUrl;
    public static function saveSupplier($request){
        self::$supplier = new Supplier();
        self::$supplier->supplier_name = $request->supplier_name;
        self::$supplier->phone = $request->phone;
        self::$supplier->email = $request->email;
        self::$supplier->image = self::saveImage($request);
        self::$supplier->account = $request->account;
        self::$supplier->address = $request->address;
        self::$supplier->save();
    }

    private static function saveImage($request)
    {
        self::$image = $request->file('image');
        if (self::$image)
        {
            if (self::$supplier->image)
            {
                if (file_exists(self::$supplier->image))
                {
                    unlink(self::$supplier->image);
                }
            }
            self::$imageNewName = $request->supplier_name.'-'.rand().'.'.self::$image->getClientOriginalExtension();
            self::$directory = 'admin-asset/upload-image/supplier/';
            self::$imageUrl = self::$directory.self::$imageNewName;
            self::$image->move(self::$directory,self::$imageNewName);
        }
        else
        {
            self::$imageUrl = self::$supplier->image;
        }
        return self::$imageUrl;
    }
    public static function updateStatus($id){
        self::$supplier = Supplier::find($id);
        if (self::$supplier->status == 1){
            self::$supplier->status = 0;
        }else{
            self::$supplier->status = 1;
        }
        self::$supplier->save();
    }
    public static function updateSupplier($request,$id){
        self::$supplier=Supplier::find($id);
        self::$supplier->supplier_name = $request->supplier_name;
        self::$supplier->phone = $request->phone;
        self::$supplier->email = $request->email;
        self::$supplier->image = self::saveImage($request);
        self::$supplier->account = $request->account;
        self::$supplier->address = $request->address;
        self::$supplier->status = $request->status;
        self::$supplier->save();

    }
    public static function deleteSupplier($id){
        self::$supplier = Supplier::find($id);
        if (self::$supplier->image){
            if (file_exists(self::$supplier->image)){
                unlink(self::$supplier->image);
            }
        }
        self::$supplier->delete();

    }
}
