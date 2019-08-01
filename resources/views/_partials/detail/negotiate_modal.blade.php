<div class="modal fade" id="negotiate-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" data-background-color="aqua">
            <div class="modal-header pl-5">
                <h5 class="font-size-20 text-color-dark modal-title mt-3">{{ getLocale($locale_detail, 'link-negotiate-1', '') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="fa fa-times" aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body pl-5 pr-5">
                <div class="mb-2">
                    <label for="length-stay" class="label">{{ getLocale($locale_detail, 'link-negotiate-2', '') }}</label>
                    <select id="length-stay" class="form-control input-aqua">
                        <option>{{ getLocale($locale_detail, 'link-negotiate-3', '') }}</option>
                    </select>
                </div>
                <div class="mb-2">
                    <label for="payment-terms" class="label">{{ getLocale($locale_detail, 'link-negotiate-4', '') }}</label>
                    <select id="payment-terms" class="form-control input-aqua">
                        <option>{{ getLocale($locale_detail, 'link-negotiate-5', '') }}</option>
                    </select>
                </div>
                <div class="mb-2">
                    <label class="label mb-3">{{ getLocale($locale_detail, 'link-negotiate-6', '') }}</label>
                    <div id="slider-offer" class="mb-3 mt-5"></div>
                    <div class="d-flex">
                        <span class="mr-auto">{{ session('locale')=='id' ? 'RP' : 'IDR' }} 85.000.000</span>
                        <span>{{ session('locale')=='id' ? 'RP' : 'IDR' }} 119.000.000</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer pl-5 pr-5">
                <button type="button" class="btn btn-primary btn-block btn-save text-uppercase btn-submit-offering">
                {{ getLocale($locale_detail, 'link-negotiate-7', '') }}
                </button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="negotiate-message-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content text-center pt-4" data-background-color="aqua">
            <div class="modal-body pl-5 pr-5 pb-2">
                <div><img class="img-fluid" src="{{url('img/offer-success.svg')}}"/></div>
                <h3 class="mt-3 font-weight-600 text-color-dark">{{ getLocale($locale_detail, 'link-negotiate-8', '') }}</h3>
                <div class="text-color-gray-1 font-size-14 mt-1">{{ getLocale($locale_detail, 'link-negotiate-9', '') }}.</div>
            </div>
            <div class="modal-footer pl-5 pr-5">
                <button type="button" data-dismiss="modal" class="btn btn-primary btn-block">{{ getLocale($locale_detail, 'link-negotiate-10', '') }}</button>
            </div>
        </div>
    </div>
</div>
