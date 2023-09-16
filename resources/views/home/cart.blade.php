<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script><style>
   @import url('https://fonts.googleapis.com/css?family=Open+Sans&display=swap');body{background-color: #eeeeee;font-family: 'Open Sans',serif;font-size: 14px}.container-fluid{margin-top:70px}.card-body{-ms-flex: 1 1 auto;flex: 1 1 auto;padding: 1.40rem}.img-sm{width: 80px;height: 80px}.itemside .info{padding-left: 15px;padding-right: 7px}.table-shopping-cart .price-wrap{line-height: 1.2}.table-shopping-cart .price{font-weight: bold;margin-right: 5px;display: block}.text-muted{color: #969696 !important}a{text-decoration: none !important}.card{position: relative;display: -ms-flexbox;display: flex;-ms-flex-direction: column;flex-direction: column;min-width: 0;word-wrap: break-word;background-color: #fff;background-clip: border-box;border: 1px solid rgba(0,0,0,.125);border-radius: 0px}.itemside{position: relative;display: -webkit-box;display: -ms-flexbox;display: flex;width: 100%}.dlist-align{display: -webkit-box;display: -ms-flexbox;display: flex}[class*="dlist-"]{margin-bottom: 5px}.coupon{border-radius: 1px}.price{font-weight: 600;color: #212529}.btn.btn-out{outline: 1px solid #fff;outline-offset: -5px}.btn-main{border-radius: 2px;text-transform: capitalize;font-size: 15px;padding: 10px 19px;cursor: pointer;color: #fff;width: 100%}.btn-light{color: #ffffff;background-color: #F44336;border-color: #f8f9fa;font-size: 12px}.btn-light:hover{color: #ffffff;background-color: #F44336;border-color: #F44336}.btn-apply{font-size: 11px}
           /* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}

</style>
<head>
    @include('home.css')

    @include('sweetalert::alert')
    
   <title>Cart - Checkout</title>
</head>
{{-- <base href="/public"> --}}
@include('home.header')
<div class="container-fluid">
        <div class="row">
            <aside class="col-lg-9">
                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-borderless table-shopping-cart" >
                            <thead class="text-muted">
                                <tr class="small text-uppercase">
                                    <th scope="col">Image</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Sku</th>
                                    <th scope="col" width="120">Quantity</th>
                                    <th scope="col" width="120">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                    @foreach ($cart as $cartt)
                                        
                                <tr>
                                    <td >
                                        <figure style="" class="itemside align-items-center">
                                            <div class="aside"><img src="/storage/uploads/{{$cartt->image}}" class="img-sm"></div>
                                        </figure>
                                    </td>
                                    <td >
                                            <div class="info"> <a href="{{ url('/more_details') }}/{{ $cartt->productId }}" class="title text-dark" data-abc="true">{{ $cartt->product_title }}</a>
                                                {{-- <p class="text-muted small">SIZE: L <br> Brand: MAXTRA</p> --}}
                                            </div>
                                    </td>
                                    <td >
                                        <div class="info"> <a href="#" class="title text-dark" data-abc="true">{{ $cartt->Sku }}</a>
                                        </div>
                                </td>
                                <form action="{{ url('add_cart',$cartt->productId ) }}" method="post" >

                                    <td style="padding-left: 0px;"> 

                                        <div style="" class=" d-flex">

  
                                                @csrf

                                            <input style="width:80px" min="0" name="cartQty"  value="{{ $cartt->quantity }}" type="number" class="form-control form-control-sm" />
                                        

                                        </div>
                                    </td>
                                </form>

                                    <td>
                                        @if (!empty($cartt->discount))

                                        <div class="price-wrap"> <var class="price">$ {{ $cartt->price }} X {{ $cartt->quantity }}</var>Total: <small style="text-decoration-line: line-through;text-decoration-thickness: 1.5px;" class="text-muted"> ${{ $cartt->price_muliply_qty }} </small> &nbsp; <small class="text-muted"> ${{ $cartt->totalPrice }} </small> </div>
                                        @else
                                        <div class="price-wrap"> <var class="price">$ {{ $cartt->price }} X {{ $cartt->quantity }}</var>Total:  <small class="text-muted"> ${{ $cartt->price_muliply_qty }} </small> </div>

                                        @endif
                                    </td>
                        
                                    <td class="text-right d-none d-md-block">
                                        <form action="{{ url('remove_cart_product',$cartt->id) }}" method="post">
                                            @csrf
                                            {{-- <input onclick="confirmation(event)" type="submit" value="Remove" > --}}
                                            <button><i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </aside>
            <aside class="col-lg-3">
                <div class="card mb-3">
                    <div class="card-body">
                        <form>
                            <div class="form-group"> <label>Have coupon?</label>
                                <div class="input-group"> <input type="text" class="form-control coupon" name="" placeholder="Coupon code"> <span class="input-group-append"> <button class="btn btn-primary btn-apply coupon">Apply</button> </span> </div>
                            </div>
                        </form>
                    </div>
                </div>
                    
                <div class="card">
                    <div class="card-body">
                        <dl class="dlist-align">

                                
                            <dt>Total price:</dt>

                            <dd  class="text-right ml-3">   ${{ $price }}  </dd>

                        </dl>
                        <dl class="dlist-align">
                            <dt>Discount:</dt>
                            @if ($difference > 5)
                            <dd class="text-right text-danger ml-3">- ${{ $difference }}</dd>

                            @endif
                        </dl>
                        <dl class="dlist-align">
                            <dt>Total:</dt>
                            <dd class="text-right text-dark b ml-3"><strong>${{ $totalDiscount }}</strong></dd>
                        </dl>
                        <hr>@if ($totalDiscount > 20)
                            
                         <a href="{{ url('cash_order',Auth::user()->id) }}" onclick="confirmaorder(event)" class="btn btn-out btn-primary btn-square btn-main" data-abc="true"> Make Order - Cash on delivery </a> <a style="margin-top:10px" href="{{ url('stripe',$totalDiscount) }}" class="btn btn-out btn-primary btn-square btn-main" data-abc="true">Make Order - Card Payment </a> @endif <a href="{{ url('/') }}" class="btn btn-out btn-success btn-square btn-main mt-2" data-abc="true">Continue Shopping</a>
                    </div>
                </div>

            </aside>
        </div>
    </div>

<script>
    function confirmation(ev) {
        ev.preventDefault();
        var urlToRedirect = ev.currentTarget.getAttribute('href');  
        console.log(urlToRedirect); 
        swal({
            title: "Are you sure to cancel this product",
            text: "You will not be able to revert this!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willCancel) => {
            if (willCancel) {
                window.location.href = urlToRedirect;
            }  
        });
    }

    function confirmaorder(ev) {
        ev.preventDefault();
        var urlToRedirect = ev.currentTarget.getAttribute('href');  
        console.log(urlToRedirect); 
        swal({
            title: "Are you sure you want to place order",
            text: "you will place order 'cash on delivery' ",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willCancel) => {
            if (willCancel) {
                window.location.href = urlToRedirect;
            }  
        });
    }
</script> 