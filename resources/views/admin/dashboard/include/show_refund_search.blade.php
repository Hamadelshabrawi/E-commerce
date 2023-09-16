
<!DOCTYPE html>
<html lang="en">

  <head>
    {{-- <base href="/public"> --}}
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
                    <form name="autocomplete-textbox" id="autocomplete-textbox" method="get" action="{{ url('Admin_refund_search') }}">
                      @csrf
                      <input type="text" class="form-control" placeholder="Search products" id="name" name="search">
                    </form><br>
                    <h4 class="card-title">Refund Table</h4>
                    
                    </p>
                    <div class="table-responsive">
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>User Name</th>
                            <th>Order Id</th>
                            <th>Reason</th>
                            <th>Image</th>
                            <th>Replace or Refund</th>
                            <th>Admin status</th>
                            <th>At</th>

                            <th>Admin Name</th>



                          </tr>
                        </thead>
                        <tbody>
                          @php $count = 1;
                               @endphp
                        @foreach ( $refund as $refundd)  
    
                          <tr>
                            <td> {{ $count++ }} </td>
                            <td> {{ $refundd->name }} </td>
                             <td> {{ $refundd->order_id }} </td>
                            <td><label> {{ $refundd->reason }} </label></td>
                            <td> <img src="/product/{{ $refundd->image }}" alt=""> </td>

                            <td> {{ $refundd->replaceOrrefund }} </td>

                            

                            @if($refundd->admin_approved != 'Approved')

                            <td>
                               <form action="{{ url('refund_approve',$refundd->id) }}" method="post">
                                 @csrf
                                 <button style="width: 140px" class="badge badge-danger">Pending</button>
                               </form>
                             </td>

                            @else
                       
                            <td>
                               <form action="{{ url('refund_approve',$refundd->id) }}" method="post">
                                 @csrf
                                 <button style="width: 140px" class="badge badge-warning">{{ $refundd->admin_approved }}</button>
                               </form>
                             </td>
                             @endif



                            {{-- <td><a class="badge badge-danger" href ="{{ url('refund_approve',$refund->id) }}" >{{ $refund->admin_approved }}</a></td> --}}

                            <td> {{ $refundd->created_at }} </td> 

                            {{-- @if (!empty($adminname[$count-2])) --}}

                            @if (!empty($adminname[$count-2]))
                            <td class="px-4 py-3 text-sm">{{ $adminname[$count-2] }} </td>
                            @else
                            <td class="px-4 py-3 text-sm">-</td>
                            @endif

                            @endforeach
                          </tr>


                        </tbody>
                      </table>
                    </div>
                  </div>
                  <a href="">
                    {!!$refund->withQueryString()->links('pagination::bootstrap-5')!!}
                    </a>
                </div>
            </div>

        
        
          @include('admin.dashboard.footer')
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