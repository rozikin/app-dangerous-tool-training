<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ProductAllocation;
use Illuminate\Http\Request;
use DataTables;


class ProductAllocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function AllProductAllocation()
    {
        return view('backend.product_allocation.all_product_allocation');
    }

    /**
     * Show the form for creating a new resource.
     */


     public function GetProductAllocation(Request $request){

        if ($request->ajax()) {
            $data = ProductAllocation::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                      return   '<div class="d-flex align-items-center justify-content-between flex-wrap">
                      <div class="d-flex align-items-center">
                        
                          <div class="d-flex align-items-center">
                              <div class="actions dropdown">
                                  <a href="#" data-bs-toggle="dropdown"> ••• </a>
                                  <div class="dropdown-menu" role="menu">
                                    
                                  
                                          <a href="javascript:void(0)"
                                              class="dropdown-item editProductAllocation" data-id="'.$row->id.'"> &nbsp; Edit</a>
                                   
                          
                                          <a href="javascript:void(0)"
                                              class="dropdown-item text-danger deleteProductAllocation"
                                              data-id="'.$row->id.'"> &nbsp; Delete</a>
                                   

                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>';

                    })



                    // ->addColumn('qr_code', function($row){ return QrCode::size(30)->generate($row->color_code);})

                    ->rawColumns(['action'])

                    ->make(true);
                 

        }

    }

    public function GetProductAllocationGlobal(Request $request){
        if ($request->ajax()) {
            $data = ProductAllocation::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
    
                        return '<a href="javascript:void(0)" class="select-allo"  data-id="'.$row->id.'"  data-name="'.$row->department.'">Select</a>';
    
                    })
                  
                    ->rawColumns(['action'])
    
                    ->make(true);
                 
    
        }
    }
    



    /**
     * Store a newly created resource in storage.
     */
    public function StoreProductAllocation(Request $request)
    {

        if( $request->product_allocation_id == ""){
        $request->validate([
            'department' => 'required',
            'mo' => 'required',
            'style' => 'required',
            'destination' => 'required',
            'remark' => 'required',
        
        ]);

        

       $post = ProductAllocation::updateOrCreate([

   
        'id' => $request->product_allocation_id

         ],[
            'department' => $request->department,
            'mo' => $request->mo,
            'style' => $request->style,
            'destination' => $request->destination,
            'remark' => $request->remark,

        ]);


        //return response
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Disimpan!',
            'data'    => $post,
            'alert-type' => 'success'  
        ]);
    }
    else 
    {
        $request->validate([
            'department' => 'required',
            'mo' => 'required',
            'style' => 'required',
            'destination' => 'required',
            'remark' => 'required',
        
        ]);

        

       $post = ProductAllocation::updateOrCreate([

   
        'id' => $request->product_allocation_id

         ],[
            'department' => $request->department,
            'mo' => $request->mo,
            'style' => $request->style,
            'destination' => $request->destination,
            'remark' => $request->remark,

        ]);


        //return response
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Disimpan!',
            'data'    => $post,
            'alert-type' => 'success'  
        ]);
    }
}

    /**
     * Display the specified resource.
     */
    public function show(ProductAllocation $productAllocation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function EditProductAllocation($id)
    {

        $category = ProductAllocation::find($id);
        // return view('backend.products.edit_product',compact('products'));
        return response()->json($category);
    }




    /**
     * Remove the specified resource from storage.
     */
    public function DeleteProductAllocation($id)
    {
        ProductAllocation::findOrFail($id)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Data Post Berhasil Dihapus!.',
        ]);
    }
}
