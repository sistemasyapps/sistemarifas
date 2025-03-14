<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title></title>
  <!-- site favicon -->
  <link rel="icon" type="image/png" href="assets/images/favicon.png" sizes="16x16">
  <!-- bootstrap 4  -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <!-- fontawesome 5  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" integrity="sha512-q3eWabyZPc1XTCmF+8/LuE1ozpg5xxn7iO89yfSOd5/oKvyqLngoNGsx8jq92Y8eXJ/IRxQbEC+FGSYxtk2oiw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- line-awesome webfont -->
  <!-- <link rel="stylesheet" href="assets/css/line-awesome.min.css"> -->
  <!-- custom select css -->
  <!-- <link rel="stylesheet" href="assets/css/vendor/nice-select.css"> -->
  <!-- animate css  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- lightcase css -->
  <!-- <link rel="stylesheet" href="assets/css/vendor/lightcase.css"> -->
  <!-- slick slider css -->
  <!-- <link rel="stylesheet" href="assets/css/vendor/slick.css"> -->
  <!-- jquery ui css -->
  <!-- <link rel="stylesheet" href="assets/css/vendor/jquery-ui.min.css"> -->
  <!-- datepicker css -->
  <!-- <link rel="stylesheet" href="assets/css/vendor/datepicker.min.css"> -->
  <!-- style main css -->
  <link rel="stylesheet" href="assets/css/main.css?version=1.0.1">
</head>
  <body>

  <div class="preloader">
    <svg class="mainSVG" viewBox="0 0 800 600" xmlns="https://www.w3.org/2000/svg">
      <defs>   
        <path id="puff" d="M4.5,8.3C6,8.4,6.5,7,6.5,7s2,0.7,2.9-0.1C10,6.4,10.3,4.1,9.1,4c2-0.5,1.5-2.4-0.1-2.9c-1.1-0.3-1.8,0-1.8,0
        s-1.5-1.6-3.4-1C2.5,0.5,2.1,2.3,2.1,2.3S0,2.3,0,4.4c0,1.1,1,2.1,2.2,2.1C2.2,7.9,3.5,8.2,4.5,8.3z" fill="#fff"/>
        <circle id="dot"  cx="0" cy="0" r="5" fill="#fff"/>   
      </defs>
      
        <circle id="mainCircle" fill="none" stroke="none" stroke-width="2" stroke-miterlimit="10" cx="400" cy="300" r="130"/>
        <circle id="circlePath" fill="none" stroke="none" stroke-width="2" stroke-miterlimit="10" cx="400" cy="300" r="80"/>
      
      <g id="mainContainer" >
        <g id="car">
    <path id="carRot" fill="#FFF"  d="M45.6,16.9l0-11.4c0-3-1.5-5.5-4.5-5.5L3.5,0C0.5,0,0,1.5,0,4.5l0,13.4c0,3,0.5,4.5,3.5,4.5l37.6,0
      C44.1,22.4,45.6,19.9,45.6,16.9z M31.9,21.4l-23.3,0l2.2-2.6l14.1,0L31.9,21.4z M34.2,21c-3.8-1-7.3-3.1-7.3-3.1l0-13.4l7.3-3.1
      C34.2,1.4,37.1,11.9,34.2,21z M6.9,1.5c0-0.9,2.3,3.1,2.3,3.1l0,13.4c0,0-0.7,1.5-2.3,3.1C5.8,19.3,5.1,5.8,6.9,1.5z M24.9,3.9
      l-14.1,0L8.6,1.3l23.3,0L24.9,3.9z"/>      
        </g>
      </g>
    </svg>
  </div>

  <!-- scroll-to-top start -->
  <div class="scroll-to-top">
    <span class="scroll-icon">
      <i class="las la-arrow-up"></i>
    </span>
  </div>
  <!-- scroll-to-top end -->


  <!-- <div class="theme-switcher">
    <div class="theme-switcher__icon">
      <i class="las la-cog"></i>
    </div>
    <div class="theme-switcher__body">
      <div class="single dark active">
        <a href="index.html">Dark Version</a>
      </div>
      <div class="single light mt-4">
        <a href="light-index.html">Light Version</a>
      </div>
    </div>
  </div> -->

  <!-- page-wrapper start -->
  <div class="page-wrapper">
      <!-- login modal -->
  <div class="modal fade" id="loginModal" tabindex="1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-body">
          <div class="account-form-area">
            <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close"><i class="las la-times"></i></button>
            <h3 class="title">Welcome Back</h3>
            <div class="account-form-wrapper">
              <form>
                <div class="form-group">
                  <label>Email <sup>*</sup></label>
                  <input type="email" name="login_name" id="login_name" placeholder="Enter your Email">
                </div>
                <div class="form-group">
                  <label>password <sup>*</sup></label>
                  <input type="password" name="login_pass" id="login_pass" placeholder="password">
                </div>
                <div class="d-flex flex-wrap justify-content-between mt-2">
                  <div class="custom-checkbox">
                    <input type="checkbox" name="id-1" id="id-1" checked>
                    <label for="id-1">Remember Password</label>
                    <span class="checkbox"></span>
                  </div>
                  <a href="#0" class="link">Forgot Password?</a>
                </div>
                <div class="form-group text-center mt-5">
                  <button class="cmn-btn">log in</button>
                </div>
              </form>
              <p class="text-center mt-4">Don't have an account? <a href="#0" data-bs-toggle="modal" data-bs-target="#signupModal"> Sign Up Now</a></p>
              <div class="divider">
                <span>or</span>
              </div>
              <ul class="social-link-list">
                <li><a href="#0"><i class="fab fa-facebook-f"></i></a></li>
                <li><a href="#0"><i class="fab fa-twitter"></i></a></li>
                <li><a href="#0"><i class="fab fa-google-plus-g"></i></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Sign Up modal -->
  <div class="modal fade" id="signupModal" tabindex="1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-body">
          <div class="account-form-area">
            <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close"><i class="las la-times"></i></button>
            <h3 class="title">Open Free Account</h3>
            <div class="account-form-wrapper">
              <form>
                <div class="form-group">
                  <label>Email <sup>*</sup></label>
                  <input type="email" name="signup_name" id="signup_name" placeholder="Enter your Email">
                </div>
                <div class="form-group">
                  <label>password <sup>*</sup></label>
                  <input type="password" name="signup_pass" id="signup_pass" placeholder="password">
                </div>
                <div class="form-group">
                  <label>confirm password <sup>*</sup></label>
                  <input type="password" name="signup_re-pass" id="signup_re-pass" placeholder="Confirm Password">
                </div>
                <div class="d-flex flex-wrap mt-2">
                  <div class="custom-checkbox">
                    <input type="checkbox" name="id-2" id="id-2" checked>
                    <label for="id-2">I agree to the</label>
                    <span class="checkbox"></span>
                  </div>
                  <a href="#0" class="link ml-1">Terms, Privacy Policy and Fees</a>
                </div>
                <div class="form-group text-center mt-5">
                  <button class="cmn-btn">log in</button>
                </div>
              </form>
              <p class="text-center mt-4"> Already have an account? <a href="#0" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a></p>
              <div class="divider">
                <span>or</span>
              </div>
              <ul class="social-link-list">
                <li><a href="#0"><i class="fab fa-facebook-f"></i></a></li>
                <li><a href="#0"><i class="fab fa-twitter"></i></a></li>
                <li><a href="#0"><i class="fab fa-google-plus-g"></i></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- header-section start  -->
  <header class="header">
    
    <!-- <div class="header__top">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-sm-6">
            <div class="left d-flex align-items-center">
              <a href="tel:65655655"><i class="las la-phone-volume"></i> Customer Support</a>
              <div class="language">
                <i class="las la-globe-europe"></i>
                <select>
                  <option>En</option>
                  <option>Rus</option>
                  <option>Bn</option>
                  <option>Hp</option>
                  <option>Frn</option>
                </select>
              </div>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="right">
              <div class="product__cart">
                <span class="total__amount">0.00</span>
                <a href="cart.html"  class="amount__btn">
                  <i class="las la-shopping-basket"></i>
                  <span class="cart__num">08</span>
                </a>
              </div>
              <a href="#0" class="user__btn" data-bs-toggle="modal" data-bs-target="#loginModal"><i class="las la-user"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div> -->

    <div class="header__bottom">
      <div class="container">
        <nav class="navbar navbar-expand-xl p-0 align-items-center">
          <a class="site-logo site-title" href="/">
            
            <span class="logo-icon">
              <i class="flaticon-fire"></i>
            </span>
          </a>
          <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="menu-toggle"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav main-menu ms-auto">
              <li class="menu_has_children">
                <a href="#0">Home</a>
                <ul class="sub-menu">
                  <li><a href="index.html">Home One</a></li>
                  <li><a href="index-two.html">Home Two</a></li>
                  <li><a href="index-three.html">Home Three</a></li>
                  <li><a href="index-four.html">Home Four</a></li>
                </ul>
              </li>
              <li class="menu_has_children">
                <a href="#0">Contest</a>
                <ul class="sub-menu">
                  <li><a href="contest.html">All contest</a></li>
                  <li><a href="contest-details-one.html">Contest Details One</a></li>
                  <li><a href="contest-details-two.html">Contest Details Two</a></li>
                  <li><a href="lottery-details.html">Lottery Details One</a></li>
                  <li><a href="lottery-details-two.html">Lottery Details Two</a></li>
                </ul>
              </li>
              <li><a href="winner.html">Winners</a></li>
              <li class="menu_has_children">
                <a href="#0">pages</a>
                <ul class="sub-menu">
                  <li><a href="about.html">About Us</a></li>
                  <li><a href="affiliate.html">Affiliate Page</a></li>
                  <li><a href="how-work.html">How it works</a></li>
                  <li><a href="user.html">User Panel</a></li>
                  <li><a href="blog.html">Blog Posts</a></li>
                  <li><a href="blog-single.html">Blog Single</a></li>
                  <li><a href="cart.html">Cart Page</a></li>
                  <li><a href="checkout.html">Checkout Page</a></li>
                  <li><a href="faq.html">FAQ Page</a></li>
                  <li><a href="error-404.html">404 Page</a></li>
                </ul>
              </li>
              <li><a href="contact.html">contact</a></li>
            </ul>
            <div class="nav-right">
              <a href="/compra" class="cmn-btn style--three btn--sm"><img src="assets/images/icon/btn/tag.png" alt="icon" class="me-2"> Comprar Tickets</a>
            </div>
          </div>
        </nav>
      </div>
    </div><!-- header__bottom end -->
  </header>
  <!-- header-section end  -->

    <!-- hero start -->
    <section class="hero">
      <div class="hero__shape"><img src="assets/images/elements/hero-shape.jpg.png" alt="image"></div>
      <div class="hero__element"><img src="assets/images/elements/hero-building.png" alt="image"></div>
      <div class="hero__car wow bounceIn" data-wow-duration="0.5s" data-wow-delay="1s">
        <img src="assets/images/elements/car-shadow.png" alt="image" class="car-shadow">
        <img src="assets/images/elements/car-ray.png" alt="image" class="car-ray">
        <img src="assets/images/elements/car-light.png" alt="image" class="car-light">
        <img src="assets/images/elements/rifa_orinoco.png" alt="image" class="hero-car">
        <img src="assets/images/elements/car-star.png" alt="image" class="car-star">
      </div>
      <div class="container">
        <div class="row justify-content-center justify-content-lg-start">
          <div class="col-lg-6 col-md-8">
            <div class="hero__content">
              <div class="hero__subtitle wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.3s">Contest FOR YOUR CHANCE to</div>
              <h2 class="hero__title wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.5s">big win</h2>
              <p class="wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.7s">Now's your chance to win a car! Check out the prestige cars you can win in our car prize draws. Will you be our next lucky winner?</p>
              <div class="hero__btn wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.9s">
                <a href="/compra" class="cmn-btn">Participate Now</a>
                <!-- <a class="video-btn" href="https://www.youtube.com/embed/d6xn5uflUjg" data-rel="lightcase:myCollection"><i class="fas fa-play"></i></a> -->
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="hero__thumb">
              <img src="assets/images/elements/car-main.png" alt="">
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- hero start -->

    <!-- how to play section start -->
    <section class="position-relative z-index-two pt-120 pb-120 overflow-hidden">
      <div class="play-elements wow bounceIn" data-wow-duration="0.5s" data-wow-delay="0.7s">
        <img src="assets/images/elements/play-el.png" alt="image">
      </div>
      <div class="container">
        <div class="row">
          <div class="col-lg-6 text-sm-start text-center wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.3s">
            <div class="section-header">
              <span class="section-sub-title">Need to know about</span>
              <h2 class="section-title">How To Play</h2>
              <p>Follow these 3 easy steps! </p>
            </div>
          </div>
        </div>
        <div class="row mb-none-30 justify-content-xl-start justify-content-center">
          <div class="col-xl-3 col-lg-4 col-sm-6 mb-30">
            <div class="play-card bg_img" data-background="assets/images/elements/card-bg-1.jpg">
              <div class="play-card__icon">
                <img src="assets/images/icon/play/1.png" alt="image-icon">
                <span class="play-card__number">01</span>
              </div>
              <div class="play-card__content">
                <h3 class="play-card__title">Choose</h3>
                <p>Register to RIFA & Choose your contest</p>
              </div>
            </div><!-- play-card end -->
          </div>
          <div class="col-xl-3 col-lg-4 col-sm-6 mb-30">
            <div class="play-card bg_img" data-background="assets/images/elements/card-bg-2.jpg">
              <div class="play-card__icon">
                <img src="assets/images/icon/play/2.png" alt="image-icon">
                <span class="play-card__number">02</span>
              </div>
              <div class="play-card__content">
                <h3 class="play-card__title">buy</h3>
                <p>Pick Your Numbers & Complete your Purchase</p>
              </div>
            </div><!-- play-card end -->
          </div>
          <div class="col-xl-3 col-lg-4 col-sm-6 mb-30">
            <div class="play-card bg_img" data-background="assets/images/elements/card-bg-3.jpg">
              <div class="play-card__icon">
                <img src="assets/images/icon/play/3.png" alt="image-icon">
                <span class="play-card__number">03</span>
              </div>
              <div class="play-card__content">
                <h3 class="play-card__title">Win</h3>
                <p>Start Dreaming, you're almost there</p>
              </div>
            </div><!-- play-card end -->
          </div>
        </div>
      </div>
    </section>
    <!-- how to play section end -->

    <!-- contest section start -->
    <section class="position-relative pt-120 pb-120">
      <div class="bg-el"><img src="assets/images/elements/contest-bg.png" alt="image"></div>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.3s">
            <div class="section-header text-center">
              <span class="section-sub-title">Try your chance at winning</span>
              <h2 class="section-title">Current Contest</h2>
              <p>Participants buy tickets and lots are drawn to determine the winners.</p>
            </div>
          </div>
        </div><!-- row end -->

        <div class="row wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.3s">
          <div class="col-lg-12">

            <ul class="nav nav-tabs justify-content-center mb-30 border-0" id="myTab" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="cmn-btn style--two d-flex align-items-center active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">
                <span class="me-3"><img src="assets/images/icon/btn/car.png" alt="icon"></span> Dream Car
                </button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="cmn-btn style--two d-flex align-items-center" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">
                  <span class="me-3"><img src="assets/images/icon/btn/box.png" alt="icon"></span>All lifestyle
                </button>
              </li>
            </ul>
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                <div class="row mb-none-30">
                  <div class="col-xl-4 col-md-6 mb-30">
                    <div class="contest-card">
                      <a href="contest-details-one.html" class="item-link"></a>
                      <div class="contest-card__thumb">
                        <img src="assets/images/contest/1.png" alt="image">
                        <a href="#0" class="action-icon"><i class="far fa-heart"></i></a>
                        <div class="contest-num">
                          <span>contest no:</span>
                          <h4 class="number">b2t</h4>
                        </div>
                      </div>
                      <div class="contest-card__content">
                        <div class="left">
                          <h5 class="contest-card__name">The Breeze Zodiac IX</h5>
                        </div>
                        <div class="right">
                          <span class="contest-card__price">$3.99</span>
                          <p>ticket price</p>
                        </div>
                      </div>
                      <div class="contest-card__footer">
                        <ul class="contest-card__meta">
                          <li>
                            <i class="las la-clock"></i>
                            <span>5d</span>
                          </li>
                          <li>
                            <i class="las la-ticket-alt"></i>
                            <span>9805</span>
                            <p>Remaining</p>
                          </li>
                        </ul>
                      </div>
                    </div><!-- contest-card end -->
                  </div>
                  <div class="col-xl-4 col-md-6 mb-30">
                    <div class="contest-card">
                      <a href="contest-details-one.html" class="item-link"></a>
                      <div class="contest-card__thumb">
                        <img src="assets/images/contest/2.png" alt="image">
                        <a href="#0" class="action-icon"><i class="far fa-heart"></i></a>
                        <div class="contest-num">
                          <span>contest no:</span>
                          <h4 class="number">x9u</h4>
                        </div>
                      </div>
                      <div class="contest-card__content">
                        <div class="left">
                          <h5 class="contest-card__name">The Del Sol Trailblazer</h5>
                        </div>
                        <div class="right">
                          <span class="contest-card__price">$3.99</span>
                          <p>ticket price</p>
                        </div>
                      </div>
                      <div class="contest-card__footer">
                        <ul class="contest-card__meta">
                          <li>
                            <i class="las la-clock"></i>
                            <span>5d</span>
                          </li>
                          <li>
                            <i class="las la-ticket-alt"></i>
                            <span>9805</span>
                            <p>Remaining</p>
                          </li>
                        </ul>
                      </div>
                    </div><!-- contest-card end -->
                  </div>
                  <div class="col-xl-4 col-md-6 mb-30">
                    <div class="contest-card">
                      <a href="contest-details-one.html" class="item-link"></a>
                      <div class="contest-card__thumb">
                        <img src="assets/images/contest/3.png" alt="image">
                        <a href="#0" class="action-icon"><i class="far fa-heart"></i></a>
                        <div class="contest-num">
                          <span>contest no:</span>
                          <h4 class="number">8y3</h4>
                        </div>
                      </div>
                      <div class="contest-card__content">
                        <div class="left">
                          <h5 class="contest-card__name">The Miata Dart IV</h5>
                        </div>
                        <div class="right">
                          <span class="contest-card__price">$3.99</span>
                          <p>ticket price</p>
                        </div>
                      </div>
                      <div class="contest-card__footer">
                        <ul class="contest-card__meta">
                          <li>
                            <i class="las la-clock"></i>
                            <span>5d</span>
                          </li>
                          <li>
                            <i class="las la-ticket-alt"></i>
                            <span>9805</span>
                            <p>Remaining</p>
                          </li>
                        </ul>
                      </div>
                    </div><!-- contest-card end -->
                  </div>
                  <div class="col-xl-4 col-md-6 mb-30">
                    <div class="contest-card">
                      <a href="contest-details-one.html" class="item-link"></a>
                      <div class="contest-card__thumb">
                        <img src="assets/images/contest/4.png" alt="image">
                        <a href="#0" class="action-icon"><i class="far fa-heart"></i></a>
                        <div class="contest-num">
                          <span>contest no:</span>
                          <h4 class="number">r9d</h4>
                        </div>
                      </div>
                      <div class="contest-card__content">
                        <div class="left">
                          <h5 class="contest-card__name">The Fabia Magnum</h5>
                        </div>
                        <div class="right">
                          <span class="contest-card__price">$3.99</span>
                          <p>ticket price</p>
                        </div>
                      </div>
                      <div class="contest-card__footer">
                        <ul class="contest-card__meta">
                          <li>
                            <i class="las la-clock"></i>
                            <span>5d</span>
                          </li>
                          <li>
                            <i class="las la-ticket-alt"></i>
                            <span>9805</span>
                            <p>Remaining</p>
                          </li>
                        </ul>
                      </div>
                    </div><!-- contest-card end -->
                  </div>
                  <div class="col-xl-4 col-md-6 mb-30">
                    <div class="contest-card">
                      <a href="contest-details-one.html" class="item-link"></a>
                      <div class="contest-card__thumb">
                        <img src="assets/images/contest/5.png" alt="image">
                        <a href="#0" class="action-icon"><i class="far fa-heart"></i></a>
                        <div class="contest-num">
                          <span>contest no:</span>
                          <h4 class="number">pr2</h4>
                        </div>
                      </div>
                      <div class="contest-card__content">
                        <div class="left">
                          <h5 class="contest-card__name">The Omega Navigator</h5>
                        </div>
                        <div class="right">
                          <span class="contest-card__price">$3.99</span>
                          <p>ticket price</p>
                        </div>
                      </div>
                      <div class="contest-card__footer">
                        <ul class="contest-card__meta">
                          <li>
                            <i class="las la-clock"></i>
                            <span>5d</span>
                          </li>
                          <li>
                            <i class="las la-ticket-alt"></i>
                            <span>9805</span>
                            <p>Remaining</p>
                          </li>
                        </ul>
                      </div>
                    </div><!-- contest-card end -->
                  </div>
                  <div class="col-xl-4 col-md-6 mb-30">
                    <div class="contest-card">
                      <a href="contest-details-one.html" class="item-link"></a>
                      <div class="contest-card__thumb">
                        <img src="assets/images/contest/6.png" alt="image">
                        <a href="#0" class="action-icon"><i class="far fa-heart"></i></a>
                        <div class="contest-num">
                          <span>contest no:</span>
                          <h4 class="number">w03</h4>
                        </div>
                      </div>
                      <div class="contest-card__content">
                        <div class="left">
                          <h5 class="contest-card__name">Shelby Cobra</h5>
                        </div>
                        <div class="right">
                          <span class="contest-card__price">$3.99</span>
                          <p>ticket price</p>
                        </div>
                      </div>
                      <div class="contest-card__footer">
                        <ul class="contest-card__meta">
                          <li>
                            <i class="las la-clock"></i>
                            <span>5d</span>
                          </li>
                          <li>
                            <i class="las la-ticket-alt"></i>
                            <span>9805</span>
                            <p>Remaining</p>
                          </li>
                        </ul>
                      </div>
                    </div><!-- contest-card end -->
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                <div class="row mb-none-30">
                  <div class="col-xl-4 col-md-6 mb-30">
                    <div class="contest-card">
                      <a href="contest-details-one.html" class="item-link"></a>
                      <div class="contest-card__thumb">
                        <img src="assets/images/contest/4.png" alt="image">
                        <a href="#0" class="action-icon"><i class="far fa-heart"></i></a>
                        <div class="contest-num">
                          <span>contest no:</span>
                          <h4 class="number">r9d</h4>
                        </div>
                      </div>
                      <div class="contest-card__content">
                        <div class="left">
                          <h5 class="contest-card__name">The Fabia Magnum</h5>
                        </div>
                        <div class="right">
                          <span class="contest-card__price">$3.99</span>
                          <p>ticket price</p>
                        </div>
                      </div>
                      <div class="contest-card__footer">
                        <ul class="contest-card__meta">
                          <li>
                            <i class="las la-clock"></i>
                            <span>5d</span>
                          </li>
                          <li>
                            <i class="las la-ticket-alt"></i>
                            <span>9805</span>
                            <p>Remaining</p>
                          </li>
                        </ul>
                      </div>
                    </div><!-- contest-card end -->
                  </div>
                  <div class="col-xl-4 col-md-6 mb-30">
                    <div class="contest-card">
                      <a href="contest-details-one.html" class="item-link"></a>
                      <div class="contest-card__thumb">
                        <img src="assets/images/contest/5.png" alt="image">
                        <a href="#0" class="action-icon"><i class="far fa-heart"></i></a>
                        <div class="contest-num">
                          <span>contest no:</span>
                          <h4 class="number">pr2</h4>
                        </div>
                      </div>
                      <div class="contest-card__content">
                        <div class="left">
                          <h5 class="contest-card__name">The Omega Navigator</h5>
                        </div>
                        <div class="right">
                          <span class="contest-card__price">$3.99</span>
                          <p>ticket price</p>
                        </div>
                      </div>
                      <div class="contest-card__footer">
                        <ul class="contest-card__meta">
                          <li>
                            <i class="las la-clock"></i>
                            <span>5d</span>
                          </li>
                          <li>
                            <i class="las la-ticket-alt"></i>
                            <span>9805</span>
                            <p>Remaining</p>
                          </li>
                        </ul>
                      </div>
                    </div><!-- contest-card end -->
                  </div>
                  <div class="col-xl-4 col-md-6 mb-30">
                    <div class="contest-card">
                      <a href="contest-details-one.html" class="item-link"></a>
                      <div class="contest-card__thumb">
                        <img src="assets/images/contest/6.png" alt="image">
                        <a href="#0" class="action-icon"><i class="far fa-heart"></i></a>
                        <div class="contest-num">
                          <span>contest no:</span>
                          <h4 class="number">w03</h4>
                        </div>
                      </div>
                      <div class="contest-card__content">
                        <div class="left">
                          <h5 class="contest-card__name">Shelby Cobra</h5>
                        </div>
                        <div class="right">
                          <span class="contest-card__price">$3.99</span>
                          <p>ticket price</p>
                        </div>
                      </div>
                      <div class="contest-card__footer">
                        <ul class="contest-card__meta">
                          <li>
                            <i class="las la-clock"></i>
                            <span>5d</span>
                          </li>
                          <li>
                            <i class="las la-ticket-alt"></i>
                            <span>9805</span>
                            <p>Remaining</p>
                          </li>
                        </ul>
                      </div>
                    </div><!-- contest-card end -->
                  </div>
                </div>
              </div>
            </div>            
          </div>
        </div><!-- row end-->
        <div class="row mt-30">
          <div class="col-lg-12">
            <div class="btn-grp">
              <a href="contest.html" class="btn-border">browse more</a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- contest section end -->

    <!-- winner section start -->
    <section class="position-relative pt-120 pb-120">
      <div class="bg-el"><img src="assets/images/bg/winner.jpg" alt="image"></div>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.3s">
            <div class="section-header text-center">
              <span class="section-sub-title">The biggest lottery winners of the month</span>
              <h2 class="section-title">Top Ten winners</h2>
              <p>There have been numerous winnings, but some winners were luckier than others</p>
            </div>
          </div>
        </div><!-- row end -->
        <div class="row">
          <div class="col-lg-12">
            <div class="winner-wrapper">
              <div class="left">
                <div class="winner-prize-thumb wow bounceIn" data-wow-duration="0.5s" data-wow-delay="0.5s"><img src="assets/images/elements/car.png" alt="image"></div>
              </div>
              <div class="right">
                <div class="winner-slider">
                  <div class="winner-slide-item">
                    <div class="winner-thumb"><img src="assets/images/winner/w-1.png" alt="image"></div>
                    <div class="winner-content bg_img" data-background="assets/images/elements/winner-content-bg.jpg">
                      <h6 class="winner-name">Breeze Zodiac</h6>
                      <p>Draw took place on</p>
                      <span class="draw-date">19/04/2023</span>
                    </div>
                  </div><!-- winner-slide-item end -->
                  <div class="winner-slide-item">
                    <div class="winner-thumb"><img src="assets/images/winner/w-1.png" alt="image"></div>
                    <div class="winner-content bg_img" data-background="assets/images/elements/winner-content-bg.jpg">
                      <h6 class="winner-name">Breeze Zodiac</h6>
                      <p>Draw took place on</p>
                      <span class="draw-date">19/04/2023</span>
                    </div>
                  </div><!-- winner-slide-item end -->
                  <div class="winner-slide-item">
                    <div class="winner-thumb"><img src="assets/images/winner/w-1.png" alt="image"></div>
                    <div class="winner-content bg_img" data-background="assets/images/elements/winner-content-bg.jpg">
                      <h6 class="winner-name">Breeze Zodiac</h6>
                      <p>Draw took place on</p>
                      <span class="draw-date">19/04/2023</span>
                    </div>
                  </div><!-- winner-slide-item end -->
                </div>
              </div>
            </div>
          </div>
        </div><!-- row end -->
      </div><!-- container end -->
    </section>
    <!-- winner section end -->

    <!-- latest winner section start  -->
    <section class="latest-winner-section position-relative pt-120 pb-120">
      <div class="el-1"><img src="assets/images/elements/w-el-1.png" alt="image"></div>
      <div class="el-2"><img src="assets/images/elements/w-el-2.png" alt="image"></div>
      <div class="el-3"><img src="assets/images/elements/w-el-3.png" alt="image"></div>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.3s">
            <div class="section-header text-center">
              <span class="section-sub-title">Meet the latest winners from your favorite contest</span>
              <h2 class="section-title">Latest Winners</h2>
              <p>Check your ticket number's to see if you are a Winner in the Dream Lottery.</p>
            </div>
          </div>
        </div><!-- row end -->

        <div class="row wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.5s">
          <div class="col-lg-12">
            <ul class="nav nav-tabs winner-tab-nav" id="winnerTab" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" id="dream-tab" data-bs-toggle="tab" data-bs-target="#dream" role="tab" aria-controls="dream" aria-selected="true">
                  <div class="icon-thumb"><img src="assets/images/icon/winner-tab/1.png" alt="image"></div>
                  <span>Dream Car</span>
                </button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="bike-tab" data-bs-toggle="tab" data-bs-target="#bike" role="tab" aria-controls="bike" aria-selected="false">
                  <div class="icon-thumb"><img src="assets/images/icon/winner-tab/2.png" alt="image"></div>
                  <span>bike</span>
                </button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="watch-tab" data-bs-toggle="tab" data-bs-target="#watch" role="tab" aria-controls="watch" aria-selected="false">
                  <div class="icon-thumb"><img src="assets/images/icon/winner-tab/3.png" alt="image"></div>
                  <span>watch</span>
                </button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="laptop-tab" data-bs-toggle="tab" data-bs-target="#laptop" role="tab" aria-controls="laptop" aria-selected="false">
                  <div class="icon-thumb"><img src="assets/images/icon/winner-tab/4.png" alt="image"></div>
                  <span>laptop</span>
                </button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="money-tab" data-bs-toggle="tab" data-bs-target="#money" role="tab" aria-controls="money" aria-selected="false">
                  <div class="icon-thumb"><img src="assets/images/icon/winner-tab/5.png" alt="image"></div>
                  <span>Money</span>
                </button>
              </li>
            </ul>
            <div class="tab-content mt-50" id="winnerTabContent">
              <div class="tab-pane fade show active" id="dream" role="tabpanel" aria-labelledby="dream-tab">
                <div class="row mb-none-30">
                  <div class="col-lg-4 mb-30">
                    <div class="number-check-wrapper">
                      <h3 class="title">Check My Numbers</h3>
                      <p>Are you holding on to a winning ticket? Here's an easy way to find out.</p>
                      <form class="check-number-form">
                        <input type="tel" class="form-control mt-30 mb-30" name="check-number1" id="check-number1" placeholder="Enter Contest No">
                        <div class="number-list-wrapper">
                          <p>Enter Your Lottery Numbers</p>
                          <div class="number-list mt-3 mb-3">
                            <input type="text" name="text1" id="text1" placeholder="00">
                            <input type="text" name="text2" id="text2" placeholder="00">
                            <input type="text" name="text3" id="text3" placeholder="00">
                            <input type="text" name="text4" id="text4" placeholder="00">
                            <input type="text" name="text5" id="text5" placeholder="00">
                            <input type="text" name="text6" id="text6" placeholder="00">
                            <input type="text" name="text7" id="text7" placeholder="00">
                          </div><!-- number-list end -->
                          <select class="nice-select">
                            <option>Last 7 days</option>
                            <option>Last 6 days</option>
                            <option>Last 5 days</option>
                            <option>Last 4 days</option>
                            <option>Last 3 days</option>
                          </select>
                          <div class="text-center mt-100">
                            <button type="submit" class="cmn-btn">check my numbers</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                  <div class="col-lg-8 mb-30">
                    <div class="winner-card mb-30">
                      <div class="winner-card__thumb">
                        <img src="assets/images/win-car/6.png" alt="image">
                      </div>
                      <div class="winner-card__content">
                        <div class="winner-thumb"><img src="assets/images/winner/1.png" alt="image"></div>
                        <div class="content-top">
                          <div class="left">
                            <h5>The Breeze Zodiac IX</h5>
                          </div>
                          <div class="right">
                            <span>Draw took place on</span>
                            <p>Saturday April 20, 2023</p>
                          </div>
                        </div>
                        <div class="content-bottom">
                          <div class="number-list-wrapper">
                            <p>Winning Numbers:</p>
                            <ul class="number-list mt-2">
                              <li>11</li>
                              <li>88</li>
                              <li>23</li>
                              <li>9</li>
                              <li>19</li>
                              <li>26</li>
                              <li>87</li>
                            </ul><!-- number-list end -->
                          </div>
                          <div class="right">
                            <p>Contest No:</p>
                            <span class="contest-num">B2T</span>
                          </div>
                        </div>
                      </div>
                    </div><!-- winner-card end -->
                    <div class="winner-card mb-30">
                      <div class="winner-card__thumb">
                        <img src="assets/images/win-car/4.png" alt="image">
                      </div>
                      <div class="winner-card__content">
                        <div class="winner-thumb"><img src="assets/images/winner/2.png" alt="image"></div>
                        <div class="content-top">
                          <div class="left">
                            <h5>The Breeze Zodiac IX</h5>
                          </div>
                          <div class="right">
                            <span>Draw took place on</span>
                            <p>Saturday April 20, 2023</p>
                          </div>
                        </div>
                        <div class="content-bottom">
                          <div class="number-list-wrapper">
                            <p>Winning Numbers:</p>
                            <ul class="number-list mt-2">
                              <li>11</li>
                              <li>88</li>
                              <li>23</li>
                              <li>9</li>
                              <li>19</li>
                              <li>26</li>
                              <li>87</li>
                            </ul><!-- number-list end -->
                          </div>
                          <div class="right">
                            <p>Contest No:</p>
                            <span class="contest-num">B2T</span>
                          </div>
                        </div>
                      </div>
                    </div><!-- winner-card end -->
                    <div class="winner-card mb-30">
                      <div class="winner-card__thumb">
                        <img src="assets/images/win-car/3.png" alt="image">
                      </div>
                      <div class="winner-card__content">
                        <div class="winner-thumb"><img src="assets/images/winner/3.png" alt="image"></div>
                        <div class="content-top">
                          <div class="left">
                            <h5>The Breeze Zodiac IX</h5>
                          </div>
                          <div class="right">
                            <span>Draw took place on</span>
                            <p>Saturday April 20, 2023</p>
                          </div>
                        </div>
                        <div class="content-bottom">
                          <div class="number-list-wrapper">
                            <p>Winning Numbers:</p>
                            <ul class="number-list mt-2">
                              <li>11</li>
                              <li>88</li>
                              <li>23</li>
                              <li>9</li>
                              <li>19</li>
                              <li>26</li>
                              <li>87</li>
                            </ul><!-- number-list end -->
                          </div>
                          <div class="right">
                            <p>Contest No:</p>
                            <span class="contest-num">B2T</span>
                          </div>
                        </div>
                      </div>
                    </div><!-- winner-card end -->
                    <div class="winner-card mb-30">
                      <div class="winner-card__thumb">
                        <img src="assets/images/win-car/4.png" alt="image">
                      </div>
                      <div class="winner-card__content">
                        <div class="winner-thumb"><img src="assets/images/winner/4.png" alt="image"></div>
                        <div class="content-top">
                          <div class="left">
                            <h5>The Breeze Zodiac IX</h5>
                          </div>
                          <div class="right">
                            <span>Draw took place on</span>
                            <p>Saturday April 20, 2023</p>
                          </div>
                        </div>
                        <div class="content-bottom">
                          <div class="number-list-wrapper">
                            <p>Winning Numbers:</p>
                            <ul class="number-list mt-2">
                              <li>11</li>
                              <li>88</li>
                              <li>23</li>
                              <li>9</li>
                              <li>19</li>
                              <li>26</li>
                              <li>87</li>
                            </ul><!-- number-list end -->
                          </div>
                          <div class="right">
                            <p>Contest No:</p>
                            <span class="contest-num">B2T</span>
                          </div>
                        </div>
                      </div>
                    </div><!-- winner-card end -->
                    <div class="winner-card mb-30">
                      <div class="winner-card__thumb">
                        <img src="assets/images/win-car/5.png" alt="image">
                      </div>
                      <div class="winner-card__content">
                        <div class="winner-thumb"><img src="assets/images/winner/5.png" alt="image"></div>
                        <div class="content-top">
                          <div class="left">
                            <h5>The Breeze Zodiac IX</h5>
                          </div>
                          <div class="right">
                            <span>Draw took place on</span>
                            <p>Saturday April 20, 2023</p>
                          </div>
                        </div>
                        <div class="content-bottom">
                          <div class="number-list-wrapper">
                            <p>Winning Numbers:</p>
                            <ul class="number-list mt-2">
                              <li>11</li>
                              <li>88</li>
                              <li>23</li>
                              <li>9</li>
                              <li>19</li>
                              <li>26</li>
                              <li>87</li>
                            </ul><!-- number-list end -->
                          </div>
                          <div class="right">
                            <p>Contest No:</p>
                            <span class="contest-num">B2T</span>
                          </div>
                        </div>
                      </div>
                    </div><!-- winner-card end -->
                    <div class="winner-card mb-30">
                      <div class="winner-card__thumb">
                        <img src="assets/images/win-car/6.png" alt="image">
                      </div>
                      <div class="winner-card__content">
                        <div class="winner-thumb"><img src="assets/images/winner/6.png" alt="image"></div>
                        <div class="content-top">
                          <div class="left">
                            <h5>The Breeze Zodiac IX</h5>
                          </div>
                          <div class="right">
                            <span>Draw took place on</span>
                            <p>Saturday April 20, 2023</p>
                          </div>
                        </div>
                        <div class="content-bottom">
                          <div class="number-list-wrapper">
                            <p>Winning Numbers:</p>
                            <ul class="number-list mt-2">
                              <li>11</li>
                              <li>88</li>
                              <li>23</li>
                              <li>9</li>
                              <li>19</li>
                              <li>26</li>
                              <li>87</li>
                            </ul><!-- number-list end -->
                          </div>
                          <div class="right">
                            <p>Contest No:</p>
                            <span class="contest-num">B2T</span>
                          </div>
                        </div>
                      </div>
                    </div><!-- winner-card end -->
                    <div class="btn-grp">
                      <a href="winner.html" class="btn-border">browse more</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="bike" role="tabpanel" aria-labelledby="bike-tab">
                <div class="row mb-none-30">
                  <div class="col-lg-4 mb-30">
                    <div class="number-check-wrapper">
                      <h3 class="title">Check My Numbers</h3>
                      <p>Are you holding on to a winning ticket? Here's an easy way to find out.</p>
                      <form class="check-number-form">
                        <input type="tel" class="form-control mt-30 mb-30" name="check-number2" id="check-number2" placeholder="Enter Contest No">
                        <div class="number-list-wrapper">
                          <p>Enter Your Lottery Numbers</p>
                          <div class="number-list mt-3 mb-3">
                            <input type="text" name="text8" id="text8" placeholder="00">
                            <input type="text" name="text9" id="text9" placeholder="00">
                            <input type="text" name="text10" id="text10" placeholder="00">
                            <input type="text" name="text11" id="text11" placeholder="00">
                            <input type="text" name="text12" id="text12" placeholder="00">
                            <input type="text" name="text13" id="text13" placeholder="00">
                            <input type="text" name="text14" id="text14" placeholder="00">
                          </div><!-- number-list end -->
                          <select class="nice-select">
                            <option>Last 7 days</option>
                            <option>Last 6 days</option>
                            <option>Last 5 days</option>
                            <option>Last 4 days</option>
                            <option>Last 3 days</option>
                          </select>
                          <div class="text-center mt-100">
                            <button type="submit" class="cmn-btn">check my numbers</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                  <div class="col-lg-8 mb-30">
                    <div class="winner-card mb-30">
                      <div class="winner-card__thumb">
                        <img src="assets/images/win-car/5.png" alt="image">
                      </div>
                      <div class="winner-card__content">
                        <div class="winner-thumb"><img src="assets/images/winner/1.png" alt="image"></div>
                        <div class="content-top">
                          <div class="left">
                            <h5>The Breeze Zodiac IX</h5>
                          </div>
                          <div class="right">
                            <span>Draw took place on</span>
                            <p>Saturday April 20, 2023</p>
                          </div>
                        </div>
                        <div class="content-bottom">
                          <div class="number-list-wrapper">
                            <p>Winning Numbers:</p>
                            <ul class="number-list mt-2">
                              <li>11</li>
                              <li>88</li>
                              <li>23</li>
                              <li>9</li>
                              <li>19</li>
                              <li>26</li>
                              <li>87</li>
                            </ul><!-- number-list end -->
                          </div>
                          <div class="right">
                            <p>Contest No:</p>
                            <span class="contest-num">B2T</span>
                          </div>
                        </div>
                      </div>
                    </div><!-- winner-card end -->
                    <div class="winner-card mb-30">
                      <div class="winner-card__thumb">
                        <img src="assets/images/win-car/6.png" alt="image">
                      </div>
                      <div class="winner-card__content">
                        <div class="winner-thumb"><img src="assets/images/winner/2.png" alt="image"></div>
                        <div class="content-top">
                          <div class="left">
                            <h5>The Breeze Zodiac IX</h5>
                          </div>
                          <div class="right">
                            <span>Draw took place on</span>
                            <p>Saturday April 20, 2023</p>
                          </div>
                        </div>
                        <div class="content-bottom">
                          <div class="number-list-wrapper">
                            <p>Winning Numbers:</p>
                            <ul class="number-list mt-2">
                              <li>11</li>
                              <li>88</li>
                              <li>23</li>
                              <li>9</li>
                              <li>19</li>
                              <li>26</li>
                              <li>87</li>
                            </ul><!-- number-list end -->
                          </div>
                          <div class="right">
                            <p>Contest No:</p>
                            <span class="contest-num">B2T</span>
                          </div>
                        </div>
                      </div>
                    </div><!-- winner-card end -->
                    <div class="winner-card mb-30">
                      <div class="winner-card__thumb">
                        <img src="assets/images/win-car/3.png" alt="image">
                      </div>
                      <div class="winner-card__content">
                        <div class="winner-thumb"><img src="assets/images/winner/3.png" alt="image"></div>
                        <div class="content-top">
                          <div class="left">
                            <h5>The Breeze Zodiac IX</h5>
                          </div>
                          <div class="right">
                            <span>Draw took place on</span>
                            <p>Saturday April 20, 2023</p>
                          </div>
                        </div>
                        <div class="content-bottom">
                          <div class="number-list-wrapper">
                            <p>Winning Numbers:</p>
                            <ul class="number-list mt-2">
                              <li>11</li>
                              <li>88</li>
                              <li>23</li>
                              <li>9</li>
                              <li>19</li>
                              <li>26</li>
                              <li>87</li>
                            </ul><!-- number-list end -->
                          </div>
                          <div class="right">
                            <p>Contest No:</p>
                            <span class="contest-num">B2T</span>
                          </div>
                        </div>
                      </div>
                    </div><!-- winner-card end -->
                    <div class="winner-card mb-30">
                      <div class="winner-card__thumb">
                        <img src="assets/images/win-car/4.png" alt="image">
                      </div>
                      <div class="winner-card__content">
                        <div class="winner-thumb"><img src="assets/images/winner/4.png" alt="image"></div>
                        <div class="content-top">
                          <div class="left">
                            <h5>The Breeze Zodiac IX</h5>
                          </div>
                          <div class="right">
                            <span>Draw took place on</span>
                            <p>Saturday April 20, 2023</p>
                          </div>
                        </div>
                        <div class="content-bottom">
                          <div class="number-list-wrapper">
                            <p>Winning Numbers:</p>
                            <ul class="number-list mt-2">
                              <li>11</li>
                              <li>88</li>
                              <li>23</li>
                              <li>9</li>
                              <li>19</li>
                              <li>26</li>
                              <li>87</li>
                            </ul><!-- number-list end -->
                          </div>
                          <div class="right">
                            <p>Contest No:</p>
                            <span class="contest-num">B2T</span>
                          </div>
                        </div>
                      </div>
                    </div><!-- winner-card end -->
                    <div class="winner-card mb-30">
                      <div class="winner-card__thumb">
                        <img src="assets/images/win-car/5.png" alt="image">
                      </div>
                      <div class="winner-card__content">
                        <div class="winner-thumb"><img src="assets/images/winner/5.png" alt="image"></div>
                        <div class="content-top">
                          <div class="left">
                            <h5>The Breeze Zodiac IX</h5>
                          </div>
                          <div class="right">
                            <span>Draw took place on</span>
                            <p>Saturday April 20, 2023</p>
                          </div>
                        </div>
                        <div class="content-bottom">
                          <div class="number-list-wrapper">
                            <p>Winning Numbers:</p>
                            <ul class="number-list mt-2">
                              <li>11</li>
                              <li>88</li>
                              <li>23</li>
                              <li>9</li>
                              <li>19</li>
                              <li>26</li>
                              <li>87</li>
                            </ul><!-- number-list end -->
                          </div>
                          <div class="right">
                            <p>Contest No:</p>
                            <span class="contest-num">B2T</span>
                          </div>
                        </div>
                      </div>
                    </div><!-- winner-card end -->
                    <div class="winner-card mb-30">
                      <div class="winner-card__thumb">
                        <img src="assets/images/win-car/6.png" alt="image">
                      </div>
                      <div class="winner-card__content">
                        <div class="winner-thumb"><img src="assets/images/winner/6.png" alt="image"></div>
                        <div class="content-top">
                          <div class="left">
                            <h5>The Breeze Zodiac IX</h5>
                          </div>
                          <div class="right">
                            <span>Draw took place on</span>
                            <p>Saturday April 20, 2023</p>
                          </div>
                        </div>
                        <div class="content-bottom">
                          <div class="number-list-wrapper">
                            <p>Winning Numbers:</p>
                            <ul class="number-list mt-2">
                              <li>11</li>
                              <li>88</li>
                              <li>23</li>
                              <li>9</li>
                              <li>19</li>
                              <li>26</li>
                              <li>87</li>
                            </ul><!-- number-list end -->
                          </div>
                          <div class="right">
                            <p>Contest No:</p>
                            <span class="contest-num">B2T</span>
                          </div>
                        </div>
                      </div>
                    </div><!-- winner-card end -->
                    <div class="btn-grp">
                      <a href="winner.html" class="btn-border">browse more</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="watch" role="tabpanel" aria-labelledby="watch-tab">
                <div class="row mb-none-30">
                  <div class="col-lg-4 mb-30">
                    <div class="number-check-wrapper">
                      <h3 class="title">Check My Numbers</h3>
                      <p>Are you holding on to a winning ticket? Here's an easy way to find out.</p>
                      <form class="check-number-form">
                        <input type="tel" class="form-control mt-30 mb-30" name="check-number3" id="check-number3" placeholder="Enter Contest No">
                        <div class="number-list-wrapper">
                          <p>Enter Your Lottery Numbers</p>
                          <div class="number-list mt-3 mb-3">
                            <input type="text" name="text15" id="text15" placeholder="00">
                            <input type="text" name="text16" id="text16" placeholder="00">
                            <input type="text" name="text17" id="text17" placeholder="00">
                            <input type="text" name="text18" id="text18" placeholder="00">
                            <input type="text" name="text19" id="text19" placeholder="00">
                            <input type="text" name="text20" id="text20" placeholder="00">
                            <input type="text" name="text21" id="text21" placeholder="00">
                          </div><!-- number-list end -->
                          <select class="nice-select">
                            <option>Last 7 days</option>
                            <option>Last 6 days</option>
                            <option>Last 5 days</option>
                            <option>Last 4 days</option>
                            <option>Last 3 days</option>
                          </select>
                          <div class="text-center mt-100">
                            <button type="submit" class="cmn-btn">check my numbers</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                  <div class="col-lg-8 mb-30">
                    <div class="winner-card mb-30">
                      <div class="winner-card__thumb">
                        <img src="assets/images/win-car/3.png" alt="image">
                      </div>
                      <div class="winner-card__content">
                        <div class="winner-thumb"><img src="assets/images/winner/1.png" alt="image"></div>
                        <div class="content-top">
                          <div class="left">
                            <h5>The Breeze Zodiac IX</h5>
                          </div>
                          <div class="right">
                            <span>Draw took place on</span>
                            <p>Saturday April 20, 2023</p>
                          </div>
                        </div>
                        <div class="content-bottom">
                          <div class="number-list-wrapper">
                            <p>Winning Numbers:</p>
                            <ul class="number-list mt-2">
                              <li>11</li>
                              <li>88</li>
                              <li>23</li>
                              <li>9</li>
                              <li>19</li>
                              <li>26</li>
                              <li>87</li>
                            </ul><!-- number-list end -->
                          </div>
                          <div class="right">
                            <p>Contest No:</p>
                            <span class="contest-num">B2T</span>
                          </div>
                        </div>
                      </div>
                    </div><!-- winner-card end -->
                    <div class="winner-card mb-30">
                      <div class="winner-card__thumb">
                        <img src="assets/images/win-car/2.png" alt="image">
                      </div>
                      <div class="winner-card__content">
                        <div class="winner-thumb"><img src="assets/images/winner/2.png" alt="image"></div>
                        <div class="content-top">
                          <div class="left">
                            <h5>The Breeze Zodiac IX</h5>
                          </div>
                          <div class="right">
                            <span>Draw took place on</span>
                            <p>Saturday April 20, 2023</p>
                          </div>
                        </div>
                        <div class="content-bottom">
                          <div class="number-list-wrapper">
                            <p>Winning Numbers:</p>
                            <ul class="number-list mt-2">
                              <li>11</li>
                              <li>88</li>
                              <li>23</li>
                              <li>9</li>
                              <li>19</li>
                              <li>26</li>
                              <li>87</li>
                            </ul><!-- number-list end -->
                          </div>
                          <div class="right">
                            <p>Contest No:</p>
                            <span class="contest-num">B2T</span>
                          </div>
                        </div>
                      </div>
                    </div><!-- winner-card end -->
                    <div class="winner-card mb-30">
                      <div class="winner-card__thumb">
                        <img src="assets/images/win-car/3.png" alt="image">
                      </div>
                      <div class="winner-card__content">
                        <div class="winner-thumb"><img src="assets/images/winner/3.png" alt="image"></div>
                        <div class="content-top">
                          <div class="left">
                            <h5>The Breeze Zodiac IX</h5>
                          </div>
                          <div class="right">
                            <span>Draw took place on</span>
                            <p>Saturday April 20, 2023</p>
                          </div>
                        </div>
                        <div class="content-bottom">
                          <div class="number-list-wrapper">
                            <p>Winning Numbers:</p>
                            <ul class="number-list mt-2">
                              <li>11</li>
                              <li>88</li>
                              <li>23</li>
                              <li>9</li>
                              <li>19</li>
                              <li>26</li>
                              <li>87</li>
                            </ul><!-- number-list end -->
                          </div>
                          <div class="right">
                            <p>Contest No:</p>
                            <span class="contest-num">B2T</span>
                          </div>
                        </div>
                      </div>
                    </div><!-- winner-card end -->
                    <div class="winner-card mb-30">
                      <div class="winner-card__thumb">
                        <img src="assets/images/win-car/4.png" alt="image">
                      </div>
                      <div class="winner-card__content">
                        <div class="winner-thumb"><img src="assets/images/winner/4.png" alt="image"></div>
                        <div class="content-top">
                          <div class="left">
                            <h5>The Breeze Zodiac IX</h5>
                          </div>
                          <div class="right">
                            <span>Draw took place on</span>
                            <p>Saturday April 20, 2023</p>
                          </div>
                        </div>
                        <div class="content-bottom">
                          <div class="number-list-wrapper">
                            <p>Winning Numbers:</p>
                            <ul class="number-list mt-2">
                              <li>11</li>
                              <li>88</li>
                              <li>23</li>
                              <li>9</li>
                              <li>19</li>
                              <li>26</li>
                              <li>87</li>
                            </ul><!-- number-list end -->
                          </div>
                          <div class="right">
                            <p>Contest No:</p>
                            <span class="contest-num">B2T</span>
                          </div>
                        </div>
                      </div>
                    </div><!-- winner-card end -->
                    <div class="winner-card mb-30">
                      <div class="winner-card__thumb">
                        <img src="assets/images/win-car/5.png" alt="image">
                      </div>
                      <div class="winner-card__content">
                        <div class="winner-thumb"><img src="assets/images/winner/5.png" alt="image"></div>
                        <div class="content-top">
                          <div class="left">
                            <h5>The Breeze Zodiac IX</h5>
                          </div>
                          <div class="right">
                            <span>Draw took place on</span>
                            <p>Saturday April 20, 2023</p>
                          </div>
                        </div>
                        <div class="content-bottom">
                          <div class="number-list-wrapper">
                            <p>Winning Numbers:</p>
                            <ul class="number-list mt-2">
                              <li>11</li>
                              <li>88</li>
                              <li>23</li>
                              <li>9</li>
                              <li>19</li>
                              <li>26</li>
                              <li>87</li>
                            </ul><!-- number-list end -->
                          </div>
                          <div class="right">
                            <p>Contest No:</p>
                            <span class="contest-num">B2T</span>
                          </div>
                        </div>
                      </div>
                    </div><!-- winner-card end -->
                    <div class="winner-card mb-30">
                      <div class="winner-card__thumb">
                        <img src="assets/images/win-car/6.png" alt="image">
                      </div>
                      <div class="winner-card__content">
                        <div class="winner-thumb"><img src="assets/images/winner/6.png" alt="image"></div>
                        <div class="content-top">
                          <div class="left">
                            <h5>The Breeze Zodiac IX</h5>
                          </div>
                          <div class="right">
                            <span>Draw took place on</span>
                            <p>Saturday April 20, 2023</p>
                          </div>
                        </div>
                        <div class="content-bottom">
                          <div class="number-list-wrapper">
                            <p>Winning Numbers:</p>
                            <ul class="number-list mt-2">
                              <li>11</li>
                              <li>88</li>
                              <li>23</li>
                              <li>9</li>
                              <li>19</li>
                              <li>26</li>
                              <li>87</li>
                            </ul><!-- number-list end -->
                          </div>
                          <div class="right">
                            <p>Contest No:</p>
                            <span class="contest-num">B2T</span>
                          </div>
                        </div>
                      </div>
                    </div><!-- winner-card end -->
                    <div class="btn-grp">
                      <a href="winner.html" class="btn-border">browse more</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="laptop" role="tabpanel" aria-labelledby="laptop-tab">
                <div class="row mb-none-30">
                  <div class="col-lg-4 mb-30">
                    <div class="number-check-wrapper">
                      <h3 class="title">Check My Numbers</h3>
                      <p>Are you holding on to a winning ticket? Here's an easy way to find out.</p>
                      <form class="check-number-form">
                        <input type="tel" class="form-control mt-30 mb-30" name="check-number4" id="check-number4" placeholder="Enter Contest No">
                        <div class="number-list-wrapper">
                          <p>Enter Your Lottery Numbers</p>
                          <div class="number-list mt-3 mb-3">
                            <input type="text" name="text22" id="text22" placeholder="00">
                            <input type="text" name="text23" id="text23" placeholder="00">
                            <input type="text" name="text24" id="text24" placeholder="00">
                            <input type="text" name="text25" id="text25" placeholder="00">
                            <input type="text" name="text26" id="text26" placeholder="00">
                            <input type="text" name="text27" id="text27" placeholder="00">
                            <input type="text" name="text28" id="text28" placeholder="00">
                          </div><!-- number-list end -->
                          <select class="nice-select">
                            <option>Last 7 days</option>
                            <option>Last 6 days</option>
                            <option>Last 5 days</option>
                            <option>Last 4 days</option>
                            <option>Last 3 days</option>
                          </select>
                          <div class="text-center mt-100">
                            <button type="submit" class="cmn-btn">check my numbers</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                  <div class="col-lg-8 mb-30">
                    <div class="winner-card mb-30">
                      <div class="winner-card__thumb">
                        <img src="assets/images/win-car/1.png" alt="image">
                      </div>
                      <div class="winner-card__content">
                        <div class="winner-thumb"><img src="assets/images/winner/1.png" alt="image"></div>
                        <div class="content-top">
                          <div class="left">
                            <h5>The Breeze Zodiac IX</h5>
                          </div>
                          <div class="right">
                            <span>Draw took place on</span>
                            <p>Saturday April 20, 2023</p>
                          </div>
                        </div>
                        <div class="content-bottom">
                          <div class="number-list-wrapper">
                            <p>Winning Numbers:</p>
                            <ul class="number-list mt-2">
                              <li>11</li>
                              <li>88</li>
                              <li>23</li>
                              <li>9</li>
                              <li>19</li>
                              <li>26</li>
                              <li>87</li>
                            </ul><!-- number-list end -->
                          </div>
                          <div class="right">
                            <p>Contest No:</p>
                            <span class="contest-num">B2T</span>
                          </div>
                        </div>
                      </div>
                    </div><!-- winner-card end -->
                    <div class="winner-card mb-30">
                      <div class="winner-card__thumb">
                        <img src="assets/images/win-car/2.png" alt="image">
                      </div>
                      <div class="winner-card__content">
                        <div class="winner-thumb"><img src="assets/images/winner/2.png" alt="image"></div>
                        <div class="content-top">
                          <div class="left">
                            <h5>The Breeze Zodiac IX</h5>
                          </div>
                          <div class="right">
                            <span>Draw took place on</span>
                            <p>Saturday April 20, 2023</p>
                          </div>
                        </div>
                        <div class="content-bottom">
                          <div class="number-list-wrapper">
                            <p>Winning Numbers:</p>
                            <ul class="number-list mt-2">
                              <li>11</li>
                              <li>88</li>
                              <li>23</li>
                              <li>9</li>
                              <li>19</li>
                              <li>26</li>
                              <li>87</li>
                            </ul><!-- number-list end -->
                          </div>
                          <div class="right">
                            <p>Contest No:</p>
                            <span class="contest-num">B2T</span>
                          </div>
                        </div>
                      </div>
                    </div><!-- winner-card end -->
                    <div class="winner-card mb-30">
                      <div class="winner-card__thumb">
                        <img src="assets/images/win-car/3.png" alt="image">
                      </div>
                      <div class="winner-card__content">
                        <div class="winner-thumb"><img src="assets/images/winner/3.png" alt="image"></div>
                        <div class="content-top">
                          <div class="left">
                            <h5>The Breeze Zodiac IX</h5>
                          </div>
                          <div class="right">
                            <span>Draw took place on</span>
                            <p>Saturday April 20, 2023</p>
                          </div>
                        </div>
                        <div class="content-bottom">
                          <div class="number-list-wrapper">
                            <p>Winning Numbers:</p>
                            <ul class="number-list mt-2">
                              <li>11</li>
                              <li>88</li>
                              <li>23</li>
                              <li>9</li>
                              <li>19</li>
                              <li>26</li>
                              <li>87</li>
                            </ul><!-- number-list end -->
                          </div>
                          <div class="right">
                            <p>Contest No:</p>
                            <span class="contest-num">B2T</span>
                          </div>
                        </div>
                      </div>
                    </div><!-- winner-card end -->
                    <div class="winner-card mb-30">
                      <div class="winner-card__thumb">
                        <img src="assets/images/win-car/4.png" alt="image">
                      </div>
                      <div class="winner-card__content">
                        <div class="winner-thumb"><img src="assets/images/winner/4.png" alt="image"></div>
                        <div class="content-top">
                          <div class="left">
                            <h5>The Breeze Zodiac IX</h5>
                          </div>
                          <div class="right">
                            <span>Draw took place on</span>
                            <p>Saturday April 20, 2023</p>
                          </div>
                        </div>
                        <div class="content-bottom">
                          <div class="number-list-wrapper">
                            <p>Winning Numbers:</p>
                            <ul class="number-list mt-2">
                              <li>11</li>
                              <li>88</li>
                              <li>23</li>
                              <li>9</li>
                              <li>19</li>
                              <li>26</li>
                              <li>87</li>
                            </ul><!-- number-list end -->
                          </div>
                          <div class="right">
                            <p>Contest No:</p>
                            <span class="contest-num">B2T</span>
                          </div>
                        </div>
                      </div>
                    </div><!-- winner-card end -->
                    <div class="winner-card mb-30">
                      <div class="winner-card__thumb">
                        <img src="assets/images/win-car/5.png" alt="image">
                      </div>
                      <div class="winner-card__content">
                        <div class="winner-thumb"><img src="assets/images/winner/5.png" alt="image"></div>
                        <div class="content-top">
                          <div class="left">
                            <h5>The Breeze Zodiac IX</h5>
                          </div>
                          <div class="right">
                            <span>Draw took place on</span>
                            <p>Saturday April 20, 2023</p>
                          </div>
                        </div>
                        <div class="content-bottom">
                          <div class="number-list-wrapper">
                            <p>Winning Numbers:</p>
                            <ul class="number-list mt-2">
                              <li>11</li>
                              <li>88</li>
                              <li>23</li>
                              <li>9</li>
                              <li>19</li>
                              <li>26</li>
                              <li>87</li>
                            </ul><!-- number-list end -->
                          </div>
                          <div class="right">
                            <p>Contest No:</p>
                            <span class="contest-num">B2T</span>
                          </div>
                        </div>
                      </div>
                    </div><!-- winner-card end -->
                    <div class="winner-card mb-30">
                      <div class="winner-card__thumb">
                        <img src="assets/images/win-car/6.png" alt="image">
                      </div>
                      <div class="winner-card__content">
                        <div class="winner-thumb"><img src="assets/images/winner/6.png" alt="image"></div>
                        <div class="content-top">
                          <div class="left">
                            <h5>The Breeze Zodiac IX</h5>
                          </div>
                          <div class="right">
                            <span>Draw took place on</span>
                            <p>Saturday April 20, 2023</p>
                          </div>
                        </div>
                        <div class="content-bottom">
                          <div class="number-list-wrapper">
                            <p>Winning Numbers:</p>
                            <ul class="number-list mt-2">
                              <li>11</li>
                              <li>88</li>
                              <li>23</li>
                              <li>9</li>
                              <li>19</li>
                              <li>26</li>
                              <li>87</li>
                            </ul><!-- number-list end -->
                          </div>
                          <div class="right">
                            <p>Contest No:</p>
                            <span class="contest-num">B2T</span>
                          </div>
                        </div>
                      </div>
                    </div><!-- winner-card end -->
                    <div class="btn-grp">
                      <a href="winner.html" class="btn-border">browse more</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="money" role="tabpanel" aria-labelledby="money-tab">
                <div class="row mb-none-30">
                  <div class="col-lg-4 mb-30">
                    <div class="number-check-wrapper">
                      <h3 class="title">Check My Numbers</h3>
                      <p>Are you holding on to a winning ticket? Here's an easy way to find out.</p>
                      <form class="check-number-form">
                        <input type="tel" class="form-control mt-30 mb-30" name="check-number5" id="check-number5" placeholder="Enter Contest No">
                        <div class="number-list-wrapper">
                          <p>Enter Your Lottery Numbers</p>
                          <div class="number-list mt-3 mb-3">
                            <input type="text" name="text29" id="text29" placeholder="00">
                            <input type="text" name="text30" id="text30" placeholder="00">
                            <input type="text" name="text31" id="text31" placeholder="00">
                            <input type="text" name="text32" id="text32" placeholder="00">
                            <input type="text" name="text33" id="text33" placeholder="00">
                            <input type="text" name="text34" id="text34" placeholder="00">
                            <input type="text" name="text35" id="text35" placeholder="00">
                          </div><!-- number-list end -->
                          <select class="nice-select">
                            <option>Last 7 days</option>
                            <option>Last 6 days</option>
                            <option>Last 5 days</option>
                            <option>Last 4 days</option>
                            <option>Last 3 days</option>
                          </select>
                          <div class="text-center mt-100">
                            <button type="submit" class="cmn-btn">check my numbers</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                  <div class="col-lg-8 mb-30">
                    <div class="winner-card mb-30">
                      <div class="winner-card__thumb">
                        <img src="assets/images/win-car/4.png" alt="image">
                      </div>
                      <div class="winner-card__content">
                        <div class="winner-thumb"><img src="assets/images/winner/1.png" alt="image"></div>
                        <div class="content-top">
                          <div class="left">
                            <h5>The Breeze Zodiac IX</h5>
                          </div>
                          <div class="right">
                            <span>Draw took place on</span>
                            <p>Saturday April 20, 2023</p>
                          </div>
                        </div>
                        <div class="content-bottom">
                          <div class="number-list-wrapper">
                            <p>Winning Numbers:</p>
                            <ul class="number-list mt-2">
                              <li>11</li>
                              <li>88</li>
                              <li>23</li>
                              <li>9</li>
                              <li>19</li>
                              <li>26</li>
                              <li>87</li>
                            </ul><!-- number-list end -->
                          </div>
                          <div class="right">
                            <p>Contest No:</p>
                            <span class="contest-num">B2T</span>
                          </div>
                        </div>
                      </div>
                    </div><!-- winner-card end -->
                    <div class="winner-card mb-30">
                      <div class="winner-card__thumb">
                        <img src="assets/images/win-car/2.png" alt="image">
                      </div>
                      <div class="winner-card__content">
                        <div class="winner-thumb"><img src="assets/images/winner/2.png" alt="image"></div>
                        <div class="content-top">
                          <div class="left">
                            <h5>The Breeze Zodiac IX</h5>
                          </div>
                          <div class="right">
                            <span>Draw took place on</span>
                            <p>Saturday April 20, 2023</p>
                          </div>
                        </div>
                        <div class="content-bottom">
                          <div class="number-list-wrapper">
                            <p>Winning Numbers:</p>
                            <ul class="number-list mt-2">
                              <li>11</li>
                              <li>88</li>
                              <li>23</li>
                              <li>9</li>
                              <li>19</li>
                              <li>26</li>
                              <li>87</li>
                            </ul><!-- number-list end -->
                          </div>
                          <div class="right">
                            <p>Contest No:</p>
                            <span class="contest-num">B2T</span>
                          </div>
                        </div>
                      </div>
                    </div><!-- winner-card end -->
                    <div class="winner-card mb-30">
                      <div class="winner-card__thumb">
                        <img src="assets/images/win-car/3.png" alt="image">
                      </div>
                      <div class="winner-card__content">
                        <div class="winner-thumb"><img src="assets/images/winner/3.png" alt="image"></div>
                        <div class="content-top">
                          <div class="left">
                            <h5>The Breeze Zodiac IX</h5>
                          </div>
                          <div class="right">
                            <span>Draw took place on</span>
                            <p>Saturday April 20, 2023</p>
                          </div>
                        </div>
                        <div class="content-bottom">
                          <div class="number-list-wrapper">
                            <p>Winning Numbers:</p>
                            <ul class="number-list mt-2">
                              <li>11</li>
                              <li>88</li>
                              <li>23</li>
                              <li>9</li>
                              <li>19</li>
                              <li>26</li>
                              <li>87</li>
                            </ul><!-- number-list end -->
                          </div>
                          <div class="right">
                            <p>Contest No:</p>
                            <span class="contest-num">B2T</span>
                          </div>
                        </div>
                      </div>
                    </div><!-- winner-card end -->
                    <div class="winner-card mb-30">
                      <div class="winner-card__thumb">
                        <img src="assets/images/win-car/4.png" alt="image">
                      </div>
                      <div class="winner-card__content">
                        <div class="winner-thumb"><img src="assets/images/winner/4.png" alt="image"></div>
                        <div class="content-top">
                          <div class="left">
                            <h5>The Breeze Zodiac IX</h5>
                          </div>
                          <div class="right">
                            <span>Draw took place on</span>
                            <p>Saturday April 20, 2023</p>
                          </div>
                        </div>
                        <div class="content-bottom">
                          <div class="number-list-wrapper">
                            <p>Winning Numbers:</p>
                            <ul class="number-list mt-2">
                              <li>11</li>
                              <li>88</li>
                              <li>23</li>
                              <li>9</li>
                              <li>19</li>
                              <li>26</li>
                              <li>87</li>
                            </ul><!-- number-list end -->
                          </div>
                          <div class="right">
                            <p>Contest No:</p>
                            <span class="contest-num">B2T</span>
                          </div>
                        </div>
                      </div>
                    </div><!-- winner-card end -->
                    <div class="winner-card mb-30">
                      <div class="winner-card__thumb">
                        <img src="assets/images/win-car/5.png" alt="image">
                      </div>
                      <div class="winner-card__content">
                        <div class="winner-thumb"><img src="assets/images/winner/5.png" alt="image"></div>
                        <div class="content-top">
                          <div class="left">
                            <h5>The Breeze Zodiac IX</h5>
                          </div>
                          <div class="right">
                            <span>Draw took place on</span>
                            <p>Saturday April 20, 2023</p>
                          </div>
                        </div>
                        <div class="content-bottom">
                          <div class="number-list-wrapper">
                            <p>Winning Numbers:</p>
                            <ul class="number-list mt-2">
                              <li>11</li>
                              <li>88</li>
                              <li>23</li>
                              <li>9</li>
                              <li>19</li>
                              <li>26</li>
                              <li>87</li>
                            </ul><!-- number-list end -->
                          </div>
                          <div class="right">
                            <p>Contest No:</p>
                            <span class="contest-num">B2T</span>
                          </div>
                        </div>
                      </div>
                    </div><!-- winner-card end -->
                    <div class="winner-card mb-30">
                      <div class="winner-card__thumb">
                        <img src="assets/images/win-car/6.png" alt="image">
                      </div>
                      <div class="winner-card__content">
                        <div class="winner-thumb"><img src="assets/images/winner/6.png" alt="image"></div>
                        <div class="content-top">
                          <div class="left">
                            <h5>The Breeze Zodiac IX</h5>
                          </div>
                          <div class="right">
                            <span>Draw took place on</span>
                            <p>Saturday April 20, 2023</p>
                          </div>
                        </div>
                        <div class="content-bottom">
                          <div class="number-list-wrapper">
                            <p>Winning Numbers:</p>
                            <ul class="number-list mt-2">
                              <li>11</li>
                              <li>88</li>
                              <li>23</li>
                              <li>9</li>
                              <li>19</li>
                              <li>26</li>
                              <li>87</li>
                            </ul><!-- number-list end -->
                          </div>
                          <div class="right">
                            <p>Contest No:</p>
                            <span class="contest-num">B2T</span>
                          </div>
                        </div>
                      </div>
                    </div><!-- winner-card end -->
                    <div class="btn-grp">
                      <a href="winner.html" class="btn-border">browse more</a>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- tab-content end -->
          </div>
        </div><!-- row end -->
      </div>
    </section>
    <!-- latest winner section end  -->

    <!-- overview section start -->
    <section class="overview-section pt-120">
      <div class="map-el"><img src="assets/images/elements/map.png" alt="image"></div>
      <div class="obj-1"><img src="assets/images/elements/overview-obj-1.png" alt="image"></div>
      <div class="obj-2"><img src="assets/images/elements/overview-obj-2.png" alt="image"></div>
      <div class="obj-3"><img src="assets/images/elements/overview-obj-3.png" alt="image"></div>
      <div class="obj-4"><img src="assets/images/elements/overview-obj-4.png" alt="image"></div>

      <div class="container">
        <div class="row justify-content-center">
          <div class="col-xl-7 col-lg-8 col-md-10 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.3s">
            <div class="section-header text-center">
              <span class="section-sub-title">Our Users Around the World</span>
              <h2 class="section-title">Let the number speak for us</h2>
              <p>Over the years we have provided millions of players with tickets to lotteries across the globe and enjoyed having more than one million winners</p>
            </div>
          </div>
        </div><!-- row end -->
      </div><!-- container end -->
      <div class="map-pointer">
        <div class="pointer num-1"></div>
        <div class="pointer num-2"></div>
        <div class="pointer num-3"></div>
        <div class="pointer num-4"></div>
        <div class="pointer num-5"></div>
        <div class="pointer num-6"></div>
        <div class="pointer num-7"></div>
        <div class="pointer num-8"></div>
        <div class="pointer num-9"></div>
      </div>

      <div class="container">
        <div class="row justify-content-center mb-none-30">
          <div class="col-lg-4 col-sm-6 mb-30 wow bounceIn" data-wow-duration="0.5s" data-wow-delay="0.3s">
            <div class="overview-card hover--effect-1">
              <div class="overview-card__icon">
                <img src="assets/images/icon/overview/1.png" alt="">
              </div>
              <div class="overview-card__content">
                <span class="number">12000+</span>
                <p>Verified Users</p>
              </div>
            </div><!-- overview-card end -->
          </div>
          <div class="col-lg-4 col-sm-6 mb-30 wow bounceIn" data-wow-duration="0.5s" data-wow-delay="0.5s">
            <div class="overview-card hover--effect-1">
              <div class="overview-card__icon">
                <img src="assets/images/icon/overview/2.png" alt="">
              </div>
              <div class="overview-card__content">
                <span class="number">13</span>
                <p>Years on the market</p>
              </div>
            </div><!-- overview-card end -->
          </div>
          <div class="col-lg-4 col-sm-6 mb-30 wow bounceIn" data-wow-duration="0.5s" data-wow-delay="0.7s">
            <div class="overview-card hover--effect-1">
              <div class="overview-card__icon">
                <img src="assets/images/icon/overview/3.png" alt="">
              </div>
              <div class="overview-card__content">
                <span class="number">98%</span>
                <p>Customer Satisfaction</p>
              </div>
            </div><!-- overview-card end -->
          </div>
        </div>
      </div><!-- container end -->
    </section>
    <!-- overview section end -->

    <!-- features section start -->
    <section class="pt-120 pb-120">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6 order-lg-1 order-2">
            <div class="row mb-none-30">
              <div class="col-lg-6 mb-30">
                <div class="row mb-none-30">
                  <div class="col-lg-12 col-md-6 mb-30 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.3s">
                    <div class="feature-card hover--effect-1">
                      <div class="feature-card__icon">
                        <img src="assets/images/icon/feature/1.png" alt="image">
                      </div>
                      <div class="feature-card__content">
                        <h3 class="feature-title">Safe Service</h3>
                        <p>Nulla ultricies in nulla ac efficitur. In vel neque arcu. Donec quis</p>
                      </div>
                    </div><!-- feature-card end -->
                  </div><!-- feature-card end -->
                  <div class="col-lg-12 col-md-6 mb-30 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.5s">
                    <div class="feature-card hover--effect-1">
                      <div class="feature-card__icon">
                        <img src="assets/images/icon/feature/3.png" alt="image">
                      </div>
                      <div class="feature-card__content">
                        <h3 class="feature-title">Network</h3>
                        <p>Nulla ultricies in nulla ac efficitur. In vel neque arcu. Donec quis</p>
                      </div>
                    </div><!-- feature-card end -->
                  </div><!-- feature-card end -->
                </div>
              </div>
              <div class="col-lg-6 mb-30 mt-lg-5">
                <div class="row mb-none-30">
                  <div class="col-lg-12 col-md-6 mb-30 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.3s">
                    <div class="feature-card hover--effect-1">
                      <div class="feature-card__icon">
                        <img src="assets/images/icon/feature/2.png" alt="image">
                      </div>
                      <div class="feature-card__content">
                        <h3 class="feature-title">Security</h3>
                        <p>Nulla ultricies in nulla ac efficitur. In vel neque arcu. Donec quis</p>
                      </div>
                    </div><!-- feature-card end -->
                  </div><!-- feature-card end -->
                  <div class="col-lg-12 col-md-6 mb-30 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.5s">
                    <div class="feature-card hover--effect-1">
                      <div class="feature-card__icon">
                        <img src="assets/images/icon/feature/4.png" alt="image">
                      </div>
                      <div class="feature-card__content">
                        <h3 class="feature-title">Support</h3>
                        <p>Nulla ultricies in nulla ac efficitur. In vel neque arcu. Donec quis</p>
                      </div>
                    </div><!-- feature-card end -->
                  </div><!-- feature-card end -->
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6 order-lg-2 order-1 text-lg-start text-center wow fadeInRight" data-wow-duration="0.5s" data-wow-delay="0.5s">
            <div class="section-header">
              <span class="section-sub-title">An Exhaustive list of</span>
              <h2 class="section-title">Our features.</h2>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In pretium, elit quis vehicula interdum, sem metus iaculis sapien, sed bibendum lectus augue eu metus.</p>
              <a href="#0" class="d-flex align-items-center mt-3 justify-content-lg-start justify-content-center">Show all features<i class="las la-angle-double-right text-danger"></i></a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- features section end -->

    <!-- testimonial section start -->
    <section class="has-bg--shape pt-120 pb-120">
      <div class="bg-shape">
        <div class="round-shape d-sm-block d-none"><img src="assets/images/elements/round-shape.png" alt="image"></div>
        <div class="shape-1"></div>
        <div class="shape-2"></div>
        <div class="shape-3"></div>
        <div class="shape-4"></div>
        <div class="shape-5"></div>
        <div class="shape-6"></div>
      </div>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-xl-8 col-lg-9 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.3s">
            <div class="section-header text-center">
              <span class="section-sub-title">Testimonial</span>
              <h2 class="section-title">our Happy Customers All Around the World</h2>
              <p>With over 12 years of experience as the world’s leading online lottery service provider. Find out what our members have to say about us!</p>
            </div>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-lg-8">
            <div class="testimonial-area bg_img" data-background="assets/images/elements/testimonial-single.jpg">
              <div class="testimonial-slider">
                <div class="testimonial-single">
                  <div class="testimonial-single__thumb">
                    <img src="assets/images/winner/2.png" alt="image">
                  </div>
                  <div class="testimonial-single__content">
                    <h4 class="client-name">Dave Ford</h4>
                    <p>“Unbelievable this is a dream come true,no way would I ever think I would own a car like this” </p>
                    <div class="ratings">
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                    </div>
                  </div>
                </div><!-- testimonial-single end -->
                <div class="testimonial-single">
                  <div class="testimonial-single__thumb">
                    <img src="assets/images/winner/1.png" alt="image">
                  </div>
                  <div class="testimonial-single__content">
                    <h4 class="client-name">Dave Ford</h4>
                    <p>“Unbelievable this is a dream come true,no way would I ever think I would own a car like this” </p>
                    <div class="ratings">
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                    </div>
                  </div>
                </div><!-- testimonial-single end -->
              </div><!-- testimonial-slider end -->
            </div><!-- testimonial-area end -->
          </div>
        </div>
      </div>
    </section>
    <!-- testimonial section end -->

    <!-- support section start  -->
    <section class="pb-120">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8">
            <div class="section-header text-center">
              <span class="section-sub-title">Get in touch with our friendly support</span>
              <h2 class="section-title">Customer Support</h2>
              <p>Have a question or need help? Contact our friendly support team.</p>
            </div>
          </div>
        </div>
        <div class="row mb-none-30">
          <div class="col-lg-6 mb-30 wow zoomIn" data-wow-duration="0.5s" data-wow-delay="0.3s">
            <div class="support-card">
              <div class="support-card__thumb">
                <img src="assets/images/icon/support/1.png" alt="image">
              </div>
              <div class="support-card__content">
                <h3 class="support-card__title">Talk to our support team</h3>
                <p>Got a question about Lotteries? Get in touch with our friendly staff.</p>
                <div class="btn-grp justify-content-xl-start mt-3">
                  <a href="tel:6564545" class="btn-border btn-sm text-capitalize">Call us <i class="fas fa-phone-alt"></i></a>
                  <a href="/cdn-cgi/l/email-protection#f5919d919fb59298949c99db969a98" class="cmn-btn btn-sm text-capitalize">Email us <i class="far fa-envelope"></i></a>
                </div>
              </div>
            </div><!-- support-card end -->
          </div>
          <div class="col-lg-6 mb-30 wow zoomIn" data-wow-duration="0.5s" data-wow-delay="0.5s">
            <div class="support-card">
              <div class="support-card__thumb">
                <img src="assets/images/icon/support/2.png" alt="image">
              </div>
              <div class="support-card__content">
                <h3 class="support-card__title">Our Guide to Rifa</h3>
                <p>Check out our FAQs to see if we can help you out. </p>
                <div class="btn-grp justify-content-xl-start mt-3">
                  <a href="faq.html" class="btn-border btn-sm text-capitalize">FAQs & Help</a>
                </div>
              </div>
            </div><!-- support-card end -->
          </div>
        </div>
      </div>
    </section>
    <!-- support section end  -->

      <!-- footer section start  -->
  <footer class="footer-section">
    <div class="bg-shape--top"><img src="assets/images/elements/round-shape-2.png" alt="image"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-12 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.7s">
          <div class="subscribe-area">
            <div class="left">
              <span class="subtitle">Subscribe to Sorko</span>
              <h3 class="title">To Get Exclusive Benefits</h3>
            </div>
            <div class="right">
              <form class="subscribe-form">
                <input type="email" name="subscribe_email" id="subscribe_email" placeholder="Enter Your Email">
                <button type="submit">Subscribe</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container pt-120">
      <div class="row pb-5 align-items-center">
        <div class="col-lg-4">
          <ul class="app-btn">
            <li><a href="#0"><img src="assets/images/icon/store-btn/1.png" alt="image"></a></li>
            <li><a href="#0"><img src="assets/images/icon/store-btn/2.png" alt="image"></a></li>
          </ul>
        </div>
        <div class="col-lg-8">
          <ul class="short-links justify-content-lg-end justify-content-center">
            <li><a href="#0">Abount</a></li>
            <li><a href="#0">FAQs</a></li>
            <li><a href="#0">Contact</a></li>
            <li><a href="#0">Terms of Services</a></li>
            <li><a href="#0">Privacy</a></li>
          </ul>
        </div>
      </div>
      <hr>
      <div class="row py-5 align-items-center">
        <div class="col-lg-6">
          <p class="copy-right-text text-lg-start text-center mb-lg-0 mb-3">Copyright © 2023.All Rights Reserved By <a href="index.html">Rifa</a></p>
        </div>
        <div class="col-lg-6">
          <ul class="social-links justify-content-lg-end justify-content-center">
            <li><a href="#0"><i class="fab fa-facebook-f"></i></a></li>
            <li><a href="#0"><i class="fab fa-twitter"></i></a></li>
            <li><a href="#0"><i class="fab fa-linkedin-in"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
  </footer>
  <!-- footer section end -->
  </div>
  <!-- page-wrapper end -->
  <!-- jQuery library -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <!-- bootstrap js -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/js/all.min.js" integrity="sha512-LW9+kKj/cBGHqnI4ok24dUWNR/e8sUD8RLzak1mNw5Ja2JYCmTXJTF5VpgFSw+VoBfpMvPScCo2DnKTIUjrzYw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!-- custom select js -->
  <!-- <script src="assets/js/vendor/jquery.nice-select.min.js"></script>  -->
  <!-- lightcase js -->
  <!-- <script src="assets/js/vendor/lightcase.js"></script> -->
  <!-- wow js -->
  <!-- <script src="assets/js/vendor/wow.min.js"></script> -->
  <!-- slick slider js -->
  <!-- <script src="assets/js/vendor/slick.min.js"></script> -->
  <!-- countdown js -->
  <!-- <script src="assets/js/vendor/jquery.countdown.js"></script> -->
  <!-- jquery ui js -->
  <!-- <script src="assets/js/vendor/jquery-ui.min.js"></script> -->
  <!-- datepicker js -->
  <!-- <script src="assets/js/vendor/datepicker.min.js"></script> -->
  <!-- <script src="assets/js/vendor/datepicker.en.js"></script> -->
  <!-- preloader -->
  <!-- <script src='assets/js/vendor/TweenMax.min.js'></script> -->
  <!-- <script src='assets/js/vendor/MorphSVGPlugin.min.js'></script> -->
  <!-- <script src="assets/js/preloader.js"></script> -->
  <!-- contact js -->
  <!-- <script src="assets/js/contact.js"></script> -->
  <!-- custom js -->
  <script src="assets/js/app.js"></script>
  </body>
</html>
