
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


                <div class="card" style="margin-top:40px">
                  <div class="card-body">
                    <form name="autocomplete-textbox" id="autocomplete-textbox" method="get" action="{{ url('Admin_subscribe_search') }}">
                      @csrf
                      <input type="text" class="form-control" placeholder="Search products" id="name" name="search">
                    </form><br>
                    <h4 class="card-title">Subscribe Table</h4>
                    </p>
                    <div class="table-responsive">
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>User Name</th>
                            <th>User Email</th>
                            <th>User Phone</th>
                            <th>User Address</th>
                            <th>User Type</th>
                            <th>Subscribed Email </th>
                            <th>Create At </th>
                            <th>Delete</th>
                          </tr>
                        </thead>
                        <tbody>
                          @php $count = 1; @endphp
                  @foreach ( $subscribe as $subscribee )
  
                          <tr>
                            <td>{{ $count++ }}</td>

                          
                          <td>
                            <a class="badge rounded-pill bg-dark" >{{ $subscribee->name }}</a>
                          </td>

                          <td>
                            <a class="badge rounded-pill bg-dark" >{{ $subscribee->email }}</a>
                          </td>

                          <td>
                            <a class="badge rounded-pill bg-dark" >{{ $subscribee->phone }}</a>
                          </td>

                          <td>
                            <a class="badge rounded-pill bg-dark" >{{ $subscribee->address }}</a>
                          </td>

                          <td>
                            @if ($subscribee->usertype == 1)
                              <a class="badge rounded-pill bg-dark" >Admin</a>
                            @else
                              <a class="badge rounded-pill bg-dark" >User</a>
                            @endif
                          </td>
                          <td > {{ $subscribee->subscribe_email }} </td>

                          <td class="text-danger"> {{ $subscribee->created_at }} </td>

                            <td>
                              <form action="{{ url('admin_delete_subscribe',$subscribee->id) }}" method="post">
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
                  <a href="">
                    {!!$subscribe->withQueryString()->links('pagination::bootstrap-5')!!}
                    </a>
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
