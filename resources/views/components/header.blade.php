<!--/header-w3l-->
<div class="header-w3l">
    <!-- header -->
    <header id="site-header" class="fixed-top">
      <div class="container">
        <nav class="navbar navbar-expand-lg stroke">
          <a class="navbar-brand" href="{{url('/')}}">
            SE<span class="fab fa-xbox sub-logo"></span>G
          </a>
          <!-- if logo is image enable this   
          <a class="navbar-brand" href="#index.html">
              <img src="image-path" alt="Your logo" title="Your logo" style="height:35px;" />
          </a> -->
          <button
            class="navbar-toggler collapsed bg-gradient"
            type="button"
            data-toggle="collapse"
            data-target="#navbarTogglerDemo02"
            aria-controls="navbarTogglerDemo02"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon fa icon-expand fa-bars"></span>
            <span class="navbar-toggler-icon fa icon-close fa-times"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav ml-lg-auto">
              <li class="nav-item  {{ (request()->is('/')) ? 'active' : '' }}">
                <a class="nav-link" href="{{url('/')}}">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Features</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Price</a>
              </li>

              <li class="nav-item {{ (request()->is('login')) ? 'active' : '' }}">
                <a class="nav-link" href="{{route('login')}}">Login</a>
              </li>
              <li class="nav-item {{ (request()->is('/register')) ? 'active' : '' }}">
                <a class="btn btn-style" href="{{route('register')}}">Register</a>
              </li>
              <li class="search-bar ml-lg-3 mr-lg-5 mt-lg-0 mt-4"></li>
            </ul>
          </div>
          <!-- toggle switch for light and dark theme -->
          <div class="mobile-position">
            <nav class="navigation">
              <div class="theme-switch-wrapper">
                <label class="theme-switch" for="checkbox">
                  <input type="checkbox" id="checkbox" />
                  <div class="mode-container">
                    <i class="gg-sun"></i>
                    <i class="gg-moon"></i>
                  </div>
                </label>
              </div>
            </nav>
          </div>
          <!-- //toggle switch for light and dark theme -->
        </nav>
      </div>
    </header>
    <!-- //header -->
  </div>
  <!--//header-w3l-->