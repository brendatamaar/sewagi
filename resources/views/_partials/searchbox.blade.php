<section id="search-popup">
    <form id="searchbox-form" action="{{ route('search') }}" method="POST">
        @csrf
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
                                class="btn btn-checkbox btn-rounded btn-outline-primary btn-sm text-capitalize rounded mr-10 active">
                                <input type="checkbox" class="home-filter" name="cond_co_living"
                                    data-param="cond_co_living" checked value="1">{{ getLocale($locale, 'link-interest-2', '') }}</label>
                            <label
                                class="btn btn-checkbox btn-rounded btn-outline-primary btn-sm text-capitalize rounded mr-10 active">
                                <input type="checkbox" class="home-filter" name="cond_entire_space"
                                    data-param="cond_entire_space" checked value="1">{{ getLocale($locale, 'link-interest-3', '') }}</label>
                        </span>
                    </div>
                    <div class="col-lg-2 d-none d-md-flex justify-content-end align-items-center mb-10">
                        <a href="javascript:void(0)" class="searchbox-close"><i class="fas fa-times"></i> {{ getLocale($locale, 'link-close', '') }}</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 col-12 offset-lg-2">
                        <div class="input-group input-homepage mb-20">
                            <div class="input-group-prepend">
                                <span class="input-group-text icon-location">A</span>
                            </div>
                            <input type="text" name="q" class="form-control searchbox-value searchbox-primary border-0"
                                id="searchbox" placeholder="{{ getLocale($locale, 'placeholder-search', 'Enter location, property name, company or education entity') }}">
                            <input type="hidden" name="lat" id="lat">
                            <input type="hidden" name="lng" id="lng">
                            <input type="hidden" name="place_id" id="place_id">
                            <input type="hidden" id="recent_search">
                            <input type="hidden" name="maps" id="maps" value="false">
                            <input type="hidden" name="nearme" value="0" id="input-is-nearme">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="removeLocation"><i class="fas fa-times"></i></span>
                                <span class="input-group-text input-group-target">
                                    <button type="button" class="btn btn-grey btn-target" id="currentLocation"><i
                                            class="fanicon-target-two"></i></button>
                                </span>
                            </div>
                            <div class="input-group-prepend">
                                <button type="button" class="btn btn-primary searchbox-btn">{{ getLocale($locale, 'link-discover', '') }}</button>
                            </div>
                        </div>
                        <div class="mb-38 d-flex align-items-center">
                            <p
                                class="search-recent-text text-uppercase font-size-12 d-inline-block mb-0 d-lg-inline-block d-block mr-10">
                                {{ getLocale($locale, 'label-recent-search', 'Recent searches') }}</p>
                            <span>
                                <span class="btn-group-toggle" data-toggle="buttons" id="recentSearch"></span>
                            </span>
                        </div>
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
                    <p class="text-color-dark form-control-style mb-10">
                        {{ getLocale($locale, 'link-filter-2', '') }}
                    </p>
                    <p class="mb-10">
                        <span class="btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-checkbox btn-rounded btn-outline-primary btn-sm rounded mr-10">
                                <input name="type_apartment" class="home-filter" type="checkbox" data-param="type_apartment" value="1">{{ getLocale($locale, 'link-filter-3', '') }}
                            </label>
                            <label class="btn btn-checkbox btn-rounded btn-outline-primary btn-sm rounded mr-10">
                                <input name="type_house" class="home-filter" type="checkbox" data-param="type_house" value="1">{{ getLocale($locale, 'link-filter-4', '') }}
                            </label>
                        </span>
                    </p>
                    <div class="fox-line"></div>
                    <p class="text-color-dark form-control-style mb-10">
                        {{ getLocale($locale, 'link-filter-5', '') }}
                    </p>
                    <p class="mb-10">
                        <span class="btn-group-toggle" data-toggle="buttons">
                        <label class="btn btn-checkbox btn-outline-primary mr-15 btn-circle">
                            <input name="bedroom_1" type="checkbox">1
                        </label>
                        <label class="btn btn-checkbox btn-outline-primary mr-15 btn-circle">
                            <input name="bedroom_2" type="checkbox">2
                        </label>
                        <label class="btn btn-checkbox btn-outline-primary mr-15 btn-circle">
                            <input name="bedroom_3" type="checkbox">3
                        </label>
                        <label class="btn btn-checkbox btn-outline-primary mr-15 btn-circle">
                            <input name="bedroom_4" type="checkbox">4
                        </label>
                        <label class="btn btn-checkbox btn-outline-primary mr-15 btn-circle">
                            <input name="bedroom_5" type="checkbox">5+
                        </label>
                        </span>
                    </p>
                    <div class="fox-line"></div>
                    <div class="w-100">
                        <input type="hidden" name="is_commute" value="0" id="input-is-commute">
                        <div class="d-flex align-items-center mb-10">
                            <p class="text-color-dark form-control-style mr-auto mb-0"><span data-text="{{ getLocale($locale, 'link-filter-6', '') }}" id="titleAddCommute">{{ getLocale($locale, 'link-filter-6', '') }}</span> <span class="text-color-gray-6 font-weight-normal">Beta</span></p>
                            <a class="btn btn-outline-primary btn-icon collapse-icon d-flex align-items-center justify-content-center collapsed"
                                data-toggle="collapse" href="#collapseAddCommute" role="button" aria-expanded="false"
                                aria-controls="collapseAddCommute"><i class="fas fa-plus"></i></a>
                        </div>
                        <div class="background-white mb-10 collapse commute-input" id="collapseAddCommute">
                            <div class="row pt-10 justify-content-between align-items-center">
                                <div class="col-auto">
                                    <div class="form-group">
                                        <select class="select2 select2-list-property commute-time" name="time">
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
                                            <input type="text" class="form-control" id="commute-location" placeholder="{{ getLocale($locale, 'label-loc-detail', '') }}">
                                        </div>
                                    </div>
                                </div>
                               <div class="col-auto px-0">
                                    <div class="form-group form-control-style text-color-dark px-2">{{ getLocale($locale, 'label-by-short', '') }}</div>
                               </div>
                                <div class="col-auto">
                                    <div class="form-group">
                                        <select class="select2 select2-list-property commute-time" name="commute_type">
                                            <option value="car">{{ getLocale($locale, 'label-car', '') }}</option>
                                            <option value="bike">{{ getLocale($locale, 'label-motorbike', '') }}</option>
                                            <option value="walk">{{ getLocale($locale, 'label-walking', '') }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-9 col-12 offset-lg-2 pl-41">
                                    <div class="mr-10 my-12 font-size-12 text-uppercase text-color-gray-6 font-weight-500 letter-spacing-18">{{ getLocale($locale, 'link-filter-7', '') }}</div>
                                    <div class="mb-10 p-lg-0">
                                        <span class="btn-group-toggle" data-toggle="buttons">
                                            <label class="btn btn-checkbox btn-rounded auto-height text-capitalize btn-outline-primary btn-sm rounded mr-10">
                                                <input type="radio" name="landmark" value=""/>
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
                                                <br /><span class="font-weight-normal font-size-11">{{ getLocale($locale, 'label-direction-s', '') }} </span>
                                            </label>
                                            <label class="btn btn-checkbox btn-rounded auto-height text-capitalize btn-outline-primary btn-sm rounded mr-10">
                                                <input type="radio" name="landmark" value=""/>
                                                Gandaria City Mall
                                                <br /><span class="font-weight-normal font-size-11">{{ getLocale($locale, 'label-direction-s', '') }} </span>
                                            </label>
                                            <label class="btn btn-checkbox btn-rounded auto-height text-capitalize btn-outline-primary btn-sm rounded mr-10">
                                                <input type="radio" name="landmark" value=""/>
                                                Taman Anggrek Mall
                                                <br /><span class="font-weight-normal font-size-11">{{ getLocale($locale, 'label-direction-w', '') }} </span>
                                            </label>
--}}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="fox-line"></div>
                        <p class="text-color-dark form-control-style mb-10">
                            {{ getLocale($locale, 'link-filter-8', 'Terms') }}
                        </p>
                        <div class="pad-left-10">
                            <p class="form-control-style mb-10">
                                {{ getLocale($locale, 'link-filter-9', 'Length of stay') }}
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

                            <p class="form-control-style mb-10">
                                {{ getLocale($locale, 'link-filter-10', 'Payment options') }}
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
                        <p class="text-color-dark form-control-style mb-15">{{ getLocale($locale, 'link-filter-11', 'Range budget per month') }}</p>
                        <div id="searchbox-slider" class="mb-10"></div>
                        <input type="text" name="min_price" class="fox-hide searchbox-slider-input-1">
                        <input type="text" name="max_price" class="fox-hide searchbox-slider-input-2">
                        <div class="d-flex mb-5">
                            <span id="searchbox-slider-text-1" class="mr-auto">{{ session('locale')=='id' ? 'RP' : 'IDR' }} 1</span>
                            <span id="searchbox-slider-text-2">{{ session('locale')=='id' ? 'RP' : 'IDR' }} 3.000.000.000</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>

<template id="recent-search">
    <label class="btn btn-checkbox btn-rounded btn-outline-primary btn-sm rounded mr-10 mb-lg-0">
        <input class="recent-search" type="radio"><span class="item-name">TV</span>
    </label>
</template>
