<?php


namespace  App\Http\Controllers\Backend;

use App\Exports\ProductExport;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\CategoryProduct;
use App\Models\ProductAllocation;
use App\Models\Color;
use DataTables;



class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function AllProduct()

    {

        $products = Product::with('colors','categorys','allocations')->get();
        return view('backend.products.all_product',compact('products'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function AddProduct()
    {
        return view('backend.products.add_product');
    }

    public function GetProductin(Request $request){
     
        if ($request->ajax()) {
            $data = Product::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
    
                        return '<a href="javascript:void(0)" class="select-product"  data-id="'.$row->id.'"  data-kode="'.$row->product_code.'" data-nama="'.$row->product_name.'">Select</a>';
    
                    })
                  
                    ->rawColumns(['action'])
    
                    ->make(true);
                 
    
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function StoreProduct(Request $request): RedirectResponse
    {
        $request->validate([

            'product_code' => 'required',
            'product_name' => 'required',
            'product_spesification' => 'required',
            'product_category_id' => 'required',
            'product_color_id' => 'required',
            'product_allocation_id' => 'required',
            'product_size' => 'required',
            'product_group' => 'required',
            'product_unit' => 'required',
            'product_price' => 'required',

            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

    
        if ($image = $request->file('image')) {

            $destinationPath = 'upload/product/';

            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();

            $image->move($destinationPath, $profileImage);

            $input['image'] = "$profileImage";

        }

      

        Product::create([
            
            'product_code' => $request->product_code,
            'product_name' => $request->product_name,
            'product_spesification' => $request->product_spesification,
            'product_category_id' => $request->product_category_id,
            'product_color_id' => $request->product_color_id,
            'product_allocation_id' => $request->product_allocation_id,
            'product_size' => $request->product_size,
            'product_group' => $request->product_group,
            'product_unit' => $request->product_unit,
            'product_price' => $request->product_price,
            'image' => $profileImage,
            'product_stock' => 1

        ]);

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

        $id_category = $products->product_category_id;
        $id_color = $products->product_color_id;
        $id_allocation = $products->product_allocation_id;

        $cat = CategoryProduct::findOrFail($id_category);
        $col = Color::findOrFail($id_color);
        $allo = ProductAllocation::findOrFail($id_allocation);
        return view('backend.products.edit_product',compact('products','cat','col','allo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function UpdateProduct(Request $request, $id)
    {
      

        $data = Product::findOrFail($id);
        $data->product_code = $request->product_code;
        $data->product_name = $request->product_name;
        $data->product_spesification = $request->product_spesification;
        $data->product_category_id = $request->product_category_id;
        $data->product_color_id = $request->product_color_id;
        $data->product_allocation_id = $request->product_allocation_id;
        $data->product_size = $request->product_size;
        $data->product_group = $request->product_group;
        $data->product_price = $request->product_price;
        $data->product_unit = $request->product_unit;
        $data->product_stock = $request->product_stock;
  

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
