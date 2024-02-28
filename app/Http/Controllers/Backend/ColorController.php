<?php

namespace  App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;
use DataTables;

class ColorController extends Controller
{
   
    public function AllColor()
    {
        // $colors = Color::latest()->get();


        return view('backend.color.all_color');

      

    }

    public function GetColor(Request $request){

        // $colors = Color::latest()->get();
        // return response()->json($colors);

        if ($request->ajax()) {

  

            $data = Color::latest()->get();

  

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editColor">Edit</a>';
                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteColor">Delete</a>';
                            return $btn;

                    })

                    ->rawColumns(['action'])

                    ->make(true);

        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function StoreColor(Request $request)
    {
        $request->validate([
            'color_code' => 'required',
            'color_name' => 'required',

        ]);

       $post = Color::updateOrCreate([

        'id' => $request->color_id

         ],[
            'color_code' => $request->color_code,
            'color_name' => $request->color_name,

        ]);


        //return response
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Disimpan!',
            'data'    => $post  
        ]);
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Color $color)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $colors = Color::findOrFail($id);
        // return view('backend.products.edit_product',compact('products'));
        return response()->json($colors);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Color $color)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function DeleteColor($id)
    {
        Color::findOrFail($id)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Data Post Berhasil Dihapus!.',
        ]);
    }
}
