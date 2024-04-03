@extends('admin.admin_dashboard')

@section('admin')

<div class="page-content mt-5">

   

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <div>
                        <div class="row">
                            <div class="col">
                                <nav class="page-breadcrumb">
                                    <ol class="breadcrumb">
                                        <a href="{{ route('add.product') }}" class="btn btn-primary mx-1 btn-sm"><i class="feather-16" data-feather="file-plus"></i> &nbsp;Add Product</a>
                                    </ol>
                                </nav>
                            </div>

                            <div class="col">
                                <h6 class="card-title text-center">Product All</h6>

                            </div>
                            <div class="col">
                                <h6 class="card-title text-center"></h6>
                            </div>
                        </div>
                       
                    </div>
                   

                   

                    <div class="table-responsive">
                        <table id="dataTableExample" class="table table-sm">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    {{-- <th>Image</th> --}}
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Spesification</th>
                                    <th>Color</th>
                                    <th>Category</th>
                                    <th>Allocation</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $key=> $item)

                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    {{-- <td>
                                        <img class="wd-100 rounded-circle"
                                            src="{{(!empty($item->image))? url('upload/product/'.$item->image):url('upload/product/no_image.jpg')}}"
                                            alt="profile"> --}}
                                    </td>
                                    <td>{{ $item->product_code }}</td>
                                    <td>{{ $item->product_name }}</td>
                                    <td>{{  Str::limit($item->product_spesification,20) }}</td>
                               
                                    <td>{{  $item->colors->color_name}}</td>
                              
                                    <td>{{$item->categorys->category_name }}</td>
                                    <td>{{$item->allocations->department }}</td>
                                    <td>{{ $item->product_price }}</td>
                                    <td>{{ $item->product_stock }}</td>
                                 
                               

                                    <td>
                                        <div class="d-flex align-items-center justify-content-between flex-wrap">
                                            <div class="d-flex align-items-center">
                                              
                                                <div class="d-flex align-items-center">
                                                    <div class="actions dropdown">
                                                        <a href="#" data-bs-toggle="dropdown">  <i data-feather="more-horizontal"></i></a>
                                                        <div class="dropdown-menu" role="menu">
                                                          
                                                        
                                                                <a href="{{ route('edit.product', $item->id) }}"
                                                                    class="dropdown-item"><i class="feather-16" data-feather="edit-3"></i> &nbsp; Edit</a>
                                                         
                                                
                                                                <a href="{{ route('delete.product', $item->id) }}"
                                                                    class="dropdown-item text-danger"
                                                                    id="delete"><i class="feather-16" data-feather="trash-2"></i> &nbsp; Delete</a>
                                                         

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>



                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>




@endsection