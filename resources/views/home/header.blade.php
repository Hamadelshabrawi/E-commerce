 <header class="header">
   <div class="container">
      @if (session()->has('message'))
      <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"> X </button>
        {{ session()->get('message') }}
      </div>
    @endif
       <div class="row">
           <div class="col-lg-3">
               <div class="header__logo">
                   <a href="{{ url('/') }}"><img src="ogani-master/img/logo.png" alt=""></a>
               </div>
           </div>
           <div class="col-lg-6">
               <nav class="header__menu">
                   <ul >
                       <li class="active"><a href="{{ url('/') }}">Home</a></li>
                       <li><a href="{{ url('products_page') }}">Shop</a></li>
                       <li><a href="#">Pages</a>
                           <ul class="header__menu__dropdown">
                               <li><a href="./shop-details.html">Shop Details</a></li>
                               <li><a href="./shoping-cart.html">Shoping Cart</a></li>
                               <li><a href="./checkout.html">Check Out</a></li>
                               <li><a href="./blog-details.html">Blog Details</a></li>
                           </ul>
                       </li>
                       <li><a href="./blog.html">Blog</a></li>
                       @if ( Auth::user())
                       <li><a href="{{ url('showcart')}}">My Cart <span class="badge bg-secondary">{{ $countcart }}</span> </a></li>
                       @endif
                     </li>
                   </ul>
               </nav>
           </div>
           <div class="col-lg-3" style="margin-top:-10px">
               <div class="header__cart">
               @if (Route::has('login'))
               @auth
                    <x-app-layout>
                    </x-app-layout>
               @else
                   <ul>
                       <li><a href="{{ route('login') }}" style="background-color: red;width:80px" class="btn btn-primary">Login</a></li>
                       <li><a style="background-color: #b0b435;width:80px;color:white" class="btn btn-light" href="{{ route('register') }}">Register</a></li>
                   </ul>
               @endauth
               @endif
               </div>

           </div>
       </div>
       <div class="humberger__open">
           <i class="fa fa-bars"></i>
       </div>
   </div>
</header>