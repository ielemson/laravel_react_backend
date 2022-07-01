  <!-- footer -->
  <footer class="w3l-footer-29-main">
    <div class="footer-29-w3l py-5">
      <div class="container py-lg-5 py-md-3">
        <div class="w3l-footer-texthny-inf text-center">
          <h6 class="foot-sub-title mb-1">LET’S WORK TOGETHER</h6>
          <h4>
            <a href="mailto:seogexample@mail.com" class="mail"
              >Seogexample@mail.com</a
            >
          </h4>
          <div class="main-social-footer-29 mt-4 mb-lg-5 mb-4">
            <a href="#facebook" class="facebook"
              ><span class="fab fa-facebook-f"></span
            ></a>
            <a href="#twitter" class="twitter"
              ><span class="fab fa-twitter"></span
            ></a>
            <a href="#instagram" class="instagram"
              ><span class="fab fa-instagram"></span
            ></a>
            <a href="#linkedin" class="linkedin"
              ><span class="fab fa-linkedin-in"></span
            ></a>
          </div>
        </div>
      </div>
    </div>
    <!-- //footer -->
    <!-- copyright -->
    <section class="w3l-copyright">
      <div class="container">
        <div class="row bottom-copies">
          <p class="col-lg-6 copy-footer-29">
            © <span class="year" id="year"></span> AAERLAW. All rights
            reserved
          </p>
          <div class="col-lg-6 footer-list-29">
            <ul class="d-flex text-lg-right">
              <li>
                <a href="#">Faq</a>
              </li>
              <li class="ml-lg-5 ml-md-4"><a href="/about.html">About</a></li>
              <li class="ml-lg-5 ml-md-4"><a href="#"> Terms & Conditions</a></li>
              <li class="mx-lg-5 mx-md-4">
                <a href="#">Privacy Policy</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section>
    <!-- move top -->
    <button
      onclick="topFunction()"
      id="movetop"
      title="Go to top"
      class="top"
    >
      &#10548;
    </button>
    <script>
      // When the user scrolls down 20px from the top of the document, show the button
      window.onscroll = function () {
        scrollFunction();
      };

      function scrollFunction() {
        if (
          document.body.scrollTop > 20 ||
          document.documentElement.scrollTop > 20
        ) {
          document.getElementById("movetop").style.display = "block";
        } else {
          document.getElementById("movetop").style.display = "none";
        }
      }

      // When the user clicks on the button, scroll to the top of the document
      function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
      }
    </script>
    <!-- /move top -->
  </footer>
  <!--//footer-->