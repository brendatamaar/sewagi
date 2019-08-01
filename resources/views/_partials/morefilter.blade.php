<section id="search-popup">
    <form id="searchbox-filter-form" onsubmit="return false">
        <div class="search-header-box">
            <div class="container">
                <div class="row mb-20">
                    <a href="{{ url('') }}" class='col-md-2 col-10 mb-10 d-flex align-items-center'>
                        <img class="img-fluid" src="{{ asset('/images/Logo.svg') }}" />
                    </a>
                    <div class="col-2 mb-10 d-flex d-md-none justify-content-end align-items-center">
                        <a href="javascript:void(0)" class="searchbox-close"><i class="fas fa-times"></i> {{ getLocale($locale, 'link-close', '') }}</a>
                    </div>
                    <div class="col-md-8 d-flex flex-wrap align-items-center mb-10">
                        <span class="mr-20 interested-text">{{ getLocale($locale, 'link-interest-1', '') }}</span>
                        <span class="btn-group-toggle" data-toggle="buttons">
                            <label
                                class="btn btn-checkbox btn-rounded btn-outline-primary btn-sm text-capitalize rounded mr-10">
                                <input type="checkbox" class="more-filter" data-type="cond" data-id="co_living">{{ getLocale($locale, 'link-interest-2', '') }}</label>
                            <label
                                class="btn btn-checkbox btn-rounded btn-outline-primary btn-sm text-capitalize rounded mr-10">
                                <input type="checkbox" class="more-filter" data-type="cond"
                                    data-id="entire_space">{{ getLocale($locale, 'link-interest-3', '') }}</label>
                        </span>
                    </div>
                    <div class="col-lg-2 d-none d-md-flex justify-content-end align-items-center mb-10">
                        <a href="javascript:void(0)" class="searchbox-close"><i class="fas fa-times"></i> {{ getLocale($locale, 'link-close', '') }}</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 col-12 offset-lg-2">
                        <!--  top -->
                        <div class="input-group input-homepage mb-20 custom-input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text icon-location">A</span>
                            </div>
                            <input type="text" name="q" id="searchbox"
                                class="form-control searchbox-value searchbox-primary border-0 more-filter"
                                placeholder="{{ getLocale($locale, 'placeholder-search', '') }}" value="">
                            <input type="hidden" name="lat" id="lat">
                            <input type="hidden" name="lng" id="lng">
                            <input type="hidden" name="place_id" id="place_id">
                            <input type="hidden" id="recent_search">
                            <div class="input-group-prepend">
                                <span class="input-group-icon d-flex align-items-center background-white pr-15">
                                    <i class="fas fa-times removeLocation"></i></span>
                                <span class="input-group-text input-group-target">
                                    <button type="button" class="btn btn-grey btn-target currentLocation"><i
                                            class="fanicon-target-two"></i></button>
                                </span>
                            </div>
                        </div>
                        <div class="mb-38 d-flex align-items-center">
                            <p class="search-recent-text text-uppercase font-size-12 d-inline-block mb-10 d-lg-inline-block d-block mr-10">{{ getLocale($locale, 'label-recent-search', 'Recent searches') }}</p>
                            <span>
                                <span class="btn-group-toggle" data-toggle="buttons" id="moreRecentSearch"></span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="search-body-box">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-12 offset-lg-2">
                        <p class="text-color-gray-6 text-help specific-req-text mt-20 mb-24">
                            {{ getLocale($locale, 'link-filter-1', '') }}.
                        </p>
                        <p class="text-color-dark form-control-style mb-20">
                            {{ getLocale($locale, 'link-filter-2', '') }}
                        </p>
                        <p class="mb-10">
                            <span class="btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-checkbox btn-rounded btn-outline-primary btn-sm rounded mr-10">
                                    <input class="more-filter" data-type="type_apartment" data-id="apartment"
                                        type="checkbox">{{ getLocale($locale, 'link-filter-3', '') }}
                                </label>
                                <label class="btn btn-checkbox btn-rounded btn-outline-primary btn-sm rounded mr-10">
                                    <input class="more-filter" data-type="type_house" data-id="house"
                                        type="checkbox">{{ getLocale($locale, 'link-filter-4', '') }}
                                </label>
                            </span>
                        </p>
                        <div class="fox-line"></div>
                        <p class="text-color-dark form-control-style mb-20">
                            {{ getLocale($locale, 'link-filter-5', '') }}
                        </p>
                        <p class="mb-10">
                            <span class="btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-checkbox btn-outline-primary mr-15 btn-circle">
                                    <input class="more-filter" data-type="bedroom" data-id="1" type="checkbox">1
                                </label>
                                <label class="btn btn-checkbox btn-outline-primary mr-15 btn-circle">
                                    <input class="more-filter" data-type="bedroom" data-id="2" type="checkbox">2
                                </label>
                                <label class="btn btn-checkbox btn-outline-primary mr-15 btn-circle">
                                    <input class="more-filter" data-type="bedroom" data-id="3" type="checkbox">3
                                </label>
                                <label class="btn btn-checkbox btn-outline-primary mr-15 btn-circle">
                                    <input class="more-filter" data-type="bedroom" data-id="4" type="checkbox">4
                                </label>
                                <label class="btn btn-checkbox btn-outline-primary mr-15 btn-circle">
                                    <input class="more-filter" data-type="bedroom" data-id="5" type="checkbox">5+
                                </label>
                            </span>
                        </p>
                        <div class="fox-line"></div>
                        <div class="w-100">
                            <div class="d-flex align-items-center mb-10">
                                <p class="text-color-dark form-control-style mr-auto mb-0">{{ getLocale($locale, 'link-filter-6', '') }} <span
                                        class="text-color-gray-6 font-weight-normal">Beta</span></p>
                                </p>
                                <a class="btn btn-outline-primary btn-icon collapse-icon d-flex align-items-center justify-content-center collapsed"
                                    data-toggle="collapse" href="#collapseAddCommute" role="button"
                                    aria-expanded="false" aria-controls="collapseAddCommute"><i
                                        class="fas fa-plus"></i></a>
                            </div>
                            <div class="background-white mb-10 commute-input collapse" id="collapseAddCommute">
                                <div class="row pt-10 justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="form-group">
                                            <select class="select2 select2-list-property commute-time" data-type="time" name="time">
                                                <option value="5">5 {{ getLocale($locale, 'link-minute', '') }}</option>
                                                <option value="15">15 {{ getLocale($locale, 'link-minute', '') }}</option>
                                                <option value="30">30 {{ getLocale($locale, 'link-minute', '') }}</option>
                                                <option value="45">45 {{ getLocale($locale, 'link-minute', '') }}</option>
                                                <option value="60">60 {{ getLocale($locale, 'link-minute', '') }}</option>
                                                <option value="90">90 {{ getLocale($locale, 'link-minute', '') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-auto px-0">
                                        <div class="form-group form-control-style text-color-dark px-2">{{ getLocale($locale, 'label-to', '') }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="form-group">
                                            <div class="input-group input-aqua select2-special">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text icon-location">A</span>
                                                </div>
                                                <input type="text" class="form-control" id="commute-location" placeholder="Enter location, property name, company or education entity">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-auto px-0">
                                        <div class="form-group form-control-style text-color-dark px-2">{{ getLocale($locale, 'label-by-short', '') }}</div>
                                   </div>
                                    <div class="col-auto">
                                        <div class="form-group">
                                            <select class="select2 select2-list-property commute-time" data-type="commute_type" name="commute_type">
                                                <option value="car">{{ getLocale($locale, 'label-car', '') }}</option>
                                                <option value="motorcycle">{{ getLocale($locale, 'label-motorbike', '') }}</option>
                                                <option value="walking">{{ getLocale($locale, 'label-walking', '') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-9 col-12 offset-lg-2 pl-35">
                                        <div
                                            class="mr-10 my-12 font-size-12 text-uppercase text-color-gray-6 font-weight-500 letter-spacing-18">
                                            {{ getLocale($locale, 'link-filter-7', '') }}</div>
                                        <div class="mb-10 p-lg-0">
                                            <span class="btn-group-toggle" data-toggle="buttons">
                                                <label
                                                    class="btn btn-checkbox btn-rounded auto-height text-capitalize btn-outline-primary btn-sm rounded mr-10">
                                                    <input type="radio" name="landmark" value="" />
                                                    Bundaran HI
                                                    {{--
                                                <br />
                                                <span class="font-weight-normal font-size-11">Central Jakarta</span>
--}}
                                                </label>
                                                <label
                                                    class="btn btn-checkbox btn-rounded auto-height text-capitalize btn-outline-primary btn-sm rounded mr-10">
                                                    <input type="radio" name="landmark" value="" />
                                                    Kelapa Gading Mall
                                                    {{--
                                                <br /><span class="font-weight-normal font-size-11">North Jakarta</span>
--}}
                                                </label>
                                                <label
                                                    class="btn btn-checkbox btn-rounded auto-height text-capitalize btn-outline-primary btn-sm rounded mr-10">
                                                    <input type="radio" name="landmark" value="" />
                                                    Central Park Mall
                                                    {{--
                                                <br /><span class="font-weight-normal font-size-11">West Jakarta</span>
--}}
                                                </label>
                                                <label
                                                    class="btn btn-checkbox btn-rounded auto-height text-capitalize btn-outline-primary btn-sm rounded mr-10">
                                                    <input type="radio" name="landmark" value="" />
                                                    Bassura City Mall
                                                    {{--
                                                <br /><span class="font-weight-normal font-size-11">East Jakarta</span>
--}}
                                                </label>
                                                <label
                                                    class="btn btn-checkbox btn-rounded auto-height text-capitalize btn-outline-primary btn-sm rounded mr-10">
                                                    <input type="radio" name="landmark" value="" />
                                                    Cilandak Town Square
                                                    {{--
                                                <br />
                                                <span class="font-weight-normal font-size-11">South Jakarta</span>
--}}
                                                </label>
                                                {{--
                                            <label class="btn btn-checkbox btn-rounded auto-height text-capitalize btn-outline-primary btn-sm rounded mr-10">
                                                <input type="radio" name="landmark" value=""/>
                                                Lippo Mall Kemang
                                                <br /><span class="font-weight-normal font-size-11">South Jakarta</span>
                                            </label>
                                            <label class="btn btn-checkbox btn-rounded auto-height text-capitalize btn-outline-primary btn-sm rounded mr-10">
                                                <input type="radio" name="landmark" value=""/>
                                                Gandaria City Mall
                                                <br /><span class="font-weight-normal font-size-11">South Jakarta</span>
                                            </label>
                                            <label class="btn btn-checkbox btn-rounded auto-height text-capitalize btn-outline-primary btn-sm rounded mr-10">
                                                <input type="radio" name="landmark" value=""/>
                                                Taman Anggrek Mall
                                                <br /><span class="font-weight-normal font-size-11">West Jakarta</span>
                                            </label>
--}}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="fox-line"></div>
                        <p class="text-color-dark form-control-style mb-20">
                        {{ getLocale($locale, 'link-filter-8', '') }}
                        </p>
                        <div class="pad-left-10">
                            <p class="form-control-style mb-20">
                            {{ getLocale($locale, 'link-filter-9', '') }}
                            </p>
                            <p class="mb-10">
                                <span class="btn-group-toggle" data-toggle="buttons">
                                    <label
                                        class="btn btn-checkbox btn-rounded btn-outline-primary btn-sm rounded mr-10 text-lowercase">
                                        <input type="radio" name="range_of_stay" value="3">3 {{ getLocale($locale, 'link-month', '') }}
                                    </label>
                                    <label
                                        class="btn btn-checkbox btn-rounded btn-outline-primary btn-sm rounded mr-10 text-lowercase">
                                        <input type="radio" name="range_of_stay" value="6">6 {{ getLocale($locale, 'link-month', '') }}
                                    </label>
                                    <label
                                        class="btn btn-checkbox btn-rounded btn-outline-primary btn-sm rounded mr-10 text-lowercase">
                                        <input type="radio" name="range_of_stay" value="9">9 {{ getLocale($locale, 'link-month', '') }}
                                    </label>
                                    <label
                                        class="btn btn-checkbox btn-rounded btn-outline-primary btn-sm rounded mr-10 text-lowercase">
                                        <input type="radio" name="range_of_stay" value="12">1 {{ getLocale($locale, 'link-year', '') }}
                                    </label>
                                </span>
                            </p>
                            <p class="form-control-style mb-20">
                            {{ getLocale($locale, 'link-filter-10', '') }}
                            </p>
                            <p class="mb-10">
                                <span class="btn-group-toggle" data-toggle="buttons">
                                    <label
                                        class="btn btn-checkbox btn-rounded btn-outline-primary btn-sm rounded mr-10">
                                        <input type="checkbox" name="payment_options" value="12">{{ getLocale($locale, 'link-monthly', '') }}
                                    </label>
                                    <label
                                        class="btn btn-checkbox btn-rounded btn-outline-primary btn-sm rounded mr-10">
                                        <input type="checkbox" name="payment_options" value="3">{{ getLocale($locale, 'link-quarterly', '') }}
                                    </label>
                                    <label
                                        class="btn btn-checkbox btn-rounded btn-outline-primary btn-sm rounded mr-10">
                                        <input type="checkbox" name="payment_options" value="6">{{ getLocale($locale, 'link-twice', '') }}
                                    </label>
                                    <label
                                        class="btn btn-checkbox btn-rounded btn-outline-primary btn-sm rounded mr-10">
                                        <input type="checkbox" name="payment_options" value="1">{{ getLocale($locale, 'link-once', '') }}
                                    </label>
                                </span>
                            </p>
                        </div>
                        <div class="fox-line"></div>
                        <p class="text-color-dark form-control-style mb-20">{{ getLocale($locale, 'link-filter-11', '') }}</p>
                        <div id="searchbox-slider-2" class="mb-10"></div>
                        <input type="text" name="min_price" class="fox-hide" id="searchbox-slider-2-input-1">
                        <input type="text" name="max_price" class="fox-hide" id="searchbox-slider-2-input-2">
                        <div class="d-flex mb-5">
                            <span id="searchbox-slider-2-text-1" class="mr-auto">{{ session('locale')=='id' ? 'RP' : 'IDR' }} 1</span>
                            <span id="searchbox-slider-2-text-2">{{ session('locale')=='id' ? 'RP' : 'IDR' }} 3.000.000.000</span>
                        </div>
                        <div class="fox-line"></div>
                        <!--  -..........-->
                        <div>
                            <p class="text-color-dark form-control-style mb-28">
                                {{ getLocale($locale_search, 'label-title-6', '') }}
                            </p>
                            <p class="text-color-dark form-control-style mb-20">
                            {{ getLocale($locale_search, 'label-search-detail-1', '') }}
                            </p>
                            <p class="mb-10">
                                <div class="d-flex align-items-center">
                                    <label class="text-color-dark form-control-style font-size-14 mr-30">
                                    {{ getLocale($locale_search, 'label-search-detail-2', '') }}
                                    </label>
                                    <label class="switch">
                                        <input type="checkbox" class="more-filter" data-type="view_360">
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </p>
                            <div class="fox-line"></div>
                            <!--  -..........-->
                            <p class="text-color-dark form-control-style mb-20">
                            {{ getLocale($locale_search, 'label-search-detail-3', '') }}
                            </p>
                            <p class="mb-10">
                                <div class="row">
                                    <span class="btn-group-toggle row fox-search-img-container" id="design-styles"
                                        data-toggle="buttons"></span>
                                </div>
                            </p>
                        </div>
                        <div id="apartmentFiltered">
                            <div class="fox-line"></div>
                            <!--  -..........-->
                            <p class="text-color-dark form-control-style mb-20">
                            {{ getLocale($locale_search, 'label-search-detail-4', '') }}
                            </p>
                            <p class="mb-10">
                                <span class="btn-group-toggle" data-toggle="buttons">
                                    <label
                                        class="btn btn-checkbox btn-rounded btn-outline-primary btn-sm rounded mr-10 mb-10">
                                        <input type="checkbox" class="more-filter" data-type="floor_level"
                                            data-id="below 5" />{{ getLocale($locale_search, 'label-search-detail-5', '') }}
                                    </label>
                                    <label
                                        class="btn btn-checkbox btn-rounded btn-outline-primary btn-sm rounded mr-10 mb-10">
                                        <input type="checkbox" class="more-filter" data-type="floor_level"
                                            data-id="between 5-10" />{{ getLocale($locale_search, 'label-search-detail-6', '') }}
                                    </label>
                                    <label
                                        class="btn btn-checkbox btn-rounded btn-outline-primary btn-sm rounded mr-10 mb-10">
                                        <input type="checkbox" class="more-filter" data-type="floor_level"
                                            data-id="above 10" />{{ getLocale($locale_search, 'label-search-detail-7', '') }}
                                    </label>
                                </span>
                            </p>
                        </div>
                        <div id="houseFiltered">
                            <div class="fox-line"></div>
                            <!--  -..........-->
                            <p class="text-color-dark form-control-style mb-20">
                            {{ getLocale($locale_search, 'label-search-detail-8', '') }}
                            </p>
                            <p class="mb-10">
                                <span class="btn-group-toggle" data-toggle="buttons">
                                    <label
                                        class="btn btn-checkbox btn-rounded btn-outline-primary btn-sm rounded mr-10 mb-10">
                                        <input type="checkbox" class="more-filter" data-type="land_area"
                                            data-id="residental" />{{ getLocale($locale_search, 'label-search-detail-9', '') }}
                                    </label>
                                    <label
                                        class="btn btn-checkbox btn-rounded btn-outline-primary btn-sm rounded mr-10 mb-10">
                                        <input type="checkbox" class="more-filter" data-type="land_area"
                                            data-id="non residental" />{{ getLocale($locale_search, 'label-search-detail-10', '') }}
                                    </label>
                                </span>
                            </p>
                            <div class="fox-line"></div>
                            <!--  -..........-->
                            <p class="text-color-dark form-control-style mb-20">
                            {{ getLocale($locale_search, 'label-search-detail-11', '') }}
                            </p>
                            <p class="mb-10">
                                <span class="btn-group-toggle" data-toggle="buttons">
                                    <label
                                        class="btn btn-checkbox btn-rounded btn-outline-primary btn-sm rounded mr-10 mb-10">
                                        <input type="checkbox" class="more-filter" data-type="arrangement"
                                            data-id="townhouse" />{{ getLocale($locale_search, 'label-search-detail-12', '') }}
                                    </label>
                                    <label
                                        class="btn btn-checkbox btn-rounded btn-outline-primary btn-sm rounded mr-10 mb-10">
                                        <input type="checkbox" class="more-filter" data-type="arrangement"
                                            data-id="standalone" />{{ getLocale($locale_search, 'label-search-detail-13', '') }}
                                    </label>
                                </span>
                            </p>
                        </div>
                        <div class="fox-line"></div>
                        <!--  -..........-->
                        <p class="text-color-dark form-control-style mb-20">
                        {{ getLocale($locale_search, 'label-search-detail-14', '') }}
                        </p>
                        <p class="mb-10">
                            <span class="btn-group-toggle" data-toggle="buttons">
                                <label
                                    class="btn btn-checkbox btn-rounded btn-outline-primary btn-sm rounded mr-10 mb-10">
                                    <input type="checkbox" class="more-filter" data-type="property_furniture"
                                        data-id="furnished" />{{ getLocale($locale_search, 'label-search-detail-15', '') }}
                                </label>
                                <label
                                    class="btn btn-checkbox btn-rounded btn-outline-primary btn-sm rounded mr-10 mb-10">
                                    <input type="checkbox" class="more-filter" data-type="property_furniture"
                                        data-id="semi-furnished" />{{ getLocale($locale_search, 'label-search-detail-16', '') }}
                                </label>
                                <label
                                    class="btn btn-checkbox btn-rounded btn-outline-primary btn-sm rounded mr-10 mb-10">
                                    <input type="checkbox" class="more-filter" data-type="property_furniture"
                                        data-id="unfurnished" />{{ getLocale($locale_search, 'label-search-detail-17', '') }}
                                </label>
                            </span>
                        </p>
                        <div class="fox-line"></div>
                        <!--  -..........-->
                        <p class="text-color-dark form-control-style mb-20">
                        {{ getLocale($locale_search, 'label-search-detail-18', '') }}
                        </p>
                        <p class="mb-10">
                            <span class="btn-group-toggle" data-toggle="buttons" id="amenities"></span>
                        </p>
                        <div class="fox-line"></div>
                        <!--  -..........-->
                        <p class="text-color-dark form-control-style mb-20">
                        {{ getLocale($locale_search, 'label-search-detail-19', '') }}
                        </p>
                        <p class="mb-10">
                            <span class="btn-group-toggle" data-toggle="buttons" id="facilities"></span>
                        </p>
                        <div class="fox-line"></div>
                        <!--  -..........-->
                        <p class="text-color-dark form-control-style mb-20">
                        {{ getLocale($locale_search, 'label-search-detail-20', '') }}
                        </p>
                        <p class="mb-10">
                            <div class="d-flex align-items-center">
                                <label class="text-color-dark form-control-style font-size-14 mr-30">{{ getLocale($locale_search, 'label-search-detail-21', '') }}</label>
                                <label class="switch">
                                    <input type="checkbox" class="more-filter" data-type="pet_friendly">
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </p>
                        <div class="fox-line"></div>
                        <!--  -..........-->
                        <div id="colivingFiltered">
                            <p class="text-color-dark form-control-style mb-20">
                            {{ getLocale($locale_search, 'label-search-detail-22', '') }}
                            </p>
                            <p class="mb-10">
                                <span class="btn-group-toggle" data-toggle="buttons">
                                    <label
                                        class="btn btn-checkbox btn-rounded btn-outline-primary btn-sm rounded mr-10 mb-10">
                                        <input type="checkbox" class="more-filter" data-type="bedroom_type"
                                            data-id="master" />{{ getLocale($locale_search, 'label-search-detail-23', '') }}
                                    </label>
                                    <label
                                        class="btn btn-checkbox btn-rounded btn-outline-primary btn-sm rounded mr-10 mb-10">
                                        <input type="checkbox" class="more-filter" data-type="bedroom_type"
                                            data-id="standard" />{{ getLocale($locale_search, 'label-search-detail-24', '') }}
                                    </label>
                                    <label
                                        class="btn btn-checkbox btn-rounded btn-outline-primary btn-sm rounded mr-10 mb-10">
                                        <input type="checkbox" class="more-filter" data-type="bedroom_type"
                                            data-id="pocket" />{{ getLocale($locale_search, 'label-search-detail-25', '') }}
                                    </label>
                                </span>
                            </p>
                            <div class="fox-line"></div>
                            <!--  -..........-->
                            <p class="text-color-dark form-control-style mb-20">
                            {{ getLocale($locale_search, 'label-search-detail-26', '') }}
                            </p>
                            <p class="mb-10">
                                <span class="btn-group-toggle" data-toggle="buttons">
                                    <label
                                        class="btn btn-checkbox btn-rounded btn-outline-primary btn-sm rounded mr-10 mb-10">
                                        <input type="checkbox" class="more-filter" data-type="bedroom_furniture"
                                            data-id="furnished" />{{ getLocale($locale_search, 'label-search-detail-27', '') }}
                                    </label>
                                    <label
                                        class="btn btn-checkbox btn-rounded btn-outline-primary btn-sm rounded mr-10 mb-10">
                                        <input type="checkbox" class="more-filter" data-type="bedroom_furniture"
                                            data-id="semi-furnished" />{{ getLocale($locale_search, 'label-search-detail-28', '') }}
                                    </label>
                                    <label
                                        class="btn btn-checkbox btn-rounded btn-outline-primary btn-sm rounded mr-10 mb-10">
                                        <input type="checkbox" class="more-filter" data-type="bedroom_furniture"
                                            data-id="unfurnished" />{{ getLocale($locale_search, 'label-search-detail-29', '') }}
                                    </label>
                                </span>
                            </p>
                            <div class="fox-line"></div>
                            <!--  -..........-->
                            <p class="text-color-dark form-control-style mb-20">
                            {{ getLocale($locale_search, 'label-search-detail-30', '') }}
                            </p>
                            <p class="mb-10">
                                <div style="margin:0" class="row">
                                    <label class="text-color-dark form-control-style font-size-14 mr-30">{{ getLocale($locale_search, 'label-search-detail-31', '') }}</label>
                                    <label class="switch">
                                        <input type="checkbox" class="more-filter" data-type="ensuite_bathroom">
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </p>
                            <div class="fox-line"></div>

                            <!--  -..........-->
                            <p class="text-color-dark form-control-style mb-20">
                            {{ getLocale($locale_search, 'label-search-detail-32', '') }}
                            </p>
                            <p class="text-color-dark form-control-style mb-20">
                            {{ getLocale($locale_search, 'label-search-detail-33', '') }}
                            </p>
                            <p class="mb-10">
                                <span class="btn-group-toggle" data-toggle="buttons">
                                    <label
                                        class="btn btn-checkbox btn-rounded btn-outline-primary btn-sm rounded mr-10 mb-10">
                                        <input type="checkbox" class="search-preference" data-type="gender"
                                            data-id="is_mostly_male" />{{ getLocale($locale_search, 'label-search-detail-34', '') }}
                                    </label>
                                    <label
                                        class="btn btn-checkbox btn-rounded btn-outline-primary btn-sm rounded mr-10 mb-10">
                                        <input type="checkbox" class="search-preference" data-type="gender"
                                            data-id="is_mostly_female" />{{ getLocale($locale_search, 'label-search-detail-35', '') }}
                                    </label>
                                </span>
                            </p>
                            <div class="fox-line"></div>
                            <!--  -..........-->
                            <p class="text-color-dark form-control-style mb-20">
                            {{ getLocale($locale_search, 'label-search-detail-36', '') }}
                            </p>
                            <p class="mb-10">
                                <span class="btn-group-toggle" data-toggle="buttons" id="hobbies"></span>
                            </p>
                            <div class="fox-line"></div>
                            <!--  -..........-->
                            <p class="text-color-dark form-control-style mb-20">
                            {{ getLocale($locale_search, 'label-search-detail-37', '') }}
                            </p>
                            <p class="mb-10">
                                <span class="btn-group-toggle" data-toggle="buttons" id="lifestyles"></span>
                            </p>
                            <div class="fox-line"></div>
                            <!--  -..........-->
                            <p class="text-color-dark form-control-style mb-20">
                            {{ getLocale($locale_search, 'label-search-detail-38', '') }}
                            </p>
                            <div class="mb-10 fox-search-custom">
                                <div class="col-md-12 search-box-container">
                                    <div class="input-group input-homepage mb-20 custom-input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text icon-location">A</span>
                                        </div>
                                        <input type="text" id="hometown" name="from" class="form-control border-0"
                                            placeholder="{{ getLocale($locale_search, 'label-search-detail-39', '') }}" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="fox-line"></div>
                            <!--  -..........-->
                            <p class="text-color-dark form-control-style mb-20">
                                {{ getLocale($locale_search, 'label-search-detail-40', '') }}
                            </p>
                            <p class="mb-10">
                                <span class="btn-group-toggle" data-toggle="buttons" id="professions"></span>
                            </p>
                            <div class="fox-line"></div>
                            <!--  -..........-->
                            <div>
                                <p class="text-color-dark form-control-style mb-20">{{ getLocale($locale_search, 'label-search-detail-41', '') }}</p>
                                <div id="searchbox-slider-3" class="mb-10"></div>
                                <div class="d-flex mb-5">
                                    <span class="mr-auto" id="searchbox-slider-3-text-1">18</span>
                                    <span id="searchbox-slider-3-text-2">60+</span>
                                </div>
                            </div>
                            <div class="fox-line"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="search-foot-box">
            <div class="container">
                <div class="row">
                    <div class='mb-10 col-lg-8 col-12 offset-lg-2'>
                        <div class="text-right" style="padding: 31px 0;">
                            <button type="button" id="cancelListing" class="btn btn-link">{{ getLocale($locale_search, 'link-cancel', '') }}</button>
                            <button type="button" id="resetListing" class="btn btn-link">{{ getLocale($locale_search, 'link-reset', '') }}</button>
                            <button type="button" id="showListing" class="btn btn-info custom-btn-green">{{ getLocale($locale_search, 'link-show', '') }} <span>5000</span> {{ getLocale($locale_search, 'link-listing', '') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>
<template id="designPreference">
    <div class="col-md-3 mb-10">
        <div class="fox-search-img mb-16">
            <img
                src="https://cdn0-production-images-kly.akamaized.net/lx4frCrNhu-tEOreV_69_kccAjo=/640x360/smart/filters:quality(75):strip_icc():format(webp)/kly-media-production/medias/2362989/original/033001900_1537355462-apa_yang_salah_dari_foto_ini.jpg6.jpg" />
        </div>
        <label class="btn btn-checkbox btn-rounded btn-outline-primary btn-sm rounded">
            <input type="checkbox" class="more-filter" data-type="styles" /><span class="style-name">Industrial</span>
        </label>
    </div>
</template>
<template id="amenityFacility">
    <label class="btn btn-checkbox btn-rounded btn-outline-primary btn-sm rounded mr-10 mb-10">
        <input type="checkbox" class="more-filter" /><span class="item-name">TV</span>
    </label>
</template>
<template id="searchPreference">
    <label class="btn btn-checkbox btn-rounded btn-outline-primary btn-sm rounded mr-10 mb-10">
        <input type="checkbox" class="search-preference" /><span class="item-name">TV</span>
    </label>
</template>
<template id="recent-search">
    <label class="btn btn-checkbox btn-rounded btn-outline-primary btn-sm rounded mr-10 mb-10">
        <input class="recent-search" type="radio"><span class="item-name">TV</span>
    </label>
</template>
