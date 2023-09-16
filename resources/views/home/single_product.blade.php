<!DOCTYPE html>
<html lang="en">

<head>    
    <base href="/public">

    <meta charset="utf-8">
    <title>Hamad E-Commerce</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    @include('home.css')
        <!-- Google Font -->
        {{-- <link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet"> --}}
        {{-- <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"> --}}
    
        <!-- Css Styles -->
        {{-- <link rel="stylesheet" href="{{ asset('ashion-master/css/bootstrap.min.css') }}" type="text/css"> --}}
        <link rel="stylesheet" href="{{ asset('ashion-master/css/font-awesome.min.css') }}" type="text/css">
        <link rel="stylesheet" href="{{ asset('ashion-master/css/elegant-icons.css') }}" type="text/css">
        <link rel="stylesheet" href="{{ asset('ashion-master/css/jquery-ui.min.cs') }}s" type="text/css">
        <link rel="stylesheet" href="{{ asset('ashion-master/css/magnific-popup.css') }}" type="text/css">
        <link rel="stylesheet" href="{{ asset('ashion-master/css/owl.carousel.min.css') }}" type="text/css">
        <link rel="stylesheet" href="{{ asset('ashion-master/css/slicknav.min.css') }}" type="text/css">
        <link rel="stylesheet" href="{{ asset('ashion-master/css/style.css') }}" type="text/css">
        <style>

            .example img {
                max-height: 41vw;
                min-height: 41vw;
                max-width:29vw;
                min-width: 29vw;
            }
        </style>
</head>

<body>


@include('home.header')
@include('sweetalert::alert')


<section class="product-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="product__details__pic">
                    <div class="product__details__pic__left product__thumb nice-scroll">
                            @php $count = 0 @endphp
                            @foreach ( $productImage as $productImage)
                            <a class="pt active" href="/storage/uploads/{{ $productImage->imageName }}">
                                <img src="/storage/uploads/{{ $productImage->imageName }}" alt="">
                            </a>
                            @endforeach
                    </div>
                    <div class="product__details__slider__content">
                        {{-- <div style=" height: 300px; width: 400px; overflow: hidden;" class="product__details__pic__slider owl-carousel"> --}}
                        <div class="product__details__pic__slider owl-carousel example example-cover">

                            @php $count = 0; @endphp
                            @foreach ($productImagee as $productImagee)
                            {{-- <img style=" height: 400%; width: 400px;" data-hash="product-{{ $count++ }}" class="product__big__img" src="/storage/uploads/{{ $productImagee->imageName }}" alt=""> --}}
                            <img style=" height: 400%; width: 400px;" data-hash="product-{{ $count++ }}" class="product__big__img" src="/storage/uploads/{{ $productImagee->imageName }}" alt="">

                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="product__details__text">
                    <h3>{{ $products->title }}</h3><br>
                    {{-- <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <span>( 138 reviews )</span>
                    </div> --}}
                    @if ($products->discount_price !== null)
                    <div class="product__details__price">$ {{ $products->discount_price }} <span>$ {{ $products->price }} </span></div>
                    @else
                    <div  class="product__details__price">$ {{ $products->price }}.00<span></span></div>
                    @endif

                    <form action="{{ url('add_cart',$products->id) }}" method="post">
                        @csrf
                    <div class="product__details__button">
                        <div class="quantity">
                            @if ($products->quantity >= 1 && $products->quantity !== 0 )
                            <span>Quantity:</span>
                            <div class="pro-qty">
                                <input type="text" min="10" value="1" max="{{ $products->quantity }}" name="cartQty">
                            </div>
                            @endif
                        </div>
                        @if ($products->quantity >= 1 && $products->quantity !== 0 )
                        <input class="cart-btn" type="submit" value="Add to cart" name="" id="">
                        {{-- <a href="#" class="cart-btn"><span class="icon_bag_alt"></span> </a> --}}
                    @endif
                </form>
                        <ul> 
                            @auth
                            @if(  $result  != 1 )
                            <li><a  href="{{ url('makeLike',$products->id) }}"><span style="color:rgb(194, 173, 198)" class="icon_heart_alt"></span></a></li>
                            {{-- <li><a href="#"><span class="icon_adjust-horiz"></span></a></li> --}}
                            @else
                            <li><a style="background-color:rgb(32, 22, 178)" href="{{ url('makeLike',$products->id) }}"><span style="color:rgb(181, 181, 166)" class="icon_heart_alt"></span></a></li>
                            @endif
                            @endauth
                        </ul>
                    </div>
                    <div class="product__details__widget">
                        <ul>
                            <li>
                                <span>Availability:</span>
                                @if ($products->quantity > 10)
                                <div class="stock__checkbox">
                                    <label for="stockin">
                                        In Stock
                                        <input type="checkbox" id="stockin">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                @elseif($products->quantity > 1)
                                <div class="stock__checkbox">
                                    <label for="stockin">
                                        Limited Stock
                                        <input type="checkbox" id="stockin">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                @else
                                <div class="stock__checkbox">
                                    <label for="stockin">
                                        Out Of Stock
                                        <input type="checkbox" id="stockin">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                @endif
                            </li>
                            <li>
                                <span>Sku:</span>
                                <p>{{ $products->Sku }}</p>
                            </li>
                            <li>
                                <span>Available color:</span>
                                <div class="color__checkbox">
                                    <label for="red">
                                        <input type="radio" name="color__radio" id="red" checked>
                                        <span class="checkmark"></span>
                                    </label>
                                    <label for="black">
                                        <input type="radio" name="color__radio" id="black">
                                        <span class="checkmark black-bg"></span>
                                    </label>
                                    <label for="grey">
                                        <input type="radio" name="color__radio" id="grey">
                                        <span class="checkmark grey-bg"></span>
                                    </label>
                                </div>
                            </li>
                            <li>
                                <span>Available size:</span>
                                <div class="size__btn">
                                    <label for="xs-btn" class="active">
                                        <input type="radio" id="xs-btn">
                                        xs
                                    </label>
                                    <label for="s-btn">
                                        <input type="radio" id="s-btn">
                                        s
                                    </label>
                                    <label for="m-btn">
                                        <input type="radio" id="m-btn">
                                        m
                                    </label>
                                    <label for="l-btn">
                                        <input type="radio" id="l-btn">
                                        l
                                    </label>
                                </div>
                            </li>
                            <li>
                                <span>Promotions:</span>
                                <p>Free shipping</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="product__details__tab">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item" style="margin-right: 46px;">
                            <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Description</a>
                        </li>
                        <li class="nav-item" style="margin-right: 46px;">
                            <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Specification</a>
                        </li>
                        <li class="nav-item" style="margin-right: 46px;">
                            <a  class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">Reviews ( {{ $countcomment }} )</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                            <h6>Description</h6>
                            <p>{{ $products->description }}</p>
                        </div>
                        <div class="tab-pane" id="tabs-2" role="tabpanel">
                            <h6>Specification</h6>
                            <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut loret fugit, sed
                                quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt loret.
                                Neque porro lorem quisquam est, qui dolorem ipsum quia dolor si. Nemo enim ipsam
                                voluptatem quia voluptas sit aspernatur aut odit aut loret fugit, sed quia ipsu
                                consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Nulla
                            consequat massa quis enim.</p>
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget
                                dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes,
                                nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium
                            quis, sem.</p>
                        </div>
                        <div class="tab-pane" id="tabs-3" role="tabpanel">
                            <h3>Reviews</h3><br>
                            @foreach ($comment as $comment)
                            <div style="border:1px solid rgb(211, 206, 206);padding:8px"> <div style="font-weight: 700;"> {{ $comment->user_name }}</div>{{ $comment->created_at }}<p><br> " {{ $comment->comment }} "</p>  <br>
                            @auth
                            @if(Auth::user()->id == $comment->user_id)
                            <button  type="button" ><a href="" class="btn btn-success">Edit</a></button> 

                            {{-- <form action="{{ url('delete_comment',$comment->id) }}" method="post">
                                @csrf
                                <button class="btn btn-danger">Delete</button>
                            </form>   --}}
                            <div class="form" style="float: left;padding:0px 10px  0px">
                                <form method="POST" action="{{ url('delete_comment',$comment->id) }}">
                                  @csrf
                                    <button class="btn btn-danger">Delete</button>
                                </form>
                                

                            @endif   
                            @endauth
                            </div><br>
                            @endforeach

                        @auth
                            @if ($checkPreviusProductOrder !== 0)
                                @if ( $commentDisable == 0 )
                                    <form method="post" action="{{ url('commentmessage',$products->id) }}">
                                        @csrf
                                        <div class="card-footer py-3 border-0" style="background-color: #f8f9fa; width:40%">
                                            <div class="d-flex flex-start w-100">
                                                <div class="form-outline w-100">
                                                    <input class="form-control" name="commentMessage" id="textAreaExample" rows="4"
                                                    style="background: #fff;">
                                                    <label class="form-label" for="textAreaExample">Message</label>
                                                </div>
                                            </div>
                                            <div class="float-end mt-2 pt-1">
                                            </div>
                                        </div>
                                    </form>
                                @endif
                            @endif
                        @endauth

                    </div>
                </div>
            </div>

            
        </div>
    </div>
</section>


    <!-- Js Plugins -->
    <script src="{{ asset('ashion-master/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('ashion-master/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('ashion-master/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('ashion-master/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('ashion-master/js/mixitup.min.js') }}"></script>
    <script src="{{ asset('ashion-master/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('ashion-master/js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('ashion-master/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('ashion-master/js/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('ashion-master/js/main.js') }}"></script>

</body>

</html>