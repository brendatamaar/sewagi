@extends('_partials.master_solid')
@section('content')
<section class="title">
    <div class="container d-flex flex-wrap">
        <div>
            <h3 class="text-color-dark">Amazing city scape - Cipete utara</h3>
            <p class="mb-0 font-size-14 text-color-gray-8">Cipete, Jakarta Selatan</p>
        </div>
        <div class="ml-auto mt-1 font-size-12">
            <span>4.5</span>
            <span class="stars">
                <i class="fas fa-star text-color-orange"></i>
                <i class="fas fa-star text-color-orange"></i>
                <i class="fas fa-star text-color-orange"></i>
                <i class="fas fa-star text-color-orange"></i>
                <i class="fas fa-star text-color-orange"></i>
            </span>
            <span class="text-color-gray-2">
                (20 {{ getLocale($locale_detail, 'link-review', '') }})
            </span>
        </div>
    </div>
</section>
<section class="tabs sticky-wrapper" data-background-color="white">
    <nav class="container" id="nav-sections">
        <ul class="mb-3 nav nav-tabs tabs-default text-uppercase">
            <li class="nav-item">
                <a class="nav-link" href="#about">
                {{ getLocale($locale_detail, 'link-detail-1', '') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#amenities">
                {{ getLocale($locale_detail, 'link-detail-2', '') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#facilities">
                {{ getLocale($locale_detail, 'link-detail-3', '') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#room-arrangements">
                {{ getLocale($locale_detail, 'link-detail-4', '') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#house-rules">
                {{ getLocale($locale_detail, 'link-detail-5', '') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#reviews">
                {{ getLocale($locale_detail, 'link-detail-6', '') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#neighborhood">
                {{ getLocale($locale_detail, 'link-detail-7', '') }}
                </a>
            </li>
        </ul>
    </nav>
</section>
<section class="position-relative">
    <div class="container">
        <div id="carousel-detail" class="card-img-top carousel slide carousel-watcher" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=0cf4ef4cb623c8a52b1a624f76eaf5bf&auto=format&fit=crop&w=750&q=80">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=0cf4ef4cb623c8a52b1a624f76eaf5bf&auto=format&fit=crop&w=750&q=80">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=0cf4ef4cb623c8a52b1a624f76eaf5bf&auto=format&fit=crop&w=750&q=80">
                </div>
            </div>
            <ol class="carousel-indicators">
                <li data-target="#carousel-detail" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-detail" data-slide-to="1"></li>
                <li data-target="#carousel-detail" data-slide-to="2"></li>
            </ol>
            <button type="button" class="btn btn-prev btn-primary" disabled role="button" data-target="#carousel-detail" data-slide="prev">&larr;</button>
            <button type="button" class="btn btn-next btn-primary" role="button" data-target="#carousel-detail" data-slide="next">&rarr;</button>
        </div>
    </div>
</section>
<section class="booking-sticky d-flex justify-content-center">
    <div class="container booking-sticky-container">
        <div class="row">
            <div class="col-sm-4 offset-sm-7 booking-sticky-content p-0">
                <div class="btn-group-toggle d-flex pt-4 pl-4 pr-4" data-toggle="buttons">
                    <button class="btn btn-checkbox btn-outline-primary flex-fill mr-2 p-1">
                        <input type="radio" />
                        {{ getLocale($locale_detail, 'link-box-1', '') }}
                    </button>
                    <button class="btn btn-checkbox btn-outline-primary flex-fill p-1">
                        <input type="radio" />
                        {{ getLocale($locale_detail, 'link-box-2', '') }}
                    </button>
                </div>
                <div class="d-flex">
                    <div class="tabs-navigator" data-navi="prev"><span class="fas fa-chevron-left"></span></div>
                    <ul class="d-flex flex-fill nav nav-tabs tabs-default tabs-fill text-uppercase btn-group-toggle" data-toggle="buttons">
                        <li class="nav-item">
                            <div class="nav-link btn active"><input type="radio" name="month" value="12" checked/>1 {{ getLocale($locale_detail, 'label-year', '') }}</div>
                        </li>
                        <li class="nav-item">
                            <div class="nav-link btn"><input type="radio" name="month" value="1" />1 {{ getLocale($locale_detail, 'label-month', '') }}</div>
                        </li>
                        <li class="nav-item">
                            <div class="nav-link btn"><input type="radio" name="month" value="3" />3 {{ getLocale($locale_detail, 'label-month', '') }}</div>
                        </li>
                        <li class="nav-item">
                            <div class="nav-link btn"><input type="radio" name="month" value="6" />6 {{ getLocale($locale_detail, 'label-month', '') }}</div>
                        </li>
                    </ul>
                    <div class="tabs-navigator" data-navi="next"><span class="fas fa-chevron-right"></span></div>
                </div>
                <div class="p-4">
                    <select class="form-control input-aqua">
                        <option>{{ getLocale($locale_detail, 'link-box-3', '') }}</option>
                    </select>
                    <br/>
                    <select class="form-control input-aqua">
                        <option>{{ session('locale')=='id' ? 'RP' : 'IDR' }} 120.000.000</option>
                    </select>
                    <div class="text-center font-size-12 mt-2 mb-2">
                        {{ getLocale($locale_detail, 'link-box-4', '') }} <a href="javascript:void(0);" class="negotiate-btn">{{ getLocale($locale_detail, 'link-box-5', '') }}</a>
                    </div>
                    <button type="button" class="btn btn-block p-2 btn-primary text-uppercase schedule-btn">{{ getLocale($locale_detail, 'link-box-6', '') }}</button>
                    <button type="button" class="btn btn-block p-2 btn-outline-primary text-uppercase">{{ getLocale($locale_detail, 'link-box-7', '') }}</button>
                </div>
                <div class="d-flex">
                    <button class="btn btn-footer flex-fill btn-white"><img src="{{asset('img/ic_logout.svg')}}"/> {{ getLocale($locale_detail, 'label-share', '') }}</button>
                    <button class="btn btn-footer flex-fill btn-white">{{ getLocale($locale_detail, 'label-save', '') }}</button>
                    <button class="btn btn-footer flex-fill btn-white"><img src="{{asset('img/ic_heart.svg')}}"/> {{ getLocale($locale_detail, 'label-favourites', '') }}</button>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="position-relative">
    <div class="anchor" id="about"></div>
    <div class="container">
        <div class="row mt-4">
            <div class="col-sm-6 offset-sm-1 text-color-gray-1">
                <div class="d-flex align-items-start font-size-14 mb-3">
                    <img src="{{url('img/001-home.svg')}}" class="mr-2" width="24px" />
                    <ul class="category-list dot-separator">
                        <li>{{ getLocale($locale_detail, 'li1', 'Female only') }}</li>
                        <li>6 {{ getLocale($locale_detail, 'li2', 'renters') }}</li>
                        <li>4 {{ getLocale($locale_detail, 'li3', 'bedrooms') }}</li>
                        <li>5 {{ getLocale($locale_detail, 'li4', 'beds') }}</li>
                        <li>3 {{ getLocale($locale_detail, 'li5', 'bathrooms') }}</li>
                        <li>72 m²</li>
                    </ul>
                </div>
                <div>
                    {{ getLocale($locale_detail, 'desc1', "Cipete Utara is a place for dreamers to reset, reflect, and create. Designed with a 'slow' pace in mind, our hope is that
                    you enjoy every part of your stay; from making local coffee by drip in the morning, choosing the perfect
                    record to put on as the sun sets, or by relaxing in the hot tub surrounded by a starry night sky.") }}
                </div>
                <div class="d-flex align-items-center mt-2 mb-4">
                    <div class="text-uppercase font-size-12 text-color-gray-7 mr-1">{{ session('locale') == 'en' ? 'Style' : 'Model' }}</div>
                    <ul class="category-list font-size-14 text-color-gray-1 font-weight-600">
                        <li><a class="no-style" href="javascript:void(0);">#modern</a></li>
                        <li><a class="no-style" href="javascript:void(0);">#modern</a></li>
                    </ul>
                </div>
                <hr class="mt-4 mb-0" />
            </div>
            <div class="col-sm-3 offset-sm-1"></div>
        </div>
    </div>
</section>
<section class="position-relative">
    <div class="anchor" id="amenities"></div>
    <div class="container">
        <div class="row mt-4 mb-4">
            <div class="col-sm-6 offset-sm-1 d-flex flex-wrap align-items-center">
                <h3 class="mb-0 flex-fill text-dark">{{ getLocale($locale_detail, 'link-detail-title-2', '') }}</h3>
                <a href="javascript:void(0);">{{ getLocale($locale_detail, 'link-detail-8', '') }} &rarr;</a>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 offset-sm-1">
                <div class="row text-color-gray-1 mb-4">
                    <div class="feature-grid">
                        <img src="{{url('img/001-home.svg')}}" class="mr-2" width="24px" />
                        <div>{{ getLocale($locale_detail, 'amenities1', 'Television') }}</div>
                    </div>
                    <div class="feature-grid">
                        <img src="{{url('img/001-home.svg')}}" class="mr-2" width="24px" />
                        <div>{{ getLocale($locale_detail, 'amenities2', 'Hair dryer') }}</div>
                    </div>
                    <div class="feature-grid">
                        <img src="{{url('img/001-home.svg')}}" class="mr-2" width="24px" />
                        <div>{{ getLocale($locale_detail, 'amenities3', 'Superfast Wifi') }}</div>
                    </div>
                    <div class="feature-grid">
                        <img src="{{url('img/001-home.svg')}}" class="mr-2" width="24px" />
                        <div>{{ getLocale($locale_detail, 'amenities4', 'Laundry') }}</div>
                    </div>
                    <div class="feature-grid">
                        <img src="{{url('img/001-home.svg')}}" class="mr-2" width="24px" />
                        <div>{{ getLocale($locale_detail, 'amenities5', 'Kitchenware') }}</div>
                    </div>
                    <div class="feature-grid">
                        <img src="{{url('img/001-home.svg')}}" class="mr-2" width="24px" />
                        <div>{{ getLocale($locale_detail, 'amenities6', 'Flatiron') }}</div>
                    </div>
                    <div class="feature-grid">
                        <img src="{{url('img/001-home.svg')}}" class="mr-2" width="24px" />
                        <div>{{ getLocale($locale_detail, 'amenities7', 'Elevator') }}</div>
                    </div>
                    <div class="feature-grid">
                        <img src="{{url('img/001-home.svg')}}" class="mr-2" width="24px" />
                        <div>{{ getLocale($locale_detail, 'amenities8', 'Gymnasium') }}</div>
                    </div>
                    <div class="feature-grid">
                        <img src="{{url('img/001-home.svg')}}" class="mr-2" width="24px" />
                        <div>{{ getLocale($locale_detail, 'amenities9', 'Free parking') }}</div>
                    </div>
                </div>
                <hr class="mt-4 mb-0" />
            </div>
        </div>
    </div>
</section>
<section class="position-relative">
    <div class="anchor" id="facilities"></div>
    <div class="container">
        <div class="row mt-4 mb-4">
            <div class="col-sm-6 offset-sm-1 d-flex flex-wrap align-items-center">
                <h3 class="mb-0 flex-fill text-dark">{{ getLocale($locale_detail, 'link-detail-title-3', '') }}</h3>
                <a href="javascript:void(0);">{{ getLocale($locale_detail, 'link-detail-9', '') }} &rarr;</a>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 offset-sm-1">
                <div class="row text-color-gray-1 mb-4">
                    <div class="feature-grid">
                        <img src="{{url('img/001-home.svg')}}" class="mr-2" width="24px" />
                        <div>{{ getLocale($locale_detail, 'facilities1', 'Elevator') }}</div>
                    </div>
                    <div class="feature-grid">
                        <img src="{{url('img/001-home.svg')}}" class="mr-2" width="24px" />
                        <div>{{ getLocale($locale_detail, 'facilities2', 'Gymnasium') }}</div>
                    </div>
                    <div class="feature-grid">
                        <img src="{{url('img/001-home.svg')}}" class="mr-2" width="24px" />
                        <div>{{ getLocale($locale_detail, 'facilities3', 'Free parking') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="position-relative" data-background-color="aqua">
    <div class="anchor" id="room-arrangements"></div>
    <div class="container pt-5">
        <div class="row">
            <div class="col-sm-6 offset-sm-1">
                <h3 class="mb-0 flex-fill text-dark">{{ getLocale($locale_detail, 'link-detail-title-4', '') }}</h3>
                <div class="list-n-divider">
                    @for ($i = 0;$i
                    < 3; $i++) @component( '_partials/room_list',[ 'id'=> $i, 'images'=>[ 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=0cf4ef4cb623c8a52b1a624f76eaf5bf&auto=format&fit=crop&w=750&q=80',
                        'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=0cf4ef4cb623c8a52b1a624f76eaf5bf&auto=format&fit=crop&w=750&q=80',
                            'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=0cf4ef4cb623c8a52b1a624f76eaf5bf&auto=format&fit=crop&w=750&q=80',
                        ], 'locale_detail'=>$locale_detail ]) @endcomponent @endfor
                </div>
            </div>
        </div>
    </div>
</section>
<section class="position-relative" data-background-color="dark">
    <div class="anchor" id="house-rules"></div>
    <div class="container pt-5 pb-5">
        <div class="row">
            <div class="col-sm-6 offset-sm-1">
                <h3 class="mb-0 flex-fill">{{ getLocale($locale_detail, 'link-detail-title-5', '') }}</h3>
                <div class="font-size-20 font-weight-600 pt-4 pb-3">{{ getLocale($locale_detail, 'link-detail-title-8', '') }}</div>
                <div>
                    <ul class="custom-list">
                        <li>{{ getLocale($locale_detail, 'link-content-5-1-1', 'Not safe or suitable for infants (Under 2 years)') }}</li>
                        <li>{{ getLocale($locale_detail, 'link-content-5-1-2', 'Not suitable for pets') }}</li>
                        <li>{{ getLocale($locale_detail, 'link-content-5-1-3', 'Check-in is anytime after 2PM') }}</li>
                        <li>{{ getLocale($locale_detail, 'link-content-5-1-4', 'Self check-in with building staff') }}</li>
                    </ul>
                    <ul id="collapse-rules" class="custom-list collapse">
                        <li>{{ getLocale($locale_detail, 'link-content-5-1-1', 'Not safe or suitable for infants (Under 2 years)') }}</li>
                        <li>{{ getLocale($locale_detail, 'link-content-5-1-2', 'Not suitable for pets') }}</li>
                        <li>{{ getLocale($locale_detail, 'link-content-5-1-3', 'Check-in is anytime after 2PM') }}</li>
                        <li>{{ getLocale($locale_detail, 'link-content-5-1-4', 'Self check-in with building staff') }}</li>
                    </ul>
                    <a href="javascript:void(0);" data-target="#collapse-rules" class="collapse-animated font-size-14 mb-3 collapsed" data-toggle="collapse">{{ getLocale($locale_detail, 'link-detail-11', '') }}<span class="collapse-widget"><i class="fas fa-chevron-up"></i></span>
                    </a>
                </div>
                <div class="font-size-20 font-weight-600 pt-4 pb-3">{{ getLocale($locale_detail, 'link-detail-title-9', '') }}</div>
                <div>
                    <ul class="custom-list">
                        <li>{{ getLocale($locale_detail, 'link-content-5-2-1', 'House for female only') }}</li>
                        <li>{{ getLocale($locale_detail, 'link-content-5-2-2', 'If you damage the home, you may be charged up to Rp 6933600') }}</li>
                        <li>{{ getLocale($locale_detail, 'link-content-5-2-3', 'Loud noise would be disrespectful to neighbours') }}</li>
                        <li>{{ getLocale($locale_detail, 'link-content-5-2-4', 'Use ASHTRAYS for cigarettes and no smoking inside bedrooms.') }}</li>
                    </ul>
                    <ul id="collapse-acknowledge" class="custom-list collapse">
                        <li>{{ getLocale($locale_detail, 'link-content-5-2-1', 'House for female only') }}</li>
                        <li>{{ getLocale($locale_detail, 'link-content-5-2-2', 'If you damage the home, you may be charged up to Rp 6933600') }}</li>
                        <li>{{ getLocale($locale_detail, 'link-content-5-2-3', 'Loud noise would be disrespectful to neighbours') }}</li>
                        <li>{{ getLocale($locale_detail, 'link-content-5-2-4', 'Use ASHTRAYS for cigarettes and no smoking inside bedrooms.') }}</li>
                    </ul>
                    <a href="javascript:void(0);" data-target="#collapse-acknowledge" class="collapse-animated font-size-14 mb-3 collapsed" data-toggle="collapse">{{ getLocale($locale_detail, 'link-detail-12', '') }}<span class="collapse-widget"><i class="fas fa-chevron-up"></i></span>
                    </a>
                </div>
                <div class="font-size-20 font-weight-600 pt-4 pb-3">{{ getLocale($locale_detail, 'link-detail-title-10', '') }}</div>
                <div>
                    <div>
                        {{ getLocale($locale_detail, 'link-content-5-3-1', 'Cancel up to 5 days before check in and get a full refund (minus service fees). Cancel within 5 days of your trip and the
                        first night is non-refundable, but 50% of the cost for the remaining nights will be refunded. Service
                        fees are refunded when cancellation happens before check in and within 48 hours of booking.') }}'
                    </div>
                    <div id="collapse-cancellation" class="collapse">
                        {{ getLocale($locale_detail, 'link-content-5-3-2', 'Cancel up to 5 days before check in and get a full refund (minus service fees). Cancel within 5 days of your trip and the
                        first night is non-refundable, but 50% of the cost for the remaining nights will be refunded. Service
                        fees are refunded when cancellation happens before check in and within 48 hours of booking.') }}
                    </div>
                    <a href="javascript:void(0);" data-target="#collapse-cancellation" class="collapse-animated font-size-14 mb-3 collapsed"
                        data-toggle="collapse">{{ getLocale($locale_detail, 'link-detail-13', '') }}<span class="collapse-widget"><i class="fas fa-chevron-up"></i></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="position-relative">
    <div class="anchor" id="reviews"></div>
    <div class="container pt-5 pb-5">
        <div class="row">
            <div class="col-sm-6 offset-sm-1">
                <h3 class="mb-0 text-dark">{{ getLocale($locale_detail, 'link-detail-title-11', '') }}</h3>
                <div class="list-n-divider">
                    <div class="row pb-4">
                        <div class="col-md-6">
                            <span class="rating text-color-orange font-weight-600">4.5</span>
                            <span class="rating-max text-color-orange font-weight-600">/5</span>
                            <div class="text-color-orange font-weight-600 font-size-16">{{ getLocale($locale_detail, 'label-excellent', 'Very Excellent') }}</div>
                            <div class="font-size-16 text-color-gray-2">({{ getLocale($locale_detail, 'link-based-on', '') }} 20 {{ getLocale($locale_detail, 'link-review', '') }})</div>
                        </div>
                        <div class="col-md-6 pt-3">
                            @component('_partials/star_detail',['name'=>getLocale($locale_detail, 'link-detail-14', '')]) @endcomponent @component('_partials/star_detail',['name'=>getLocale($locale_detail, 'link-detail-15', '')])
                            @endcomponent @component('_partials/star_detail',['name'=>getLocale($locale_detail, 'link-detail-16', '')]) @endcomponent @component('_partials/star_detail',['name'=>getLocale($locale_detail, 'link-detail-17', '')])
                            @endcomponent
                        </div>
                    </div>
                    <div class="pt-4 pb-4">
                        @component('_partials/review_list',[ 'image'=>"https://images.unsplash.com/photo-1512917774080-9991f1c4c750?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=0cf4ef4cb623c8a52b1a624f76eaf5bf&auto=format&fit=crop&w=750&q=80",
                        'name'=>'Silvia Sandjaja', 'time'=>'3 '.getLocale($locale_detail, 'link-days-ago', 'days ago'), 'rating'=>'4.5', 'text'=>getLocale($locale_detail, 'label-testimoni1', 'Location was wonderful We were able to walk every where, and the neighborhood was adorable. Well decorated and beautiful.')
                        ]) @endcomponent
                    </div>
                    <div class="pt-4 pb-4">
                        @component('_partials/review_list',[ 'image'=>"https://images.unsplash.com/photo-1512917774080-9991f1c4c750?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=0cf4ef4cb623c8a52b1a624f76eaf5bf&auto=format&fit=crop&w=750&q=80",
                        'name'=>'Silvia Sandjaja', 'time'=>'3 '.getLocale($locale_detail, 'link-days-ago', 'days ago'), 'rating'=>'4.5', 'text'=>getLocale($locale_detail, 'label-testimoni2', 'Location was wonderful We were able to walk every where, and the neighborhood was adorable. The location first of all  prime for our family of 5. The space was perfect. The staff excellent. Robyn\'s décor here gave the cozy feeling to make ourselves at home. Will for sure return to one of Robyn\'s villas.') ]) @endcomponent
                    </div>
                    <div class="pt-4 pb-4">
                        @component('_partials/review_list',[ 'image'=>"https://images.unsplash.com/photo-1512917774080-9991f1c4c750?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=0cf4ef4cb623c8a52b1a624f76eaf5bf&auto=format&fit=crop&w=750&q=80",
                        'name'=>'Silvia Sandjaja', 'time'=>'3 '.getLocale($locale_detail, 'link-days-ago', 'days ago'), 'rating'=>'4.5', 'text'=>getLocale($locale_detail, 'label-testimoni3', 'Location was wonderful!
                        We were able to walk every where, and the neighborhood was adorable. The location first of all was
                        prime for our family of 5. The space was perfect.') ]) @endcomponent
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
<section class="position-relative">
    <div class="anchor" id="neighborhood"></div>
    <div class="container">
        <nav id="neighborhood-tabs">
            <ul class="mb-3 col-sm-10 sm-offset-1 nav nav-tabs tabs-default text-uppercase" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#neighborhood-tab-fnb" role="tab">F & B</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#neighborhood-tab-entertain" role="tab">Entertainment</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#neighborhood-tab-hospitals" role="tab">Hospitals</a>
                </li>
            </ul>
        </nav>
        <div class="row" id="map-list">
            <div class="col-sm-3 sm-offset-1 order-sm-0 order-1 map-marker-list">
                <div class="tab-content pb-5">
                </div>
            </div>
            <div class="col-sm-7 map mb-5">
                <div id="neighborhood-map" style="height:300px;"></div>
                <button class="marker-full-btn btn btn-primary">{{ getLocale($locale_detail, 'label-map', 'View full map') }}</button>
            </div>
        </div>
    </div>
</section>
@include('_partials.detail.negotiate_modal', ['locale_detail' => $locale_detail])
@include('_partials.detail.schedule_modal', ['locale_detail' => $locale_detail])
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
@endsection
@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css"/>
@endpush
 @push('js')
<script src="{{asset('plugins/accounting/accounting.min.js')}}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDXocBdFpVkoj8XNn5OnqVrmsPgviAH9wU"></script>
<script src="https://cdn.rawgit.com/googlemaps/v3-utility-library/master/markerwithlabel/src/markerwithlabel.js"></script>
<script src="{{asset('plugins/moment/moment.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>
<script src="{{url('js/detail.js')}}"></script>
<script>
$(document).ready(function(){
    $('body').scrollspy({target: '#nav-sections'});
    initDetailMap([
        {
            name: '{{ getLocale($locale_detail, 'link-school', '') }}',
            markers: [
                {
                    name: 'Lehrman School',
                    distance: 0.2,
                    point: {lat: -34.397, lng: 150.644}
                },
                {
                    name: 'Lehrman School 2',
                    distance: 0.4,
                    point: {lat: -34.097, lng: 150.944}
                },
                {
                    name: 'Lehrman School 3',
                    distance: 0.4,
                    point: {lat: -34.597, lng: 150.244}
                },
            ]
        },
        {
            name: '{{ getLocale($locale_detail, 'link-entertainment', '') }}',
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
