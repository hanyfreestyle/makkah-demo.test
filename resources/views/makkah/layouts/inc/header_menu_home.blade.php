<header class="ltn__header-area ltn__header-5 ltn__header-logo-and-mobile-menu-in-mobile ltn__header-logo-and-mobile-menu ltn__header-transparent gradient-color-4---">    <!-- ltn__header-top-area start -->
  <div class="ltn__header-top-area top-area-color-white d-none d-md-block">
    <div class="container">
      <div class="row">
        <div class="col-md-7">
          <div class="ltn__top-bar-menu">
            <ul>
              <li><a href="#"><i class="fa-solid fa-envelope-circle-check"></i> {{$webConfig->email}}</a></li>
              <li><a href="#"><i class="fa-solid fa-location-dot"></i> {{$webConfig->schema_address}} ,{{$webConfig->schema_city}}</a></li>
            </ul>
          </div>
        </div>
        <div class="col-md-5">
          <div class="top-bar-right text-end">
            <div class="ltn__top-bar-menu">
              <ul>
                <li>
                  <div class="ltn__drop-menu ltn__currency-menu ltn__language-menu">
                    <ul>
                      <li>
                        <a href="{{ LaravelLocalization::getLocalizedURL(webChangeLocale(),$pageView['go_home']) }}">
                          <span class="active-currency changeLanguage">{{__('web/def.change_language')}}</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </li>
                <li>
                  <x-makkah.def.social-media type="header" :web-config="$webConfig"/>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="ltn__header-middle-area ltn__header-sticky ltn__sticky-bg-black">
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="site-logo-wrap">
            <div class="site-logo edit_logo"><a href="{{route('web.index')}}">
                <img src="{{defImagesDir('logo_light','photo')}}" class="img-fluid"/>
              </a>
            </div>
            <div class="get-support clearfix d-none">
              <div class="get-support-icon"><i class="icon-call"></i></div>
              <div class="get-support-info"><h6>Get Support</h6>                                <h4><a href="tel:+123456789">123-456-789-10</a></h4></div>
            </div>
          </div>
        </div>
        <div class="col header-menu-column menu-color-white">
          <div class="header-menu d-none d-xl-block">
            <nav>
              <div class="ltn__main-menu">
                <ul>
                  <li><a href="{{route('web.index')}}">Home</a></li>
                  <li><a href="about.php">About Us</a></li>
                  <li><a href="#">Our Project</a>
                    <ul>
                      <li><a href="#">Rowaq Sheikh Zayed</a></li>
                      <li><a href="#">October Projects</a></li>
                      <li><a href="#">Alexandria Projects</a></li>
                    </ul>
                  </li>
                  <li><a href="#">Leatest News</a></li>
                  <li><a href="contact.php">Contact Us</a></li>
                  <li class="special-link"><a href="tel:+201221563252">+2 0122 1563 252 </a></li>
                </ul>
              </div>
            </nav>
          </div>
        </div>
        <div class="col--- ltn__header-options ltn__header-options-2 ">                    <!-- Mobile Menu Button -->
          <div class="mobile-menu-toggle d-xl-none"><a href="#ltn__utilize-mobile-menu" class="ltn__utilize-toggle">
              <svg viewBox="0 0 800 600">
                <path d="M300,220 C300,220 520,220 540,220 C740,220 640,540 520,420 C440,340 300,200 300,200" id="top"></path>
                <path d="M300,320 L540,320" id="middle"></path>
                <path d="M300,210 C300,210 520,210 540,210 C740,210 640,530 520,410 C440,330 300,190 300,190" id="bottom" transform="translate(480, 320) scale(1, -1) translate(-480, -318) "></path>
              </svg>
            </a></div>
        </div>
      </div>
    </div>
  </div>
  <!-- ltn__header-middle-area end -->
</header>
<!-- Utilize Mobile Menu Start -->
<div id="ltn__utilize-mobile-menu" class="ltn__utilize ltn__utilize-mobile-menu">
  <div class="ltn__utilize-menu-inner ltn__scrollbar">
    <div class="ltn__utilize-menu-head">
      <div class="site-logo">
        <a href="{{route('web.index')}}">
          <img src="{{defImagesDir('logo_dark','photo')}}" class="img-fluid"/>
        </a>
      </div>
      <button class="ltn__utilize-close">×</button>
    </div>
    <div class="ltn__utilize-menu">
      <ul>
        <li><a href="{{route('web.index')}}">Home</a></li>
        <li><a href="about.php">About Us</a></li>
        <li><a href="#">Our Project</a>
          <ul class="sub-menu">
            <li><a href="#">Rowaq Sheikh Zayed</a></li>
            <li><a href="#">October Projects</a></li>
            <li><a href="#">Alexadria Projects</a></li>
          </ul>
        </li>
        <li><a href="#">News</a></li>
        <li><a href="contact.php">Contact Us</a></li>
      </ul>
    </div>        <!--        <div class="ltn__utilize-buttons ltn__utilize-buttons-2">-->        <!--            <ul>-->        <!--                <li>-->
    <!--                    <a href="account.html" title="My Account">-->        <!--                            <span class="utilize-btn-icon">-->
    <!--                                <i class="far fa-user"></i>-->        <!--                            </span>-->        <!--                        My Account-->        <!--                    </a>-->
    <!--                </li>-->        <!--                <li>-->        <!--                    <a href="wishlist.html" title="Wishlist">-->
    <!--                            <span class="utilize-btn-icon">-->        <!--                                <i class="far fa-heart"></i>-->        <!--                                <sup>3</sup>-->
    <!--                            </span>-->        <!--                        Wishlist-->        <!--                    </a>-->        <!--                </li>-->        <!--                <li>-->
    <!--                    <a href="cart.html" title="Shoping Cart">-->        <!--                            <span class="utilize-btn-icon">-->
    <!--                                <i class="fas fa-shopping-cart"></i>-->        <!--                                <sup>5</sup>-->        <!--                            </span>-->
    <!--                        Shoping Cart-->        <!--                    </a>-->        <!--                </li>-->        <!--            </ul>-->        <!--        </div>-->
    <div class="ltn__social-media-2">
      <ul>
        <li><a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
        <li><a href="#" title="Twitter"><i class="fab fa-twitter"></i></a></li>
        <li><a href="#" title="Linkedin"><i class="fab fa-linkedin"></i></a></li>
        <li><a href="#" title="Instagram"><i class="fab fa-instagram"></i></a></li>
      </ul>
    </div>
  </div>
</div><!-- Utilize Mobile Menu End -->
<div class="ltn__utilize-overlay"></div>