@extends('_partials.master_solid')
@section('content')<!-- start: cookie -->
@if (!Cookie::get('cookie-policy'))
<div class="navbar-on-top" style="display: none;">
    <div class="container">
        <span class="color-main-dark font-size-13">{{ getLocale($locale, 'label-cookie', '') }} <a href="#">{{ getLocale($locale, 'link-cookie', '') }}</a>.</span>
        <a class="close-btn" href="javascript:void(0);">
            <span class="clear-cross"></span>
        </a>
    </div>
</div>
@endif
<!-- end: cookie -->

<!-- start: home -->
<section class="section-content d-flex flex-column flex-wrap justify-content-center align-items-center vh-min-100 background-gradient-1">
    <div class=""></div>
    <button onclick="$zopim.livechat.window.show()" class="btn-chat background-primary">
        <i class="fas fa-comment-alt"></i>
    </button>
    <!-- start: home slider -->
    <div id="homeSlider" >
        <div class="home-slider">
          <div class="home-slider-item">
            <img src="{{ $background }}" class="d-block w-100" alt="Slider">
          </div>
        </div>
    </div>
    <div class="hero-filter mini position-absolute">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="main-heading mb-50">
                        <span class="text-color-orange">Find employee accomodations</span>
                        <span class="text-color-dark">without sacrificing flexibility.</span>
                    </h1>
                    <div class="home-search">
                        <a class="btn btn-primary btn-wide ml-xl-80" href="#">REGISTER NOW</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end: home -->


<!-- start: corporate home needs -->
<section class="section-content about-sewagi">
    <div class="container pt-100 pb-100">
        <div class="row">
            <div class="col-12 mb-50">
                <h3 class="font-size-28 font-weight-bold text-center mb-15">{{ getLocale($locale_company_client, 'label-jumbotron2-1', '') }}</h3>
                <p class="text-center mb-0">{{ getLocale($locale_company_client, 'label-jumbotron2-2', '') }}</p>
                <p class="text-center mb-0">{{ getLocale($locale_company_client, 'label-jumbotron2-3', '') }}</p>
                <p class="text-center mb-0">{{ getLocale($locale_company_client, 'label-jumbotron2-4', '') }}</p>
            </div>
        </div>
        <div class="row what-we-provide d-flex flex-row flew-wrap justify-content-center">
            <div class="col-xl-3 col-md-6 col-12">
                <p class="h3 mb-3 text-left text-color-orange-2">01</p>
                <div class="provide-image mb-15">
                    <img src="{{ url('img/homepage/company-client-onsite-employees.png') }}" alt="On-site employees"/>
                </div>
                <div class="provide-desc text-center">
                    <h5 class="font-size-16 mb-10">{{ getLocale($locale_company_client, 'label-jumbotron2-5', '') }}</h5>
                    <p class="font-size-14 mb-0">{{ getLocale($locale_company_client, 'label-jumbotron2-8', '') }}</p>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-12">
                <h5 class="h3 mb-3 text-left text-color-orange-2">02</h5>
                <div class="provide-image mb-15">
                    <img src="{{ url('img/homepage/company-client-project-training-oriented-employees.png') }}" alt="Project & Training oriented employees"/>
                </div>
                <div class="provide-desc text-center">
                    <h5 class="font-size-16 mb-10">{{ getLocale($locale_company_client, 'label-jumbotron2-6', '') }}</h5>
                    <p class="font-size-14 mb-0">{{ getLocale($locale_company_client, 'label-jumbotron2-9', '') }}  <a href="#" class="font-weight-bold">{{ getLocale($locale_company_client, 'label-jumbotron2-10', '') }}</a> {{ getLocale($locale_company_client, 'label-jumbotron2-11', '') }}</p>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-12">
                <p class="h3 mb-3 text-left text-color-orange-2">03</p>
                <div class="provide-image mb-15">
                    <img src="{{ url('img/homepage/company-client-team-building.png') }}" alt="Team building & trade fairs"/>
                </div>
                <div class="provide-desc text-center">
                    <h5 class="font-size-16 mb-10">{{ getLocale($locale_company_client, 'label-jumbotron2-7', '') }}</h5>
                    <p class="font-size-14 mb-0">{{ getLocale($locale_company_client, 'label-jumbotron2-12', '') }}</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center">
                <div class="mt-50">
                    <a class="btn btn-primary btn-wide ml-xl-80" href="#" role="button">{{ getLocale($locale_company_client, 'label-jumbotron2-13', '') }}</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end: corporate home needs -->

<!-- start: business process -->
<section class="section-content about-sewagi background-aqua">
    <div class="container pt-100 pb-100">
        <div class="row">
            <div class="col-12">
                <h3 class="font-size-28 font-weight-bold text-center mb-50">{{ getLocale($locale_company_client, 'label-jumbotron3-1', '') }}</h3>
            </div>
        </div>
        <div class="row what-we-provide">
            <div class="col-sm-3 col-6 mb-3">
                <p class="h3 mb-3 text-left text-color-orange-2">01</p>
                <div class="provide-image mb-15">
                    <img src="{{ url('img/homepage/company-client-seemless-renting.png') }}" alt="Seamless renting"/>
                </div>
                <div class="provide-desc text-center">
                    <h5 class="font-size-16 mb-10">{{ getLocale($locale_company_client, 'label-jumbotron3-2', '') }}</h5>
                    <p class="font-size-14 mb-5">Browse properties, select terms, visit them on your preferred times, sign lease digitally, place your employees and re-book properties easily.</p>
                    <p class="font-size-14 mb-0">Whenever you see these logos on our listing, you may check it out in <a href="#" class="font-weight-bold">360 Viewing</a> and schedule a <a href="#" class="font-weight-bold">Live Virtual Tour</a></p>
                </div>

                <div class="tab-footer-icon text-center mt-20">
                    <a href="#" data-toggle="modal" data-target="#modalExploreLiveVirtualTour"><img src="{{ asset('/img/ic_360vr_grey.svg') }}" class="icon"></a>
                    <a href="#" data-toggle="modal" data-target="#modalExploreLiveVirtualTour" class="ml-10"><img src="{{ asset('/img/ic_view_virtual_field_grey.svg') }}" class="icon"></a>
                </div>
            </div>
            <div class="col-sm-3 col-6 mb-3">
                <p class="h3 mb-3 text-left text-color-orange-2">02</p>
                <div class="provide-image mb-15">
                    <img src="{{ url('img/homepage/company-client-secure-online-payment.png') }}" alt="Secure online paymen"/>
                </div>
                <div class="provide-desc text-center">
                    <h5 class="font-size-16 mb-10">{{ getLocale($locale_company_client, 'label-jumbotron3-3', '') }}</h5>
                    <p class="font-size-14 mb-0">{{ getLocale($locale_company_client, 'label-jumbotron3-7', '') }}</p>
                </div>
            </div>
            <div class="col-sm-3 col-6 mb-3">
                <p class="h3 mb-3 text-left text-color-orange-2">03</p>
                <div class="provide-image mb-15">
                    <img src="{{ url('img/homepage/company-client-simple-management-tool.png') }}" alt="Simple management tool"/>
                </div>
                <div class="provide-desc text-center">
                    <h5 class="font-size-16 mb-10">{{ getLocale($locale_company_client, 'label-jumbotron3-4', '') }}</h5>
                    <p class="font-size-14 mb-0">Unified user dashboard.<br>Track invoices and expenses easily. Differentiate billing from what your employees consume and what you've agreed to cover.</p>
                </div>
            </div>
            <div class="col-sm-3 col-6 mb-3">
                <p class="h3 mb-3 text-left text-color-orange-2">04</p>
                <div class="provide-image mb-15">
                    <img src="{{ url('img/homepage/company-client-intelligent-customer-support.png') }}" alt="Intelligent customer support and services"/>
                </div>
                <div class="provide-desc text-center">
                    <h5 class="font-size-16 mb-10">{{ getLocale($locale_company_client, 'label-jumbotron3-5', '') }}</h5>
                    <p class="font-size-14 mb-5">Our dedicated customer agents will always be on top of your standards.</p>
                    <p class="font-size-14 mb-0">Insured living means you don't need to worry for your employees welfare.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center">
                <div class="mt-50">
                    <a class="btn btn-primary btn-wide ml-xl-80" href="#" role="button">{{ getLocale($locale_company_client, 'label-jumbotron3-10', '') }}</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end: what we provide -->
<!-- start: recommend us -->
@component('_partials.recommend_us', compact('locale_recommend'))
@endcomponent
<!-- end: recommend us -->
@component('_partials.question', compact('locale_question'))
@endcomponent
<!-- start: discover -->
<section class="section-content background-light-orange">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="work-with-us d-flex flex-column flex-wrap justify-content-center align-items-center py-50">
                    <p class="font-mono font-size-16 text-color-orange text-uppercase text-center mb-35">{{ getLocale($locale_company_client, 'label-jumbotron4-1', '') }}</p>
                    <h3 class="font-size-28 font-weight-bold text-center mb-35">{{ getLocale($locale_company_client, 'label-jumbotron4-2', '') }}</h3>
                    <a class="btn btn-primary btn-wide" href="#">{{ getLocale($locale_company_client, 'label-jumbotron4-3', '') }}</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end: work with us -->
@endsection
