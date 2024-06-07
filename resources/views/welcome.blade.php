<x-app-layout>
    @vite(['resources/css/style.css','resources/css/responsive.css','resources/css/bootstrap.css',])
<style>a:hover{
    text-decoration: none;color:black;
}
a{
    color: black;
}
</style>
<!-- end header section -->
    <!-- slider section -->
<div class="hero_area">
    <div class="bg-box">
        <img src="{{Vite::asset('/resources/images/hero-bg.jpg')}}" alt="">
    </div>
    <section class="slider_section ">
        <div id="customCarousel1" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <div class="container ">
                <div class="row">
                  <div class="col-md-7 col-lg-6 ">
                    <div class="detail-box">
                      <h1>
                        Dual Game
                      </h1>
                      <p>
                        Doloremque, itaque aperiam facilis rerum, commodi, temporibus sapiente ad mollitia laborum quam quisquam esse error unde. Tempora ex doloremque, labore, sunt repellat dolore, iste magni quos nihil ducimus libero ipsam.
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="carousel-item ">
              <div class="container ">
                <div class="row">
                  <div class="col-md-7 col-lg-6 ">
                    <div class="detail-box">
                      <h1>
                        Hire player
                      </h1>
                      <p>
                        Doloremque, itaque aperiam facilis rerum, commodi, temporibus sapiente ad mollitia laborum quam quisquam esse error unde. Tempora ex doloremque, labore, sunt repellat dolore, iste magni quos nihil ducimus libero ipsam.
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="carousel-item">
              <div class="container ">
                <div class="row">
                  <div class="col-md-7 col-lg-6 ">
                    <div class="detail-box">
                      <h1>
                        Best skill
                      </h1>
                      <p>
                        Doloremque, itaque aperiam facilis rerum, commodi, temporibus sapiente ad mollitia laborum quam quisquam esse error unde. Tempora ex doloremque, labore, sunt repellat dolore, iste magni quos nihil ducimus libero ipsam.
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="container">
            <ol class="carousel-indicators">
              <li data-target="#customCarousel1" data-slide-to="0" class="active"></li>
              <li data-target="#customCarousel1" data-slide-to="1"></li>
              <li data-target="#customCarousel1" data-slide-to="2"></li>
            </ol>
          </div>
        </div>

      </section>
      <!-- end slider section -->
</div>

    <!-- Search section -->
    <div class="container">
        @include("home.search")
        <div class="search "></div>
    </div>

    <!-- end search section -->

    <!-- food section -->

    <section class="food_section layout_padding-bottom">
      <div class="container">
        <div class="heading_container heading_center m-5">
          <h2>
              Vip player
            </h2>
        </div>

        <ul class="filters_menu">
          <li class="active" data-filter="*">All</li>
          <li data-filter=".burger">LoL</li>
          <li data-filter=".pizza">Cod</li>
          <li data-filter=".pasta">Pugb</li>
          <li data-filter=".fries">WZ</li>
        </ul>

        <div class="filters-content">
          <div class="row grid">
          @foreach ($vip_user as $player)
          <a class="col-sm-4 col-lg-3 hover:none all pizza" href='/user/{{$player->id}}'>
            <div class="">
              <div class="box">
                <div>
                  <div class="">
                    <img src="{{$player->avatar}}" alt="">
                  </div>
                  <div class="detail-box">
                    <h5>
                      {{$player->name}}
                    </h5>
                    <div class="options">
                      <h6>
                        ${{$player->price}}/h
                      </h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </a>
          @endforeach
          </div>
        </div>
      </div>
    </section>

    <section class="food_section layout_padding-bottom">
      <div class="container">
        <div class="heading_container heading_center m-5">
          <h2>
              Hot player
          </h2>
        </div>

        <div class="filters-content">
          <div class="row grid">
          @foreach ($hot_user as $player)
          <a class="col-sm-4 col-lg-3 hover:none all pizza" href='/user/{{$player->id}}'>
            <div class="">
              <div class="box">
                <div>
                  <div class="">
                    <img src="{{$player->avatar}}" alt="">
                  </div>
                  <div class="detail-box">
                    <h5>
                      {{$player->name}}
                    </h5>
                    <div class="options">
                      <h6>
                        ${{$player->price}}/h
                      </h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </a>
          @endforeach
          </div>
        </div>
      </div>
    </section>

    <!-- footer section -->
    <footer class="footer_section">
      <div class="container">
        <div class="row">
          <div class="col-md-4 footer-col">
            <div class="footer_contact">
              <h4>
                Contact Us
              </h4>
              <div class="contact_link_box">
                <a href="">
                  <i class="fa fa-map-marker" aria-hidden="true"></i>
                  <span>
                    Location
                  </span>
                </a>
                <a href="">
                  <i class="fa fa-phone" aria-hidden="true"></i>
                  <span>
                    Call +01 1234567890
                  </span>
                </a>
                <a href="">
                  <i class="fa fa-envelope" aria-hidden="true"></i>
                  <span>
                    demo@gmail.com
                  </span>
                </a>
              </div>
            </div>
          </div>
          <div class="col-md-4 footer-col">
            <div class="footer_detail">
              <a href="" class="footer-logo">
                Feane
              </a>
              <p>
                Necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with
              </p>
              <div class="footer_social">
                <a href="">
                  <i class="fa fa-facebook" aria-hidden="true"></i>
                </a>
                <a href="">
                  <i class="fa fa-twitter" aria-hidden="true"></i>
                </a>
                <a href="">
                  <i class="fa fa-linkedin" aria-hidden="true"></i>
                </a>
                <a href="">
                  <i class="fa fa-instagram" aria-hidden="true"></i>
                </a>
                <a href="">
                  <i class="fa fa-pinterest" aria-hidden="true"></i>
                </a>
              </div>
            </div>
          </div>
          <div class="col-md-4 footer-col">
            <h4>
              Opening Hours
            </h4>
            <p>
              Everyday
            </p>
            <p>
              10.00 Am -10.00 Pm
            </p>
          </div>
        </div>
        <div class="footer-info">
          <p>
            &copy; <span id="displayYear"></span> All Rights Reserved By
            <a href="https://html.design/">Free Html Templates</a><br><br>
            &copy; <span id="displayYear"></span> Distributed By
            {{-- <a href="https://themewagon.com/" target="_blank">ThemeWagon</a> --}}
          </p>
        </div>
      </div>
    </footer>
    <!-- footer section -->
    <!-- popper js -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <!-- bootstrap js -->
    <script src="{{Vite::asset('resources/js/bootstrap.js')}}"></script>
    <!-- owl slider -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
    </script>
    <!-- isotope js -->
    <script src="https://unpkg.com/isotope-layout@3.0.4/dist/isotope.pkgd.min.js"></script>
    <!-- nice select -->
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"></script> --}}
    {{-- @vite(["resources/js/nice-select.js"]) --}}
    <!-- custom js -->
    <script src="{{Vite::asset('resources/js/custom.js')}}"></script>
    </script>
    <!-- End Google Map -->

</x-app-layout>
