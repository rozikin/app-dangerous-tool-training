@extends('admin.admin_dashboard')

@section('admin')

    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                @if (Auth::user()->can('add.type'))
                    <a href="{{ route('add.type') }}" class="btn btn-inverse-info"><i class="feather-16" data-feather="file-plus"></i> &nbsp;Add Property Type</a>
                @endif
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Property Type All</h6>

                        <div class="table-responsive">
                            <table id="dataTableExample" class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Type Name</th>
                                        <th>Type Icon</th>
                                        <th>QR</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($types as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->type_name }}</td>
                                            <td>{{ $item->type_icon }}</td>
                                            <td> {!! QrCode::size(30)->generate($item->type_name) !!}</td>
                                        
                                            <td>
                                                <div class="d-flex align-items-center justify-content-between flex-wrap">
                                                    <div class="d-flex align-items-center">
                                                      
                                                        <div class="d-flex align-items-center">
                                                            <div class="actions dropdown">
                                                                <a href="#" data-bs-toggle="dropdown">  <i data-feather="more-horizontal"></i></a>
                                                                <div class="dropdown-menu" role="menu">
                                                                
                                                                    @if (Auth::user()->can('edit.type'))
                                                                        <a href="{{ route('edit.type', $item->id) }}"
                                                                            class="dropdown-item"><i class="feather-16" data-feather="edit-3"></i> &nbsp; Edit</a>
                                                                    @endif
                                                                    @if (Auth::user()->can('delete.type'))
                                                                        <a href="{{ route('delete.type', $item->id) }}"
                                                                            class="dropdown-item text-danger"
                                                                            id="delete"><i class="feather-16" data-feather="trash-2"></i> &nbsp; Delete</a>
                                                                    @endif

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
