@extends('_partials.master_trans')
@section('content')
    <!-- start: cookie -->
    <div class="cookie-policy">
        <div class="container">
            <span class="color-main-dark font-size-13">{{ getLocale($locale, 'label-cookie', '') }} <a href="#">{{ getLocale($locale, 'link-cookie', '') }}.</span>
            <a class="close-btn" href="javascript:closeCookie();">
            <i class="fas fa-times"></i>
            </a>
        </div>
    </div>
    <!-- end: cookie -->

    <!-- start: home -->
    <section class="section-content d-flex flex-column flex-wrap justify-content-center vh-min-100 background-gradient-1">
      <div class=""></div>
      <button class="btn-chat background-primary">
        <i class="fas fa-comment-alt"></i>
      </button>
      <!-- start: home slider -->
      <div id="homeSlider" >
        <div class="home-slider">
          <div class="home-slider-item">
            <img src="../img/homepage/background/{{ $background }}" class="d-block w-100" alt="Slider">
          </div>
          <!-- <div class="carousel-item active">
            <img src="../img/slide-2.jpg" class="d-block w-100" alt="...">
          </div> -->
        </div>
      </div>
      <!-- end: home -->
      <div class="hero-filter position-absolute">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="home-search">
                <h1 class="main-heading mb-55">
                  {!! $title !!}
                </h1>
                <div class="input-group input-homepage">
                  <div class="input-group-prepend searchbox-trigger">
                    <span class="input-group-text">A</span>
                  </div>
                  <input type="text" class="form-control searchbox-trigger searchbox-value border-0" placeholder="Enter location or property name ...">
                  <div class="input-group-prepend">
                    <span class="input-group-icon d-flex align-items-center background-white pr-15"><i class="fas fa-times"></i></span>
                    <span class="input-group-icon d-flex align-items-center background-white pr-10"><i class="fas fa-bullseye"></i></span>
                    <button type="button" class="btn btn-primary searchbox-btn">Discover</button>
                  </div>
                </div>
                <p class="text-uppercase recent-search font-size-12 mb-10">recent searches</p>
                <div class="mb-15 btn-group-toggle" data-toggle="buttons">
                  <label class="btn btn-checkbox btn-rounded btn-outline-primary btn-overlay mr-10 mb-10"><input type="checkbox" />Menteng</label>
                  <label class="btn btn-checkbox btn-rounded btn-outline-primary btn-overlay mr-10 mb-10"><input type="checkbox" />1Park Residences</label>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- end: home -->
    <!-- start: most viewed listings -->
    <section class="section-content background-aqua py-65">
      <!-- <div class="background-shadow"></div> -->
      <div class="container prop-content">
        <div class="row">
          <div class="col-12">
            <h3 class="font-size-34 font-weight-bold mb-150 pt-20 pl-xl-55">Properties recommended by us</h3>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-12 slider-viewed-listings">
            <div class="owl-carousel main-listings">
              <!-- start: property item -->
              <div class="col-12 property-wrapper">
                <div class="property-item">
                  <div id="" class="pp-images position-relative">
                    <div class="image-wrapper-1">
                      <div class="image-sizing-1">
                        <img src="../img/slide-1.jpg" alt="image">
                      </div>
                    </div>
                    <div class="image-wrapper-2">
                      <div class="image-sizing-2">
                        <a href="">
                          <img src="../img/slide-2.jpg" alt="image">
                        </a>
                        <span class="main-tag">#modern</span>
                      </div>
                    </div>
                    <div class="image-wrapper-3">
                      <div class="image-sizing-3">
                        <img src="../img/slide-3.jpg" alt="image">
                      </div>
                    </div>
                  </div>
                  <div class="pp-detail">
                    <div class="row">
                      <div class="col-md-10 col-12">
                        <div class="pp-highlight">
                          <div class="pp-tags">
                            <span class="card-tag">Co Living</span>
                            <span class="card-tag card-tag-outline">Entire House</span>
                          </div>
                          <h4 class="pp-title">Amazing City Escape - Cipete Utara</h4>
                          <p class="pp-location">Menteng, Jakarta Pusat</p>
                          <p class="pp-price">Starting from <strong>Rp 5,260,000 per Month</strong></p>
                        </div>
                        <div class="pp-spec d-flex flex-row flex-wrap">
                          <span class="pp-rates">
                            <span class="pp-stars">4.5</span>
                            <i class="fas fa-star text-color-orange"></i>
                            <span class="pp-raters color-light-brown pl-2">(35)</span>
                          </span>
                          <span class="pp-landsize d-flex flex-row flex-wrap justify-content-start align-items-center">
                            <img src="../img/pp-landsize.jpg" alt="Landsize">
                            <span>169.4m<sup>2</sup></span>
                          </span>
                          <span class="pp-room d-flex flex-row flex-wrap justify-content-start align-items-center">
                            <img src="../img/pp-room.jpg" alt="Room">
                            <span class="font-weight-bold">2</span>/
                            <span>8</span>
                          </span>
                          <span class="pp-bed d-flex flex-row flex-wrap justify-content-start align-items-center">
                            <img src="../img/pp-bed.jpg" alt="Bed">
                            <span>3</span>
                          </span>
                        </div>
                      </div>
                      <div class="col-md-2 col-12 d-flex flex-md-column flex-row flex-wrap align-items-md-end align-items-center justify-content-md-end justify-content-between mt-md-0 mt-10">
                        <button class="btn btn-icon-small btn-favorite background-white mb-auto mt-md-40">
                          <i class="far fa-heart icon icon-small"></i>
                        </button>
                        <a href="#" class="outline-none font-weight-bold">Details</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end: property item -->
              <!-- start: property item -->
              <div class="col-12 property-wrapper">
                <div class="property-item">
                  <div id="" class="pp-images position-relative">
                  <div class="image-wrapper-1">
                      <div class="image-sizing-1">
                        <img src="../img/slide-1.jpg" alt="image">
                      </div>
                    </div>
                    <div class="image-wrapper-2">
                      <div class="image-sizing-2">
                        <img src="../img/slide-2.jpg" alt="image">
                        <span class="main-tag">#modern</span>
                      </div>
                    </div>
                    <div class="image-wrapper-3">
                      <div class="image-sizing-3">
                        <img src="../img/slide-3.jpg" alt="image">
                      </div>
                    </div>
                  </div>
                  <div class="pp-detail">
                    <div class="row">
                      <div class="col-md-10 col-12">
                        <div class="pp-highlight">
                          <div class="pp-tags">
                            <span class="card-tag">Co Living</span>
                            <span class="card-tag card-tag-outline">Entire House</span>
                          </div>
                          <h4 class="pp-title">Amazing City Escape - Cipete Utara</h4>
                          <p class="pp-location">Menteng, Jakarta Pusat</p>
                          <p class="pp-price">Starting from <strong>Rp 5,260,000 per Month</strong></p>
                        </div>
                        <div class="pp-spec d-flex flex-row flex-wrap">
                          <span class="pp-rates">
                            <span class="pp-stars">4.5</span>
                            <i class="fas fa-star text-color-orange"></i>
                            <span class="pp-raters color-light-brown pl-2">(35)</span>
                          </span>
                          <span class="pp-landsize d-flex flex-row flex-wrap justify-content-start align-items-center">
                            <img src="../img/pp-landsize.jpg" alt="Landsize">
                            <span>169.4m<sup>2</sup></span>
                          </span>
                          <span class="pp-room d-flex flex-row flex-wrap justify-content-start align-items-center">
                            <img src="../img/pp-room.jpg" alt="Room">
                            <span class="font-weight-bold">2</span>/
                            <span>8</span>
                          </span>
                          <span class="pp-bed d-flex flex-row flex-wrap justify-content-start align-items-center">
                            <img src="../img/pp-bed.jpg" alt="Bed">
                            <span>3</span>
                          </span>
                        </div>
                      </div>
                      <div class="col-md-2 col-12 d-flex flex-md-column flex-row flex-wrap align-items-md-end align-items-center justify-content-md-end justify-content-between mt-md-0 mt-10">
                        <button class="btn btn-icon-small btn-favorite background-white mb-auto mt-md-40">
                          <i class="far fa-heart icon icon-small"></i>
                        </button>
                        <a href="#" class="outline-none font-weight-bold">Details</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end: property item -->
              <!-- start: property item -->
              <div class="col-12 property-wrapper">
                <div class="property-item">
                  <div id="" class="pp-images position-relative">
                    <div class="image-wrapper-1">
                      <div class="image-sizing-1">
                        <img src="../img/slide-1.jpg" alt="image">
                      </div>
                    </div>
                    <div class="image-wrapper-2">
                      <div class="image-sizing-2">
                        <img src="../img/slide-2.jpg" alt="image">
                        <span class="main-tag">#modern</span>
                      </div>
                    </div>
                    <div class="image-wrapper-3">
                      <div class="image-sizing-3">
                        <img src="../img/slide-3.jpg" alt="image">
                      </div>
                    </div>
                  </div>
                  <div class="pp-detail">
                    <div class="row">
                      <div class="col-md-10 col-12">
                        <div class="pp-highlight">
                          <div class="pp-tags">
                            <span class="card-tag">Co Living</span>
                            <span class="card-tag card-tag-outline">Entire House</span>
                          </div>
                          <h4 class="pp-title">Amazing City Escape - Cipete Utara</h4>
                          <p class="pp-location">Menteng, Jakarta Pusat</p>
                          <p class="pp-price">Starting from <strong>Rp 5,260,000 per Month</strong></p>
                        </div>
                        <div class="pp-spec d-flex flex-row flex-wrap">
                          <span class="pp-rates">
                            <span class="pp-stars">4.5</span>
                            <i class="fas fa-star text-color-orange"></i>
                            <span class="pp-raters color-light-brown pl-2">(35)</span>
                          </span>
                          <span class="pp-landsize d-flex flex-row flex-wrap justify-content-start align-items-center">
                            <img src="../img/pp-landsize.jpg" alt="Landsize">
                            <span>169.4m<sup>2</sup></span>
                          </span>
                          <span class="pp-room d-flex flex-row flex-wrap justify-content-start align-items-center">
                            <img src="../img/pp-room.jpg" alt="Room">
                            <span class="font-weight-bold">2</span>/
                            <span>8</span>
                          </span>
                          <span class="pp-bed d-flex flex-row flex-wrap justify-content-start align-items-center">
                            <img src="../img/pp-bed.jpg" alt="Bed">
                            <span>3</span>
                          </span>
                        </div>
                      </div>
                      <div class="col-md-2 col-12 d-flex flex-md-column flex-row flex-wrap align-items-md-end align-items-center justify-content-md-end justify-content-between mt-md-0 mt-10">
                        <button class="btn btn-icon-small btn-favorite background-white mb-auto mt-40">
                          <i class="far fa-heart icon icon-small"></i>
                        </button>
                        <a href="#" class="outline-none font-weight-bold">Details</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end: property item -->
              <!-- start: property item -->
              <div class="col-12 property-wrapper">
                <div class="property-item">
                  <div id="" class="pp-images position-relative">
                    <div class="image-wrapper-1">
                      <div class="image-sizing-1">
                        <img src="../img/slide-1.jpg" alt="image">
                      </div>
                    </div>
                    <div class="image-wrapper-2">
                      <div class="image-sizing-2">
                        <img src="../img/slide-2.jpg" alt="image">
                        <span class="main-tag">#modern</span>
                      </div>
                    </div>
                    <div class="image-wrapper-3">
                      <div class="image-sizing-3">
                        <img src="../img/slide-3.jpg" alt="image">
                      </div>
                    </div>
                  </div>
                  <div class="pp-detail">
                    <div class="row">
                      <div class="col-md-10 col-12">
                        <div class="pp-highlight">
                          <div class="pp-tags">
                            <span class="card-tag">Co Living</span>
                            <span class="card-tag card-tag-outline">Entire House</span>
                          </div>
                          <h4 class="pp-title">Amazing City Escape - Cipete Utara</h4>
                          <p class="pp-location">Menteng, Jakarta Pusat</p>
                          <p class="pp-price">Starting from <strong>Rp 5,260,000 per Month</strong></p>
                        </div>
                        <div class="pp-spec d-flex flex-row flex-wrap">
                          <span class="pp-rates">
                            <span class="pp-stars">4.5</span>
                            <i class="fas fa-star text-color-orange"></i>
                            <span class="pp-raters color-light-brown pl-2">(35)</span>
                          </span>
                          <span class="pp-landsize d-flex flex-row flex-wrap justify-content-start align-items-center">
                            <img src="../img/pp-landsize.jpg" alt="Landsize">
                            <span>169.4m<sup>2</sup></span>
                          </span>
                          <span class="pp-room d-flex flex-row flex-wrap justify-content-start align-items-center">
                            <img src="../img/pp-room.jpg" alt="Room">
                            <span class="font-weight-bold">2</span>/
                            <span>8</span>
                          </span>
                          <span class="pp-bed d-flex flex-row flex-wrap justify-content-start align-items-center">
                            <img src="../img/pp-bed.jpg" alt="Bed">
                            <span>3</span>
                          </span>
                        </div>
                      </div>
                      <div class="col-md-2 col-12 d-flex flex-md-column flex-row flex-wrap align-items-md-end align-items-center justify-content-md-end justify-content-between mt-md-0 mt-10">
                        <button class="btn btn-icon-small btn-favorite background-white mb-auto mt-md-40">
                          <i class="far fa-heart icon icon-small"></i>
                        </button>
                        <a href="#" class="outline-none font-weight-bold">Details</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end: property item -->
              <!-- start: property item -->
              <div class="col-12 property-wrapper">
                <div class="property-item">
                  <div id="" class="pp-images position-relative">
                    <div class="image-wrapper-1">
                      <div class="image-sizing-1">
                        <img src="../img/slide-1.jpg" alt="image">
                      </div>
                    </div>
                    <div class="image-wrapper-2">
                      <div class="image-sizing-2">
                        <img src="../img/slide-2.jpg" alt="image">
                        <span class="main-tag">#modern</span>
                      </div>
                    </div>
                    <div class="image-wrapper-3">
                      <div class="image-sizing-3">
                        <img src="../img/slide-3.jpg" alt="image">
                      </div>
                    </div>
                  </div>
                  <div class="pp-detail">
                    <div class="row">
                      <div class="col-md-10 col-12">
                        <div class="pp-highlight">
                          <div class="pp-tags">
                            <span class="card-tag">Co Living</span>
                            <span class="card-tag card-tag-outline">Entire House</span>
                          </div>
                          <h4 class="pp-title">Amazing City Escape - Cipete Utara</h4>
                          <p class="pp-location">Menteng, Jakarta Pusat</p>
                          <p class="pp-price">Starting from <strong>Rp 5,260,000 per Month</strong></p>
                        </div>
                        <div class="pp-spec d-flex flex-row flex-wrap">
                          <span class="pp-rates">
                            <span class="pp-stars">4.5</span>
                            <i class="fas fa-star text-color-orange"></i>
                            <span class="pp-raters color-light-brown pl-2">(35)</span>
                          </span>
                          <span class="pp-landsize d-flex flex-row flex-wrap justify-content-start align-items-center">
                            <img src="../img/pp-landsize.jpg" alt="Landsize">
                            <span>169.4m<sup>2</sup></span>
                          </span>
                          <span class="pp-room d-flex flex-row flex-wrap justify-content-start align-items-center">
                            <img src="../img/pp-room.jpg" alt="Room">
                            <span class="font-weight-bold">2</span>/
                            <span>8</span>
                          </span>
                          <span class="pp-bed d-flex flex-row flex-wrap justify-content-start align-items-center">
                            <img src="../img/pp-bed.jpg" alt="Bed">
                            <span>3</span>
                          </span>
                        </div>
                      </div>
                      <div class="col-md-2 col-12 d-flex flex-md-column flex-row flex-wrap align-items-md-end align-items-center justify-content-md-end justify-content-between mt-md-0 mt-10">
                        <button class="btn btn-icon-small btn-favorite background-white mb-auto mt-md-40">
                          <i class="far fa-heart icon icon-small"></i>
                        </button>
                        <a href="#" class="outline-none font-weight-bold">Details</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end: property item -->
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12 pl-xl-70">
            <a href="#" class="btn-more-properties outline-none font-weight-bold">See More of Most Viewed <i class="fas fa-long-arrow-alt-right"></i></a>
          </div>
        </div>
      </div>
    </section>
    <!-- end: most viewed listings -->
    <!-- start: what we provide -->
    <section class="section-content about-sewagi">
      <div class="container pt-100 pb-100">
        <div class="row">
          <div class="col-12">
            <p class="font-mono text-uppercase font-size-16 font-weight-bold text-color-orange text-center mb-75">What we provide</p>
          </div>
        </div>
        <div class="row what-we-provide">
          <!-- start: item -->
          <div class="col-xl-2-4 col-md-6 col-12">
            <div class="we-provide-item mb-lg-0 mb-40">
              <div class="provide-image mb-15">
                <img src="../img/renter_illustrasi3.png" alt="provide 1">
              </div>
              <div class="provide-desc text-center">
                <h5 class="font-size-16">Monthly payments</h5>
                <p class="font-size-14 mb-0">Pay as you go.</p>
              </div>
            </div>
          </div>
          <!-- end: item -->
          <!-- start: item -->
          <div class="col-xl-2-4 col-md-6 col-12">
            <div class="we-provide-item mb-lg-0 mb-40">
              <div class="provide-image mb-15">
                <img src="../img/connect.svg" alt="provide 2">
              </div>
              <div class="provide-desc text-center">
                <h5 class="font-size-16">Flexibility</h5>
                <p class="font-size-14 mb-0">Choose your payment and staying terms Rent the way you want.</p>
              </div>
            </div>
          </div>
          <!-- end: item -->
          <!-- start: item -->
          <div class="col-xl-2-4 col-md-6 col-12">
            <div class="we-provide-item mb-lg-0 mb-40">
              <div class="provide-image mb-15">
                <img src="../img/renter_illustrasi1.png" alt="provide 3">
              </div>
              <div class="provide-desc text-center">
                <h5 class="font-size-16">Preferred locations</h5>
                <p class="font-size-14 mb-0">Use our commute feature to be close to your activity hubs.</p>
              </div>
            </div>
          </div>
          <!-- end: item -->
          <!-- start: item -->
          <div class="col-xl-2-4 col-md-6 col-12">
            <div class="we-provide-item mb-lg-0 mb-40">
              <div class="provide-image mb-15">
                <img src="../img/owner2.svg" alt="provide 4">
              </div>
              <div class="provide-desc text-center">
                <h5 class="font-size-16">Co-living compatibility</h5>
                <p class="font-size-14 mb-0">We match you with like minded housemates.</p>
              </div>
            </div>
          </div>
          <!-- end: item -->
          <!-- start: item -->
          <div class="col-xl-2-4 col-md-6 col-12">
            <div class="we-provide-item mb-lg-0 mb-40">
              <div class="provide-image mb-15">
                <img src="../img/owner4.svg" alt="provide 5">
              </div>
              <div class="provide-desc text-center">
                <h5 class="font-size-16">Peace of mind</h5>
                <p class="font-size-14 mb-0">Unified dashboard paired with customer support for a seamless renting experience.</p>
              </div>
            </div>
          </div>
          <!-- end: item -->
        </div>
      </div>
    </section>
    <!-- end: what we provide -->
    <!-- start: about sewagi -->
    <section id="about-us" class="section-content about-sewagi">
      <div class="pot-brick"></div>
      <div class="container pt-100 pb-200">
        <div class="row">
          <div class="col-12">
            <p class="font-mono font-size-16 font-weight-bold text-color-orange text-uppercase text-center mb-75">What is Sewagi</p>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="max-width-lg-55 max-width-100">
              <h3 class="font-size-32 font-weight-bold mb-50">SEWAGI lets you rent on your terms & list your property for free.</h3>
            </div>
          </div>
          <div class="col-12">
            <div class="ml-lg-300 max-width-lg-40">
              <p class="font-size-22 mb-lg-40">Our marketplace provides you with rental flexibility, proximity & shareability.</p>
              <p class="font-size-22">While giving your property the edge in leasing out faster & safer.</p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- end: about sewagi -->
    <!-- start: how sewagi helps you -->
    <section class="section-content pt-15">
      <div class="background-shadow"></div>
      <div class="container info-content">
        <div class="row">
          <div class="col-12">
            <p class="font-mono font-size-16 font-weight-bold text-color-orange text-uppercase text-center mb-75">How Sewagi Helps You as a</p>
          </div>
        </div>
        <div class="row info-tab-row">
          <div class="col-12">
            <div id="menu-tabs" class="col-12 mb-100">
              <ul class="nav nav-tabs tabs-slash justify-content-center padding-bottom-0" role="tablist">
                <li class="nav-item">
                  <a class="nav-link font-size-28 font-weight-bold active" data-toggle="tab" href="#renter-tab" role="tab">Renter</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link font-size-28 font-weight-bold" data-toggle="tab" href="#coliving-tab" role="tab">Co-Living Renter</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link font-size-28 font-weight-bold" data-toggle="tab" href="#owner-tab" role="tab">Property Lister</a>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-12">
            <div class="tab-content pb-5">
              <div class="tab-pane active show" id="renter-tab" role="tabpanel">
                <div class="row">
                  <div class="col-lg-3 col-md-6 col-12">
                    <div class="mb-15 image-card">
                      <img src="https://sewagi-web.inspira.web.id/img/renter_illustrasi1.png" />
                    </div>
                    <p class="mb-15 text-center text-color-dark font-size-20 title-card font-weight-bold">Find and collect the listings you like</p>
                    <p class="mb-15 text-center text-color-gray-1">Check out our listing and refine your filters to get the best match.</p>
                  </div>
                  <div class="col-lg-3 col-md-6 col-12">
                    <div class="mb-15 image-card">
                      <img src="https://sewagi-web.inspira.web.id/img/renter_illustrasi2.png" />
                    </div>
                    <p class="mb-15 text-center text-color-dark font-size-20 title-card font-weight-bold">Schedule for a room tour</p>
                    <p class="mb-15 text-center text-color-gray-1">Have a closer look at your future home. No strings attached.</p>
                  </div>
                  <div class="col-lg-3 col-md-6 col-12">
                    <div class="mb-15 image-card">
                      <img src="https://sewagi-web.inspira.web.id/img/renter_illustrasi3.png" />
                    </div>
                    <p class="mb-15 text-center text-color-dark font-size-20 title-card font-weight-bold">Set up your digital identity</p>
                    <p class="mb-15 text-center text-color-gray-1">Like what you see? Sign the contract digitally and the place is yours.</p>
                  </div>
                  <div class="col-lg-3 col-md-6 col-12">
                    <div class="mb-15 image-card">
                      <img src="https://sewagi-web.inspira.web.id/img/renter_illustrasi4.png" />
                    </div>
                    <p class="mb-15 text-center text-color-dark font-size-20 title-card font-weight-bold"><i>MOVE IN!</i></p>
                    <p class="mb-15 text-center text-color-gray-1">You are all set! Move in and be part of the community.</p>
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="coliving-tab" role="tabpanel">
                <div class="row">
                  <div class="col-lg-3 col-md-6 col-12">
                    <div class="mb-15 image-card">
                      <img src="https://sewagi-web.inspira.web.id/img/renter_illustrasi1.png" />
                    </div>
                    <p class="mb-15 text-center text-color-dark font-size-20 title-card font-weight-bold">Find and collect the listings you like</p>
                    <p class="mb-15 text-center text-color-gray-1">Check out our co-living listing and refine your filters to get the best match.</p>
                  </div>
                  <div class="col-lg-3 col-md-6 col-12">
                    <div class="mb-15 image-card">
                      <img src="https://sewagi-web.inspira.web.id/img/connect.svg" />
                    </div>
                    <p class="mb-15 text-center text-color-dark font-size-20 title-card font-weight-bold">Connect with the existing renters</p>
                    <p class="mb-15 text-center text-color-gray-1">See if you could get along well with the existing renters while visiting your future home.</p>
                  </div>
                  <div class="col-lg-3 col-md-6 col-12">
                    <div class="mb-15 image-card">
                      <img src="https://sewagi-web.inspira.web.id/img/renter_illustrasi3.png" />
                    </div>
                    <p class="mb-15 text-center text-color-dark font-size-20 title-card font-weight-bold">Set up your digital identity</p>
                    <p class="mb-15 text-center text-color-gray-1">Like what you are seeing? Sign the contract and the place is yours.</p>
                  </div>
                  <div class="col-lg-3 col-md-6 col-12">
                    <div class="mb-15 image-card">
                      <img src="https://sewagi-web.inspira.web.id/img/renter_illustrasi4.png" />
                    </div>
                    <p class="mb-15 text-center text-color-dark font-size-20 title-card font-weight-bold"><i>MOVE IN!</i></p>
                    <p class="mb-15 text-center text-color-gray-1">You are all set! Move in and be part of the community.</p>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <div class="mt-30 text-center">
                      <button class="btn btn-primary btn-wide" type="button" class="close font-weight-normal" data-toggle="modal" data-target="#modalRenter">What is co-living?</button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="owner-tab" role="tabpanel">
                <div class="row">
                  <div class="col-lg-3 col-md-6 col-12">
                    <div class="mb-15 image-card">
                      <img src="https://sewagi-web.inspira.web.id/img/owner1.svg" />
                    </div>
                    <p class="mb-15 text-center text-color-dark font-size-20 title-card font-weight-bold">Tell us about your property</p>
                    <p class="mb-15 text-center text-color-gray-1">Give us your property details. The more details the better.</p>
                  </div>
                  <div class="col-lg-3 col-md-6 col-12">
                    <div class="mb-15 image-card">
                      <img src="https://sewagi-web.inspira.web.id/img/owner2.svg" />
                    </div>
                    <p class="mb-15 text-center text-color-dark font-size-20 title-card font-weight-bold">Let us do the heavy lifting</p>
                    <p class="mb-15 text-center text-color-gray-1">Sewagi will help you price it right, market it to the right prospects and take care of the paperwork.</p>
                  </div>
                  <div class="col-lg-3 col-md-6 col-12">
                    <div class="mb-15 image-card">
                      <img src="https://sewagi-web.inspira.web.id/img/owner3.svg" />
                    </div>
                    <p class="mb-15 text-center text-color-dark font-size-20 title-card font-weight-bold">Prove and sign the digital contract</p>
                    <p class="mb-15 text-center text-color-gray-1">Safe yourself the hassle, sign your contract digitally.</p>
                  </div>
                  <div class="col-lg-3 col-md-6 col-12">
                    <div class="mb-15 image-card">
                      <img src="https://sewagi-web.inspira.web.id/img/owner4.svg" />
                    </div>
                    <p class="mb-15 text-center text-color-dark font-size-20 title-card font-weight-bold">Get your passive income</p>
                    <p class="mb-15 text-center text-color-gray-1">Kick back and see your income grow.</p>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <div class="mt-30 text-center">
                      <button class="btn btn-primary btn-wide" type="button" class="close font-weight-normal" data-toggle="modal" data-target="#modalPropertyLister">Let's do it</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section>
    <!-- end: how sewagi helps you -->
    <!-- start: discover listings -->
    <section class="section-content pt-85">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <h3 class="font-size-32 font-weight-bold text-center mb-40">Discover listings that fit you the most</h3>
          </div>
        </div>
        <div class="row row-discover-lists">
          <div class="col-lg-4 col-md-6 col-12 px-0 d-flex align-items-center background-primary-dark">
            <div class="discover-item">
              <div class="banner-tag mb-25 background-white">Co-Living</div>
              <p class="font-size-13 color-white mb-15">Willing to share living space with others?</p>
              <h4 class="font-size-20 font-weight-bold color-white mb-25">We can help you find the best housemates match.</h4>
              <a class="btn btn-primary btn-wide" href="#">Find me a co-living</a>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-12 px-0 d-flex align-items-center background-aqua">
            <div class="discover-item">
              <div class="banner-tag mb-25 background-white">Active Worker</div>
              <p class="font-size-13 mb-15">Can’t find a living space near your office area?</p>
              <h4 class="font-size-20 font-weight-bold mb-25">We have listings within walking distance near your office.</h4>
              <a class="btn btn-primary btn-wide" href="#">Find a pad near my office</a>
            </div>
          </div>
          <div class="col-lg-4 col-12 px-0 d-flex align-items-center background-primary-orange">
            <div class="discover-item">
              <div class="banner-tag mb-25 background-white">Family Friendly</div>
              <p class="font-size-13 color-white mb-15">Need a living area for your kids?</p>
              <h4 class="font-size-20 font-weight-bold color-white mb-25">Worry no more. We can provide listings with school nearby.</h4>
              <a class="btn btn-primary btn-wide" href="#">Find a pad near school</a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- end: discover listings -->
    <!-- start: property owner -->
    <section class="section-content background-primary-dark mt-120">
      <div class="container">
        <div class="row row-property-lister">
          <div class="col-md-6 col-12 d-flex flex-column flex-wrap justify-content-start align-items-center pb-60">
            <img class="img-fluid" src="../img/sofa-asset.png" />
          </div>
          <div class="col-md-6 col-12 d-flex flex-column flex-wrap justify-content-center align-items-start">
            <div class="property-lister d-flex flex-column flex-wrap justify-content-md-start align-items-md-start justify-content-center align-items-center w-100 py-xl-115 py-50">
            <p class="font-mono font-size-16 font-weight-bold text-color-orange text-uppercase mb-35">Are you a property lister?</p>
              <h3 class="font-size-32 font-weight-bold color-white mb-40">Go for effortless leasing as a</h3>
              <a class="btn btn-primary btn-wide ml-xl-40" href="{{url('/property-lister/homeowner')}}" role="button">Homeowner</a>
              <a class="btn btn-primary btn-wide ml-xl-40" href="{{url('/property-lister/agent')}}" role="button">Property Agent</a>
              <a class="btn btn-primary btn-wide ml-xl-40" href="{{url('/property-lister/building-management')}}" role="button">Building Management</a>
              <a class="btn btn-primary btn-wide ml-xl-40" href="{{url('/property-lister/housemate')}}" role="button">Housemate</a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- end: property owner -->
    @component('_partials.recommend_us')
    @endcomponent
    <!-- start: work with us -->
    <section class="section-content background-light-orange">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="work-with-us d-flex flex-column flex-wrap justify-content-center align-items-center py-50">
              <p class="font-mono font-size-16 font-weight-bold text-color-orange text-uppercase text-center mb-35">Work With Us</p>
              <h3 class="font-size-28 font-weight-bold text-center mb-20">Start earning income from real estate deals on your free time</h3>
              <a class="btn btn-primary btn-wide" href="{{url('/join/agent')}}">Become a showing agent</a>
              <h3 class="font-size-28 font-weight-bold text-center mt-40 mb-20">Increase efficiency by placing your fellow workers near your office or project locations</h3>
              <a class="btn btn-primary btn-wide" href="{{url('/join/company-client')}}">Start placing my company staff</a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- end: work with us -->
    @if(Auth::user())
    <div id="auth"></div>
    @endif
@endsection

@push('js')
<script>
function closeCookie(){
    $('.cookie-policy').remove();
}
</script>
@endpush
