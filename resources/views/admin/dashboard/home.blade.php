
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
            @include('admin.dashboard.body')
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