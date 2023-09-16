<div class="col-lg-3">
    <div style="max-height: 520px;min-height: 520px;overflow: auto;" class="hero__categories">
        <div style="background:red" class="hero__categories__all">
            <i class="fa fa-bars"></i>
            <span>All Category</span>
        </div>
        <ul>
            @foreach ( $Category as $Category )
            <li data-filter=".{{$Category->category_name}}"><a href="#">{{ $Category->category_name }}</a></li>
            @endforeach

        </ul>
    </div>
</div>