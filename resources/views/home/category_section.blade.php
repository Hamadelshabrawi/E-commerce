<section class="categories">
    <div class="container">
        <div class="row">
            <div class="categories__slider owl-carousel">
                @foreach ( $Category as $Category )
                {{-- <li data-filter=".{{$Category->category_name}}"><a href="#">{{ $Category->category_name }}</a></li> --}}
                <div class="col-lg-3">
                    <div class="categories__item set-bg" data-setbg=" {{ ('storage/uploads/') }}{{ $Category->image }}">
                        <h5><a href="#">{{ $Category->category_name }}</a></h5>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
</section>