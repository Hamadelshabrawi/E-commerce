<!-- Site Icons -->
{{-- <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon"> --}}
<link rel="apple-touch-icon" href="images/apple-touch-icon.png">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="pcss/bootstrap.min.css">
<!-- Site CSS -->
<link rel="stylesheet" href="pcss/style.css">
<!-- Responsive CSS -->
<link rel="stylesheet" href="pcss/responsive.css">
<!-- Custom CSS -->
<link rel="stylesheet" href="pcss/custom.css">

<div class="products-box">
    <div class="container">
        {{-- <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Featured Product</h2>
                </div>
                <div class="featured__controls">
                    <ul>
                        <li class="active" data-filter="*">All</li>
                        @foreach ( $Category as $Category )
                        <li data-filter=".{{$Category->category_name}}">{{ $Category->category_name }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div> --}}

        <div class="row special-list">

            @foreach ($products as $productss)
            @if($productss->quantity < 1)
            <div class="col-lg-3 col-md-6 special-grid top-featured {{$productss->category}}">
                <div class="products-single fix">
                    <div class="box-img-hover">
                        <div class="type-lb">
                            <p class="sale" style="background: none">Out Of Stock</p>
                        </div>
                        <img style="max-height: 20vw;min-height: 20vw;max-width:20vw;min-width: 20vw;" src="/storage/uploads/{{ $productss->image }}" class="img-fluid" alt="Image">
                    </div>
                    <div class="why-text">
                        <h4><a style="line-height: 1.5em;height: 3em;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;width: 100%;" href="{{ url('/more_details',$productss->id )}}">{{ $productss->title }}</a></h4>
                        <h4 style="font-size:10px">SKU : {{ $productss->Sku }}</h4>

                        @if ($productss->discount_price !=null)
                            <h5 style=""> $ {{ $productss->discount_price }}</h5> <h5 style="background-color:#F7444E;margin-left:46%;text-decoration-line: line-through;text-decoration-thickness: 2px;"> $ {{ $productss->price }}</h5> 
                        @else
                            <h5> ${{ $productss->price }}</h5>
                        @endif
                    </div>
                </div>
            </div>
            @else
            <div class="col-lg-3 col-md-6 special-grid top-featured {{$productss->category}}">
                <div class="products-single fix">
                    <div class="box-img-hover">
                        <div class="type-lb">
                            @if ($productss->discount_price !=null)
                            <p class="sale" style="background-color: rgb(150, 19, 19)">Sale</p>
                            @else
                            <p class="sale ">New</p>
                            @endif
                        </div>
                        <img style="max-height: 20vw;min-height: 20vw;max-width:20vw;min-width: 20vw;" src="/storage/uploads/{{ $productss->image }}" class="img-fluid" alt="Image">
                        <div class="mask-icon">
                            <form action="{{ url('Quick_add_cart',$productss->id)}}" method="post">
                                @csrf
                                <a class="cart"><button>Add to Cart</button></a>
                                {{-- <input class="cart" type="submit" value="Add to Cart" > --}}
                            </form>
                        </div>
                    </div>
                    <div class="why-text">
                        <h4><a style="line-height: 1.5em;height: 3em;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;width: 100%;" href="{{ url('/more_details',$productss->id )}}">{{ $productss->title }}</a></h4>
                        <h4 style="font-size:10px">SKU : {{ $productss->Sku }}</h4>

                        @if ($productss->discount_price !=null)
                            <h5 style=""> $ {{ $productss->discount_price }}</h5> <h5 style="background-color:#F7444E;margin-left:46%;text-decoration-line: line-through;text-decoration-thickness: 2px;"> $ {{ $productss->price }}</h5> 
                        @else
                            <h5> ${{ $productss->price }}</h5>
                        @endif
                    </div>
                </div>
            </div>
            @endif
            @endforeach

        </div>
    </div>
</div>

<!-- ALL JS FILES -->
<script src="pjs/jquery-3.2.1.min.js"></script>
<script src="pjs/popper.min.js"></script>
<script src="pjs/bootstrap.min.js"></script>
<!-- ALL PLUGINS -->
<script src="pjs/jquery.superslides.min.js"></script>
<script src="pjs/bootstrap-select.js"></script>
<script src="pjs/inewsticker.js"></script>
<script src="pjs/bootsnav.js."></script>
<script src="pjs/images-loded.min.js"></script>
<script src="pjs/isotope.min.js"></script>
<script src="pjs/owl.carousel.min.js"></script>
<script src="pjs/baguetteBox.min.js"></script>
<script src="pjs/form-validator.min.js"></script>
<script src="pjs/contact-form-script.js"></script>
<script src="pjs/custom.js"></script>