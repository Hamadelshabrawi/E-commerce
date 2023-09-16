
<!DOCTYPE html>
<html lang="en">

  <head>
    {{-- <base href="/public"> --}}
    @include('admin.dashboard.css')
<style>
  input{
    background-color : #2A3038; 
}
.flex-container {
  display: flex;
  flex-wrap: nowrap;
}

.flex-container > img  {
  background-color: #f1f1f1;
  width: 100px;
  margin: 10px;
  text-align: center;
  line-height: 75px;
  font-size: 30px;
}
/* .flex-container > button 
 {
  margin: 10px;
  text-align: center;
  width: 100px;

} */
input[type='submit'] {
  margin: 10px;
  text-align: center;
  width: 100px;
}
</style>
  </head>

  <body>
    <div class="container-scroller">

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
                    <h4 class="card-title">Edit Product</h4>
                    <form  class="forms-sample" action="{{ url('edit_product_confirm',$products->id) }}" method="post" enctype="multipart/form-data">
                      @csrf
                      <div class="form-group">
                        <label for="exampleInputName1">Product Title</label>
                        <input style="background-color : #2A3038" type="text" class="form-control" id="exampleInputName1" placeholder="Name" name="product_title" value="{{ $products->title }}">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail3">Product Price</label>
                        <input type="number" class="form-control" id="exampleInputEmail3" placeholder="Price" name="product_pricee" value="{{ $products->price }}">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail3">SKU</label>
                        <input type="text" class="form-control" id="exampleInputEmail3" placeholder="Price" name="Sku" value="{{ $products->Sku }}">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword4">Discount Proce</label>
                        <input type="number" class="form-control" id="exampleInputPassword4" placeholder="Discount" name="discount_price" value="{{ $products->discount_price }}">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword4">Quantity</label>
                        <input type="number" class="form-control" id="exampleInputPassword4" placeholder="Quantity" name="quantity" value="{{ $products->quantity }}">
                      </div>

                      <div class="form-group">
                        <label for="exampleSelectGender">Category</label>
                        <select  selected="" class="form-control" id="exampleSelectGender" name="category"">
                          <option value="{{ $products->category }}">{{ $products->category }}</option>                          
                          @foreach ($category as $category)
                          <option value="{{ $category->category_name }}">{{ $category->category_name }}</option>
                          @endforeach

                        </select>
                      </div>

                      <div class="form-group">
                        <label for="exampleSelectGender">Featured</label>
                        <select value="" selected="" class="form-control" id="exampleSelectGender" name="featured"">
                          <option value="{{ $products->featured }}">{{ $products->featured }}</option>
                          <option value="Latest">Latest</option>
                          <option value="Top Rated">Top Rated</option>
                          <option value="Review">Review</option>

                        </select>
                      </div>

                      <div class="form-group">
                        <label for="exampleSelectGender">Enable</label>
                        <select  selected="" class="form-control" id="exampleSelectGender" name="active"">
                          @if( $products->active == 1 )
                          <option value="{{ $products->active }}">Enable</option>                          
                          <option value="0">Disable</option>
                          @else
                          <option value="{{ $products->active }}">Disable</option>                          
                          <option value="1">Enable</option>
                          @endif
                        </select>
                      </div>
                      <div class="user-image mb-3 text-center">
                        <div class="imgPreview flex-container">
                          @foreach ($media as $media)                       
                          <img src="/storage/uploads/{{ $media->imageName }}" alt="" title="press to remove">
                          @endforeach
                        </div>
                        <div  class="imgPreview flex-container">
                          @foreach ($mediaa as $mediaa)                       
                          {{-- <a href="{{ url('remove_image_edite_product',$mediaa->id) }}" class="badge badge-primary">Remove</a>  --}}
                          <form action="{{ url('remove_image_edite_product',$mediaa->id) }}" method="post">
                            @csrf
                            <input type="submit" class="btn btn-primary" value="Remove">
                          </form>
                          @endforeach
                        </div>
                    </div>  
                      <div class="form-group">
                        <label>Image upload</label>
                        <input type="file" name="image[]" multiple>
                      </div>
                      <div class="form-group">
                        <label for="exampleTextarea1">Description</label>
                        <input value="{{ $products->description}}"class="form-control" id="exampleTextarea1" rows="4" name="description">
                      </div>
                      <button class="btn btn-primary text-uppercase" type="submit" >Send</button>               
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