
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
                            <th> Change Type </th>
                            <th> Remove </th>



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
                            <td>
                                <form action="{{ url('edit_userype_one',$userss->id) }}" method="post">
                                    @csrf
                                    @if( $userss->usertype != 0)
                                    <button  class="badge badge-success" href ="" >Change To user</button></td>
                                    @else 
                                    <button  class="badge badge-success" href ="" >Change To Admin</button></td>
                                    @endif
                                </form>
                            </td>
                              
                            <td>
                                <form action="{{ url('delete_user',$userss->id) }}" method="post">
                                  @csrf
                                  <button onclick="return confirm('Are you sure you want to delete this Product')"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
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