@extends('admin.admin_dashboard')

@section('admin')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <a href="javascript:void(0)" class="btn btn-primary mx-1" id="btn-create-color">TAMBAH</a>
                {{-- <a href="{{ route('add.color') }}" class="btn btn-primary mx-1"><i class="feather-16" data-feather="file-plus"></i> &nbsp;Add color</a> --}}
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">color All</h6>

                        <div class="table-responsive">

                            <table id="colorTable" class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>ID</th>
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
            </div>
        </div>

    </div>






    <!-- Modal -->
    <div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>

                </div>
                <div class="modal-body">

                    <form id="colorForm" name="colorForm">
                        <input type="hidden" name="color_id" id="color_id">
                        <div class="mb-3">
                            <label for="color_code" class="form-label">Color Code:</label>
                            <input type="text" class="form-control" id="color_code" name="color_code">
                        </div>
                        <div class="mb-3">
                            <label for="color_name" class="form-label">Color Name:</label>
                            <input type="text" class="form-control" id="color_name" name="color_name">
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                    <button type="submit" class="btn btn-primary" id="saveBtn" value="create">SIMPAN</button>
                </div>
            </div>
        </div>
    </div>




    <script>
        $(function() {

            $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }

            });




            var table = $('#colorTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('get.color') }}",
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




            /*------------------------------------------

            --------------------------------------------

            Click to Button

            --------------------------------------------

            --------------------------------------------*/

            $('#btn-create-color').click(function() {

                $('#saveBtn').val("create-product");

                $('#product_id').val('');

                $('#colorForm').trigger("reset");

                $('#exampleModalLabel').html("Create New Color");

                $('#modal-create').modal('show');

            });


            /*------------------------------------------

            --------------------------------------------

            Create Product Code

            --------------------------------------------

            --------------------------------------------*/

            $('#saveBtn').click(function(e) {

                e.preventDefault();

                $(this).html('Sending..');



                $.ajax({

                    data: $('#colorForm').serialize(),

                    url: "{{ route('store.color') }}",

                    type: "POST",

                    dataType: 'json',

                    success: function(data) {



                        $('#colorForm').trigger("reset");

                        $('#modal-create').modal('hide');

                        table.ajax.reload(null, false);

                        $('#saveBtn').html('SIMPAN');



                    },

                    error: function(data) {

                        console.log('Error:', data);

                        $('#saveBtn').html('Save Changes');

                    }

                });

            });

            /*------------------------------------------

            --------------------------------------------

            Click to Edit Button

            --------------------------------------------

            --------------------------------------------*/

            $('body').on('click', '.editColor', function() {

                var color_id = $(this).data('id');
                console.log(color_id);

                $.ajax({

                    type: "GET",

                    url: "/edit/color/" + color_id,

                    success: function(data) {

                        $('#exampleModalLabel').html("Edit color");

                        $('#saveBtn').val("edit-user");

                        $('#modal-create').modal('show');

                        $('#color_id').val(data.id);
                        $('#color_code').val(data.color_code);

                        $('#color_name').val(data.color_name);


                    },

                    error: function(data) {

                        console.log('Error:', data);

                    }

                });


                // $.get("/edit/color/" + color_id, function(
                //     data) {

                //     $('#exampleModalLabel').html("Edit color");

                //     $('#saveBtn').val("edit-user");

                //     $('#modal-create').modal('show');

                //     $('#color_id').val(data.id);
                //     $('#color_code').val(data.color_code);

                //     $('#color_name').val(data.color_name);

                // })

            });

            /*------------------------------------------

            --------------------------------------------

            Delete Product Code

            --------------------------------------------

            --------------------------------------------*/


            $('body').on('click', '.deleteColor', function() {



                var color_id = $(this).data("id");



                confirm("Are You sure want to delete !");



                $.ajax({

                    type: "GET",

                    url: "/delete/color/" + color_id,

                    success: function(data) {

                        table.ajax.reload(null, false);

                    },

                    error: function(data) {

                        console.log('Error:', data);

                    }

                });

            });




        });
    </script>
@endsection
