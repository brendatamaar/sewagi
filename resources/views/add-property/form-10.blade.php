@extends('_partials.master_solid_nosearch')
@section('content')
<form id="newPropertyData10" role="form" method="POST" class="form-list-property">
    @csrf
    <div class="row justify-content-between align-items-center mb-5">
        <div class="col-auto">
            <h3>{{ getLocale($locale_form10, 'label-1', "Let's review your listing") }}</h3>
        </div>
        <div class="col-auto">
            <a href="#" class="btn btn-primary">{{ getLocale($locale_form10, 'label-2', "VIEW LISTING MOCKUP") }}</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="card card-list-property">
                <div class="card-header">
                    <h6 class="text-muted">{{ getLocale($locale_form10, 'label-3', "STEP 1") }}</h6>
                    <h5 style="min-height: 45px">{{ getLocale($locale_form10, 'label-4', "Basic property information") }}</h5>
                </div>
                <div class="card-body justify-content-between d-flex flex-column">
                    <ul class="list-unstyled list-vertical-line">
                        <li class="d-flex align-items-center">
                            <span class="icon-circle d-flex align-items-center {{ $reviewPropertyTypeLivingCondition ? 'active' : '' }}">
                                <i class="fas fa-check"></i>
                            </span>
                            <span>
                                <p class="mb-0">{{ getLocale($locale_form10, 'label-5', "Property type & living condition") }}</p>
                            </span>
                        </li>
                        <li class="d-flex align-items-center">
                            <span class="icon-circle d-flex align-items-center {{ $reviewBedroomBathroom ? 'active' : '' }}">
                                <i class="fas fa-check"></i>
                            </span>
                            <span>
                                <p class="mb-0">{{ getLocale($locale_form10, 'label-6', "Bedroom & bathroom") }}</p>
                            </span>
                        </li>
                        <li class="d-flex align-items-center">
                            <span class="icon-circle d-flex align-items-center {{ $reviewLocation ? 'active' : '' }}">
                                <i class="fas fa-check"></i>
                            </span>
                            <span>
                                <p class="mb-0">{{ getLocale($locale_form10, 'label-7', "Location") }}</p>
                            </span>
                        </li>
                    </ul>
                    <a href="/create-property/{{$property->id}}/1" class="btn btn-outline-primary">{{ getLocale($locale_form10, 'label-edit', "EDIT") }}</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-list-property">
                <div class="card-header">
                    <h6 class="text-muted">{{ getLocale($locale_form10, 'label-8', "STEP 2") }}</h6>
                    <h5 style="min-height: 45px">{{ getLocale($locale_form10, 'label-9', "Tell us the details") }}</h5>
                </div>
                <div class="card-body justify-content-between d-flex flex-column">
                    <ul class="list-unstyled list-vertical-line">
                        <li class="d-flex align-items-center">
                            <span class="icon-circle d-flex align-items-center {{ $reviewDescriptionHouseRules ? 'active' : '' }}">
                                <i class="fas fa-check"></i>
                            </span>
                            <span>
                                <p class="mb-0">{{ getLocale($locale_form10, 'label-10', "Description & house rules") }}</p>
                            </span>
                        </li>
                        <li class="d-flex align-items-center">
                            <span class="icon-circle d-flex align-items-center {{ $reviewAmenitiesFacilities ? 'active' : '' }}">
                                <i class="fas fa-check"></i>
                            </span>
                            <span>
                                <p class="mb-0">{{ getLocale($locale_form10, 'label-11', "Amenities & facilities") }}</p>
                            </span>
                        </li>
                        <li class="d-flex align-items-center">
                            <span class="icon-circle d-flex align-items-center {{ $reviewPhotos ? 'active' : '' }}">
                                <i class="fas fa-check"></i>
                            </span>
                            <span>
                                <p class="mb-0">{{ getLocale($locale_form10, 'label-12', "Photos") }}</p>
                            </span>
                        </li>
                        <li class="d-flex align-items-center">
                            <span class="icon-circle d-flex align-items-center {{ $reviewLegalDetails ? 'active' : '' }}">
                                <i class="fas fa-check"></i>
                            </span>
                            <span>
                                <p class="mb-0">{{ getLocale($locale_form10, 'label-13', "Legal details") }}</p>
                            </span>
                        </li>
                    </ul>
                    <a href="/create-property/{{$property->id}}/4" class="btn btn-outline-primary">{{ getLocale($locale_form10, 'label-edit', "EDIT") }}</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-list-property">
                <div class="card-header">
                    <h6 class="text-muted">{{ getLocale($locale_form10, 'label-14', "STEP 3") }}</h6>
                    <h5 style="min-height: 45px">{{ getLocale($locale_form10, 'label-15', "Payment preference") }}</h5>
                </div>
                <div class="card-body justify-content-between d-flex flex-column">
                    <ul class="list-unstyled list-vertical-line">
                        <li class="d-flex align-items-center">
                            <span class="icon-circle d-flex align-items-center {{ $reviewPaymentPreferenceForCoLiving ? 'active' : '' }}">
                                <i class="fas fa-check"></i>
                            </span>
                            <span>
                                <p class="mb-0">{{ getLocale($locale_form10, 'label-16', "Payment preference for co-living") }}</p>
                            </span>
                        </li>
                        <li class="d-flex align-items-center">
                            <span class="icon-circle d-flex align-items-center {{ $reviewPaymentPreferenceForEntireSpace ? 'active' : '' }}">
                                <i class="fas fa-check"></i>
                            </span>
                            <span>
                                <p class="mb-0">{{ getLocale($locale_form10, 'label-17', "Payment preference for entire space") }}</p>
                            </span>
                        </li>
                    </ul>
                    <a href="/create-property/{{$property->id}}/{{ $property->is_entire_space ? 8 : 9 }}" class="btn btn-outline-primary">{{ getLocale($locale_form10, 'label-edit', "EDIT") }}</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 border-top py-5">
            <div class="row">
                <div class="col-md-12">
                    <h5 class="mb-4">{{ getLocale($locale_form10, 'label-18', "Legal documents") }}</h5>
                    <p class="text-muted mb-4">{{ getLocale($locale_form10, 'label-19', "You may skip uploading the required document for now. However, you will need to upload them when signing the lease contract with the renter") }}. <span><a href="/create-property/{{$property->id}}/7">{{ getLocale($locale_form10, 'label-20', "Upload now") }}.</a></span></p>
                </div>
                <div class="col-md-4">
                    <ul class="list-unstyled">
                        <li class="d-flex align-items-center mb-4">
                            <span class="icon-circle d-flex align-items-center {{ $reviewOwnershipCertificate ? 'active' : '' }}">
                                <i class="fas fa-check"></i>
                            </span>
                            <span>
                                <p class="mb-0">{{ getLocale($locale_form10, 'label-21', "Property ownership certificate") }}</p>
                            </span>
                        </li>
                        <li class="d-flex align-items-center">
                            <span class="icon-circle d-flex align-items-center {{ $reviewInsuranceDocument ? 'active' : '' }}">
                                <i class="fas fa-check"></i>
                            </span>
                            <span>
                                <p class="mb-0">{{ getLocale($locale_form10, 'label-22', "Property insurance document") }}</p>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 border-top py-5">
            <div class="row">
                <div class="col-md-12">
                    <h5 class="mb-4">{{ getLocale($locale_form10, 'label-34', "Default Payment Safe") }}</h5>
                    <p class="text-muted mb-4">{{ getLocale($locale_form10, 'label-35', "Your Default Payment Safe insurance coverage, will only activate once you’ve successfully leased a property or bedroom via Sewagi") }}</p>
                    <p class="text-muted mb-4">
                        @if (session('locale')=='id')
                            Lihat keamanan pembayaran <span><a href="">premium</a></span> dan <span><a href="">manfaatnya</a></span>.
                        @else
                            View Default Payment Safe <span><a href="">premiums</a></span> and <span><a href="">benefits</a></span>.
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="id" value="{{ $property->id }}" />
    <input value="10" type="hidden" name="step" id="step">
</form>
<div class="modal fade modal-dashboard" id="modalSubmitAgree" tabindex="-1" role="dialog">
    <div class="modal-dialog from-right" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                <img class="mb-5" src="../img/listing-submitted.svg" alt="">
                <p class="mb-5">{{ getLocale($locale_form10, 'label-23', "By submitting my listing to Sewagi, I understand and agree to honor the following") }} <a href="#">{{ getLocale($locale_form10, 'label-24', "General Terms of Partnership") }}</a> {{ getLocale($locale_form10, 'label-25', "and abide by the Sewagi platform") }} <a href="#">{{ getLocale($locale_form10, 'label-26', "Terms of Use") }}</a> {{ getLocale($locale_form10, 'label-27', "and") }} <a href="#">{{ getLocale($locale_form10, 'label-28', "Privacy Policy") }}</a></p>
                <div class="button-group">
                    <button class="btn btn-outline-primary mr-2" data-dismiss="modal">{{ getLocale($locale_form10, 'label-29', "DECLINE") }}</button>
                    <button class="btn btn-primary" href="#modalSubmitSuccess" data-dismiss="modal" id="btnAgree" data-toggle="modal">{{ getLocale($locale_form10, 'label-30', "AGREE") }}</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade modal-dashboard" id="modalSubmitSuccess" tabindex="-1" role="dialog">
    <div class="modal-dialog from-right" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                <img class="mb-5" src="../img/listing-submitted.svg" alt="">
                <h5 class="mb-5">{{ getLocale($locale_form10, 'label-31', "Yeay! Your listing has been submitted") }}.</h5>
                <p class="mb-5">{{ getLocale($locale_form10, 'label-31', "We will review your listing to check if all is tip-top before publishing it online within one working day") }}.</p>
                <div class="button-group">
                    <a class="btn btn-primary" href="#" data-dismiss="modal">{{ getLocale($locale_form10, 'label-33', "GO TO DASHBOARD") }}</a>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
@section('next_step')
<a id="link-previous" href="/create-property/{{ $property->id }}/{{ $property->is_co_living ? 9 : 8 }}" class="btn btn-link btn-prev-list-property d-flex align-items-center">
    <i class="fas fa-long-arrow-alt-left mr-2"></i>
    {{ getLocale($locale_form10, 'label-previous', 'Previous') }}
</a>
<a id ="link-submit" class="btn btn-primary btn-next-list-property" href="#modalSubmitAgree" data-toggle="modal">
    {{ getLocale($locale_form10, 'label-submit', 'SUBMIT') }}
    <i class="fas fa-long-arrow-alt-right ml-2"></i>
</a>
@endsection
