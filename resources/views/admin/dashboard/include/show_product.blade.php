
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


              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Product Table  <a href="{{ url('view_product') }}" style="margin-left:80% " class="badge rounded-pill bg-primary">Add Product</a></h4>
                    </h4>
                    </p>
                    <div class="table-responsive">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th> Image </th>
                            <th> ID </th>
                            <th> Product name </th>
                            <th> Sku </th>
                            <th> Price </th>
                            <th> Discount </th>
                            <th> Description </th>
                            <th> Category </th>
                            <th> Featured</th>
                            <th> Status </th>
                            <th> Created At </th>
                            <th> Edit </th>
                            <th> Download</th>
                            <th> Delete</th>

                          </tr>
                        </thead>
                        <tbody>

                          @foreach ( $products as $productss )
                            
                          <tr>

                            <td class="py-1">
                              <img src="/storage/uploads/{{ $productss->image }}" alt="image" />
                            </td>
                            <td> {{ $productss->id  }} </td>
                            <td style="width:400px;max-height: calc(2 * 1.5em);line-height: 1.5em;overflow: hidden;text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 2;
                            -webkit-box-orient: vertical;"> {{ $productss->title  }} </td>
                            <td> {{ $productss->Sku  }} </td>
                            <td> {{ $productss->price }} </td>
                            <td> {{ $productss->discount_price }} </td>
                            <td style="width:400px;max-height: calc(2 * 1.5em);line-height: 1.5em;overflow: hidden;text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 2;
                            -webkit-box-orient: vertical;"> {{ $productss->description }} </td>
                            <td> {{ $productss->category }} </td>
                            <td> {{ $productss->featured }} </td>

                            @if( $productss->active > 0)
                            <td> <div class="badge rounded-pill bg-light text-dark">Enabled</div>  </td>
                            @else
                            <td> <span class="badge rounded-pill bg-warning text-dark" > Disabled </span>  </td>
                            @endif
                            <td> {{ $productss->created_at }} </td>
                            {{-- <td><a class="badge badge-success" href ="{{ url('edit_product',$productss->id) }}" >Edit</a></td> --}}
                            <td>
                              <a href ="{{ url('edit_product',$productss->id) }}"
                              class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                              aria-label="Edit"
                            >
                              <svg
                                class="w-5 h-5"
                                aria-hidden="true"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                              >
                                <path
                                  d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"
                                ></path>
                              </svg>
                            </a>

                            </td>
                            <td><a class="badge badge-success" href ="{{ url('pdf_product',$productss->id) }}" >PDF</a></td>

                            <td>
                            <form action="{{ url('delete_product',$productss->id) }}" method="post">
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
                      {!!$products->withQueryString()->links('pagination::bootstrap-5')!!}
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