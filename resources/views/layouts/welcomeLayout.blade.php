<!--
Author: W3layouts
Author URL: http://w3layouts.com
-->
<!DOCTYPE html>
<html lang="zxx">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta
      name="keywords"
      content="aaerlaw firm"
    />
    <title>
     Home :: AAERLAW
    </title>
    <link
      href="//fonts.googleapis.com/css2?family=Nunito:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300&display=swap"
      rel="stylesheet"
    />

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{asset('css/style-starter.css')}}" />
  </head>
  <body>
    
    @include('components.header')
    <!--/w3l-banner-content-->
    @yield('content')
    <!-- //testimonials section -->
    <!-- /Thank-section -->
    <!-- <section class="w3l-content-3 py-5"> -->
    <!-- /content-6-section -->
    <!-- <div class="content-3-info py-3">
        <div class="container py-lg-4">
          <div class="welcome-left text-center">
            <h6 class="title-subhny mb-2">Thank you for Watching</h6>
            <h3 class="title-w3l two">
              Purchase the Workplace now and make everything easier
            </h3>

            <a class="btn btn-style btn-primary mt-sm-5 mt-4 mr-2" href="#">
              Purchase Now</a
            >
          </div>
        </div>
      </div>
    </section> -->
    <!-- //Thank-section -->
  @include('components.footer')

    <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('js/theme-change.js')}}"></script>
    <!-- disable body scroll which navbar is in active -->
    <script>
      $(function () {
        $(".navbar-toggler").click(function () {
          $("body").toggleClass("noscroll");
        });
      });
    </script>
    <!-- disable body scroll which navbar is in active -->

    <!--/MENU-JS-->
    <script>
      $(window).on("scroll", function () {
        var scroll = $(window).scrollTop();

        if (scroll >= 80) {
          $("#site-header").addClass("nav-fixed");
        } else {
          $("#site-header").removeClass("nav-fixed");
        }
      });

      //Main navigation Active Class Add Remove
      $(".navbar-toggler").on("click", function () {
        $("header").toggleClass("active");
      });
      $(document).on("ready", function () {
        if ($(window).width() > 991) {
          $("header").removeClass("active");
        }
        $(window).on("resize", function () {
          if ($(window).width() > 991) {
            $("header").removeClass("active");
          }
        });
      });
    </script>
    <!--//MENU-JS-->
    <script>
      //make date year dynamic
      $(document).ready(function () {
        var date = new Date();
        var year = date.getFullYear();
        $("#year").text(year);
      });
    </script>

    <script src="{{asset('js/bootstrap.min.js')}}"></script>
  </body>
</html>
