
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
                    <h4 class="card-title">Orders Table</h4>
                    
                    </p>
                    <div class="table-responsive">
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>id</th>
                            <th>order id</th>
                            <th>Customer Name</th>
                            <th>Customer Number</th>
                            <th>Adress</th>
                            <th>Total Price</th>
                            <th>Status Of payment</th>


                          </tr>
                        </thead>
                        <tbody>
                        @foreach ( $orders as $orders)  
    
                          <tr>
                            <td>{{ $orders->id }}</td>
                            <td>{{ $orders->order_id }}</td>
                            <td>{{ $orders->user_name }}</td>
                            <td>{{ $orders->user_phone }}</td>

                            <td class="text-danger">{{ $orders->user_address }}</td>
                            <td><label class="">{{ $orders->Total_price }}</label></td>
                            <td><label class="">{{ $orders->payment_status }}</label></td>

                          </tr>

                        @endforeach

                        </tbody>
                      </table>
                    </div>
                  </div>
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