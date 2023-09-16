<!DOCTYPE html>
<html lang="zxx">

<head>
@include('home.css')
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Humberger Begin -->
    
    <!-- Humberger End -->

    <!-- Header Section Begin -->
@include('home.header')
@include('sweetalert::alert')

    <!-- Header Section End -->

    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="container">
            <div class="row">
@include('home.category')
@include('home.search')
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Categories Section Begin -->
@include('home.category_section')
    <!-- Categories Section End -->

    <!-- Featured Section Begin -->
    
@include('home.product')
    <!-- Featured Section End -->

    <!-- Banner Begin -->
    {{-- <div class="banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="ogani-master/img/banner/banner-1.jpg" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="ogani-master/img/banner/banner-2.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Banner End -->

    <!-- featured product Section Begin -->

@include('home.featured_product')


    <!-- featured product Section End -->

    <!-- Blog Section Begin -->
    <section class="from-blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title from-blog__title">
                        <h2>From The Blog</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="ogani-master/img/blog/blog-1.jpg" alt="">
                        </div>
                        <div class="blog__item__text">
                            <ul>
                                <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                                <li><i class="fa fa-comment-o"></i> 5</li>
                            </ul>
                            <h5><a href="#">Cooking tips make cooking simple</a></h5>
                            <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="ogani-master/img/blog/blog-2.jpg" alt="">
                        </div>
                        <div class="blog__item__text">
                            <ul>
                                <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                                <li><i class="fa fa-comment-o"></i> 5</li>
                            </ul>
                            <h5><a href="#">6 ways to prepare breakfast for 30</a></h5>
                            <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="ogani-master/img/blog/blog-3.jpg" alt="">
                        </div>
                        <div class="blog__item__text">
                            <ul>
                                <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                                <li><i class="fa fa-comment-o"></i> 5</li>
                            </ul>
                            <h5><a href="#">Visit the clean farm in the US</a></h5>
                            <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Section End -->

    <!-- Footer Section Begin -->
@include('home.footer')
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="{{ asset('ogani-master/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('ogani-master/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('ogani-master/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('ogani-master/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('ogani-master/js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('ogani-master/js/mixitup.min.js') }}"></script>
    <script src="{{ asset('ogani-master/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('ogani-master/js/main.js') }}"></script>



</body>

</html>