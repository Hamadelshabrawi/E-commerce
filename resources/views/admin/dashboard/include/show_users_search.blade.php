
<!DOCTYPE html>
<html lang="en">

  <head>
    @include('admin.dashboard.css')
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


              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <form name="autocomplete-textbox" id="autocomplete-textbox" method="get" action="{{ url('Admin_users_search') }}">
                      @csrf
                      <input type="text" class="form-control" placeholder="Search products" id="name" name="search">
                    </form><br>
                    <h4 class="card-title">Users Table</h4>
                    </p>
                    <div class="table-responsive">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th> ID </th>
                            <th> Name </th>
                            <th> Email  </th>
                            <th> User type </th>
                            <th> Phone </th>
                            <th> Address </th>
                            <th> Email Verified </th>
                            <th> Created At </th>


                          </tr>
                        </thead>
                        <tbody>

                          @foreach ( $users as $userss )
                            
                          <tr>

                            <td> {{ $userss->id  }} </td>
                            <td> {{ $userss->name  }} </td>
                            <td> {{ $userss->email  }} </td>
                            @if( $userss->usertype > 0)
                            <td> Admin </td>
                            
                            @else 
                            <td> User </td>
                            @endif
                            <td> {{ $userss->phone }} </td>
                            <td> {{ $userss->address }} </td>
                            <td> {{ $userss->email_verified_at }} </td>
                            <td> {{ $userss->created_at }} </td>

                            @if( $userss->usertype > 0)
                            <td><a class="badge badge-success" href ="{{ url('edit_userype_one',$userss->id) }}" >Change To user</a></td>
                            
                            @else 
                            <td><a class="badge badge-success" href ="{{ url('edit_userype_one',$userss->id) }}" >Change To Admin</a></td>
                            @endif

                            <td><a onclick="return confirm('Are you sure you want to delete this Product')"class="badge badge-danger" href ="{{ url('delete_user',$userss->id) }}" >Delete</a></td>

                          </tr>
                          @endforeach

                        </tbody>
                      </table>
                    </div>
                    <a href="">
                      {!!$users->withQueryString()->links('pagination::bootstrap-5')!!}
                      </a>
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