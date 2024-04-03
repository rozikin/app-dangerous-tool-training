<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CategoryProduct;
use Illuminate\Http\Request;
use DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function AllCategory()
    {
        return view('backend.category.all_category');
    }

    
    /**
     * Show the form for creating a new resource.
     */
    public function GetCategory(Request $request){

        if ($request->ajax()) {
            $data = CategoryProduct::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                    //     return '<div class="btn-group" role="group">
                    //     <button id="btnGroupDrop1" type="button" class="btn btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    //    Action
                    //     </button>
                    //     <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                    //       <a class="dropdown-item editCategory" href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'">Edit</a>
                    //       <a class="dropdown-item deleteCategory" href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'">Delete</a>
                    //     </div>
                    //   </div>';

                      return   '<div class="d-flex align-items-center justify-content-between flex-wrap">
                      <div class="d-flex align-items-center">
                        
                          <div class="d-flex align-items-center">
                              <div class="actions dropdown">
                                  <a href="#" data-bs-toggle="dropdown"> ••• </a>
                                  <div class="dropdown-menu" role="menu">
                                    
                                  
                                          <a href="javascript:void(0)"
                                              class="dropdown-item  editCategory" data-id="'.$row->id.'"> &nbsp; Edit</a>
                                   
                          
                                          <a href="javascript:void(0)"
                                              class="dropdown-item text-danger deleteCategory"
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


    public function GetCategoryProd(Request $request){
        if ($request->ajax()) {
            $data = CategoryProduct::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
    
                        return '<a href="javascript:void(0)" class="select-cat"  data-id="'.$row->id.'" data-nama="'.$row->category_name.'">Select</a>';
    
                    })
                  
                    ->rawColumns(['action'])
    
                    ->make(true);
                 
    
        }
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function StoreCategory(Request $request)
    {

        if( $request->category_id == ""){
        $request->validate([
            'category_code' => 'required|unique:category_products|max:200',
            'category_name' => 'required',

        ]);

        

       $post = CategoryProduct::updateOrCreate([

   
        'id' => $request->category_id

         ],[
            'category_code' => $request->category_code,
            'category_name' => $request->category_name,

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
            'category_code' => 'required|max:200',
            'category_name' => 'required',

        ]);

        

       $post = CategoryProduct::updateOrCreate([

   
        'id' => $request->category_id

         ],[
            'category_code' => $request->category_code,
            'category_name' => $request->category_name,

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
    public function show(Category $category)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function EditCategory($id)
    {

        $category = CategoryProduct::find($id);
        // return view('backend.products.edit_product',compact('products'));
        return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
     public function DeleteCategory($id)
    {
        CategoryProduct::findOrFail($id)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Data Post Berhasil Dihapus!.',
        ]);
    }
}
