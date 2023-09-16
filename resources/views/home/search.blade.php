<meta name="csrf-token" content="{{ csrf_token() }}">
 
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
 var siteUrl = "{{url('/')}}";
</script>

{{-- <form action="{{ url('produc_search') }}" method="get">
    @csrf
    <div class="row mt-5">
       <div class="col-md-5 mx-auto">
          <div class="input-group">
             <input class="form-control border rounded-pill" type="search" id="name" name="searchText" placeholder="Search" id="example-search-input">
          </div>
       </div>
 </div>

 </form> --}}

 <div class="col-lg-9">
   <div class="hero__search">
       <div class="hero__search__form">
           <form action="{{ url('produc_search') }}" method="get">
            @csrf
               <input type="search" id="name" name="searchText" placeholder="Search">
               <button style="background-color:red" type="submit" class="site-btn">SEARCH</button>
           </form>
       </div>
       <div class="hero__search__phone">
           <div class="hero__search__phone__icon">
               <i style="color:red" class="fa fa-phone"></i>
           </div>
           <div class="hero__search__phone__text">
               <h5>+201063933334</h5>
               <span>support 24/7 time</span>
           </div>
       </div>
   </div>
   <div class="hero__item set-bg" data-setbg="ogani-master/img/hero/banner.jpg">
       <div class="hero__text">
           <span>FRUIT FRESH</span>
           <h2>Vegetable <br />100% Organic</h2>
           <p>Free Pickup and Delivery Available</p>
           <a style="background-color:red" href="#" class="primary-btn">SHOP NOW</a>
       </div>
   </div>
</div>


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