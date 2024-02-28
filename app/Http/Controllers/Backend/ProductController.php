<?php

namespace  App\Http\Controllers\Backend;

use App\Exports\ProductExport;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Maatwebsite\Excel\Facades\Excel;



class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function AllProduct()

    {

        $products = Product::latest()->get();
        return view('backend.products.all_product',compact('products'));

    }


    /**
     * Show the form for creating a new resource.
     */
    public function AddProduct()
    {
        return view('backend.products.add_product');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function StoreProduct(Request $request): RedirectResponse
    {
        $request->validate([

            'name' => 'required',

            'detail' => 'required',

            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

    

        $input = $request->all();

    

        if ($image = $request->file('image')) {

            $destinationPath = 'upload/product/';

            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();

            $image->move($destinationPath, $profileImage);

            $input['image'] = "$profileImage";

        }

      

        Product::create($input);

        $notification = array(
            'message' => 'Create Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.product')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    
    /**
     * Show the form for editing the specified resource.
     */
    public function EditProduct($id)
    {
        $products = Product::findOrFail($id);
        return view('backend.products.edit_product',compact('products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function UpdateProduct(Request $request, $id)
    {
      

        $data = Product::findOrFail($id);
        $data->name = $request->name;
        $data->detail = $request->detail;

        if ($request->file('image')) {
            $file = $request->file('image');
            @unlink(public_path('upload/product/' . $data->image));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/product'), $filename);
            $data['image'] = $filename;
        }

        $data->save();

        $notification = array(
            'message' => 'Update Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.product')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function DeleteProduct($id)
    {
        
        Product::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Delete Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.product')->with($notification);
    }

    public function ExportProduct()
    {

        return Excel::download(new ProductExport , 'signaturelist.xlsx');

    }


   
}
