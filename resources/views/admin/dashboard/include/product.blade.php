
<!DOCTYPE html>
<html lang="en">

  <head>
    @include('admin.dashboard.css')
    <style>
      input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}

.flex-container {
  display: flex;
  flex-wrap: nowrap;
}

.flex-container > img {
  background-color: #f1f1f1;
  width: 100px;
  margin: 10px;
  text-align: center;
  line-height: 75px;
  font-size: 30px;
}

    </style>
  </head>

  <body>
    <div class="container-scroller">
      @include('sweetalert::alert')

      <!-- partial:partials/_sidebar.html -->
            @include('admin.dashboard.sidebar')
      <!-- partial -->

      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
            @include('admin.dashboard.navbar')
            
        <!-- partial -->

        <div class="main-panel">
          <div class="content-wrapper">
              @if (session()->has('message'))
                <div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true"> X </button>
                  {{ session()->get('message') }}
                </div>
              @endif


              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Add Product</h4>
                    <form class="forms-sample" action="{{ url('add_product') }}" method="post" enctype="multipart/form-data">
                      @csrf
                      <div class="form-group">
                        <label for="exampleInputName1">Product Title</label>
                        <input type="text" class="form-control" id="exampleInputName1" placeholder="Name" name="product_title">
                      </div>
                      @error('product_title')
                      <div class="alert alert-danger">{{$message}}
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"> X </button>
                      </div>
                      @enderror
                      <div class="form-group">
                        <label for="exampleInputEmail3">Product Sku</label>
                        <input type="text" class="form-control" id="exampleInputEmail3" placeholder="Sku" name="Sku">
                        {{-- @if (session()->has('Error'))
                        <div class="alert alert-danger">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true"> X </button>
                          {{ session()->get('Error') }}
                        </div>
                      @endif --}}
                      {{-- @if (session()->has('Error')) --}}
                      @error('Sku')
                        <div class="alert alert-danger">{{$message}}
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true"> X </button>
                        </div>
                        @enderror


                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail3">Product Price</label>
                        <input type="number" class="form-control" id="exampleInputEmail3" placeholder="Price" name="product_pricee">
                      </div>
                      @error('product_pricee')
                        <div class="alert alert-danger">{{$message}}
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true"> X </button>
                        </div>
                        @enderror
                      <div class="form-group">
                        <label for="exampleInputPassword4">Discount Price</label>
                        <input type="number" class="form-control" id="exampleInputPassword4" placeholder="Discount" name="discount_price">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword4">Quantity</label>
                        <input type="number" class="form-control" id="exampleInputPassword4" placeholder="Quantity" name="quantity">
                      </div>
                      <div class="form-group">
                        <label for="exampleSelectGender">Category</label>
                        <select value="" selected="" class="form-control" id="exampleSelectGender" name="category"">
                          @foreach ($category as $category)
                            
                          <option value="{{ $category->category_name }}">{{ $category->category_name }}</option>
                          @endforeach

                        </select>
                      </div>
                      <div class="form-group">
                        <label for="exampleSelectGender">Featured</label>
                        <select value="" selected="" class="form-control" id="exampleSelectGender" name="featured"">
                          
                          <option value="Latest">Latest</option>
                          <option value="Top Rated">Top Rated</option>
                          <option value="Review">Review</option>

                        </select>
                      </div>
                      <div class="form-group">
                        <label for="exampleSelectGender">Enable</label>
                        <select value="" selected="" class="form-control" id="exampleSelectGender" name="active"">
                            
                          <option value="0">Disable</option>
                          <option value="1">Enable</option>

                        </select>
                      </div>
                      <div class="user-image mb-3 text-center">
                        <div class="imgPreview flex-container"></div>
                    </div>  
                      <div class="form-group">
                        <label>Image upload</label>
                        <input type="file" name="image[]" id="images" multiple accept=".jpg,.jpeg,.png,.gif">
                      </div>
                      @error('image')
                        <div class="alert alert-danger">{{$message}}
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true"> X </button>
                        </div>
                        @enderror
                      <div class="form-group">
                        <label for="exampleTextarea1">Description</label>
                        <input class="form-control" id="exampleTextarea1" rows="4" name="description"></input>
                      </div>
                      <button type="submit" class="btn btn-primary mr-2">Submit</button>
                      <button class="btn btn-dark">Cancel</button>
                    </form>
                  </div>
                </div>
              </div>



          </div>
        </div>
        

        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
        @include('admin.dashboard.script')
    <!-- End custom js for this page -->
  </body>
</html>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script>
    $(function() {
    // Multiple images preview with JavaScript
    var multiImgPreview = function(input, imgPreviewPlaceholder) {
        if (input.files) {
            var filesAmount = input.files.length;
            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();
                reader.onload = function(event) {
                    $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);
                }
                reader.readAsDataURL(input.files[i]);
            }
        }
    };
    $('#images').on('change', function() {
        multiImgPreview(this, 'div.imgPreview');
    });
    });    
</script>