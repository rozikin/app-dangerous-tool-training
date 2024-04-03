<?php

namespace App\Http\Controllers;

use App\Models\ProductIn;
use App\Models\Product;
use App\Models\Color;
use App\Models\ProductInDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductInController extends Controller
{
    /** 0
     * Display a listing of the resource.
     */
    public function AllProductIn()
    {   
  
        $productin = ProductIn::with('suppliers','productin_details')->get();

        return view('backend.productin.all_productin',compact('productin'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function AddProductIn()
    {
        return view('backend.productin.add_productin');
    }

    public function KodeOtomatisIN()
    {
        $in = ProductIn::latest()->first();
        // $kode_masuk = "IN";
        // $kode_tahun = date("y");

        if($in == null){
            //kode pertama
            $noUrut = "1";
        } else 
        {
            //kode berikutnya
            // $explode = explode("-", $in->product_in_no);
            // $noUrut = $explode[2];
            $noUrut = $in->id+1;
        
        }

        $kode_in = $noUrut;

        return response()->json(['kode_in' => $kode_in]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function StoreProductIn(Request $request)
    {
        // $request->validate([
        //     'supplier_id' => 'required',
        //     'reciver' => 'required',
        // ]);

        if(  $request->supplier_id !="" &&  $request->reciver !="" &&  $request->product_id !="" && $request->po !="" && $request->qty !=""){

       $simpan =  ProductIn::create([
    
            'id' => $request->product_in_id,
            'product_in_no' => $request->product_in_id,
            'supplier_id' => $request->supplier_id,
            'reciver' => $request->reciver,
        ]);


        if($simpan){
            $product_id=$request->product_id;
            $po=$request->po;
            $original_no=$request->original_no;
            $batch=$request->batch;
            $roll=$request->roll;
            $gw=$request->gw;
            $nw=$request->nw;
            $width=$request->width;
            $basic_gm2=$request->basic_gm2;
            $qty=$request->qty;
         
            for($i = 0; $i < count($request->product_id); $i++)
            {
                $Record=new ProductInDetail;
                $Record->product_in_id =   $request->product_in_id;
                $Record->product_id =           $product_id[$i];
                $Record->po_number =            $po[$i];
                $Record->original_no =           $original_no[$i];
                $Record->batch =    $batch[$i]; 
                $Record->roll =  $roll[$i];
                $Record->gw = $gw[$i];
                $Record->nw = $nw[$i];
                $Record->width = $width[$i];
                $Record->basic_gm2 = $basic_gm2[$i];
                $Record->qty = $qty[$i];
                $Record->save();
            }

        }
    

             //return response
             return response()->json([
                'success' => true,
                'message' => 'Data Berhasil Disimpan!',
                'data'    => $simpan,
                'alert-type' => 'success'  
            ]);

      
        
    }
    else {
         //return response
         return response()->json([
            'success' => false,
            'message' => 'cek isian!',
            'data'    => 'error',
            'alert-type' => 'error'  
        ]);
    }
}




            

    /**
     * Display the specified resource.
     */
    public function show(ProductIn $productIn)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductIn $productIn)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductIn $productIn)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductIn $productIn)
    {
        //
    }
}
