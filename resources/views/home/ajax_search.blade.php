{{-- <div id="ajax_search_result">

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
                 <div> Out Of Stock</div>
 
                   @endif
                 <h6>
                   @if ($productss->discount_price !=null)
                   After Discount : ${{ $productss->discount_price }}
                   @else
                   .
                   @endif
                  </h6>
 
                 <div class="img-box">
                    <img src="product/{{ $productss->image }}" alt="">
                 </div>
                 <div class="detail-box">
                    <h5>
                       {{ $productss->title }}
                    </h5>
                    @if ($productss->discount_price !=null)
                      <h6 style="text-decoration: line-through;">
                         ${{ $productss->price }}
                      </h6>
                   @else
                   <h6>
                      ${{ $productss->price }}
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
               <h6>
                 @if ($productss->discount_price !=null)
                 After Discount : ${{ $productss->discount_price }}
                 @else
                 .
                 @endif
                </h6>

               <div class="img-box">
                  <img src="product/{{ $productss->image }}" alt="">
               </div>
               <div class="detail-box">
                  <h5>
                     {{ $productss->title }}
                  </h5>
                  @if ($productss->discount_price !=null)
                    <h6 style="text-decoration: line-through;">
                       ${{ $productss->price }}
                    </h6>
                 @else
                 <h6>
                    ${{ $productss->price }}
                  @endif

               </div>
            </div>
         </div>

           @endif
         
         @endforeach
      </div>



</div> --}}