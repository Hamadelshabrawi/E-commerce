@auth

<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
      <a class="sidebar-brand brand-logo" href="{{ url('/') }}"><img src="/home/images/logo.png" alt="logo" /></a>
      <a class="sidebar-brand brand-logo-mini" href="index.html"><img src="/admin/assets/images/logo-mini.svg" alt="logo" /></a>
    </div>
    <ul class="nav">
      <li class="nav-item profile">
        <div class="profile-desc">
          <div class="profile-pic">
            <div class="count-indicator">
              <img class="img-xs rounded-circle " src="{{Auth::user()->profile_photo_url}}" alt="">
              <span class="count bg-success"></span>
            </div>

            <div class="profile-name">
              <h5 class="mb-0 font-weight-normal">{{ Auth::user()->name; }}</h5>
              <span>Admin</span>
            </div>
          </div>

          <a href="#" id="profile-dropdown" data-toggle="dropdown"></a>

        </div>
      </li>


      <li class="nav-item nav-category">
        <span class="nav-link">Navigation</span>
      </li>

      <li class="nav-item menu-items">
        <a class="nav-link" href="{{ url('redirect') }}">
          <span class="menu-icon">
            <i class="mdi mdi-chart-bar"></i>
          </span>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>

      <li class="nav-item menu-items">
        <a class="nav-link" href="{{ url('/') }}">
          <span class="menu-icon">
            <i class="mdi mdi-speedometer"></i>
          </span>
          <span class="menu-title">Home Page</span>
        </a>
      </li>

      {{-- show product Data --}}
      {{-- <li class="nav-item menu-items">
        <a class="nav-link" href="{{ url('view_product') }}">
          <span class="menu-icon">
            <i class="mdi mdi-playlist-play"></i>
          </span>
          <span class="menu-title">Add Product</span>
        </a>
      </li> --}}

      <li class="nav-item menu-items">
        <a class="nav-link" href="{{ url('show_product') }}">
          <span class="menu-icon">
            <i class="mdi mdi-playlist-play"></i>
          </span>
          <span class="menu-title">Show Product</span>
        </a>
      </li>





      {{-- show order Data --}}
      <li class="nav-item menu-items">
        <a class="nav-link"  href="{{ url('show_order') }}" aria-expanded="false" aria-controls="ui-basic">
          <span class="menu-icon">
            <i class="mdi mdi-laptop"></i>
          </span>
          <span class="menu-title">Order</span>
        </a>
        <div class="collapse" id="ui-basic">
          <ul class="nav flex-column sub-menu">
            {{-- <li class="nav-item"> <a class="nav-link" href="{{ url('show_order') }}">Show Orders</a></li> --}}
          </ul>
        </div>
      </li>

      {{-- show invoice Data --}}


      <li class="nav-item menu-items">
        <a class="nav-link"  href="{{ url('show_invoice') }}" aria-expanded="false" aria-controls="auth">
          <span class="menu-icon">
            <i class="mdi mdi-security"></i>
          </span>
          <span class="menu-title">Invoice</span>
        </a>
      </li>

      <li class="nav-item menu-items">
        <a class="nav-link"  href="{{ url('show_users') }}"" aria-expanded="false" aria-controls="auth">
          <span class="menu-icon">
            <i class="mdi mdi-security"></i>
          </span>
          <span class="menu-title">Users</span>
          <i class="menu-"></i>
        </a>
      </li>


      <li class="nav-item menu-items">
        <a class="nav-link" href="{{ url('view_category') }}">
          <span class="menu-icon">
            <i class="mdi mdi-playlist-play"></i>
          </span>
          <span class="menu-title">Category</span>
        </a>
      </li>

      <li class="nav-item menu-items">
        <a class="nav-link" href="{{ url('show_refund') }}">
          <span class="menu-icon">
            <i class="mdi mdi-playlist-play"></i>
          </span>
          <span class="menu-title">Refund</span>
        </a>
      </li>

      <li class="nav-item menu-items">
        <a class="nav-link" href="{{ url('Show_subscribes') }}">
          <span class="menu-icon">
            <i class="mdi mdi-playlist-play"></i>
          </span>
          <span class="menu-title">Subscribes</span>
        </a>
      </li>

    </ul>
  </nav>
  @endauth
