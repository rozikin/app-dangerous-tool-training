@extends('admin.admin_dashboard')

@section('admin')


<div class="page-content">


    <div class="row profile-body">

        <!-- left wrapper end -->
        <!-- middle wrapper start -->
        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body">

                        <h6 class="card-title">Add Product</h6>

                        <form action="{{ route('store.product') }}"  method="POST" class="forms-sample"   enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="address" class="form-label">Photo</label>
                                <input class="form-control" type="file" id="image" name="image">
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label"></label>
                                <img id="showImage" class="wd-80 rounded-circle"
                                    src="{{ url('upload/product/no_image.jpg') }}"
                                    alt="product">
                            </div>



                            <div class="mb-3">
                                <label for="name" class="form-label">Product Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                                    autocomplete="off">
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="detail" class="form-label">Detail</label>
                                <input type="text" class="form-control @error('detail') is-invalid @enderror" id="detail" name="detail"
                                    autocomplete="off">
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>



                            <button type="submit" class="btn btn-primary me-2">Save</button>
                            <a href="{{ route('all.product') }}" class="btn btn-danger me-2">Back</a>

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


<script type="text/javascript">
    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>





@endsection