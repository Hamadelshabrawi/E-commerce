
<!DOCTYPE html>
<html lang="en">

  <head>
    {{-- <base href="/public"> --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">


<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script type="text/javascript">

    var siteUrl = "{{url('/')}}";

</script>
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
                      <form name="autocomplete-textbox" id="autocomplete-textbox" method="get" action="{{ url('Admin_invoice_search') }}">
                        @csrf
                        <input type="text" class="form-control" placeholder="Search products" id="name" name="search">
                      </form><br>
                    <h4 class="card-title">Invoice Table</h4>
                    
                    </p>
                    <div class="table-responsive">
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>order id</th>
                            <th>User Name</th>
                            <th>Total Price</th>
                            <th>Status Of payment</th>
                            <th>Status Of delivery</th>
                            <th>Time</th>
                            <th>Select</th>




                          </tr>
                        </thead>
                        <tbody>
                          @php $count = 1; @endphp
                        @foreach ( $invoice as $invoicee)  
    
                          <tr>
                            <td> {{$count++}} </td>
                            <td> {{ $invoicee->order_id }} </td>
                            <td> {{ $invoicee->name }} </td>
                            <td><label> {{ $invoicee->total }} </label></td>
                            @if ($invoicee->paid_by =='Paid')

                            <td><label style="width: 140px" class="badge bg-light text-dark"> {{ $invoicee->paid_by }} </label></td>

                            @else

                            <td><label style="width: 140px" class="badge badge-danger"> {{ $invoicee->paid_by }} </label></td>

                            @endif

                            <td><form action="{{ url('change_delivery_to_Approve',$invoicee->id) }}" method="post">
                              @csrf
                              @if($invoicee->delivery == 'waiting for delivery')
                              <button style="width: 140px" class="badge badge-danger"> {{ $invoicee->delivery }}</button>
                              @else
                              <button style="width: 140px" class="badge badge-warning"> {{ $invoicee->delivery }}</button>
                              @endif

                            </form></td>

                            <td><label class="badge badge-primary"> {{ $invoicee->created_at  }} </label></td>


                            <td><a class="badge bg-info text-dark" href ="{{ url('single_invoice',$invoicee->order_id) }}" >Select</a></td>

                          </tr>

                        @endforeach

                        </tbody>
                      </table>
                    </div>
                  </div>
                  <a href="">
                    {!!$invoice->withQueryString()->links('pagination::bootstrap-5')!!}
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

<script>
  $(document).ready(function() {
      $( "#name" ).Admin_invoice_search({
          source: function(request, response) {
              $.ajax({
              url: siteUrl + '/' +"autocomplete",
              data: {
                      term : request.term
               },
              dataType: "json",
              success: function(data){
                 var resp = $.map(data,function(obj){
                      return obj.title;
                 }); 
                 response(resp);
              }
          });
      },
      minLength: 1
   });
  });
  </script>