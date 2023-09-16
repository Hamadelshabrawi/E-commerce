<section class="latest-product spad">
   <div class="container">
       <div class="row">
           <div class="col-lg-4 col-md-6">
               <div class="latest-product__text">
                   <h4>Latest Products</h4>
                   <div class="latest-product__slider owl-carousel">
                       <div class="latest-prdouct__slider__item">
                        @foreach ($Latestproducts as $Latestproducts)
                            
                           <a href="{{ url('/more_details',$Latestproducts->id )}}" class="latest-product__item">
                               <div class="latest-product__item__pic">
                                   <img style="max-height: 7vw;min-height:7vw;max-width:7vw;min-width:7vw;" src="{{ ('/storage/uploads/') }}{{ $Latestproducts->image }}" alt="">
                               </div>
                               <div class="latest-product__item__text">
                                   <h6>{{ $Latestproducts->title }}</h6>
                                   @if ($Latestproducts->discount_price !=null)
                                        <span><span style="text-decoration-line: line-through;text-decoration-thickness: 2px;"> $ {{ $Latestproducts->price }}</span>  $ {{ $Latestproducts->discount_price }}</span>
                                    @else
                                        <span> ${{ $Latestproducts->price }}</span>
                                    @endif
                                   {{-- <span>${{ $Latestproducts->price }}</span> --}}
                               </div>
                           </a>
                           @endforeach

                       </div>
                       <div class="latest-prdouct__slider__item">
                        @foreach ($Latestproducts1 as $Latestproducts1)

                           <a href="{{ url('/more_details',$Latestproducts1->id )}}" class="latest-product__item">
                               <div class="latest-product__item__pic">
                                   <img style="max-height: 7vw;min-height:7vw;max-width:7vw;min-width:7vw;" src="{{ ('/storage/uploads/') }}{{ $Latestproducts1->image }}">
                               </div>
                               <div class="latest-product__item__text">
                                <h6>{{ $Latestproducts1->title }}</h6>
                                @if ($Latestproducts1->discount_price !=null)
                                     <span><span style="text-decoration-line: line-through;text-decoration-thickness: 2px;"> $ {{ $Latestproducts1->price }}</span>  $ {{ $Latestproducts->discount_price }}</span>
                                 @else
                                     <span> ${{ $Latestproducts1->price }}</span>
                                 @endif
                               </div>
                           </a>
                           @endforeach
                       </div>
                   </div>
               </div>
           </div>
           <div class="col-lg-4 col-md-6">
               <div class="latest-product__text">
                   <h4>Top Rated Products</h4>
                   <div class="latest-product__slider owl-carousel">
                       <div class="latest-prdouct__slider__item">
                        @foreach ($TopRatedproducts as $TopRatedproducts)
                            
                        <a href="{{ url('/more_details',$TopRatedproducts->id )}}" class="latest-product__item">
                            <div class="latest-product__item__pic">
                                <img style="max-height: 7vw;min-height:7vw;max-width:7vw;min-width:7vw;" src="{{ ('/storage/uploads/') }}{{ $TopRatedproducts->image }}" alt="">
                            </div>
                            <div class="latest-product__item__text">
                                <h6>{{ $TopRatedproducts->title }}</h6>
                                @if ($TopRatedproducts->discount_price !=null)
                                     <span><span style="text-decoration-line: line-through;text-decoration-thickness: 2px;"> $ {{ $TopRatedproducts->price }}</span>  $ {{ $TopRatedproducts->discount_price }}</span>
                                 @else
                                     <span> ${{ $TopRatedproducts->price }}</span>
                                 @endif
                                {{-- <span>${{ $Latestproducts->price }}</span> --}}
                            </div>
                        </a>
                        @endforeach
                       </div>
                       <div class="latest-prdouct__slider__item">
                        @foreach ($TopRatedproducts1 as $TopRatedproducts1)
                            
                        <a href="{{ url('/more_details',$TopRatedproducts1->id )}}" class="latest-product__item">
                            <div class="latest-product__item__pic">
                                <img style="max-height: 7vw;min-height:7vw;max-width:7vw;min-width:7vw;" src="{{ ('/storage/uploads/') }}{{ $TopRatedproducts1->image }}" alt="">
                            </div>
                            <div class="latest-product__item__text">
                                <h6>{{ $TopRatedproducts1->title }}</h6>
                                @if ($TopRatedproducts1->discount_price !=null)
                                     <span><span style="text-decoration-line: line-through;text-decoration-thickness: 2px;"> $ {{ $TopRatedproducts1->price }}</span>  $ {{ $TopRatedproducts1->discount_price }}</span>
                                 @else
                                     <span> ${{ $TopRatedproducts1->price }}</span>
                                 @endif
                                {{-- <span>${{ $Latestproducts->price }}</span> --}}
                            </div>
                        </a>
                        @endforeach
                       </div>
                   </div>
               </div>
           </div>
           <div class="col-lg-4 col-md-6">
               <div class="latest-product__text">
                   <h4>Review Products</h4>
                   <div class="latest-product__slider owl-carousel">
                       <div class="latest-prdouct__slider__item">
                        @foreach ($Reviewproducts as $Reviewproducts)
                           <a href="{{ url('/more_details',$Reviewproducts->id )}}" class="latest-product__item">

                               <div class="latest-product__item__pic">
                                    <img style="max-height: 7vw;min-height:7vw;max-width:7vw;min-width:7vw;" src="{{ ('/storage/uploads/') }}{{ $Reviewproducts->image }}" alt="">
                               </div>
                               <div class="latest-product__item__text">
                                <h6>{{ $Reviewproducts->title }}</h6>
                                @if ($Reviewproducts->discount_price !=null)
                                <span><span style="text-decoration-line: line-through;text-decoration-thickness: 2px;"> $ {{ $Reviewproducts->price }}</span>  $ {{ $Reviewproducts->discount_price }}</span>
                                @else
                                    <span> ${{ $Reviewproducts->price }}</span>
                                @endif
                               </div>
                           </a>
                        @endforeach
                       </div>
                       <div class="latest-prdouct__slider__item">
                        @foreach ($Reviewproducts1 as $Reviewproducts1)
                           <a href="{{ url('/more_details',$Reviewproducts1->id )}}" class="latest-product__item">
                               <div class="latest-product__item__pic">
                                    <img style="max-height: 7vw;min-height:7vw;max-width:7vw;min-width:7vw;" src="{{ ('/storage/uploads/') }}{{ $Reviewproducts1->image }}" alt="">
                               </div>
                               <div class="latest-product__item__text">
                                <h6>{{ $Reviewproducts1->title }}</h6>
                                @if ($Reviewproducts1->discount_price !=null)
                                <span><span style="text-decoration-line: line-through;text-decoration-thickness: 2px;"> $ {{ $Reviewproducts1->price }}</span>  $ {{ $Reviewproducts1->discount_price }}</span>
                                @else
                                    <span> ${{ $Reviewproducts1->price }}</span>
                                @endif
                               </div>
                           </a>
                        @endforeach
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </div>
</section>