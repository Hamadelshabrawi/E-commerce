
<!DOCTYPE html>
<html lang="en">

  <head>
    <base href="/public">
    @include('admin.dashboard.css')
<style>
  input{
    background-color : #2A3038; 
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
                    <h4 class="card-title">Send Mail</h4>
                    <form class="forms-sample" action="{{ url('send_user_email',$order->id) }}" method="post" enctype="multipart/form-data">
                      @csrf
                      <div class="form-group">
                        <label for="exampleInputName1">Email Greeting</label>
                        <input style="background-color : #2A3038" type="text" name="greeting" class="form-control"   name="greeting" >
                      </div>
                      <div class="form-group">
                        <label for="exampleInputName1">Email First Line</label>
                        <input type="text" class="form-control" name="firstline" >
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail3">Body</label>
                        <input type="text" class="form-control" name="body" >
                      </div>
                      {{-- <div class="form-group">
                        <label for="exampleInputPassword4">Button</label>
                        <input type="text" class="form-control" name="button" >
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword4">Url</label>
                        <input type="text" class="form-control" name="url" >
                      </div> --}}
                      <div class="form-group">
                        <label for="exampleInputPassword4">Last line</label>
                        <input type="text" class="form-control" name="lastline" >
                      </div>




                      <button type="submit" class="btn btn-primary mr-2">Submit</button>
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