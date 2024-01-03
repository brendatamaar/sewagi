@extends('_partials.master_solid_property')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-9 pt-28">
            <h3 class="text-color-dark">Amazing Cityspace - Cipete Utara</h3>
            <p class="mb-0 font-size-14 text-color-gray-8">Cipete, Jakarta Selatan</p>
        </div>
    </div>
<div class="tabs" data-background-color="white" id="shortcut-menu">
    <nav class="container" id="nav-sections">
        <ul class="nav nav-tabs tabs-default text-uppercase">
            <li class="nav-item active">
                <a class="nav-link" href="#about">
                    {{ getLocale($locale_detail_property, 'label-title-tab-1', 'About') }}
                </a>
            </li>
            @if(count($detail->propertyPrice) > 0)
            <li class="nav-item">
                <a class="nav-link" href="#inclusive-sec">
                    {{ getLocale($locale_detail_property, 'label-title-tab-2', 'Inclusive Service') }}
                </a>
            </li>
            @endif
            <li class="nav-item">
                <a class="nav-link" href="#amenities">
                    {{ getLocale($locale_detail_property, 'label-title-tab-3', 'Amenities') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#facilities">
                    {{ getLocale($locale_detail_property, 'label-title-tab-4', 'Facilities') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#room-arrangements">
                    {{ getLocale($locale_detail_property, 'label-title-tab-5', 'Rooms Arrangements') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#house-rules">
                    {{ getLocale($locale_detail_property, 'label-title-tab-6', 'House Rules & Cancellation') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#neighborhood">
                    {{ getLocale($locale_detail_property, 'label-title-tab-7', 'Neighborhood') }}
                </a>
            </li>
            <!-- <li class="scrollTop"><a href="#"><span class="entypo-up-open"></span></a></li> -->
        </ul>
    </nav>
</div>

<div class="position-relative">
    <div class="container px-0">
        <div id="carousel-detail" class="card-img-top carousel slide carousel-watcher" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item-active">
                    <a class="fancybox-thumbs" data-fancybox-group="thumb" href="https://cdn.pixabay.com/photo/2016/11/18/17/46/architecture-1836070_1280.jpg">
                        <img class="d-block w-100" src="https://cdn.pixabay.com/photo/2016/11/18/17/46/architecture-1836070_1280.jpg">
                    </a>
                </div>
            </div>
            <ol class="carousel-indicators">
                <li data-target="#carousel-detail" data-slide-to="1" class="active"></li>
            </ol>
            <button type="button" class="btn btn-prev btn-primary" role="button" data-target="#carousel-detail" data-slide="prev">←</button>
            <button type="button" class="btn btn-next btn-primary" role="button" data-target="#carousel-detail" data-slide="next" disabled="">→</button>
        </div>
        <div class="col-sm-6 offset-sm-1">
            <button type="button" class="btn btn-info btn-lg btn-slider-dark background-primary-dark" data-toggle="modal" data-target="#list-slider-btn">View {{ $totalPhoto }} photos</button>

            <!-- The Modal -->
            <div id="list-slider-btn" class="modal fade" role="dialog">

                <div class="modal-dialog">
                <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <a class="navbar-brand" href="{{ url('') }}">Navbar</a>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <span>close</span>
                        </div>
                        <div class="modal-body">
                            <div class="container">
                                @foreach($types as $type)
                                <div class="row">
                                    <h5 class="p-15">{{ ucwords($type)}}</h5>
                                    @foreach($sliderImages as $key => $value)
                                        @if($value->imagable->name == $type)
                                            @if($key == 0)
                                                <div class="col-md-12 py-10">
                                            @else
                                                <div class="col-md-6 py-10">
                                            @endif
                                                <img class="d-block w-100" src="{{ rtrim(env('AWS_URL'), '/')}}/{{ trim($value->path, '/') }}">
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<section id="property-content">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-1">
                <div id="about" class="py-50">
                    <div class="container">
                        <div class="row mt-4">
                            <div class="col-md-12 text-color-gray-1">
                                <div class="d-flex align-items-start font-size-14 mb-3">
                                    <img src="{{ asset('img/001-home.svg') }}" class="mr-2" width="24px">
                                        <ul class="category-list dot-separator">
                                            <li><b>72 m<sup>2</sup></b></li>
                                            <li><b>below 5 stories</b></li>
                                            <li><b>3 bedroom</b></li>
                                            <li><b>2 bathroom</b></li>
                                        </ul>
                                </div>
                                <div>
                                    Cipete Utara is a place for dreamers to reset, reflect and create. Designed with a 'slow' pace in mind, our hope is that you enjoy every part of your stay; from making local coffee by drip in the morning, choosing the perfect record to put as the sun sets, or by relaxing in the hot tub surrounded by a starry night sky.
                                </div>
                                <div class="d-flex align-items-center mt-2 mb-15">
                                    <div class="text-uppercase font-size-12 text-color-gray-7 mr-1">{{ session('locale') == 'en' ? 'Style' : 'Model' }}</div>
                                    <ul class="category-list font-size-14 text-color-gray-1 font-weight-600">
                                        <li><a class="no-style" href="javascript:void(0);">#modern</a></li>
                                        <li><a class="no-style" href="javascript:void(0);">#minimalist</a></li>
                                        
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-3"></div>
                        </div>
                    </div>
                </div>
                <hr>
                <div id="inclusive-sec" class="py-50">
                    <div class="container">
                        <div class="row mt-4 mb-4">
                            <div class="col-md-12 d-flex flex-wrap align-items-center">
                                <h3 class="mb-0 flex-fill text-dark">{{ getLocale($locale_detail_property, 'label-title-1', 'Inclusive services & charges') }}</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="ml-30 mt-10">Entire House</h4>
                                <div class="row text-color-gray-1 mb-4">
                                    <div class="feature-grid">
                                        <!-- <img src="https://sewagi-web.inspira.web.id/img/001-home.svg" class="mr-2" width="24px"> -->
                                        <i class="fas fa-globe"></i>
                                        <div>{{ session('locale')=='en' ? 'Internet' : 'Internet' }}</div>
                                    </div>
                                    <div class="feature-grid">
                                        <!-- <img src="https://sewagi-web.inspira.web.id/img/001-home.svg" class="mr-2" width="24px"> -->
                                        <i class="fa fa-parking"></i>
                                        <div>{{ session('locale')=='en' ? 'Private parking slot' : 'Parkir pribadi' }}</div>
                                    </div>
                                    <div class="feature-grid">
                                        <!-- <img src="https://sewagi-web.inspira.web.id/img/001-home.svg" class="mr-2" width="24px"> -->
                                        <i class="fa fa-tv"></i>
                                        <div>{{ session('locale')=='en' ? 'TV cable' : 'TV kabel' }}</div>
                                    </div>
                                    <div class="feature-grid">
                                        <!-- <img src="https://sewagi-web.inspira.web.id/img/001-home.svg" class="mr-2" width="24px"> -->
                                        <i class="fas fa-broom"></i>
                                        <div>{{ session('locale')=='en' ? 'Cleaning service' : 'Layanan kebersihan' }}</div>
                                    </div>
                                    <div class="feature-grid">
                                        <!-- <img src="https://sewagi-web.inspira.web.id/img/001-home.svg" class="mr-2" width="24px"> -->
                                        <i class="far fa-building"></i>
                                        <div>{{ session('locale')=='en' ? 'Resident service charge fee' : 'Biaya layanan warga' }}</div>
                                    </div>
                                    
                                </div>

                                <h4 class="ml-30 mt-10">Co-Living</h4>
                                <div class="row text-color-gray-1 mb-4">
                                    <div class="feature-grid">
                                        <!-- <img src="https://sewagi-web.inspira.web.id/img/001-home.svg" class="mr-2" width="24px"> -->
                                        <i class="fas fa-globe"></i>
                                        <div>{{ session('locale')=='en' ? 'Internet' : 'Internet' }}</div>
                                    </div>
                                    <div class="feature-grid">
                                        <!-- <img src="https://sewagi-web.inspira.web.id/img/001-home.svg" class="mr-2" width="24px"> -->
                                        <i class="fa fa-tv"></i>
                                        <div>{{ session('locale')=='en' ? 'TV cable' : 'TV kabel' }}</div>
                                    </div>
                                    <div class="feature-grid">
                                        <!-- <img src="https://sewagi-web.inspira.web.id/img/001-home.svg" class="mr-2" width="24px"> -->
                                        <i class="fas fa-broom"></i>
                                        <div>{{ session('locale')=='en' ? 'Cleaning service' : 'Layanan kebersihan' }}</div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div id="amenities" class="py-50">
                    <div class="container">
                        <div class="row mt-4 mb-4">
                            <div class="col-md-12 d-flex flex-wrap align-items-center">
                                <h3 class="mb-0 flex-fill text-dark">{{ getLocale($locale_detail_property, 'label-title-2', 'Amenities') }}</h3>
                                <a href="javascript:void(0);">{{ getLocale($locale_detail_property, 'link-1', 'See all amenities') }} →</a>
                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row text-color-gray-1">
                                    <div class="feature-grid">
                                        <!-- <img src="https://sewagi-web.inspira.web.id/img/001-home.svg" class="mr-2" width="24px"> -->
                                        <i class="fa fa-tv"></i>
                                        <div>Television</div>
                                    </div>

                                    <div class="feature-grid">
                                        <!-- <img src="https://sewagi-web.inspira.web.id/img/001-home.svg" class="mr-2" width="24px"> -->
                                        <i class="fa fa-wifi"></i>
                                        <div>Wi-fi</div>
                                    </div>

                                    <div class="feature-grid">
                                        <!-- <img src="https://sewagi-web.inspira.web.id/img/001-home.svg" class="mr-2" width="24px"> -->
                                        <i class="fa fa-bath"></i>
                                        <div>Bathtub</div>
                                    </div>

                                    <div class="feature-grid">
                                        <!-- <img src="https://sewagi-web.inspira.web.id/img/001-home.svg" class="mr-2" width="24px"> -->
                                        <i class="fa fa-car"></i>
                                        <div>Free Parking</div>
                                    </div>

                                    <div class="feature-grid">
                                        <!-- <img src="https://sewagi-web.inspira.web.id/img/001-home.svg" class="mr-2" width="24px"> -->
                                        <i class="fa fa-briefcase"></i>
                                        <div>Workspace</div>
                                    </div>

                                    <div class="feature-grid">
                                        <!-- <img src="https://sewagi-web.inspira.web.id/img/001-home.svg" class="mr-2" width="24px"> -->
                                        <i class="fa fa-box"></i>
                                        <div>Deposit box</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div id="facilities" class="py-50">
                    <div class="container">
                        <div class="row mt-4 mb-4">
                            <div class="col-md-12 d-flex flex-wrap align-items-center">
                                <h3 class="mb-0 flex-fill text-dark">{{ getLocale($locale_detail_property, 'label-title-3', 'Facilities') }}</h3>
                                <a href="javascript:void(0);">{{ getLocale($locale_detail_property, 'link-2', 'See all facilities') }} →</a>
                               
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="row text-color-gray-1 mb-4">
                                    <div class="feature-grid">
                                        <!-- <img src="https://sewagi-web.inspira.web.id/img/001-home.svg" class="mr-2" width="24px"> -->
                                        <img src="https://img.icons8.com/wired/26/000000/elevator.png">
                                        <div>Elevator</div>
                                    </div>
                                    <div class="feature-grid">
                                        <!-- <img src="https://sewagi-web.inspira.web.id/img/001-home.svg" class="mr-2" width="24px"> -->
                                        <i class="fa fa-user-secret"></i>
                                        <div>24 hours Security</div>
                                    </div>
                                    <div class="feature-grid">
                                        <!-- <img src="https://sewagi-web.inspira.web.id/img/001-home.svg" class="mr-2" width="24px"> -->
                                        <i class="fa fa-car"></i>
                                        <div>Parking Space</div>
                                    </div>
                                    <div class="feature-grid">
                                        <!-- <img src="https://sewagi-web.inspira.web.id/img/001-home.svg" class="mr-2" width="24px"> -->
                                        <i class="fa fa-shopping-bag"></i>
                                        <div>Shopping Area</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="room-arrangements" class="width-costum py-50" data-background-color="aqua">
                    <div class="container pt-5">
                        <div class="row">
                            <div class="col-md-6 offset-md-1">
                                <h3 class="flex-fill text-dark">{{ getLocale($locale_detail_property, 'label-title-4', 'Room Arrangements') }}</h3>
                                <div class="list-n-divider">
                                <div class="py-30">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div id="carousel-room-item-0" class="carousel slide text-color-white" data-ride="carousel">
                                                    <div class="carousel-inner">
                                                   
                                                        <div class="carousel-item">
                                                            <img class="d-block w-100" src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?ixlib=rb-0.3.5&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;s=0cf4ef4cb623c8a52b1a624f76eaf5bf&amp;auto=format&amp;fit=crop&amp;w=750&amp;q=80">
                                                        </div>
                                                        <div class="carousel-item active">
                                                            <img class="d-block w-100" src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?ixlib=rb-0.3.5&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;s=0cf4ef4cb623c8a52b1a624f76eaf5bf&amp;auto=format&amp;fit=crop&amp;w=750&amp;q=80">
                                                        </div>
                                                        <div class="carousel-item">
                                                            <img class="d-block w-100" src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?ixlib=rb-0.3.5&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;s=0cf4ef4cb623c8a52b1a624f76eaf5bf&amp;auto=format&amp;fit=crop&amp;w=750&amp;q=80">
                                                        </div>
                                                    </div>
                                                    <ol class="carousel-indicators">
                                                        <li data-target="#carousel-room-item-0" data-slide-to="0" class=""></li>
                                                        <li data-target="#carousel-room-item-0" data-slide-to="1" class="active"></li>
                                                        <li data-target="#carousel-room-item-0" data-slide-to="2" class=""></li>
                                                    </ol>
                                                    <span class="nav-prev no-style ml-1" role="button" data-target="#carousel-room-item-0" data-slide="prev"><i class="fas fa-arrow-left"></i></span>
                                                    <span class="nav-next no-style mr-1" role="button" data-target="#carousel-room-item-0" data-slide="next"><i class="fas fa-arrow-right"></i></span>
                                                </div>
                                            </div>
                                            <div class="col-md-8 d-flex pt-3">
                                                <div class="flex-fill font-size-12 text-color-gray-6">
                                                    <div><h4 class="m-0 text-dark">Master Bedroom</h4></div>
                                                    <div>
                                                        <ul class="category-list dot-separator">
                                                            <li><i class="fa fa-expand mr-2 text-color-turqoise"></i>49 m²</li>
                                                        </ul>
                                                    </div>
                                                    <div>
                                                        <ul class="category-list dot-separator">
                                                            <li>
                                                                Furnished
                                                            </li>
                                                           <li>King size bed</li>
                                                        </ul>
                                                        <ul class="category-list dot-separator">
                                                            <li>Private bathroom</li>
                                                            <li>TV</li>
                                                            <li>Deposit Box</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <span class="btn-group-toggle btn-select-room-arrangement" data-toggle="buttons">
                                                    <label class="btn btn-outline-primary btn-select">
                                                        <input type="checkbox" value="1-1">
                                                        <span>Select</span>
                                                    </label>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                <div class="housemate-item d-flex font-size-12 py-10 mt-20" data-background-color="orange-2">
                                    <div class="text-color-dark mt-2 ml-3 font-weight-600">Meet your housemate</div>
                                        <div class="flex-fill">
                                            <div class="w-100 d-flex mt-1 mb-1">
                                                <div class="ml-2 mr-2 icon-circle-small flex-auto" data-background-color="orange">
                                                    <i class="icon icon-small fas fa-venus"></i>
                                                </div>
                                                <ul class="mt-1 category-list dot-separator text-color-gray-1">
                                                    <li>Neat</li>
                                                    <li>College student</li>
                                                    <li>Pet lovers</li>
                                                    <li>Talkative</li>
                                                    <li>Musician</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="house-rules" class="width-costum py-50 accordion" data-background-color="dark">
                    <div class="container pt-5 pb-5">
                        <div class="row">
                            <div class="col-md-6 offset-md-1 accordion">
                                <h3 class="mb-10 flex-fill">{{ getLocale($locale_detail_property, 'label-title-5', 'House rules & cancellation') }}</h3>
                                <div class="font-size-20 font-weight-600 pt-4 pb-3">{{ getLocale($locale_detail_property, 'label-title-5-1', 'General rules') }}</div>
                                <div class="mb-20">
                                    <ul class="custom-list">
                                        <li>{{ getLocale($locale_detail_property, 'link-content-5-1-1', 'Not safe or suitable for infants (Under 2 years)') }}</li>
                                        <li>{{ getLocale($locale_detail_property, 'link-content-5-1-2', 'Not suitable for pets') }}</li>
                                        <li>{{ getLocale($locale_detail_property, 'link-content-5-1-3', 'Check-in is anytime after 2PM') }}</li>
                                        <li>{{ getLocale($locale_detail_property, 'link-content-5-1-4', 'Self check-in with building staff') }}</li>
                                    </ul>
                                    <ul id="collapse-rules" class="custom-list collapse" data-parent="#house-rules">
                                        <li>{{ getLocale($locale_detail_property, 'link-content-5-1-5', 'Not safe or suitable for infants (Under 2 years)') }}</li>
                                        <li>{{ getLocale($locale_detail_property, 'link-content-5-1-6', 'Not suitable for pets') }}</li>
                                        <li>{{ getLocale($locale_detail_property, 'link-content-5-1-7', 'Check-in is anytime after 2PM') }}</li>
                                        <li>{{ getLocale($locale_detail_property, 'link-content-5-1-8', 'Self check-in with building staff') }}</li>
                                    </ul>
                                    <a href="javascript:void(0);" data-target="#collapse-rules" class="collapse-animated font-size-14 mb-3 collapsed" data-toggle="collapse">{{ getLocale($locale_detail_property, 'link-title-5-1', 'See all general rules') }}<span class="collapse-widget"><i class="fas fa-chevron-up"></i></span>
                                    </a>
                                </div>
                                <div class="font-size-20 font-weight-600 pt-4 pb-3">{{ getLocale($locale_detail_property, 'label-title-5-2', 'You must acknowledge') }}</div>
                                <div class="mb-20">
                                    <ul class="custom-list">
                                        <li>{{ getLocale($locale_detail_property, 'link-content-5-2-1', 'House for female only') }}</li>
                                        <li>{{ getLocale($locale_detail_property, 'link-content-5-2-2', 'If you damage the home, you may be charged up to Rp 6933600') }}</li>
                                        <li>{{ getLocale($locale_detail_property, 'link-content-5-2-3', 'Loud noise would be disrespectful to neighbours') }}</li>
                                        <li>{{ getLocale($locale_detail_property, 'link-content-5-2-4', 'Use ASHTRAYS for cigarettes and no smoking inside bedrooms.') }}</li>
                                    </ul>
                                    <ul id="collapse-acknowledge" class="custom-list collapse" data-parent="#house-rules">
                                        <li>{{ getLocale($locale_detail_property, 'link-content-5-2-5', 'House for female only') }}</li>
                                        <li>{{ getLocale($locale_detail_property, 'link-content-5-2-6', 'If you damage the home, you may be charged up to Rp 6933600') }}</li>
                                        <li>{{ getLocale($locale_detail_property, 'link-content-5-2-7', 'Loud noise would be disrespectful to neighbours') }}</li>
                                        <li>{{ getLocale($locale_detail_property, 'link-content-5-2-8', 'Use ASHTRAYS for cigarettes and no smoking inside bedrooms.') }}</li>
                                    </ul>
                                    <a href="javascript:void(0);" data-target="#collapse-acknowledge" class="collapse-animated font-size-14 mb-3 collapsed" data-toggle="collapse">{{ getLocale($locale_detail_property, 'link-title-5-2', 'See all rules') }}<span class="collapse-widget"><i class="fas fa-chevron-up"></i></span>
                                    </a>
                                </div>
                                <div class="font-size-20 font-weight-600 pt-4 pb-3">{{ getLocale($locale_detail_property, 'label-title-5-3', 'Cancellation policy') }}</div>
                                <div class="mb-20">
                                    <div>
                                        {{ getLocale($locale_detail_property, 'link-content-5-3-1', 'Cancel up to 5 days before check in and get a full refund (minus service fees). Cancel within 5 days of your trip and the
                                        first night is non-refundable, but 50% of the cost for the remaining nights will be refunded. Service
                                        fees are refunded when cancellation happens before check in and within 48 hours of booking.') }}
                                    </div>
                                    <div id="collapse-cancellation" class="collapse" data-parent="#house-rules">
                                        {{ getLocale($locale_detail_property, 'link-content-5-3-2', 'Cancel up to 5 days before check in and get a full refund (minus service fees). Cancel within 5 days of your trip and the
                                        first night is non-refundable, but 50% of the cost for the remaining nights will be refunded. Service
                                        fees are refunded when cancellation happens before check in and within 48 hours of booking.') }}
                                    </div>
                                    <a href="javascript:void(0);" data-target="#collapse-cancellation" class="collapse-animated font-size-14 mb-3 collapsed" data-toggle="collapse">{{ getLocale($locale_detail_property, 'link-title-5-3', 'See cancelation details') }}<span class="collapse-widget"><i class="fas fa-chevron-up"></i></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="sidebase-sticky justify-content-center">
                    <div class="container booking-sticky-container booking-sticky">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="booking-sticky-content" style="width: 337px">
                                    <input type="hidden" id="property-id" value="1">
                                    <div class="btn-group-toggle d-flex border-bottom px-9 py-16 col-md-12" data-toggle="buttons">
                                        <button class="col-md-6 btn btn btn-checkbox btn-outline-primary flex-fill living-condition active px-0 py-6 mr-0 ml-5" style="text-transform:none" data-value="entire-space">
                                            <input type="radio" name="living-conditions" value="entire-space">
                                            Entire House
                                        </button>
                                        <button class="col-md-6 btn btn-checkbox btn-outline-primary flex-fill mr-2 living-condition active px-0 py-6 mr-5 ml-16" style="text-transform:none" data-value="co-living">
                                            <input type="radio" name="living-conditions" value="co-living">
                                            Co-Living
                                        </button>
                                    </div>
                                    <div class="d-flex" style="height: 60px">
                                        <div class="tabs-navigator left" data-navi="prev"><img src="{{ asset('img/ic_sticky_arrow_left.svg') }}" class="icon-slide" alt="slide to left"></div>
                                        <ul class="d-flex flex-fill nav nav-tabs tabs-default tabs-fill text-uppercase btn-group-toggle" data-toggle="buttons" id="lengthofstay">
                                            <li class='nav-item'>
                                                <div class='nav-link active btn'>
                                                    <input type="radio" name="monthly" value="1" checked="checked">1 Year
                                                </div>
                                            </li>
                                            <li class='nav-item'>
                                                <div class='nav-link btn'>
                                                    <input type="radio" name="monthly" value="1">6 Month
                                                </div>
                                            </li>
                                            <li class='nav-item'>
                                                <div class='nav-link btn'>
                                                    <input type="radio" name="monthly" value="1">3 Month
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="tabs-navigator right" data-navi="next"><span class="fas fa-chevron-right"></span></div>
                                        
                                    </div>
                                    <div class="col btm-sticky px-32 pt-21 py-10">
                                        <div class="form-group mb-10 pt-0" id="bedroom-type-select">
                                            <select class="select2 js-select2 form-control input-aqua mb-10" id="bedroom-type" name="bedroom-type">
                                                <option value="master">Master Bedroom</option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-10">
                                            <select class="select2 form-control input-aqua mb-10" id="pricepaid">
                                                <option value="paid-1" data-description="PAID ONCE">IDR {{ number_format("120000000") }} PAID ONCE</option>
                                                <option value="paid-1" data-description="PAID TWICE">IDR {{ number_format("70000000") }} PAID TWICE</option>
                                                <option value="paid-1" data-description="PAID QUARTERLY">IDR {{ number_format("50000000") }} PAID QUARTERLY</option>
                                                <option value="paid-1" data-description="PAID MONTHLY">IDR {{ number_format("13500000") }}PAID MONTHLY</option>
                                                
                                            </select>
                                        </div>
                                        <div class="text-center font-size-12 mt-2 mb-10 lets-negotiate" style="display:none">
                                            {{ getLocale($locale_detail_property, 'link-box-1', 'Not Satisfied with the price?') }} <a href="javascript:void(0);" class="negotiate-btn" data-dismiss="modal" data-toggle="modal" data-target="#modalLetsNego">{{ getLocale($locale_detail_property, 'link-box-2', "Let's Negotiate") }}</a>
                                        </div>
                                        <div class="form-group installment_option" style="display:none">
                                            <a href="javascript:void(0);" class="btn btn-orange btn-block" id="view-monthly-installment">
                                                {{ getLocale($locale_detail_property, 'label-installment-1', 'VIEW MONTHLY INSTALLMENT RATE') }}
                                            </a>
                                        </div>
                                        <div id="monthly-installment-holder" style="display: none;">
                                            <a href="javascript:void(0);" class="btn btn-outline-orange btn-block" id="close-monthly-installment">
                                                {{ getLocale($locale_detail_property, 'label-installment-2', 'CLOSE MONTHLY INSTALLMENT RATES') }}
                                            </a>
                                            <a href="javascript:void(0);" role="button" data-toggle="popover" id="payment-schedule" class="btn-monthly-installment btn-white p-7 mt-7 gradana">
                                                <img src="{{url('/img/gradana.png')}}" alt="">
                                                <h4>
                                                    <div id="cicilanbulan"></div>
                                                    <small>
                                                        {{ getLocale($locale_detail_property, 'label-installment-3', 'PAID MONTHLY') }}
                                                    </small>
                                                </h4>
                                            </a>
                                            <a href="javascript:void(0);" data-toggle="popover" data-trigger="focus" data-container="body" data-placement="right" role="button" data-html="true" id="payment-schedule1" class="btn-monthly-installment btn-white p-7 mt-7 cicil_sewa" style="display:none;">
                                                <img src="{{url('/img/cicilsewa.png')}}" style="width:53px;height:35px; alt="">
                                                <h4>
                                                    <div id="cicilanbulansewa"></div>
                                                    <small>
                                                        {{ getLocale($locale_detail_property, 'label-installment-3', 'PAID MONTHLY') }}
                                                    </small>
                                                </h4>
                                            </a>
                                        </div>
                                        <div id="popover-content-payment-schedule" class="popover-custom" style="display: none">
                                            <div class="pop-header pop-secondary">
                                                {{ getLocale($locale_detail_property, 'label-installment-4', 'Payment schedule') }}
                                                <div class="close-popover" data-dismiss="popover">
                                                    <i class="fas fa-times pointer"></i>
                                                </div>
                                            </div>
                                            <div class="pop-body">
                                            <div id="gradanaTable"></div>
                                            </div>
                                        </div>
                                        <div id="popover-content-payment-schedule1" class="popover-custom" style="display: none">
                                            <div class="pop-header pop-secondary">
                                                {{ getLocale($locale_detail_property, 'label-installment-4', 'Payment schedule') }}
                                                <div class="close-popover" data-dismiss="popover">
                                                    <i class="fas fa-times pointer"></i>
                                                </div>
                                            </div>
                                            <div class="pop-body">
                                            <div id="cicilsewaTable"></div>
                                            </div>
                                        </div>
                                        <div class="form-group mb-15">
                                            <div class="row">
                                                @if(!Auth::user())
                                                    <div class="col-md-6 pr-lg-5">
                                                        <button type="button" class="btn btn-outline-primary btn-block px-0 py-9 font-size-12" style="line-height: 13px; letter-spacing: 0px" data-toggle="modal" data-target="#modalLogin" data-value="onsite">
                                                            {{ getLocale($locale_detail_property, 'label-installment-5', 'SCHEDULE') }}<br>{{ getLocale($locale_detail_property, 'label-installment-6', 'ONSITE TOUR') }}
                                                        </button>
                                                    </div>
                                                    <div class="col-md-6 pl-lg-5">
                                                        <button type="button" class="btn btn-outline-primary btn-block px-0 py-9 font-size-12" style="line-height: 13px; letter-spacing: 0px" data-toggle="modal" data-target="#modalLogin" data-value="virtual">
                                                            {{ getLocale($locale_detail_property, 'label-installment-5', 'SCHEDULE') }}<br>{{ getLocale($locale_detail_property, 'label-installment-7', 'LIVE VIRTUAL TOUR') }}
                                                        </button>
                                                    </div>
                                                @else
                                                    <div class="col-md-6 pr-lg-5">
                                                        <button type="button" class="btn btn-outline-primary btn-block px-0 py-9 schedule-btn font-size-12" style="line-height: 13px; letter-spacing: 0px" data-value="onsite">
                                                            {{ getLocale($locale_detail_property, 'label-installment-5', 'SCHEDULE') }}<br>{{ getLocale($locale_detail_property, 'label-installment-6', 'ONSITE TOUR') }}
                                                        </button>
                                                    </div>
                                                    <div class="col-md-6 pl-lg-5">
                                                        <button type="button" class="btn btn-outline-primary btn-block px-0 py-9 schedule-btn font-size-12" style="line-height: 13px; letter-spacing: 0px" data-value="virtual">
                                                            {{ getLocale($locale_detail_property, 'label-installment-5', 'SCHEDULE') }}<br>{{ getLocale($locale_detail_property, 'label-installment-7', 'LIVE VIRTUAL TOUR') }}
                                                        </button>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group mb-7">
                                            <a href="javascript:void(0);" class="btn btn-primary btn-block booknow-btn" data-dismiss="modal" data-toggle="modal" data-target="#modalVisitThisProperty">
                                                BOOK NOW
                                            </a>
                                        </div>
                                        <!--<button type="button" class="btn btn-block p-10 mt-10 btn-primary text-uppercase schedule-btn click-trigger">Schedule a Tour</button>-->
                                        <!-- <button type="button" class="btn btn-block p-2 btn-outline-primary text-uppercase">Book now without a Tour</button> -->
                                        <a data-toggle="popover" data-container="body" data-trigger="focus" data-placement="right" role="button" data-html="true" id="published-rates" class="font-size-12 text-center btn-block" href="javascript:void(0);">{{ getLocale($locale_detail_property, 'label-installment-9', 'Read more about published rates') }}</a>
                                        <div id="popover-content-published-rates" class="popover-custom" style="display: none">
                                            <div class="pop-header pop-primary">
                                                {{ getLocale($locale_detail_property, 'label-installment-10', 'More about published rates') }}
                                                <div class="close-popover" data-dismiss="popover">
                                                    <i class="fas fa-times pointer"></i>
                                                </div>
                                            </div>
                                            <div class="pop-body">
                                                <div>
                                                    <p><strong>
                                                        {{ getLocale($locale_detail_property, 'label-installment-11', 'Non inclusive in published rates') }}
                                                    </strong></p>
                                                    <p>{{ getLocale($locale_detail_property, 'label-installment-12', 'Residence charge IDR') }} 2,500,000 / {{ getLocale($locale_detail_property, 'label-month', 'Month') }}<br>
                                                        {{ getLocale($locale_detail_property, 'label-installment-13', "Renter's insurance fee") }} ~ {{ getLocale($locale_detail_property, 'label-idr', 'IDR') }} 150,000
                                                    </p>
                                                    <p id="installment_term" style="display:none;"><strong>Installment rates do not include<br>
                                                        deposit and any administrative fee
                                                    </strong></p>
                                                </div>

                                            </div>
                                        </div>
                                        <!--<div class="text-center font-size-12 mt-2 mb-2 gradana" style="display:none"><a href="" data-toggle="modal" data-target="#modalGradana" class="negotiate-btn">Test Gradana</a></div>-->
                                    </div>
                                    <div class="d-flex">
                                        <button class="btn btn-footer flex-fill btn-white"><img src="{{ asset('img/ic_logout.svg') }}">          {{ getLocale($locale_detail_property, 'label-share', 'Share it') }}</button>
                                        <button class="btn btn-footer flex-fill btn-white"><img src="{{ asset('img/ic_save_it.svg') }}">          {{ getLocale($locale_detail_property, 'label-save', 'Save It') }}</button>
                                        <button class="btn btn-footer flex-fill btn-white"><img src="{{ asset('img/ic_heart.svg') }}">          {{ getLocale($locale_detail_property, 'label-favourites', 'Favorites') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="neighborhood" class="py-50">
    <div class="container">
        <nav id="neighborhood-tabs">
            <ul class="mb-30 col-sm-12 nav nav-tabs tabs-default text-uppercase" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active show" data-toggle="tab" href="#neighborhood-tab-0" role="tab">{{ getLocale($locale_detail_property, 'label-neighourhood-1', 'F&B') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#neighborhood-tab-1" role="tab">{{ getLocale($locale_detail_property, 'label-neighourhood-2', 'Entertaiment') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#neighborhood-tab-2" role="tab">{{ getLocale($locale_detail_property, 'label-neighourhood-3', 'Hospitals') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#neighborhood-tab-3" role="tab">{{ getLocale($locale_detail_property, 'label-neighourhood-4', 'Stations') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#neighborhood-tab-4" role="tab">{{ getLocale($locale_detail_property, 'label-neighourhood-5', 'Education') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#neighborhood-tab-5" role="tab">{{ getLocale($locale_detail_property, 'label-neighourhood-6', 'Sports') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#neighborhood-tab-6" role="tab">{{ getLocale($locale_detail_property, 'label-neighourhood-7', 'House of worship') }}</a>
                </li>
            </ul>
        </nav>
        <div class="row" id="map-list">
            <div class="col-sm-4 order-sm-0 order-1 map-marker-list">
                <div class="tab-content pb-5">
                </div>
            </div>
            <div class="col-sm-7 map mb-5">
                <div id="neighborhood-map" style="height:300px;"></div>
                <button class="marker-full-btn btn btn-primary">{{ getLocale($locale_detail_property, 'label-neighourhood-8', 'View full map') }}</button>
            </div>
        </div>
    </div>
</section>
<!-- start: modal lets negotiate -->
<div class="modal modal-styled fade" id="modalLetsNego" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-btn-close" data-dismiss="modal" aria-label="Close">
                <img src="{{url('img/close-big.png')}}" alt="">
            </div>
            <div class="modal-body">
                <div class="modal-title">
                    {{ getLocale($locale_detail_property, 'label-nego-1', 'Negotiate your rate') }}
                </div>
                <form action="">
                    <div class="form-group">
                        <label class="text-muted">{{ getLocale($locale_detail_property, 'label-nego-2', 'LENGTH OF STAY') }}</label>
                        <select class="select2 js-select2" placeholder="Select year">
                            <option value=""></option>
                            @foreach($length as $key => $val)
                            <option value="{{ $val }}">
                                @if($val == 12)
                                    1 {{ getLocale($locale_detail_property, 'label-year', 'year') }}
                                @else
                                    @if (session('locale')=='id')
                                        {{ $val }} Bulan
                                    @else
                                        {{ $val }} Month{{ $val > 1 ? 's' : '' }}
                                    @endif
                                @endif
                            </option>
                            <!--<option value="9 months">9 months</option>
                            <option value="6 months">6 months</option>
                            <option value="3 months">3 months</option>-->
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="text-muted">{{ getLocale($locale_detail_property, 'label-nego-3', 'PAYMENT OPTION') }}</label>
                        <select class="select2 js-select2" placeholder="Select payment option">
                            <option value=""></option>
                            <option value="Paid quarterly">{{ getLocale($locale_detail_property, 'label-nego-4', 'Paid') }} {{ getLocale($locale_detail_property, 'label-nego-5', 'quarterly') }}</option>
                            <option value="Paid quarterly">{{ getLocale($locale_detail_property, 'label-nego-4', 'Paid') }} {{ getLocale($locale_detail_property, 'label-nego-5', 'quarterly') }}</option>
                            <option value="Paid quarterly">{{ getLocale($locale_detail_property, 'label-nego-4', 'Paid') }} {{ getLocale($locale_detail_property, 'label-nego-5', 'quarterly') }}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="text-muted">{{ getLocale($locale_detail_property, 'label-nego-6', 'RATE PROPOSITION') }}</label>
                        <div id="rate-proposition-slider"></div>
                    </div>
                    <div class="form-group">
                        <label class="text-muted">{{ getLocale($locale_detail_property, 'label-nego-7', 'INPUT RATE PROPOSITION MANUALLY') }}</label>
                        <div class="input-group">
                            <div class="input-group-append border-right-custom">
                                <span class="font-weight-bolder">{{ getLocale($locale_detail_property, 'label-idr', 'IDR') }}</span>
                            </div>
                            <input type="number" class="form-control form-control-noborder form-control-styled" placeholder="{{ getLocale($locale_detail_property, 'label-nego-8', 'OR manually input your desired rate') }}">
                        </div>
                    </div>
                </form>
                <div class="d-flex justify-content-center">
                    <a href="#" class="btn btn-primary btn-block" data-dismiss="modal" data-toggle="modal" data-target="#modalThankYouNego">{{ getLocale($locale_detail_property, 'label-nego-9', 'SUBMIT RATE OFFER') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end: modal lets negotiate -->
<!-- start: modal book now -->
<div class="modal modal-styled fade" id="modalVisitThisProperty" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered" style="width: 337px" role="document">
        <div class="modal-content">
            <input type="hidden" id="property-id" name="property-id" value="" />
            <input type="hidden" id="living-condition" name="living-condition" value="" />
            <input type="hidden" id="month" name="month" value="" />
            <input type="hidden" id="bedroom" name="bedroom" value="" />
            <input type="hidden" id="price" name="price" value="" />
            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
            <div class="modal-btn-close" data-dismiss="modal" aria-label="Close">
                <img src="{{url('img/close-big.png')}}" alt="">
            </div>
            <div class="modal-body mb-0 px-15 pb-10">
                <div class="modal-title px-5">
                    <h6>
                        {{ getLocale($locale_detail_property, 'label-visit-1', 'We strongly advise you to visit this property before booking it, to ensure that it meets all your expectations.') }}
                    </h6>
                </div>
                <div class="row">
                    <div class="col-lg-12 mx-auto">
                        <div class="form-group px-0">
                            <div class="row">
                                <div class="col-md-6 pl-20 pr-5">
                                    <button type="button" class="btn btn-primary btn-block px-0 schedule-btn font-size-12" data-value="onsite" style="line-height: 13px;letter-spacing: 0px">
                                        {{ getLocale($locale_detail_property, 'label-visit-2', 'SCHEDULE') }}<br>{{ getLocale($locale_detail_property, 'label-visit-3', 'ONSITE TOUR') }}
                                    </button>
                                </div>
                                <div class="col-md-6 pl-5 pr-20">
                                    <button type="button" class="btn btn-primary btn-block px-0 schedule-btn font-size-12" data-value="virtual" style="line-height: 13px;letter-spacing: 0px">
                                        {{ getLocale($locale_detail_property, 'label-visit-2', 'SCHEDULE') }}<br>{{ getLocale($locale_detail_property, 'label-visit-4', 'LIVE VIRTUAL TOUR') }}
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="form-group px-5">
                            <a href="#" class="btn btn-outline-primary btn-block btn-submit-booking">
                                {{ getLocale($locale_detail_property, 'label-visit-5', 'BOOK ANYWAY') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end: modal book now -->
<!-- start: modal message book now -->
<div class="modal fade" id="booking-message-modal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-center pt-4" data-background-color="aqua">
            <div class="modal-body pl-5 pr-5 pb-2">
                <div><img class="img-fluid" src="{{url('img/offer-success.svg')}}" /></div>
                <h3 class="mt-3 font-weight-600 text-color-dark">Thank you!</h3>
                <div class="text-color-gray-1 font-size-14 mt-1">Your price offering has been submitted. Our team member
                    will contact you within 24 hours.</div>
            </div>
            <div class="modal-footer pl-5 pr-5">
                <button type="button" data-dismiss="modal" class="btn btn-primary btn-block">Back to Home</button>
            </div>
        </div>
    </div>
</div>
<!-- end: modal message book now -->
<div class="marker-item mb-3 marker-template d-none">
    <div class="marker-icon">
        <img src="{{url('img/marker.svg')}}" />
        <div class="marker-num">1</div>
    </div>
    <div class="ml-2 marker-info">
        <div class="marker-title">A</div>
        <div class="marker-distance">B</div>
    </div>
</div>
<div class="tab-pane marker-list-template d-none" role="tabpanel">
</div>
<li class="nav-item marker-tab-template d-none">
    <a class="nav-link" data-toggle="tab" href="#neighborhood-tab-fnb" role="tab"></a>
</li>
<section id="listings" class="section-content similar-listing background-aqua py-100">
    <!-- <div class="background-shadow"></div> -->
    <div class="container prop-content">
        <div class="row">
            <div class="col-12">
                <h3 class="font-size-34 font-weight-bold mb-50 pt-20">{{ getLocale($locale_detail_property, 'label-title-6', 'Similar listings') }}</h3>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12 slider-viewed-listings">
                <div class="owl-carousel main-listings-prop owl-loaded owl-drag">
                <!-- start: property item -->

                <!-- end: property item -->
                <!-- start: property item -->

                <!-- end: property item -->
                <!-- start: property item -->

                <!-- end: property item -->
                <!-- start: property item -->

                <!-- end: property item -->
                <!-- start: property item -->

                <!-- end: property item -->
                    <div class="owl-stage-outer">
                        <div class="owl-stage" style="transform: translate3d(-2302px, 0px, 0px); transition: all 0s ease 0s;">
                            <div class="owl-item" style="width: 342.5px; margin-right: 425px;margin-left: 111px">
                                <div class="col-12 property-wrapper">
                                    <div class="property-item">
                                        <div id="" class="pp-images position-relative">
                                            <div class="image-wrapper-2">
                                                <div class="image-sizing-2">
                                                        <img src="https://cdn.pixabay.com/photo/2014/07/10/17/18/large-home-389271_1280.jpg" alt="image">
                                                    <span class="main-tag">#minimalist</span>
                                                </div>
                                            </div>
                                            <div class="position-absolute">
                                                <button class="btn btn-icon-small btn-favorite background-white mb-auto mt-md-40">
                                                    <i class="far fa-heart icon icon-small"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="pp-detail">
                                            <div class="row">
                                                <div class="col-md-12 col-12">
                                                    <div class="pp-highlight border-bottom">
                                                        <div class="pp-tags">
                                                            <span class="card-tag">{{ session('locale')=='en' ? 'Co-Living' : 'Hunian Bersama' }}</span>
                                                            <span class="card-tag card-tag-outline">Entire House</span>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <h4 class="pp-title">Gading Icon</h4>
                                                                <p class="pp-location">Kebayoran Baru, South Jakarta</p>
                                                                <p class="pp-price">{{ getLocale($locale_detail_property, 'label-starting-from', 'Starting from') }} <strong>{{ getLocale($locale_detail_property, 'label-idr', 'IDR') }} 5,260,000 per {{ strtolower(getLocale($locale_detail_property, 'label-month', 'Month')) }}</strong></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-12 d-flex flex-md-column flex-row flex-wrap align-items-md-end align-items-center justify-content-md-end justify-content-between mt-md-0 mt-10">
                                                    <div class="pp-spec d-flex flex-row flex-wrap w-100 justify-content-end">
                                                        <!--<span class="pp-rates">
                                                            <span class="pp-stars">4.5</span>
                                                            <i class="fas fa-star text-color-orange"></i>
                                                            <span class="pp-raters color-light-brown pl-2">(35)</span>
                                                        </span>-->
                                                        <!--<span class="pp-landsize d-flex flex-row flex-wrap justify-content-start align-items-center">
                                                            <img src="/img/pp-landsize.jpg" alt="Landsize">
                                                            <span>m<sup>2</sup></span>
                                                        </span>-->
                                                        <span class="pp-room d-flex flex-row flex-wrap justify-content-start align-items-center">
                                                            <img src="/img/pp-room.jpg" alt="Room">
                                                            <span class="font-weight-bold">2</span>/
                                                            <span>8</span>
                                                        </span>
                                                        <span class="pp-bed d-flex flex-row flex-wrap justify-content-start align-items-center">
                                                            <img src="/img/pp-bed.jpg" alt="Bed">
                                                            <span>2</span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="owl-item" style="width: 342.5px; margin-right: 425px;margin-left: 111px">
                                <div class="col-12 property-wrapper">
                                    <div class="property-item">
                                        <div id="" class="pp-images position-relative">
                                            <div class="image-wrapper-2">
                                                <div class="image-sizing-2">
                                                        <img src="https://cdn.pixabay.com/photo/2014/07/10/17/18/large-home-389271_1280.jpg" alt="image">
                                                    <span class="main-tag">#minimalist</span>
                                                </div>
                                            </div>
                                            <div class="position-absolute">
                                                <button class="btn btn-icon-small btn-favorite background-white mb-auto mt-md-40">
                                                    <i class="far fa-heart icon icon-small"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="pp-detail">
                                            <div class="row">
                                                <div class="col-md-12 col-12">
                                                    <div class="pp-highlight border-bottom">
                                                        <div class="pp-tags">
                                                            <span class="card-tag">{{ session('locale')=='en' ? 'Co-Living' : 'Hunian Bersama' }}</span>
                                                            <span class="card-tag card-tag-outline">Entire House</span>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <h4 class="pp-title">Gading Icon</h4>
                                                                <p class="pp-location">Kebayoran Baru, South Jakarta</p>
                                                                <p class="pp-price">{{ getLocale($locale_detail_property, 'label-starting-from', 'Starting from') }} <strong>{{ getLocale($locale_detail_property, 'label-idr', 'IDR') }} 5,260,000 per {{ strtolower(getLocale($locale_detail_property, 'label-month', 'Month')) }}</strong></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-12 d-flex flex-md-column flex-row flex-wrap align-items-md-end align-items-center justify-content-md-end justify-content-between mt-md-0 mt-10">
                                                    <div class="pp-spec d-flex flex-row flex-wrap w-100 justify-content-end">
                                                        <!--<span class="pp-rates">
                                                            <span class="pp-stars">4.5</span>
                                                            <i class="fas fa-star text-color-orange"></i>
                                                            <span class="pp-raters color-light-brown pl-2">(35)</span>
                                                        </span>-->
                                                        <!--<span class="pp-landsize d-flex flex-row flex-wrap justify-content-start align-items-center">
                                                            <img src="/img/pp-landsize.jpg" alt="Landsize">
                                                            <span>m<sup>2</sup></span>
                                                        </span>-->
                                                        <span class="pp-room d-flex flex-row flex-wrap justify-content-start align-items-center">
                                                            <img src="/img/pp-room.jpg" alt="Room">
                                                            <span class="font-weight-bold">2</span>/
                                                            <span>8</span>
                                                        </span>
                                                        <span class="pp-bed d-flex flex-row flex-wrap justify-content-start align-items-center">
                                                            <img src="/img/pp-bed.jpg" alt="Bed">
                                                            <span>2</span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="owl-item" style="width: 342.5px; margin-right: 425px;margin-left: 111px">
                                <div class="col-12 property-wrapper">
                                    <div class="property-item">
                                        <div id="" class="pp-images position-relative">
                                            <div class="image-wrapper-2">
                                                <div class="image-sizing-2">
                                                        <img src="https://cdn.pixabay.com/photo/2014/07/10/17/18/large-home-389271_1280.jpg" alt="image">
                                                    <span class="main-tag">#minimalist</span>
                                                </div>
                                            </div>
                                            <div class="position-absolute">
                                                <button class="btn btn-icon-small btn-favorite background-white mb-auto mt-md-40">
                                                    <i class="far fa-heart icon icon-small"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="pp-detail">
                                            <div class="row">
                                                <div class="col-md-12 col-12">
                                                    <div class="pp-highlight border-bottom">
                                                        <div class="pp-tags">
                                                            <span class="card-tag">{{ session('locale')=='en' ? 'Co-Living' : 'Hunian Bersama' }}</span>
                                                            <span class="card-tag card-tag-outline">Entire House</span>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <h4 class="pp-title">Gading Icon</h4>
                                                                <p class="pp-location">Kebayoran Baru, South Jakarta</p>
                                                                <p class="pp-price">{{ getLocale($locale_detail_property, 'label-starting-from', 'Starting from') }} <strong>{{ getLocale($locale_detail_property, 'label-idr', 'IDR') }} 5,260,000 per {{ strtolower(getLocale($locale_detail_property, 'label-month', 'Month')) }}</strong></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-12 d-flex flex-md-column flex-row flex-wrap align-items-md-end align-items-center justify-content-md-end justify-content-between mt-md-0 mt-10">
                                                    <div class="pp-spec d-flex flex-row flex-wrap w-100 justify-content-end">
                                                        <!--<span class="pp-rates">
                                                            <span class="pp-stars">4.5</span>
                                                            <i class="fas fa-star text-color-orange"></i>
                                                            <span class="pp-raters color-light-brown pl-2">(35)</span>
                                                        </span>-->
                                                        <!--<span class="pp-landsize d-flex flex-row flex-wrap justify-content-start align-items-center">
                                                            <img src="/img/pp-landsize.jpg" alt="Landsize">
                                                            <span>m<sup>2</sup></span>
                                                        </span>-->
                                                        <span class="pp-room d-flex flex-row flex-wrap justify-content-start align-items-center">
                                                            <img src="/img/pp-room.jpg" alt="Room">
                                                            <span class="font-weight-bold">2</span>/
                                                            <span>8</span>
                                                        </span>
                                                        <span class="pp-bed d-flex flex-row flex-wrap justify-content-start align-items-center">
                                                            <img src="/img/pp-bed.jpg" alt="Bed">
                                                            <span>2</span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="owl-nav">
                        <button type="button" role="presentation" class="owl-prev">
                            <i class="fas fa-long-arrow-alt-left"></i>
                        </button>
                        <button type="button" role="presentation" class="owl-next disabled">
                            <i class="fas fa-long-arrow-alt-right"></i>
                        </button>
                    </div>
                    <div class="owl-dots">
                        <button role="button" class="owl-dot"><span></span></button>
                        <button role="button" class="owl-dot"><span></span></button>
                        <button role="button" class="owl-dot active"><span></span></button>
                    </div>
                </div>
          </div>
        </div>
        <div class="row">
            <div class="col-12">
                <a href="#" class="btn-more-properties outline-none font-weight-bold">{{ getLocale($locale_detail_property, 'link-similar-listing', 'See more similar listing') }} <i class="fas fa-long-arrow-alt-right"></i></a>
            </div>
        </div>
    </div>
</section>
@endsection
@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />
@endpush
@push('js')

<script src="https://cdn.rawgit.com/googlemaps/v3-utility-library/master/markerwithlabel/src/markerwithlabel.js"></script>
<script src="{{asset('plugins/moment/moment.min.js')}}"></script>

<script>
        $(function() {
            $.fn.popover.Constructor.Default.whiteList.table = [];
            $.fn.popover.Constructor.Default.whiteList.tr = [];
            $.fn.popover.Constructor.Default.whiteList.td = [];
            $.fn.popover.Constructor.Default.whiteList.th = [];
            $.fn.popover.Constructor.Default.whiteList.div = [];
            $.fn.popover.Constructor.Default.whiteList.button = [];
            $.fn.popover.Constructor.Default.whiteList.tbody = [];
            $.fn.popover.Constructor.Default.whiteList.thead = [];
            $("[data-toggle=popover]").each(function(i, obj) {
                $(this).popover({
                    html: true,
                    content: function() {
                        var id = $(this).attr("id");
                        return $("#popover-content-" + id).html();
                    }
                });
            });
            $(document).on('click','.close-popover',function(){
                $('.popover').popover('hide');
            });
            $('.popover-dismiss').popover({
                trigger: 'focus'
            })


        });
        // $('[data-toggle="popover"]').popover();

      // Sticky wrapper
        var resizeSticky = function () {
            var elements = document.querySelectorAll('.sticky-wrapper, .sticky-sm-wrapper, .sticky-md-wrapper');
            for (var i = 0; i < elements.length; i++) {
                const wrapper = elements[i].closest('.main-content');
                if (wrapper) elements[i].style.top = wrapper.offsetTop + "px";
            };
        }
        resizeSticky();
        window.addEventListener('resize', resizeSticky);
    </script>
<script>
$(document).ready(function(){
    $('body').scrollspy({
        target: '#nav-sections',
        offset: 200
    });
    initDetailMap([
        {
            name: '{{ getLocale($locale_detail_property, 'link-tab-below-1', 'Schools') }}',
            markers: [
                {
                    name: '70 Public Senior High School Jakarta',
                    distance: 0.2,
                    point: {lat: -6.241651699999999, lng: 106.7968122}
                },
                {
                    name: 'Sekolah PSKD Bulungan',
                    distance: 0.4,
                    point: {lat: -6.2409361, lng: 106.7957071}
                },
                {
                    name: 'Primagama - Mayestik Kebayoran Baru',
                    distance: 0.4,
                    point: {lat: -6.239548999999999, lng: 106.795523}
                },
            ]
        },
        {
            name: '{{ getLocale($locale_detail_property, 'link-tab-below-1', 'Entertainment') }}',
            markers: [
                {
                    name: 'Lehrman School',
                    distance: 0.2,
                    point: {lat: -34.697, lng: 150.644}
                },
                {
                    name: 'Lehrman School 2',
                    distance: 0.4,
                    point: {lat: -34.997, lng: 150.944}
                },
            ]
        }
    ]);
    setOffer(85000000, 119000000);
})

</script>
@endpush
