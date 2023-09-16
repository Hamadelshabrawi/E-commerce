
<!DOCTYPE html>
<html lang="en">

  <head>
    @include('admin.dashboard.css')
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

              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Add Category</h4>

                  <form class="forms-sample" action="{{ url('add_category') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      <label for="exampleInputUsername1" >Add Category Name</label>
                      <input type="text" name="category_name" class="form-control" id="exampleInputUsername1" placeholder="Category Name" autocomplete="off" required>
                    </div>
                    <div class="custom-file">
                      <label for="formFile" class="form-label">Image upload</label>
                      <input type="file" name="image" id="images">
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button class="btn btn-dark">Cancel</button>
                  </form>
                </div>
              </div>

                <div class="card" style="margin-top:40px">
                  <div class="card-body">
                    <h4 class="card-title">Category Table</h4>
                    </p>
                    <div class="table-responsive">
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Category Name</th>
                            <th>Category status</th>
                            <th>Create At </th>
                            <th>Delete</th>
                          </tr>
                        </thead>
                        <tbody>
                          @php $count = 1; @endphp
                  @foreach ( $data as $data )
  
                          <tr>
                            <td>{{ $count++ }}</td>
                            @php $val = $data->image; @endphp
                            <th><img src="{{ ('storage/uploads/') }}{{ $data->image }}" alt=""></th>

                          <td >
                            <form action="{{ url('edit_categ_name',$data->id) }}" method="post">
                              @csrf
                              <input type="text" name="category_name" value="{{ $data->category_name }}">
                            </form>
                          </td>
                          <td>

                            <form action="{{ url('edit_categ_status',$data->id) }}" method="post">
                              @csrf
                              @if( $data->active != 1)
                              <button class="badge rounded-pill bg-dark">Disabled</button>
                              @else
                              <button class="badge rounded-pill bg-primary">Enabled</button>
                            </form>
                            @endif


                        </td>
                            <td class="text-danger"> {{ $data->created_at }}  <i class="mdi mdi-arrow-down"></i></td>

                            <td>
                              <form action="{{ url('delete_category',$data->id) }}" method="post">
                                @csrf
                                <button onclick="return confirm('Are you sure you want to delete ')">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                                  </svg>
                                  </button>
                              </form>
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
