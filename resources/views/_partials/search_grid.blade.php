<div class="grid-item">
    <a class="card" href="{{$link}}">
        <div id="carousel-search-item-{{$id}}" class="card-img-top carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                @foreach ($images as $imgid => $item)
                <div class="carousel-item{{($imgid==0)?" active":""}}">
                    <img class="d-block w-100" src="{{$item}}">
                </div>
                @endforeach
            </div>
            <ol class="carousel-indicators">
                @foreach ($images as $imgid => $item)
                <li data-target="#carousel-search-item-{{$id}}" data-slide-to="{{$imgid}}" class="{{($imgid==0)?"active":""}}"></li>
                @endforeach
            </ol>
        </div>
        <div class="tag-info">{{ session('locale')=='id' ? 'Hanya Perempuan' : 'Female Only' }}</div>
        <button class="btn btn-icon-small btn-favorite"><i class="far fa-heart icon icon-small text-color-dark"></i></button>
        <div class="card-body">
            <div class="tags mb-2">
                <span class="card-tag">{{ session('locale')=='id' ? 'Hunian Bersama' : 'Co living' }}</span>
                <span class="card-tag card-tag-outline">{{ session('locale')=='id' ? 'Ditempati Sendiri' : 'Entire House' }}</span>
            </div>
            <h4 class="card-title">{{$title}}</h4>
            <p class="font-size-14 mb-0">{{$location}}</p>
            <p class="font-size-14 mb-0">{{ session('locale')=='id' ? 'Mulai dari' : 'Starting form' }} <span class="font-weight-bold">{{$price}} {{ session('locale')=='id' ? 'per Bulan' : 'per Month' }}</span></p>
            <hr/>
            <span class="d-flex">
                <span class="font-size-12 mr-auto mb-0">45 <i class="fas fa-star text-color-orange"></i> (35)</span>
                <span class="font-size-12 mb-0 mr-2">169.4m<sup>2</sup></span>
                <span class="font-size-12 mb-0"><span class="font-weight-bold">2</span> / 8</span>
            </span>
        </div>
    </a>
</div>
