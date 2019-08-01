@extends('user._partials.master')
@section('content')
<div class="row" id="myFavourites">
    <div class="col-md-10">
        <h3 class="mb-5">My favourites</h3>
        <input type="hidden" id="user" value="{{json_encode($user)}}">

        <div class="favourite-holder" id="section-my-favourites">
            <h4 class="mb-4">Menteng</h4>
            <div class="grid mb-4">
                <div class="row" id="my-favourites-property"></div>
            </div>
            <div class="d-flex justify-content-between mb-3">
                <a href="#" class="btn btn-link">
                    See all ongoing activities
                    <img src="../img/long-arrow-right.svg" alt="">
                </a>
            </div>
        </div>
    </div>

    <div class="popular-listing-holder" id="section-popular">
        <img class="img-pattern" src="../images/pattern-about-us.png">
        <div class="col-md-10 px-0">
            <h3 class="mb-5 color-white">Popular listings you might like</h3>
            <div class="grid mb-4">
                <div class="row" id="popular-property"></div>
                {{-- <div class="row">
                    <div class="col-md-4">
                        <div class="grid-item">
                            <a class="card" style="min-height:100% !important">
                                <div id="carousel-search-item-0" class="card-img-top carousel slide"
                                    data-ride="carousel">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img class="d-block w-100"
                                                src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?ixlib=rb-0.3.5&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;s=0cf4ef4cb623c8a52b1a624f76eaf5bf&amp;auto=format&amp;fit=crop&amp;w=750&amp;q=80">
                                        </div>
                                        <div class="carousel-item">
                                            <img class="d-block w-100"
                                                src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?ixlib=rb-0.3.5&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;s=0cf4ef4cb623c8a52b1a624f76eaf5bf&amp;auto=format&amp;fit=crop&amp;w=750&amp;q=80">
                                        </div>
                                        <div class="carousel-item">
                                            <img class="d-block w-100"
                                                src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?ixlib=rb-0.3.5&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;s=0cf4ef4cb623c8a52b1a624f76eaf5bf&amp;auto=format&amp;fit=crop&amp;w=750&amp;q=80">
                                        </div>
                                    </div>
                                    <ol class="carousel-indicators">
                                        <li data-target="#carousel-search-item-0" data-slide-to="0" class="active"></li>
                                        <li data-target="#carousel-search-item-0" data-slide-to="1" class=""></li>
                                        <li data-target="#carousel-search-item-0" data-slide-to="2" class=""></li>
                                    </ol>

                                    <div class="tag-info-bottom">#INIHASTAG</div>
                                </div>
                                <div class="tag-info">Female Only</div>
                                <button class="btn btn-icon-small btn-favorite"><i
                                        class="far fa-heart icon icon-small text-color-dark"></i></button>
                                <div class="card-body box-container-card" style="z-index:10">
                                    <div class="tags mb-2">
                                        <span class="card-tag fox-btn-left">Co Living</span>
                                        <span class="card-tag fox-btn-right card-tag-outline">Entire House</span>
                                    </div>
                                    <div class="box-container-card-info-left is-show-card">
                                        <h4 class="card-title">Gading Icon</h4>
                                        <p class="font-size-14 mb-0">Kebayoran Baru, South Jakarta</p>
                                        <p class="font-size-14 mb-0">Starting from <span class="font-weight-bold">Rp
                                                20,070,000 per Month</span></p>
                                        <hr />
                                        <span class="d-flex">
                                            <span class="font-size-12 mr-auto mb-0"><span
                                                    class="font-weight-bold">45</span> <i
                                                    class="fas fa-star text-color-orange"></i> (35)</span>
                                            <div>
                                                <span class="font-size-12 mr-auto mb-0"><img class="icon-img if-img-big"
                                                        src="../img/pp-landsize.jpg" alt="Room"></i>
                                                    169.4ddm<sup>2</sup> </span>
                                                <span class="font-size-12 mb-0"> <img class="icon-img"
                                                        src="../img/pp-room.jpg" alt="Room"></i> <span
                                                        class="font-weight-bold">2</span> / 8</span>
                                            </div>
                                        </span>
                                    </div>

                                    <div class="box-container-card-info-right">
                                        <h4 class="card-title">bukan gading baru</h4>
                                        <p class="font-size-14 mb-0">kebayoran lama</p>
                                        <p class="font-size-14 mb-0">Starting from <span class="font-weight-bold">Rp
                                                5000</span></p>
                                        <hr />
                                        <span class="d-flex align-items-center">
                                            <span class="font-size-12 mr-auto mb-0"><span
                                                    class="font-weight-bold">45</span> <i
                                                    class="fas fa-star text-color-orange"></i> (35)</span>
                                            <span class="font-size-12 mr-auto mb-0"><img class="icon-img if-img-big"
                                                    src="../img/pp-landsize.jpg" alt="Room"></i> 169.4ddm<sup>2</sup>
                                            </span>
                                            <span class="font-size-12 mb-0"> <img class="icon-img"
                                                    src="../img/pp-room.jpg" alt="Room"> <span
                                                    class="font-weight-bold">2</span> / 8</span>
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="grid-item">
                            <a class="card" style="min-height:100% !important">
                                <div id="carousel-search-item-0" class="card-img-top carousel slide"
                                    data-ride="carousel">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img class="d-block w-100"
                                                src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?ixlib=rb-0.3.5&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;s=0cf4ef4cb623c8a52b1a624f76eaf5bf&amp;auto=format&amp;fit=crop&amp;w=750&amp;q=80">
                                        </div>
                                        <div class="carousel-item">
                                            <img class="d-block w-100"
                                                src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?ixlib=rb-0.3.5&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;s=0cf4ef4cb623c8a52b1a624f76eaf5bf&amp;auto=format&amp;fit=crop&amp;w=750&amp;q=80">
                                        </div>
                                        <div class="carousel-item">
                                            <img class="d-block w-100"
                                                src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?ixlib=rb-0.3.5&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;s=0cf4ef4cb623c8a52b1a624f76eaf5bf&amp;auto=format&amp;fit=crop&amp;w=750&amp;q=80">
                                        </div>
                                    </div>
                                    <ol class="carousel-indicators">
                                        <li data-target="#carousel-search-item-0" data-slide-to="0" class="active"></li>
                                        <li data-target="#carousel-search-item-0" data-slide-to="1" class=""></li>
                                        <li data-target="#carousel-search-item-0" data-slide-to="2" class=""></li>
                                    </ol>

                                    <div class="tag-info-bottom">#INIHASTAG</div>
                                </div>
                                <div class="tag-info">Female Only</div>
                                <button class="btn btn-icon-small btn-favorite"><i
                                        class="far fa-heart icon icon-small text-color-dark"></i></button>
                                <div class="card-body box-container-card" style="z-index:10">
                                    <div class="tags mb-2">
                                        <span class="card-tag fox-btn-left">Co Living</span>
                                        <span class="card-tag fox-btn-right card-tag-outline">Entire House</span>
                                    </div>
                                    <div class="box-container-card-info-left is-show-card">
                                        <h4 class="card-title">Gading Icon</h4>
                                        <p class="font-size-14 mb-0">Kebayoran Baru, South Jakarta</p>
                                        <p class="font-size-14 mb-0">Starting from <span class="font-weight-bold">Rp
                                                20,070,000 per Month</span></p>
                                        <hr />
                                        <span class="d-flex">
                                            <span class="font-size-12 mr-auto mb-0"><span
                                                    class="font-weight-bold">45</span> <i
                                                    class="fas fa-star text-color-orange"></i> (35)</span>
                                            <div>
                                                <span class="font-size-12 mr-auto mb-0"><img class="icon-img if-img-big"
                                                        src="../img/pp-landsize.jpg" alt="Room"></i>
                                                    169.4ddm<sup>2</sup> </span>
                                                <span class="font-size-12 mb-0"> <img class="icon-img"
                                                        src="../img/pp-room.jpg" alt="Room"></i> <span
                                                        class="font-weight-bold">2</span> / 8</span>
                                            </div>
                                        </span>
                                    </div>

                                    <div class="box-container-card-info-right">
                                        <h4 class="card-title">bukan gading baru</h4>
                                        <p class="font-size-14 mb-0">kebayoran lama</p>
                                        <p class="font-size-14 mb-0">Starting from <span class="font-weight-bold">Rp
                                                5000</span></p>
                                        <hr />
                                        <span class="d-flex align-items-center">
                                            <span class="font-size-12 mr-auto mb-0"><span
                                                    class="font-weight-bold">45</span> <i
                                                    class="fas fa-star text-color-orange"></i> (35)</span>
                                            <span class="font-size-12 mr-auto mb-0"><img class="icon-img if-img-big"
                                                    src="../img/pp-landsize.jpg" alt="Room"></i> 169.4ddm<sup>2</sup>
                                            </span>
                                            <span class="font-size-12 mb-0"> <img class="icon-img"
                                                    src="../img/pp-room.jpg" alt="Room"> <span
                                                    class="font-weight-bold">2</span> / 8</span>
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="grid-item">
                            <a class="card" style="min-height:100% !important">
                                <div id="carousel-search-item-0" class="card-img-top carousel slide"
                                    data-ride="carousel">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img class="d-block w-100"
                                                src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?ixlib=rb-0.3.5&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;s=0cf4ef4cb623c8a52b1a624f76eaf5bf&amp;auto=format&amp;fit=crop&amp;w=750&amp;q=80">
                                        </div>
                                        <div class="carousel-item">
                                            <img class="d-block w-100"
                                                src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?ixlib=rb-0.3.5&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;s=0cf4ef4cb623c8a52b1a624f76eaf5bf&amp;auto=format&amp;fit=crop&amp;w=750&amp;q=80">
                                        </div>
                                        <div class="carousel-item">
                                            <img class="d-block w-100"
                                                src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?ixlib=rb-0.3.5&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;s=0cf4ef4cb623c8a52b1a624f76eaf5bf&amp;auto=format&amp;fit=crop&amp;w=750&amp;q=80">
                                        </div>
                                    </div>
                                    <ol class="carousel-indicators">
                                        <li data-target="#carousel-search-item-0" data-slide-to="0" class="active"></li>
                                        <li data-target="#carousel-search-item-0" data-slide-to="1" class=""></li>
                                        <li data-target="#carousel-search-item-0" data-slide-to="2" class=""></li>
                                    </ol>

                                    <div class="tag-info-bottom">#INIHASTAG</div>
                                </div>
                                <div class="tag-info">Female Only</div>
                                <button class="btn btn-icon-small btn-favorite"><i
                                        class="far fa-heart icon icon-small text-color-dark"></i></button>
                                <div class="card-body box-container-card" style="z-index:10">
                                    <div class="tags mb-2">
                                        <span class="card-tag fox-btn-left">Co Living</span>
                                        <span class="card-tag fox-btn-right card-tag-outline">Entire House</span>
                                    </div>
                                    <div class="box-container-card-info-left is-show-card">
                                        <h4 class="card-title">Gading Icon</h4>
                                        <p class="font-size-14 mb-0">Kebayoran Baru, South Jakarta</p>
                                        <p class="font-size-14 mb-0">Starting from <span class="font-weight-bold">Rp
                                                20,070,000 per Month</span></p>
                                        <hr />
                                        <span class="d-flex">
                                            <span class="font-size-12 mr-auto mb-0"><span
                                                    class="font-weight-bold">45</span> <i
                                                    class="fas fa-star text-color-orange"></i> (35)</span>
                                            <div>
                                                <span class="font-size-12 mr-auto mb-0"><img class="icon-img if-img-big"
                                                        src="../img/pp-landsize.jpg" alt="Room"></i>
                                                    169.4ddm<sup>2</sup> </span>
                                                <span class="font-size-12 mb-0"> <img class="icon-img"
                                                        src="../img/pp-room.jpg" alt="Room"></i> <span
                                                        class="font-weight-bold">2</span> / 8</span>
                                            </div>
                                        </span>
                                    </div>

                                    <div class="box-container-card-info-right">
                                        <h4 class="card-title">bukan gading baru</h4>
                                        <p class="font-size-14 mb-0">kebayoran lama</p>
                                        <p class="font-size-14 mb-0">Starting from <span class="font-weight-bold">Rp
                                                5000</span></p>
                                        <hr />
                                        <span class="d-flex align-items-center">
                                            <span class="font-size-12 mr-auto mb-0"><span
                                                    class="font-weight-bold">45</span> <i
                                                    class="fas fa-star text-color-orange"></i> (35)</span>
                                            <span class="font-size-12 mr-auto mb-0"><img class="icon-img if-img-big"
                                                    src="../img/pp-landsize.jpg" alt="Room"></i> 169.4ddm<sup>2</sup>
                                            </span>
                                            <span class="font-size-12 mb-0"> <img class="icon-img"
                                                    src="../img/pp-room.jpg" alt="Room"> <span
                                                    class="font-weight-bold">2</span> / 8</span>
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                </div> --}}
            </div>
        </div>
    </div>
</div>

<template id="result-item">
    <div class="col-md-4">
        <div class="grid-item">
            <div class="card card-property" style="min-height:100% !important">
                @if(Auth::user())
                <button class="btn btn-icon-small btn-favorite add-favorite"><i
                        class="far fa-heart icon icon-small text-color-dark"></i></button>
                @else
                <button class="btn btn-icon-small btn-favorite" data-toggle="modal" data-target="#modalLogin"><i
                        class="far fa-heart icon icon-small text-color-dark"></i></button>
                @endif
                <div id="carousel-search-item-0" class="card-img-top carousel slide" data-ride="carousel" tabindex="0">
                    <ol class="carousel-indicators"></ol>
                    <div class="carousel-inner"></div>
                    <div class="tag-info-bottom">#INIHASTAG</div>
                </div>
                <div class="card-body box-container-card" style="z-index:10">
                    <div class="tags mb-16"></div>
                    <div class="box-container-card-info-left is-show-card">
                        <h4 class="card-title">Gading Icon</h4>
                        <p class="font-size-14 mb-0 address">Kebayoran Baru, South Jakarta</p>
                        <p class="font-size-14 mb-0">From <span class="font-weight-bold starting-price">Rp
                                20,070,000</span>
                        </p>
                        <hr />
                        <span class="d-flex">
                            <span class="font-size-12 mr-auto mb-0"><span class="font-weight-bold"></span></span>
                            <div>
                                <span class="font-size-12 mr-auto mb-0"><img class="icon-img if-img-big"
                                        src="{{ asset('/img/ic_size.png') }}" alt="icon room size"></i> <span
                                        class="room-size"></span> m<sup>2</sup> </span>
                                <span class="font-size-12 mb-0"> <img class="icon-img img-type"
                                        src="{{ asset('/img/coliving-icon.png') }}" alt="icon room availability"></i>
                                    <span class="available-room"><span class="font-weight-bold">2</span> /
                                        8</span></span>
                            </div>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<template id="navigation">
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</template>
@endsection