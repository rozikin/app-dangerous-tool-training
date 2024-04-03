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

                            <h6 class="card-title text-center mb-3">Add Product IN</h6>

                            <form class="forms-sample">
                                @csrf

                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-6">

                                            <div class="row mb-3">
                                                <label for="product_in_id" class="col-sm-3 form-label">NO</label>
                                                <div class="col-sm-9">
                                                    <input type="text"
                                                        class="form-control @error('product_in_id') is-invalid @enderror"
                                                        id="product_in_id" name="product_in_id" autocomplete="off" required>
                                                </div>

                                                @error('product_in_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="col-md-6">

                                            <div class="row mb-3">
                                                <label class="col-sm-3 form-label">Supplier</label>
                                                <div class="col-sm-9">
                                                    <div class="input-group">
                                                        <input type="hidden" class="form-control" id="supplier_id"
                                                            name="supplier_id">

                                                        <input type="text" class="form-control" id="supplier_name"
                                                            name="supplier_name" aria-describedby="button-addon2" required>
                                                        <button class="btn btn-outline-secondary" type="button"
                                                            id="cari_supplier">Search</button>

                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row mb-3">
                                                <label for="reciver" class="col-sm-3 form-label">Reciver</label>
                                                <div class="col-sm-9">
                                                    <input type="text"
                                                        class="form-control @error('reciver') is-invalid @enderror"
                                                        id="reciver" name="reciver" autocomplete="off" required>
                                                </div>
                                                @error('reciver')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                        </div>

                                        <div>
                                            <div class="text-right mb-1">
                                                <button type="button" name="add" id="add"
                                                    class="btn btn-success btn-xs">+</button>
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-sm" id="crud_table">
                                                    <thead>

                                                        <tr>
                                                            <th width="10%">Product Code</th>
                                                            <th width="30%">Product Name</th>
                                                            <th width="10%">PO</th>
                                                            <th width="10%">ORIGINAL NO</th>
                                                            <th width="10%">BATCH</th>
                                                            <th width="10%">ROLL NO</th>
                                                            <th width="10%">GW</th>
                                                            <th width="10%">NW</th>
                                                            <th width="10%">WIDTH</th>
                                                            <th width="10%">BASIC_GM2</th>
                                                            <th width="10%">QTY</th>
                                                            <th width="5%">Action</th>
                                                        </tr>
                                                    </thead>


                                                    <tbody>

                                                    </tbody>
                                                </table>



                                            </div>

                                        </div>



                                        <div class="container mt-3">

                                            <div class="row text-center">
                                                <div class="col">
                                                    <button type="submit" class="btn btn-primary me-2"
                                                        id="save">Save</button>

                                                    <a href="{{ route('all.productin') }}"
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

    <div class="modal fade cari_suppliers" id="cari_suppliers" tabindex="-1" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="varyingModalLabel">Search Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
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
                                            <th>Kode</th>
                                            <th>Name</th>
                                            <th>Group</th>
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
            generateKode()

            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });


        function generateKode() {
            var kodeUrut = document.getElementById('product_in_id');


            $.ajax({
                type: "GET",
                url: "/getkodein/productin",
                success: function(data) {
                    kodeUrut.value = data.kode_in;

                },
                error: function(data) {
                    console.log('Error:', data);


                }
            });

        }


        $(document).ready(function() {
            var count = 1;
            $('#add').click(function() {
                count = count + 1;
                var html_code = "<tr id='row" + count + "'>";

                html_code += "<td contenteditable='true' class='product_id' id='idx" + count +
                    "' style='display:none;' ></td>";
                html_code += "<td contenteditable='true' class='item_code' id='code" + count +
                    "' data-code ='" + count + "'></td>";
                html_code += "<td contenteditable='true' class='item_name' id='name" + count +
                    "'></td>";
                html_code += "<td contenteditable='true' class='po'></td>";
                html_code += "<td contenteditable='true' class='original_no'></td>";
                html_code += "<td contenteditable='true' class='batch'></td>";
                html_code += "<td contenteditable='true' class='roll'></td>";
                html_code += "<td contenteditable='true' class='gw'></td>";
                html_code += "<td contenteditable='true' class='nw'></td>";
                html_code += "<td contenteditable='true' class='width'></td>";
                html_code += "<td contenteditable='true' class='basic_gm2'></td>";
                html_code += "<td contenteditable='true' class='qty'></td>";
                html_code += "<td><button type='button' name='remove' data-row='row" + count +
                    "' class='btn btn-danger btn-xs remove'>-</button></td>";
                html_code += "</tr>";
                $('#crud_table').append(html_code);
            });



            $(document).on('click', '.item_code', function(e) {
                var code = $(this).data("code");
                sessionStorage.setItem("last", code);
                var table = $('#CariTable2').DataTable({

                    processing: true,
                    serverSide: true,
                    "bDestroy": true,
                    ajax: "{{ route('get.productin') }}",

                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'

                        },
                        {
                            data: 'product_code',
                            name: 'product_code'
                        },
                        {
                            data: 'product_name',
                            name: 'product_name'
                        },

                        {
                            data: 'product_group',
                            name: 'product_group',
                        },

                        {
                            data: 'action',
                            name: 'action'
                        },

                    ]
                });

                $('#modal_allocation').modal('show');

                $('body').on('click', '.select-product', function() {

                    let idakhir = sessionStorage.getItem("last");

                    var idx = $(this).data('id');
                    var kode = $(this).data('kode');
                    var nama = $(this).data('nama');
                    $('#idx' + idakhir).text(idx);
                    $('#code' + idakhir).text(kode);
                    $('#name' + idakhir).text(nama);


                    $('#modal_allocation').modal('hide');


                });


            });


        });

        $(document).on('click', '.remove', function() {
            var delete_row = $(this).data("row");
            $('#' + delete_row).remove();
        });


        /* When click show user */

        $(function() {


            $('#cari_supplier').click(function() {

                $('#varyingModalLabel').html("Search supplier");
                var table = $('#CariTable').DataTable({

                    processing: true,
                    serverSide: true,
                    "bDestroy": true,
                    ajax: "{{ route('get.supplierin') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'

                        },
                        {
                            data: 'supplier_code',
                            name: 'supplier_code'
                        },
                        {
                            data: 'supplier_name',
                            name: 'supplier_name'
                        },

                        {
                            data: 'action',
                            name: 'action',
                            orderable: true,
                            searchable: true
                        },
                    ]
                });

                $('#cari_suppliers').modal('show');

            });



            $('body').on('click', '.select-sup', function() {

                var idx = $(this).data('id');
                var supplier_name = $(this).data('nama');
                // console.log(idx);


                $('#supplier_id').val(idx);
                $('#supplier_name').val(supplier_name);

                $('#cari_suppliers').modal('hide');
            });


            $(function() {

                $.ajaxSetup({

                    headers: {

                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                    }

                });


                $('#save').click(function(e) {


                   

                    e.preventDefault();

                 


                    var product_id = [];
                    var po = [];
                    var original_no = [];
                    var batch = [];
                    var roll = [];
                    var gw = [];
                    var nw = [];
                    var width = [];
                    var basic_gm2 = [];
                    var qty = [];
                    $('.product_id').each(function() {
                        product_id.push($(this).text());
                    });
                    $('.po').each(function() {
                        po.push($(this).text());
                    });
                    $('.original_no').each(function() {
                        original_no.push($(this).text());
                    });
                    $('.batch').each(function() {
                        batch.push($(this).text());
                    });
                    $('.roll').each(function() {
                        roll.push($(this).text());
                    });
                    $('.gw').each(function() {
                        gw.push($(this).text());
                    });
                    $('.nw').each(function() {
                        nw.push($(this).text());
                    });
                    $('.width').each(function() {
                        width.push($(this).text());
                    });
                    $('.basic_gm2').each(function() {
                        basic_gm2.push($(this).text());
                    });
                    $('.qty').each(function() {
                        qty.push($(this).text());
                    });

                    var product_in_id = $("#product_in_id").val();
                    var supplier_id = $("#supplier_id").val();
                    var supplier_name = $("#supplier_name");
                    var reciver = $("#reciver").val();



                    if(supplier_id !="" &&  reciver !="" && product_id !="" && po !="" && qty !=""){

                        $(this).html('Sending..');

                        var count = 2;


                    $.ajax({
                        url: "{{ route('store.productin') }}",
                        type: "POST",
                        dataType: 'json',
                        data: {
                            product_in_id: product_in_id,
                            supplier_id: supplier_id,
                            reciver: reciver,

                            product_id: product_id,
                            po: po,
                            original_no: original_no,
                            batch: batch,
                            roll: roll,
                            gw: gw,
                            nw: nw,
                            width: width,
                            basic_gm2: basic_gm2,
                            qty: qty
                        },
                        success: function(data) {

                            // console.log(data);

                            $("#save").html('Save');

                       

                
                            if (data.success == true) {

                                generateKode();
                                $("#supplier_id").val("");
                                $("#supplier_name").val("");
                                $("#reciver").val("");


                                $("td[contentEditable='true']").text("");

                                for (var i = 1; i <= count; i++) {
                                    $('tr#' + i + '').remove();
                                    $('#row' + i + '').remove();
                                }

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
                                });

                             

                            } else {

                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                });

                                Toast.fire({
                                    icon: 'error',
                                    title: data.message
                                });

                            }



                        }
                   ,
                        error: function(data) {

                            $.each(data.responseJSON.errors, function(key, value) {

                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                });

                                Toast.fire({
                                    icon: 'error',
                                    title: value
                                });


                            });

                            $("#save").html('Save');
                        }
                 
                    });

                }

                else {

                    const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                });

                                Toast.fire({
                                    icon: 'error',
                                    title:  'Tolong di Periksa data masih ada yang kosong!'
                                });


                }
                });
            });
        });
    </script>
@endsection
