<!DOCTYPE html>
<html>
   <head>
      <!-- Basic -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="{{ asset('home/images/favicon.png') }}" type="">
      <meta name="csrf-token" content="{{ csrf_token() }}">
 
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
 var siteUrl = "{{url('/')}}";
</script>
      <title>All Products </title>
      @include('home.css')

      <style>
        input::-webkit-outer-spin-button,
     input::-webkit-inner-spin-button {
       -webkit-appearance: none;
       margin: 0;
     }
     
     /* Firefox */
     input[type=number] {
       -moz-appearance: textfield;
     }
     .input-group.md-form.form-sm.form-1 input{
       border: 1px solid #bdbdbd;
       border-top-right-radius: 0.25rem;
       border-bottom-right-radius: 0.25rem;
     }
     .input-group.md-form.form-sm.form-2 input {
       border: 1px solid #bdbdbd;
       border-top-left-radius: 0.25rem;
       border-bottom-left-radius: 0.25rem;
     }
     .input-group.md-form.form-sm.form-2 input.red-border {
       border: 1px solid #ef9a9a;
     }
     .input-group.md-form.form-sm.form-2 input.lime-border {
       border: 1px solid #cddc39;
     }
     .input-group.md-form.form-sm.form-2 input.amber-border {
       border: 1px solid #ffca28;
     }
     </style>

   </head>
   <body>
      <div class="hero_area">

         <!-- header section strats -->
            @include('home.header')
         <!-- end header section -->


         <section class="product_section layout_padding">
            <div class="container">
              @if (session()->has('message'))
              <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"> X </button>
                {{ session()->get('message') }}
              </div>
            @endif
               <div class="heading_container heading_center">
                  <div class="hero__search__form">
                     <form action="{{ url('produc_search') }}" method="get">
                      @csrf
                         <input style="outline:none" type="search" id="name" name="searchText" placeholder="Search">
                         <button style="background:red" type="submit" class="site-btn">SEARCH</button>
                     </form>
                 </div>
                  <h2>
                     Our <span>products</span>
                  </h2>
               </div>
               <div class="row">
                 @foreach ($products as $productss)
        
                    @if ($productss->quantity < 1)
                    <div style="pointer-events: none;
                    opacity: 0.4;" class="col-sm-6 col-md-4 col-lg-4">
                       <div class="box">
                          <div class="option_container">
                             <div class="options">
                               <a href="{{ url('more_details',$productss->id) }}" class="option2">
                                  More Details
                                  </a>
          
                               <form action="{{ url('add_cart',$productss->id) }}" method="post" >
          
                                     @csrf
                                     @if (!$productss->quantity < 1 )
                                        
                                        <div class="row" style="margin-top:50px ;">
                                           <div class="col-sm-4">
                                              <input style="width:80px ;" placeholder="Qty" type="number" min="1" max="{{ $productss->quantity }}" name="cartQty">
                                           </div>
                                           <div class="col-sm-4">
                                              <input href="" style="" type="submit" class="option1" value="Add To Card">
                                           </div>
                                        </div>
                                     @else
                                     <div class="row" style="margin-top:50px ;">
                                        <div class="col-sm-4">
                                        </div>
                                        <div class="col-sm-4">
                                        </div>
                                     </div>
                                     @endif                    
                               </form>
                             </div>
                          </div>
                          @if ($productss->quantity < 1 )
                           
                            @endif
                          <div class="img-box">
                             <img src="/storage/uploads/{{ $productss->image }}" alt="">
                          </div>
                          <div class="detail-box">
                           <h5 style="line-height: 1.5em;height: 3em;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;width: 100%;">
                              {{ $productss->title }}<br>
                              <p style="font-size: 9px;">SKU : {{ $productss->Sku }}</p>
                           </h5>
                          </div>
                          <div>
                          @if ($productss->discount_price !=null)
                               <h6 style="text-decoration: line-through;">
                                  ${{ $productss->price }}
                               </h6>
                            @else
                            <h6>
                               ${{ $productss->price }}
                            </h6>
                             @endif
                           </div>
                       </div>
                    </div>
                    @else
                    <div  class="col-sm-6 col-md-4 col-lg-4">
                     <div class="box">
                        <div class="option_container">
                           <div class="options">
                             <a href="{{ url('more_details',$productss->id) }}" class="option2">
                                More Details
                                </a>
                             <form action="{{ url('add_cart',$productss->id) }}" method="post" >
                                   @csrf
                                   @if (!$productss->quantity < 1 )
                                      <div class="row" style="margin-top:50px ;">
                                         <div class="col-sm-4">
                                            <input style="width:80px ;" placeholder="Qty" type="number" min="1" max="{{ $productss->quantity }}" name="cartQty">
                                         </div>
                                         <div class="col-sm-4">
                                            <input href="" style="" type="submit" class="option1" value="Add To Card">
                                         </div>
                                      </div>
                                   @else
                                   <div class="row" style="margin-top:50px ;">
                                      <div class="col-sm-4">
                                      </div>
                                      <div class="col-sm-4">
                                      </div>
                                   </div>
                                   @endif 
                             </form>
                           </div>
                        </div>
                        @if ($productss->quantity < 1 )
                        <div> Out Of Stock</div>
                          @endif
                        <div class="img-box">
                           <img src="/storage/uploads/{{ $productss->image }}" alt="">
                        </div>
                        <div class="detail-box">
                           <h5 style="line-height: 1.5em;height: 3em;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;width: 100%;">
                              {{ $productss->title }}<br>
                              <p style="font-size: 9px;">SKU : {{ $productss->Sku }}</p>
                           </h5>
                        </div>
                        @if ($productss->discount_price !=null)
                        <div class="block_container" style="text-align:center;">
                            <h4 class="bloc1" style="text-decoration: line-through;display:inline;"> ${{ $productss->price }} </h4>  <h4 style="display:inline;margin-left:20%">${{ $productss->discount_price }}</h4>
                         </div>
                        @else
                        <h4> ${{ $productss->price }} </h4>
                        @endif
                     </div>
                  </div>
                    @endif
                  @endforeach
               </div><br>
               <a href="">
                  {!!$products->withQueryString()->links('pagination::bootstrap-5')!!}
                  </a>
            </div>
         </section>


        <!-- footer start -->
            @include('home.footer')
        <!-- footer end -->

      <div class="cpy_">
         <p class="mx-auto">©2023 All Rights Reserved By <a href="/">E-commerce</a><br>
         
            Distributed By <a href="/" target="_blank">Hamad El-Shabrawi</a>
         
         </p>
      </div>
      <!-- jQery -->
      {{-- <script src="home/js/jquery-3.4.1.min.js"></script> --}}
      <!-- popper js -->
      <script src="{{ asset('home/js/popper.min.js') }}"></script>
      <!-- bootstrap js -->
      <script src="{{ asset('home/js/bootstrap.js') }}"></script>
      <!-- custom js -->
      <script src="{{ asset('home/js/custom.js') }}"></script>

      <script>
         document.addEventListener("DOMContentLoaded", function(event) { 
             var scrollpos = localStorage.getItem('scrollpos');
             if (scrollpos) window.scrollTo(0, scrollpos);
         });
 
         window.onbeforeunload = function(e) {
             localStorage.setItem('scrollpos', window.scrollY);
         };
     </script>
      <script>
         $(document).ready(function() {
             $( "#name" ).autocomplete({
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
   </body>
</html>