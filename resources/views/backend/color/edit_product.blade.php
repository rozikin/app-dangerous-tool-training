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

                        <h6 class="card-title">Edit Product</h6>

                        <form id="myForm"  method="POST" action="{{ route('update.product', $products->id) }}"  class="forms-sample"   enctype="multipart/form-data">
                            @csrf

                          
                            <div class="mb-3">
                                <label for="image" class="form-label">Photo</label>
                                <input type="hidden" name="id" value="{{ $products->id }}">
                                <input class="form-control" type="file" id="imagex" name="image"  value="{{ $products->image }}">
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">{{$products->image}}</label>
                                <br>
                                <img id="showImage" class="wd-80 rounded-circle"
                                    src="{{ url('upload/product/'.$products->image) }}"
                                    alt="product">
                            </div>

                            <div class="mb-3">
                                <label for="name" class="form-label">Product Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                                    autocomplete="off"  value="{{ $products->name }}">
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="detail" class="form-label">Detail</label>
                                <input type="text" class="form-control @error('detail') is-invalid @enderror" id="detail" name="detail"
                                    autocomplete="off" value="{{ $products->detail }}">
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>



                            <button type="submit" class="btn btn-primary me-2">Save</button>

                        </form>

                    </div>
                </div>

            </div>
        </div>
      
    </div>

</div>


<script type="text/javascript">
    $(document).ready(function(){
        $('#imagex').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>





@endsection


