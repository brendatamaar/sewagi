<div class="pt-3 pb-3">
    <div class="row">
        <div class="col-md-4">
            <div id="carousel-room-item-{{$id}}" class="carousel slide text-color-white" data-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($images as $imgid => $item)
                    <div class="carousel-item{{($imgid==0)?" active":""}}">
                        <img class="d-block w-100" src="{{$item}}">
                    </div>
                    @endforeach
                </div>
                <ol class="carousel-indicators">
                    @foreach ($images as $imgid => $item)
                    <li data-target="#carousel-room-item-{{$id}}" data-slide-to="{{$imgid}}" class="{{($imgid==0)?"active":""}}"></li>
                    @endforeach
                </ol>
                <span class="nav-prev no-style ml-1" role="button" data-target="#carousel-room-item-{{$id}}" data-slide="prev"><i class="fas fa-arrow-left"></i></span>
                <span class="nav-next no-style mr-1" role="button" data-target="#carousel-room-item-{{$id}}" data-slide="next"><i class="fas fa-arrow-right"></i></span>
            </div>
        </div>
        <div class="col-md-8 d-flex pt-3">
            <div class="flex-fill font-size-12 text-color-gray-6">
                <div><h4 class="m-0 text-dark">{{ getLocale($locale_detail, 'room1', 'Master Bedroom') }}</h4></div>
                <div>
                    <ul class="category-list dot-separator">
                        <li>1 {{ getLocale($locale_detail, 'room2', 'double bed') }}</li>
                        <li>1 {{ getLocale($locale_detail, 'room3', 'private bathroom') }}</li>
                    </ul>
                </div>
                <div><i class="far fa-expand mr-2 text-color-turqoise"></i>49 m²</div>
            </div>
            <span class="btn-group-toggle" data-toggle="buttons">
                <label class="btn btn-outline-primary btn-select">
                    <input type="checkbox" />
                    <span>{{ getLocale($locale_detail, 'link-select', 'Select') }}</span>
                </label>
            </span>
        </div>
    </div>
    <div class="d-flex font-size-12 pt-1 pb-1 mt-3" data-background-color="orange-2">
        <div class="text-color-dark mt-2 ml-3 font-weight-600">{{ getLocale($locale_detail, 'link-detail-10', '') }}</div>
        <div class="flex-fill">
            <div class="w-100 d-flex mt-1 mb-1">
                <div class="ml-2 mr-2 icon-circle-small flex-auto" data-background-color="orange">
                    <i class="icon icon-small fas fa-venus"></i>
                </div>
                <ul class="mt-1 category-list dot-separator text-color-gray-1">
                    <li>{{ getLocale($locale_detail, 'label-mate-1', 'Neat') }}</li>
                    <li>{{ getLocale($locale_detail, 'label-mate-2', 'College student') }}</li>
                    <li>{{ getLocale($locale_detail, 'label-mate-3', 'Pet lovers') }}</li>
                    <li>{{ getLocale($locale_detail, 'label-mate-4', 'Talkative') }}</li>
                    <li>{{ getLocale($locale_detail, 'label-mate-5', 'Musician') }}</li>
                </ul>
            </div>
        </div>
    </div>
</div>
