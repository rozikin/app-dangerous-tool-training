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
                                            <a href="{{ route('add.productin') }}" class="btn btn-primary mx-1 btn-sm"><i
                                                    class="feather-16" data-feather="file-plus"></i> &nbsp;Add Product</a>
                                        </ol>
                                    </nav>
                                </div>

                                <div class="col">
                                    <h6 class="card-title text-center">Product IN</h6>

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
                                        <th>SUPPLIER</th>
                                        <th>DATE</th>
                                        <th>Code</th>
                                        <th>Name</th>
                                        <th>Color</th>
                                        <th>Category</th>
                                        <th>Allocation</th>
                                        <th>Qty</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>


                                    @foreach ($productin as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            {{-- <td>{{ $item->product_id_no }}</td> --}}
                                            <td>{{ $item->suppliers->supplier_name }}</td>
                                            <td>{{ date('d-m-Y', strtotime($item->created_at)) }}</td>

                                            <td>
                                                @foreach($item->products as $key)
                                                    <li> {{ $key->product_code }}</li>
                                                @endforeach
                                            </td>

                                            <td>
                                                @foreach($item->products as $key)
                                                    <li> {{ $key->product_name }}</li>
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach($item->products as $key)
                                                    <li> {{ $key->colors->color_name }}</li>
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach($item->products as $key)
                                                    <li> {{ $key->categorys->category_name }}</li>
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach($item->products as $key)
                                                    <li> {{ $key->allocations->department }}</li>
                                                @endforeach
                                            </td>
                                            <td>

                                                @foreach($item->productin_details as $key)
                                                <li> {{ $key->qty }}</li>
                                            @endforeach
                                               
                                        
                                            <td>
                                                <div class="d-flex align-items-center justify-content-between flex-wrap">
                                                    <div class="d-flex align-items-center">

                                                        <div class="d-flex align-items-center">
                                                            <div class="actions dropdown">
                                                                <a href="#" data-bs-toggle="dropdown"> <i
                                                                        data-feather="more-horizontal"></i></a>
                                                                <div class="dropdown-menu" role="menu">


                                                                    <a href="{{ route('edit.product', $item->id) }}"
                                                                        class="dropdown-item"><i class="feather-16"
                                                                            data-feather="edit-3"></i> &nbsp; Edit</a>


                                                                    <a href="{{ route('delete.product', $item->id) }}"
                                                                        class="dropdown-item text-danger" id="delete"><i
                                                                            class="feather-16" data-feather="trash-2"></i>
                                                                        &nbsp; Delete</a>


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
