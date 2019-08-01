@extends('_partials.master_solid')
@section('content')
<!-- start: cookie -->
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
    <div class="hero-filter three-lines position-absolute">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="main-heading mb-50">
                        <span class="text-color-orange">{{ getLocale($locale_join, 'label-jumbotron-1', '') }}</span>
                        <span class="text-color-dark">{{ getLocale($locale_join, 'label-jumbotron-2', '') }}</span>
                        <span class="text-color-orange">{{ getLocale($locale_join, 'label-jumbotron-3', '') }}!</span>
                    </h1>
                        {{-- <h3 class="font-size-28 font-weight-bold mb-35">
                        <span class="text-color-dark d-block">Make up to 100,000 IDR each time you</span>
                        <span class="text-color-dark d-block">show or survey a property & get</span>
                        <span class="text-color-dark d-block">premiums on successful leasing deals.</span>
                        </h3> --}}
                    <div class="home-search">
                        <a class="btn btn-primary btn-wide ml-xl-80" href="#"  data-toggle="modal" data-target="#modalJoinCommunity">{{ getLocale($locale_join, 'label-jumbotron-7', '') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end: home -->

<!-- start: what we provide -->
<section class="section-content about-sewagi">
    <div class="container pt-100 pb-100">
        <div class="row">
            <div class="col-12 mb-50">
                <h3 class="font-size-28 font-weight-bold text-center mb-15">{{ getLocale($locale_join, 'label-jumbotron2-1', '') }}</h3>
                <p class="text-center mb-35">{{ getLocale($locale_join, 'label-jumbotron2-2', '') }}.</p>
            </div>
        </div>
        <div class="row what-we-provide">
            <div class="col-xl-3 col-md-6 col-12">
                <div class="we-provide-item mb-lg-0 mb-40">
                    <p class="h3 mb-3 text-left text-color-orange-2">01</p>
                    <div class="provide-image mb-15">
                        <img src="{{ url('img/homepage/showing-agent-sector.png') }}" alt="Select your sector"/>
                    </div>
                    <div class="provide-desc text-center">
                        <h5 class="font-size-16 mb-10">{{ getLocale($locale_join, 'label-jumbotron2-3', 'Select your sector') }}</h5>
                        <p class="font-size-14 mb-0">{{ getLocale($locale_join, 'label-jumbotron2-7', "You're probably more comfortable showing or surveying properties near your home or workplace") }}.</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-12">
                <div class="we-provide-item mb-lg-0 mb-40">
                    <p class="h3 mb-3 text-left text-color-orange-2">02</p>
                    <div class="provide-image mb-15">
                        <img src="{{ url('img/homepage/showing-agent-availabilities.png') }}" alt="Input your availabilities"/>
                    </div>
                    <div class="provide-desc text-center">
                        <h5 class="font-size-16 mb-10">{{ getLocale($locale_join, 'label-jumbotron2-4', 'Input your availabilities') }}</h5>
                        <p class="font-size-14 mb-0">{{ getLocale($locale_join, 'label-jumbotron2-8', 'We value your flexibility. Tell us when you’re comfortable making money.') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-12">
                <div class="we-provide-item mb-lg-0 mb-40">
                    <p class="h3 mb-3 text-left text-color-orange-2">03</p>
                    <div class="provide-image mb-15">
                        <img src="{{ url('img/homepage/showing-agent-platform.png') }}" alt="Use our proptech platform" />
                    </div>
                    <div class="provide-desc text-center">
                        <h5 class="font-size-16 mb-10">{{ getLocale($locale_join, 'label-jumbotron2-5', 'Use our proptech platform') }}</h5>
                        <p class="font-size-14 mb-0">{{ getLocale($locale_join, 'label-jumbotron2-9', 'A state of the art digital tool in the palm of your hands! So you can focus on making money.') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-12">
                <div class="we-provide-item mb-lg-0 mb-40">
                    <p class="h3 mb-3 text-left text-color-orange-2">04</p>
                    <div class="provide-image mb-15">
                            <img src="{{ url('img/homepage/showing-agent-income.png') }}" alt="Start earning more income" />
                    </div>
                    <div class="provide-desc text-center">
                        <h5 class="font-size-16 mb-10">{{ getLocale($locale_join, 'label-jumbotron2-6', 'Start earning more income') }}</h5>
                        <p class="font-size-14 mb-0">{{ getLocale($locale_join, 'label-jumbotron2-10', 'Achieve milestones to unlock premiums on leasing deals. Our instant payment system means you can withdraw your earnings whenever and wherever you want.') }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class='col-12 text-center'>
            <a href="#" class="btn btn-primary btn-wide ml-xl-80" data-toggle="modal" data-target="#modalJoinCommunity">{{ getLocale($locale_join, 'label-jumbotron2-11', '') }}</a>
        </div>
    </div>
</section>
<!-- end: what we provide -->

<div class="section-testimonial-separator row">
    <div class="col-md-8 offset-md-2" style="padding: 0;">
        <div style="height: 1px;width: 103%;background-color: #ddd;margin-left: -7.5px;margin-right: -7.5px;margin-bottom: 7.5rem;"></div>
    </div>
</div>

@component('_partials.recommend_us', compact('locale_recommend'))
@endcomponent
@component('_partials.question', compact('locale_question'))
@endcomponent
<!-- start: work with us -->
<section class="section-content background-light-orange section-property-lister-lease-my-property">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="work-with-us d-flex flex-column flex-wrap justify-content-center align-items-center py-50">
                    <p class="font-mono font-size-16 text-color-orange text-uppercase text-center mb-35">{{ getLocale($locale_join, 'label-jumbotron3-1', '') }}</p>
                    <h3 class="font-size-28 font-weight-bold text-center mb-35">{{ getLocale($locale_join, 'label-jumbotron3-2', '') }}</h3>
                    <a class="btn btn-primary btn-wide" href="#" data-toggle="modal" data-target="#modalJoinCommunity">{{ getLocale($locale_join, 'label-jumbotron3-3', '') }}</a>
                    <!-- <button class="btn btn-primary btn-wide" type="button" class="close font-weight-normal" data-toggle="modal" data-target="#modalPropertyLister">Let's do it</button> -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end: work with us -->
@endsection
