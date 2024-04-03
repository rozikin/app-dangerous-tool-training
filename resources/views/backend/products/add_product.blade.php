@extends('admin.admin_dashboard')

@section('admin')
    <div class="page-content">


        <div class="row profile-body">

            <!-- left wrapper end -->
            <!-- middle wrapper start -->
            <div class="col-md-12 col-xl-12 middle-wrapper">
                <div class="row">
                    <div class="card">
                        <div class="card-body">

                            <h6 class="card-title">Add Product</h6>

                            <form action="{{ route('store.product') }}" method="POST" class="forms-sample"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-6">

                                            <div class="row mb-3">
                                                <label for="product_code" class="col-sm-3 form-label">Code</label>
                                                <div class="col-sm-9">
                                                    <input type="text"
                                                        class="form-control @error('product_code') is-invalid @enderror"
                                                        id="product_code" name="product_code" autocomplete="off" required>
                                                </div>

                                                @error('product_code')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="row mb-3">
                                                <label for="proudct_name" class="col-sm-3 form-label">Name</label>
                                                <div class="col-sm-9">
                                                    <input type="text"
                                                        class="form-control @error('proudct_name') is-invalid @enderror"
                                                        id="product_name" name="product_name" autocomplete="off" required>
                                                </div>
                                                @error('product_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="row mb-3">
                                                <label for="product_spesification"
                                                    class="col-sm-3 form-label">Spesification</label>
                                                <div class="col-sm-9">
                                                    <input type="text"
                                                        class="form-control @error('product_spesification') is-invalid @enderror"
                                                        id="product_spesification" name="product_spesification"
                                                        autocomplete="off" required>
                                                </div>
                                                @error('product_spesification')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="row mb-3">
                                                <label for="product_size" class="col-sm-3 form-label">Size</label>
                                                <div class="col-sm-9">
                                                    <input type="text"
                                                        class="form-control @error('product_size') is-invalid @enderror"
                                                        id="product_size" name="product_size" autocomplete="off">
                                                </div>
                                                @error('product_size')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="row mb-3">
                                                <label class="col-sm-3 form-label">Category</label>
                                                <div class="col-sm-9">
                                                    <div class="input-group">
                                                        <input type="hidden" class="form-control" id="product_category_id"
                                                            name="product_category_id">

                                                        <input type="text" class="form-control"
                                                            id="product_category_nama" name="product_category_nama"
                                                            aria-describedby="button-addon2" required>
                                                        <button class="btn btn-outline-secondary" type="button"
                                                            id="cari_category">Search</button>

                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-sm-3 form-label">Color</label>
                                                <div class="col-sm-9">

                                                    <div class="input-group">

                                                        <input type="hidden" class="form-control" id="product_color_id"
                                                            name="product_color_id">

                                                        <input type="text" class="form-control" id="product_color_name"
                                                            name="product_color_name" required>
                                                        <button class="btn btn-outline-secondary" type="button"
                                                            id="cari_color">Search</button>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-sm-3 form-label">Allocation</label>
                                                <div class="col-sm-9">

                                                    <div class="input-group">

                                                        <input type="hidden" class="form-control"
                                                            id="product_allocation_id" name="product_allocation_id">


                                                        <input type="text" class="form-control"
                                                            id="product_allocation_name" name="product_allocation_name"
                                                            required>
                                                        <button class="btn btn-outline-secondary" type="button"
                                                            id="cari_allocation">Search</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">

                                            <div class="row mb-3">
                                                <label class="col-sm-3 form-label">Group</label>
                                                <div class="col-sm-9">
                                                    <select class="form-select mb-3" id="product_group"
                                                        name="product_group">
                                                        <option value="Production">Production</option>
                                                        <option value="Non Production">Non Production</option>
                                                    </select>
                                                    @error('product_group')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="product_unit" class="col-sm-3 form-label">Unit</label>
                                                <div class="col-sm-9">
                                                    <input type="text"
                                                        class="form-control @error('product_unit') is-invalid @enderror"
                                                        id="product_unit" name="product_unit" autocomplete="off"
                                                        required>
                                                </div>
                                                @error('product_unit')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="row mb-3">
                                                <label for="product_price" class="col-sm-3 form-label">Price</label>
                                                <div class="col-sm-9">
                                                    <input type="text"
                                                        class="form-control @error('product_price') is-invalid @enderror"
                                                        id="product_price" name="product_price" autocomplete="off"
                                                        required>
                                                </div>
                                                @error('product_price')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="row mb-3">
                                                <label for="address" class="col-sm-3 form-label">Photo</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control" type="file" id="image"
                                                        name="image">
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="address" class="col-sm-3 form-label"></label>
                                                <div class="col-sm-9">
                                                    <img id="showImage" class="wd-100 rounded" src="" alt="">
                                                </div>
                                            </div>


                                        </div>



                                        <div class="container mt-3">

                                            <div class="row text-center">
                                                <div class="col">
                                                    <button type="submit" class="btn btn-primary me-2">Save</button>

                                                    <a href="{{ route('all.product') }}"
                                                        class="btn btn-danger me-2">Back</a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>

                </div>
            </div>
            <!-- middle wrapper end -->
            <!-- right wrapper start -->

            <!-- right wrapper end -->
        </div>

    </div>


    <!-- modal -->

    <div class="modal fade modal_search" id="modal_search" tabindex="-1" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="varyingModalLabel">Search Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="btn-close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="container text-center">
                            <div class="table-responsive">
                                <table id="CariTable" class="table table-sm" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Code</th>
                                            <th>Name</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal_allocation" id="modal_allocation" tabindex="-1" aria-labelledby="myLargeModalLabelx"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="varyingModalLabels">Search Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="btn-close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="container text-center">
                            <div class="table-responsive">
                                <table id="CariTable2" class="table table-sm" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Department</th>
                                            <th>MO</th>
                                            <th>STYLE</th>
                                            <th>DESTINATION</th>
                                            <th>REMARK</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                    </div>
                </div>
            </div>
        </div>
    </div>



    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });



        /* When click show user */

        $(function() {


            $('#cari_category').click(function() {

                $('#varyingModalLabel').html("Search Category");
                var table = $('#CariTable').DataTable({

                    processing: true,
                    serverSide: true,
                    "bDestroy": true,
                    ajax: "{{ route('get.categoryprod') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'

                        },
                        {
                            data: 'category_code',
                            name: 'category_code'
                        },
                        {
                            data: 'category_name',
                            name: 'category_name'
                        },

                        {
                            data: 'action',
                            name: 'action',
                            orderable: true,
                            searchable: true
                        },
                    ]
                });

                $('#modal_search').modal('show');

            });



            $('body').on('click', '.select-cat', function() {

                var idx = $(this).data('id');
                var category_name = $(this).data('nama');
                console.log(idx);


                $('#product_category_id').val(idx);
                $('#product_category_nama').val(category_name);

                $('#modal_search').modal('hide');
            });


            $('#cari_color').click(function() {

                $('#varyingModalLabel').html("Search Color");

                var table = $('#CariTable').DataTable({

                    processing: true,
                    serverSide: true,
                    "bDestroy": true,
                    ajax: "{{ route('get.colorGlobal') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'

                        },
                        {
                            data: 'color_code',
                            name: 'color_code'
                        },
                        {
                            data: 'color_name',
                            name: 'color_name'
                        },

                        {
                            data: 'action',
                            name: 'action',
                            orderable: true,
                            searchable: true
                        },
                    ]
                });

                $('#modal_search').modal('show');

            });

            $('body').on('click', '.select-col', function() {

                var idx = $(this).data('id');
                var name = $(this).data('name');
                console.log(idx);


                $('#product_color_id').val(idx);
                $('#product_color_name').val(name);

                $('#modal_search').modal('hide');
            });

            $('#cari_allocation').click(function() {

                // $('#varyingModalLabels').html("Search Allocation");

                var table = $('#CariTable2').DataTable({

                    processing: true,
                    serverSide: true,
                    "bDestroy": true,
                    ajax: "{{ route('get.product_allocationglobal') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'

                        },
                        {
                            data: 'department',
                            name: 'department'
                        },
                        {
                            data: 'mo',
                            name: 'mo'
                        },

                        {
                            data: 'style',
                            name: 'style',
                        },
                        {
                            data: 'destination',
                            name: 'destination'
                        },
                        {
                            data: 'remark',
                            name: 'remark'
                        },
                        {
                            data: 'action',
                            name: 'action'
                        },

                    ]
                });

                $('#modal_allocation').modal('show');

            });

            $('body').on('click', '.select-allo', function() {

                var idx = $(this).data('id');
                var name = $(this).data('name');
                console.log(idx);


                $('#product_allocation_id').val(idx);
                $('#product_allocation_name').val(name);

                $('#modal_allocation').modal('hide');
            });
        });
    </script>
@endsection
