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
      <!-- end: home -->
    <div class="hero-filter mini position-absolute">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="main-heading mb-50">
                        {!! $pageTitle !!}
                    </h1>
                    <div class="home-search">
                        <a class="btn btn-primary btn-wide ml-xl-80" href="{{ url('/create-property') }}" role="button">{{ getLocale($locale_property_index, 'label-jumbotron-1', 'Get Started') }}</a>
                        <p class="ml-xl-87 color-white mt-10 d-block clearfix">{{ session('locale')=='id' ? 'atau ' : 'or ' }}<a href="#" onclick="event.preventDefault();">{{ session('locale')=='id' ? 'minta bantuan kami' : 'ask our help' }}</a> {{ session('locale')=='id' ? 'untuk mengiklankan properti Anda' : 'to list your property' }}.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end: home -->

<!-- start: leasing step -->
<section class="section-content about-sewagi">
    <div class="container pt-100 pb-100">
        <div class="row">
            <div class="col-12">
                <h3 class="font-size-28 font-weight-bold text-center mb-75">{{ getLocale($locale_property_index, 'label-jumbotron2-title', 'Lease your property effortlessly in 4 steps') }}</h3>
            </div>
        </div>
        <div class="row what-we-provide">
            <div class="col-xl-3 col-md-6 col-12">
                <div class="we-provide-item mb-lg-0 mb-40">
                    <p class="h3 mb-3 text-left text-color-orange-2">01</p>
                    <div class="provide-image mb-15">
                        <img src="{{ asset('img/renter_illustrasi3.png') }}" />
                    </div>
                    <div class="provide-desc text-center">
                        <h5 class="font-size-16 mb-15">{{ getLocale($locale_property_index, 'label-jumbotron2-1', 'Create your listing online') }}</h5>
                        <p class="font-size-14 mb-0">Our seamless listing steps, makes uploading content and media a breeze.</p>
                        <div class="tab-footer-icon text-center mt-15">
                            {{ session('locale')=='id' ? 'Klik untuk' : 'Click for' }} <a href="#" class="font-weight-bold">{{ session('locale')=='id' ? 'bantuan' : 'assistance' }}</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-12">
                <div class="we-provide-item mb-lg-0 mb-40">
                    <p class="h3 mb-3 text-left text-color-orange-2">02</p>
                    <div class="provide-image mb-15">
                        <img src="{{ asset('img/show-your-property.png') }}" />
                    </div>
                    <div class="provide-desc text-center">
                        <h5 class="font-size-16 mb-15">{{ getLocale($locale_property_index, 'label-jumbotron2-2', 'Show your property') }}</h5>
                        {{-- <p class="font-size-14 mb-0">Auto post your listings on social media and realty portals. Share them professionally with pre-formatted HTML/PDF view. Always be available for on-site visits with the help of our showing agents.</p> --}}
                        <p class="font-size-14 mb-5">{{ getLocale($locale_property_index, 'label-jumbotron2-content-5', "A picture says a 1000 words!") }}</p>
                        <p class="font-size-14 mb-5">{{ getLocale($locale_property_index, 'label-jumbotron2-content-6', "Be amazed by our") }} <a href="#" class="font-weight-bold">{{ getLocale($locale_property_index, 'label-jumbotron2-content-7', "360° Viewing capabilities") }}</a> & <a href="#" class="font-weight-bold">{{ getLocale($locale_property_index, 'label-jumbotron2-content-8', "Live Virtual Tour visits") }}</a>. {{ getLocale($locale_property_index, 'label-jumbotron2-content-9', "Helping you show your property without ever being there!") }}
                        </p>
                        <p class="font-size-14 mb-0">{{ getLocale($locale_property_index, 'label-jumbotron2-content-10', "If you're unavailable for on-site visits, our showing agents are always ready to help you show properties") }}.</p>

                        <div class="tab-footer-icon text-center mt-20">
                            <a href="#" data-toggle="modal" data-target="#modalExploreLiveVirtualTour"><img src="{{ asset('/img/ic_360vr_grey.svg') }}" class="icon"></a>
                            <a href="#" data-toggle="modal" data-target="#modalExploreLiveVirtualTour" class="ml-10"><img src="{{ asset('/img/ic_view_virtual_field_grey.svg') }}" class="icon"></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-12">
                <div class="we-provide-item mb-lg-0 mb-40">
                    <p class="h3 mb-3 text-left text-color-orange-2">03</p>
                    <div class="provide-image mb-15">
                        <img src="{{ asset('img/homepage/digital-contract-signing.png') }}" />
                    </div>
                    <div class="provide-desc text-center">
                        @if($page == 'agent')
                            <h5 class="font-size-16 mb-15">Digital contract signing</h5>

                            <p class="font-size-14 mb-5">Update listing details, manage wishlists, upload relevant documents and stay on top of rental terms validation between rental property owner and renter 24/7.</p>
                            <p class="font-size-14 mb-0">We help you close the deal so you can focus on the next one.</p>
                        @else
                            <h5 class="font-size-16 mb-15">Digital contract signing</h5>

                            <p class="font-size-14 mb-0">Validate your rental terms online with a couple of clicks and then finish-up by digitally signing the lease.</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-12">
                <div class="we-provide-item mb-lg-0 mb-40">
                    <p class="h3 mb-3 text-left text-color-orange-2">04</p>
                    <div class="provide-image mb-15">
                        <img src="{{ asset('img/homepage/perceive-your-passive-income.png') }}" />
                    </div>
                    <div class="provide-desc text-center">
                        @if($page == 'agent')
                            <h5 class="font-size-16 mb-15">{{ getLocale($locale_property_index, 'label-jumbotron2-4', 'Receive your passive income without a sweat') }}</h5>
                            <p class="font-size-14 mb-10">Our online dashboard lets you track lease extensions, invoice payments and update property details 24/7 across all your inventory.</p>
                            <p class="font-size-14 mb-0">Generate recurring revenues seamlessly!</p>
                        @elseif($page == 'building-management')
                            <h5 class="font-size-16 mb-15">Receive income without a sweat</h5>
                            <p class="font-size-14 mb-10">Our online dashboard lets you track lease extensions, invoice payments and update property details 24/7 across all your inventory.</p>
                            <p class="font-size-14 mb-0">Our rental insurance program will give you peace of mind in case of payment defaults or during asset maintenance and repairs.</p>
                        @else
                            <h5 class="font-size-16 mb-15">Perceive your passive income without a sweat</h5>
                            <p class="font-size-14 mb-5">Our online dashboard lets you track lease extensions, invoice payments and update property details 24/7.</p>
                            <p class="font-size-14 mb-0">Our rental insurance program will give you peace of mind in case of payment defaults or during asset maintenance and repairs.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end: leasing step -->

<!-- start: why us -->
<section class="section-content background-primary-dark">
    <div class="container py-150">
        <div class="row">
            <div class="col-12">
                <h3 class="font-size-28 font-weight-bold color-white text-center mb-75">{{ getLocale($locale_property_index, 'label-jumbotron3-title', 'What will make you love us') }}</h3>
            </div>
        </div>
        <div id="accordion-why-us-parent">
            <div class="row">
                <div class="col-xl-6 col-12">
                    <div id="accordion-why-us" class="accordion why-us-accordion mr-lg-0">
                        <div class="card background-transparent border-0">
                            <div class="card-header background-transparent border-0 p-0">
                                <h2 class="mb-0">
                                    <a class="btn btn-link d-block text-left btn-accordion" data-toggle="collapse" data-target=".multi-collapse-why-us-1" aria-expanded="false" aria-controls="multi-collapse-text-1 multi-collapse-image-1">
                                        <i class="fas fa-angle-right"></i><h5 class="color-white font-size-16 text-capitalize mb-0">{{ getLocale($locale_property_index, 'label-jumbotron3-1', 'A renter oriented platform') }}</h5>
                                    </a>
                                </h2>
                            </div>
                            <div id="multi-collapse-text-1" class="collapse multi-collapse-why-us-1 show" data-parent="#accordion-why-us-parent">
                                <div class="card-body color-white font-size-14 pl-20 pt-5">
                                    @if($page == 'agent')
                                        {{ getLocale($locale_property_index, 'label-jumbotron3-content1-1', 'Our features help you match with adequate renters accepting your property owners leasing terms.') }}
                                    @else
                                        {{ getLocale($locale_property_index, 'label-jumbotron3-content1-2', 'Our features help you match with adequate renters accepting your leasing terms.') }}
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card background-transparent border-0">
                            <div class="card-header background-transparent border-0 p-0">
                                <h2 class="mb-0">
                                    <a class="btn btn-link d-block text-left btn-accordion collapsed" data-toggle="collapse" data-target=".multi-collapse-why-us-2" aria-expanded="false" aria-controls="multi-collapse-text-2 multi-collapse-image-2">
                                        <i class="fas fa-angle-right"></i><h5 class="color-white font-size-16 text-capitalize mb-0">{{ getLocale($locale_property_index, 'label-jumbotron3-2', 'Get trusted prospective renters') }}</h5>
                                    </a>
                                </h2>
                            </div>
                            <div id="multi-collapse-text-2" class="collapse multi-collapse-why-us-2" data-parent="#accordion-why-us-parent">
                                <div class="card-body color-white font-size-14 pl-20 pt-5">
                                    {{ getLocale($locale_property_index, 'label-jumbotron3-content2-1', 'Every renter provides us with a genuine identity document, which we then digitally match to Government database and authenticate. Unlocking digital signature capability.') }}
                                </div>
                            </div>
                        </div>
                        <div class="card background-transparent border-0">
                            <div class="card-header background-transparent border-0 p-0">
                                <h2 class="mb-0">
                                    <a class="btn btn-link d-block text-left btn-accordion collapsed" data-toggle="collapse" data-target=".multi-collapse-why-us-3" aria-expanded="false" aria-controls="multi-collapse-text-3 multi-collapse-image-3">
                                        <i class="fas fa-angle-right"></i><h5 class="color-white font-size-16 text-capitalize mb-0">{{ getLocale($locale_property_index, 'label-jumbotron3-3', 'Organise property inventory anywhere anytime') }}</h5>
                                    </a>
                                </h2>
                            </div>
                            <div id="multi-collapse-text-3" class="collapse multi-collapse-why-us-3" data-parent="#accordion-why-us-parent">
                                <div class="card-body color-white font-size-14 pl-20 pt-5">
                                    @if($page == 'housemate')
                                        <p class="mb-5">Update property rates, payment terms, staying periods, equipment and amenities seamlessly 24/7. Edit and validate your smart contracts, track invoices and payments online.</p>
                                        <p class="mb-0">Stay on top of renting periods with alarm feature, helping you better adjust your offer and manage contract extensions easily.</p>
                                    @elseif($page == 'agent')
                                        <p class="mb-5">Update property rates, payment terms, staying periods, equipment and amenities seamlessly 24/7. View smart contracts status between renters and property owners, track invoices and payment online.</p>
                                        <p class="mb-0">Stay on top of renting periods with alarm feature, helping you better adjust your offer and manage contract extensions easily.</p>
                                    @else
                                        <p class="mb-5">Update your rate, payment terms, staying periods, equipment and amenities seamlessly 24/7. Edit and validate your smart contract, track invoices and payments online.</p>
                                        <p class="mb-0">Stay on top of renting periods with alarm feature, helping you better adjust your offer and manage contract extensions easily.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card background-transparent border-0">
                            <div class="card-header background-transparent border-0 p-0">
                                <h2 class="mb-0">
                                    <a class="btn btn-link d-block text-left btn-accordion collapsed" data-toggle="collapse" data-target=".multi-collapse-why-us-4" aria-expanded="false" aria-controls="multi-collapse-text-4 multi-collapse-image-4">
                                        <i class="fas fa-angle-right"></i><h5 class="color-white font-size-16 text-capitalize mb-0">{{ getLocale($locale_property_index, 'label-jumbotron3-4', 'Always be available for your property') }}</h5>
                                    </a>
                                </h2>
                            </div>
                            <div id="multi-collapse-text-4" class="collapse multi-collapse-why-us-4" data-parent="#accordion-why-us-parent">
                                <div class="card-body color-white font-size-14 pl-20 pt-5">
                                    <p class="mb-5">Better manage your visit schedules by organising them on one platform.</p>
                                    <p class="mb-5">Our showing agents and virtual visit feature are at your service for property viewings when you're not.</p>
                                    <p class="mb-0">Once on-site visits are done, renter feedback and wishlist will be directly updated to your dashboard, so you may respond accordingly without sacrificing valuable time.</p>
                                </div>
                            </div>
                        </div>
                        <div class="card background-transparent border-0">
                            <div class="card-header background-transparent border-0 p-0">
                                <h2 class="mb-0">
                                    <a class="btn btn-link d-block text-left btn-accordion collapsed" data-toggle="collapse" data-target=".multi-collapse-why-us-5" aria-expanded="false" aria-controls="multi-collapse-text-5 multi-collapse-image-5">
                                        <i class="fas fa-angle-right"></i><h5 class="color-white font-size-16 text-capitalize mb-0">{{ getLocale($locale_property_index, 'label-jumbotron3-5', 'Risk free renting via our rental insurance program') }}</h5>
                                    </a>
                                </h2>
                            </div>
                            <div id="multi-collapse-text-5" class="collapse multi-collapse-why-us-5" data-parent="#accordion-why-us-parent">
                                <div class="card-body color-white font-size-14 pl-20 pt-5">
                                    <p class="mb-0">{{ getLocale($locale_property_index, 'label-jumbotron3-content5-1', 'Never worry about late or unpaid rent, our rental insurance program will cover that for you. Maintenance needing repairs will be taken care of without you spending a dime. Damaged equipment and furniture will no longer be a burden when handling moving-out inventories.') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="card background-transparent border-0">
                            <div class="card-header background-transparent border-0 p-0">
                                <h2 class="mb-0">
                                    <a class="btn btn-link d-block text-left btn-accordion collapsed" data-toggle="collapse" data-target=".multi-collapse-why-us-6" aria-expanded="false" aria-controls="multi-collapse-text-6 multi-collapse-image-6">
                                        <i class="fas fa-angle-right"></i><h5 class="color-white font-size-16 text-capitalize mb-0">{{ getLocale($locale_property_index, 'label-jumbotron3-6', 'Better marketing paired with a free platform') }}</h5>
                                    </a>
                                </h2>
                            </div>
                            <div id="multi-collapse-text-6" class="collapse multi-collapse-why-us-6" data-parent="#accordion-why-us-parent">
                                <div class="card-body color-white font-size-14 pl-20 pt-5">
                                    @if($page == 'homeowner' || $page == 'housemate')
                                        <p class="mb-5">Our property survey will help you better position your property.</p>
                                        <p class="mb-5">Get the edge by applying Co-living rental, email sharing formatted listing cards to your clients and Whatsapp sharing your listings with a click of a button.
                                        </p>
                                        <p class="mb-5">Our 5% net commission fee is only applied when we've successfully rented your property and only when you've got payed.</p>
                                        <p class="mb-0">Connect with us to start leasing efficiently and be rewarded when listing or referring us to other property owners.</p>
                                    @elseif($page == 'agent')
                                         <p class="mb-5">Our property survey will help you better position your property.</p>
                                        <p class="mb-5">Get the edge by applying Co-living rental, email sharing formatted listing cards to your clients and Whatsapp sharing your listings with a click of a button.
                                        </p>
                                        <p class="mb-5">Our 5% net commission fee to be shared with you at 60/40 with you having the lion's share, is only applied when we've successfully helped you rent's your client properties and only when you've got payed.</p>
                                        <p class="mb-0">Connect with us to start co-brokering efficiently and be rewarded when listing or referring us to other professionals.</p>
                                    @elseif($page == 'building-management')
                                        <p class="mb-5">Our property survey will help you better position your property.</p>
                                        <p class="mb-5">Get the edge by applying Co-living rental, email sharing formatted listing cards to your clients and Whatsapp sharing your listings with a click of a button.
                                        </p>
                                        <p class="mb-5">>Our 5% net commission fee is only applied when we've successfully rented your property and only when you've got payed.</p>
                                        <p class="mb-0">Connect with us to start co-brokering efficiently and be rewarded when listing or referring us to other professionals.</p>
                                    @else
                                        <p class="mb-5">Our property survey will help you better position your property.</p>
                                        <p class="mb-5">Get the edge by applying Co-living rental, email sharing formatted listing cards to your clients and Whatsapp sharing your listings with a click of a button.
                                        </p>
                                        <p class="mb-5">Our 5% net commission fee is only applied when we've successfully rented your property and only when you've got payed.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-12">
                    <div class="display-image ml-lg-0">
                        <div class="card background-transparent border-0">
                            <div id="multi-collapse-image-1" class="collapse multi-collapse-why-us-1 show" data-parent="#accordion-why-us-parent">
                                <div class="card-body color-white font-size-14 pl-20">
                                    <img class="img-fluid" src="{{ asset('img/dashboard.jpg') }}" alt="Why Us">
                                </div>
                            </div>
                        </div>
                        <div class="card background-transparent border-0">
                            <div id="multi-collapse-image-2" class="collapse multi-collapse-why-us-2" data-parent="#accordion-why-us-parent">
                                <div class="card-body color-white font-size-14 pl-20">
                                    <img class="img-fluid" src="{{ asset('img/dashboard.jpg') }}" alt="Why Us">
                                </div>
                            </div>
                        </div>
                        <div class="card background-transparent border-0">
                            <div id="multi-collapse-image-3" class="collapse multi-collapse-why-us-3" data-parent="#accordion-why-us-parent">
                                <div class="card-body color-white font-size-14 pl-20">
                                    <img class="img-fluid" src="{{ asset('img/dashboard.jpg') }}" alt="Why Us">
                                </div>
                            </div>
                        </div>
                        <div class="card background-transparent border-0">
                            <div id="multi-collapse-image-4" class="collapse multi-collapse-why-us-4" data-parent="#accordion-why-us-parent">
                                <div class="card-body color-white font-size-14 pl-20">
                                    <img class="img-fluid" src="{{ asset('img/dashboard.jpg') }}" alt="Why Us">
                                </div>
                            </div>
                        </div>
                        <div class="card background-transparent border-0">
                            <div id="multi-collapse-image-5" class="collapse multi-collapse-why-us-5" data-parent="#accordion-why-us-parent">
                                <div class="card-body color-white font-size-14 pl-20">
                                    <img class="img-fluid" src="{{ asset('img/dashboard.jpg') }}" alt="Why Us">
                                </div>
                            </div>
                        </div>
                        <div class="card background-transparent border-0">
                            <div id="multi-collapse-image-6" class="collapse multi-collapse-why-us-6" data-parent="#accordion-why-us-parent">
                                <div class="card-body color-white font-size-14 pl-20">
                                    <img class="img-fluid" src="{{ asset('img/dashboard.jpg') }}" alt="Why Us">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end: why us -->
<!-- start: recommend us -->
@component('_partials.recommend_us')
@endcomponent
<!-- end: recommend us -->
<!-- start: FAQ -->
@component('_partials.question')
@endcomponent
<!-- end: FAQ -->
<!-- start: work with us -->
<section class="section-content background-light-orange section-property-lister-lease-my-property">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="work-with-us d-flex flex-column flex-wrap justify-content-center align-items-center py-50">
                    @if($page == 'housemate')
                        <p class="font-mono text-color-orange text-uppercase text-center mb-35">START FINDING COMPATIBLE HOUSEMATES</p>
                        <h3 class="font-size-28 font-weight-bold text-center mb-35">Sublease my property effortlessly</h3>
                        <button type="button" class="btn btn-primary btn-wide" data-toggle="modal" data-target="#modalPropertyLister">{{ getLocale($locale_property_index, 'label-jumbotron4-3', 'Get Started') }}</button>

                        <p class="mt-10">{{ session('locale')=='id' ? 'minta bantuan kami' : 'ask our help' }}</a> {{ session('locale')=='id' ? 'untuk mengiklankan properti Anda' : 'to list your property' }}.</p>
                    @elseif($page == 'agent' || $page == 'building-management')
                        <p class="font-mono text-color-orange text-uppercase text-center mb-35">START GENERATING QUALITY LEADS</p>
                        <h3 class="font-size-28 font-weight-bold text-center mb-35">Lease my property inventory effortlessly</h3>
                        <button type="button" class="btn btn-primary btn-wide" data-toggle="modal" data-target="#modalPropertyLister">{{ getLocale($locale_property_index, 'label-jumbotron4-3', 'Get Started') }}</button>

                        <p class="mt-10">{{ session('locale')=='id' ? 'minta bantuan kami' : 'ask our help' }}</a> {{ session('locale')=='id' ? 'untuk mengiklankan properti Anda' : 'to list your property' }}.</p>
                    @else
                        <p class="font-mono text-color-orange text-uppercase text-center mb-35">START GENERATING QUALITY LEADS</p>
                        <h3 class="font-size-28 font-weight-bold text-center mb-35">{{ getLocale($locale_property_index, 'label-jumbotron4-2', 'Lease my property effortlessly') }}</h3>
                        <button type="button" class="btn btn-primary btn-wide" data-toggle="modal" data-target="#modalPropertyLister">{{ getLocale($locale_property_index, 'label-jumbotron4-3', 'Get Started') }}</button>

                        <p class="mt-10">{{ session('locale')=='id' ? 'atau ' : 'or ' }}<a href="#" onclick="event.preventDefault();">{{ session('locale')=='id' ? 'minta bantuan kami' : 'ask our help' }}</a> {{ session('locale')=='id' ? 'untuk mengiklankan properti Anda' : 'to list your property' }}.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
