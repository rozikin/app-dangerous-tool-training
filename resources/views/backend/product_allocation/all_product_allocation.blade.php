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
                                            <a href="javascript:void(0)" class="btn btn-sm btn-primary mx-1"
                                                id="btn-create-allocation"><i class="feather-16"
                                                    data-feather="file-plus"></i> &nbsp;Add Data</a>

                                        </ol>
                                    </nav>
                                </div>

                                <div class="col">
                                    <h6 class="card-title text-center">Product Allocation</h6>

                                </div>
                                <div class="col">
                                    <h6 class="card-title text-center"></h6>
                                </div>
                            </div>

                        </div>


                        <div class="table-responsive">

                            <table id="ProductAllocationTable" class="table table-sm table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Department</th>
                                        <th>MO</th>
                                        <th>Style</th>
                                        <th>Destination</th>
                                        <th>Remark</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                            <br />
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

                    <form id="product_allocationForm" name="product_allocationForm">

                        <div class="alert alert-danger print-error-msg" style="display:none">

                            <ul></ul>

                        </div>

                        <input type="hidden" name="product_allocation_id" id="product_allocation_id">
                        <div class="mb-3">
                            <label for="department" class="form-label">Department:</label>
                            <input type="text" class="form-control department" id="department" name="department"
                                autofocus required>

                        </div>
                        <div class="mb-3">
                            <label for="mo" class="form-label">MO:</label>
                            <input type="text" class="form-control" id="mo" name="mo" required>
                        </div>
                        <div class="mb-3">
                            <label for="style" class="form-label">Style:</label>
                            <input type="text" class="form-control" id="style" name="style" required>
                        </div>
                        <div class="mb-3">
                            <label for="destination" class="form-label">destination:</label>
                            <input type="text" class="form-control" id="destination" name="destination" required>
                        </div>
                        <div class="mb-3">
                            <label for="remark" class="form-label">remark:</label>
                            <input type="text" class="form-control" id="remark" name="remark" required>
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

            $('#modal-create').on('shown.bs.modal', function() {
                $(this).find('[autofocus]').focus();
            });




            var table = $('#ProductAllocationTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('get.product_allocation') }}",
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
                        name: 'style'
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

            $('#btn-create-allocation').click(function() {

                $(this).find('form').trigger('reset');
                $('#product_allocationForm').find(".print-error-msg").find("ul").find("li").remove();
                $('#product_allocationForm').find(".print-error-msg").css('display', 'none');

                $('#saveBtn').val("create-product_allocation");
                $('#product_allocationForm').trigger("reset");
                $('#product_allocation_id').val('');
                $('#exampleModalLabel').html("Create New Product Allocation");
                $('#modal-create').modal('show');
                $('#department').attr("readonly", false);
                $(this).find('[autofocus]').focus();


            });


            /*------------------------------------------

            --------------------------------------------

            Create Product Code

            --------------------------------------------

            --------------------------------------------*/

            $('#saveBtn').click(function(e) {

                e.preventDefault();

                $(this).html('Sending..');

                var ids = $('#product_allocation_id').val();
                var department = $('#department').val();
                var mo = $('#mo').val();
                var style = $('#style').val();
                var remark = $('#remark').val();


                $.ajax({

                    data: $('#product_allocationForm').serialize(),
                    // data: {product_allocation_id:ids, department:department,destination:destination, mo:mo,style:style, remark:remark},
                    type: "POST",
                    url: "{{ route('store.product_allocation') }}",


                    dataType: 'json',

                    success: function(data) {

                        $('#product_allocationForm').trigger("reset");
                        $('#modal-create').modal('hide');
                        table.ajax.reload(null, false);
                        $('#saveBtn').html('SIMPAN');

                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                        });

                        Toast.fire({
                            icon: 'success',
                            title: data.message
                        })
                    },

                    error: function(data) {

                        $('#product_allocationForm').find(".print-error-msg").find("ul").html(
                            '');
                        $('#product_allocationForm').find(".print-error-msg").css('display',
                            'block');
                        $.each(data.responseJSON.errors, function(key, value) {
                            $('#product_allocationForm').find(".print-error-msg").find(
                                    "ul")
                                .append(
                                    '<li>' + value + '</li>');
                        });
                        $('#saveBtn').html('SIMPAN');
                    }

                    // error: function(data) {
                    //     console.log('Error:', data);
                    //     $('#saveBtn').html('Save Changes');
                    // }

                });

            });

            /*------------------------------------------

            --------------------------------------------

            Click to Edit Button

            --------------------------------------------

            --------------------------------------------*/

            $('body').on('click', '.editProductAllocation', function() {

                var product_allocation_ids = $(this).data('id');
                console.log(product_allocation_ids);


                $.get("/edit/product_allocation/" + product_allocation_ids, function(
                    data) {
                    $('#exampleModalLabel').html("Edit product_allocation");
                    $('#saveBtn').html("edit");
                    $('#modal-create').modal('show');
                    $('#product_allocation_id').val(data.id);
                    $('#department').val(data.department);
                    $('#mo').val(data.mo);
                    $('#style').val(data.style);
                    $('#destination').val(data.destination);
                    $('#remark').val(data.remark);

                    // $('#department').attr("readonly", true);

                })

            });

            /*------------------------------------------

            --------------------------------------------

            Delete Product Code

            --------------------------------------------

            --------------------------------------------*/


            $('body').on('click', '.deleteProductAllocation', function() {



                var product_allocation_idx = $(this).data("id");

                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger me-2'
                    },
                    buttonsStyling: false,
                })

                swalWithBootstrapButtons.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
         
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {

                        $.ajax({
                            type: "GET",
                            url: "/delete/product_allocation/" + product_allocation_idx,
                            success: function(data) {
                                table.ajax.reload(null, false);

                                swalWithBootstrapButtons.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success',

                                )
                            },
                            error: function(data) {
                                console.log('Error:', data);

                                swalWithBootstrapButtons.fire(
                                    'Cancelled',
                                    `'There is relation data'.${data.responseJSON.message}`,
                                    'error'
                                )
                            }
                        });


                    } else if (
                        // Read more about handling dismissals
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        swalWithBootstrapButtons.fire(
                            'Cancelled',
                            'Your file is safe :)',
                            'error'
                        )
                    }
                })

            });

        });
    </script>
@endsection
