@extends('_partials.master_solid_nosearch')
@section('content')
<form id="newPropertyData7" role="form" method="POST" action="{{ url('/create-property/7') }}" class="form-list-property">
    @csrf
    <div class="mb-5">
        <h4 class="mb-4 required">{{ getLocale($locale_form7, 'label-1', 'Property Ownership') }}</h4>
        <p class="text-muted fs-12">
            {{ getLocale($locale_form7, 'label-2', "For more transparency and faster contract signing process, please provide us with your property's legal details. Don't worry, we won't share them with anyone.") }}
        </p>
    </div>
    <div class="mb-5">
        <h4 class="mb-4 required">{{ getLocale($locale_form7, 'label-3', 'To whom does this property belong?') }}</h4>
        <select class="select2 select2-list-property" name="belong_to" id="your-status">
            <option value=""></option>
            <option value="1" {{ $property->belong_to == '1' ? 'selected' : '' }}>{{ getLocale($locale_form7, 'label-4', 'This property is under my name') }}</option>
            <option value="2" {{ $property->belong_to == '2' ? 'selected' : '' }}>{{ getLocale($locale_form7, 'label-5', 'I have legal rights to represent this property') }}</option>
            <option value="3" {{ $property->belong_to == '3' ? 'selected' : '' }}>{{ getLocale($locale_form7, 'label-6', 'I have rights to sublease bedrooms inside this property') }}</option>
        </select>
    </div>
    <div class="mb-5">
        <h4 class="mb-4 required">{{ getLocale($locale_form7, 'label-15', 'How will this property be leased?') }}</h4>
        <select class="select2 select2-list-property" name="ownership_status" id="ownership-status">
            <option value=""></option>
            <option value="1" {{ $property->ownership_status == '1' ? 'selected' : '' }}>{{ getLocale($locale_form7, 'label-16', 'Leased under private ownership') }}</option>
            <option value="2" {{ $property->ownership_status == '2' ? 'selected' : '' }}>{{ getLocale($locale_form7, 'label-17', 'Leased under enterprise ownership') }}</option>
        </select>
    </div>
    <div class="card card-body mb-4 form-dz property-right-wrapper" id="property-legal-certificate-ownership" style="display: none;" >
        <div class="">
            <div class="row">
                <div class="col-md-8">
                    <h5 class="required" id="property-legal-certificate-status">
                        {{ getLocale($locale_form7, 'label-18', 'Property ownership certificate') }}
                    </h5>
                </div>
                <div class="col-md-4 d-flex justify-content-end">
                    <a class="btn btn-link btn-add-photos mr-4" data-toggle="collapse" href="#photo-type-ownership-certificate" role="button" aria-expanded="false">
                        + {{ getLocale($locale_form7, 'label-8', 'Add File') }}
                    </a>
                </div>
            </div>
            <div class="collapse" id="photo-type-ownership-certificate">
                <div class="upload-image-video my-drop input-pdf-dz" id="upload-media-ownership-certificate" data-id="ownership-certificate">
                    <div class="preview-images" id="preview-image-ownership-certificate">
                        <div class="dropzone-wrap dropzone-area dropzone-button" id="dropzone-button-ownership-certificate"><i class="fas fa-camera"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="hide" id="mydz-pdf-template" style="display: none">
            <div class="dz-preview dz-file-preview">
                <div class="dz-details">
                    <img src="/img/pdf-icon.png" />
                </div>
                <div class="dz-progress">
                    <div class="progress">
                        <div class="dz-upload progress-bar progress-bar-striped progress-bar-animated bg-success" data-dz-uploadprogress role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="dz-error-message"><span data-dz-errormessage></span></div>
                <a href="#" class="dz-remove"></a>
            </div>
        </div>
    </div>
    <div class="card card-body mb-4 form-dz property-right-wrapper" id="property-legal-certificate-wrapper" style="display: none;" >
        <div class="">
            <div class="row">
                <div class="col-md-8">
                    <h5 class="required" id="property-legal-certificate-status">
                        {{ getLocale($locale_form7, 'label-7', 'Provide a document naming you as the rightful appointee to legally market this property') }}
                    </h5>
                </div>
                <div class="col-md-4 d-flex justify-content-end">
                    <a class="btn btn-link btn-add-photos mr-4" data-toggle="collapse" href="#photo-type-legal-certificate" role="button" aria-expanded="false">
                        + {{ getLocale($locale_form7, 'label-8', 'Add File') }}
                    </a>
                </div>
            </div>
            <div class="collapse" id="photo-type-legal-certificate">
                <div class="upload-image-video my-drop input-pdf-dz" id="upload-media-legal-certificate" data-id="legal-certificate">
                    <div class="preview-images" id="preview-image-legal-certificate">
                        <div class="dropzone-wrap dropzone-area dropzone-button" id="dropzone-button-legal-certificate"><i class="fas fa-camera"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="hide" id="mydz-pdf-template" style="display: none">
            <div class="dz-preview dz-file-preview">
                <div class="dz-details">
                    <img src="/img/pdf-icon.png" />
                </div>
                <div class="dz-progress">
                    <div class="progress">
                        <div class="dz-upload progress-bar progress-bar-striped progress-bar-animated bg-success" data-dz-uploadprogress role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="dz-error-message"><span data-dz-errormessage></span></div>
                <a href="#" class="dz-remove"></a>
            </div>
        </div>
    </div>
    <div class="card card-body mb-4 form-dz property-right-wrapper" id="property-legal-certificate-authority" style="display: none;" >
        <div class="">
            <div class="row">
                <div class="col-md-8">
                    <h5 class="required" id="property-legal-certificate-status">
                        {{ getLocale($locale_form7, 'label-19', 'Property ownership certificate') }}
                    </h5>
                </div>
                <div class="col-md-4 d-flex justify-content-end">
                    <a class="btn btn-link btn-add-photos mr-4" data-toggle="collapse" href="#photo-type-authority-certificate" role="button" aria-expanded="false">
                        + {{ getLocale($locale_form7, 'label-8', 'Add File') }}
                    </a>
                </div>
            </div>
            <div class="collapse" id="photo-type-authority-certificate">
                <div class="upload-image-video my-drop input-pdf-dz" id="upload-media-authority-certificate" data-id="authority-certificate">
                    <div class="preview-images" id="preview-image-authority-certificate">
                        <div class="dropzone-wrap dropzone-area dropzone-button" id="dropzone-button-authority-certificate"><i class="fas fa-camera"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="hide" id="mydz-pdf-template" style="display: none">
            <div class="dz-preview dz-file-preview">
                <div class="dz-details">
                    <img src="/img/pdf-icon.png" />
                </div>
                <div class="dz-progress">
                    <div class="progress">
                        <div class="dz-upload progress-bar progress-bar-striped progress-bar-animated bg-success" data-dz-uploadprogress role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="dz-error-message"><span data-dz-errormessage></span></div>
                <a href="#" class="dz-remove"></a>
            </div>
        </div>
    </div>
    <div class="card card-body mb-5" id="property-insured-wrapper">
        <div class="row">
            <div class="col-md-6 d-flex justify-content-between">
                <h5>
                    {{ getLocale($locale_form7, 'label-9', 'Is the property insured?') }}
                </h5>
                <div class="custom-control custom-switch">
                    <input value="0" type="checkbox" class="custom-control-input" name="insurance_status" id="property-insured-switch" {{ $property->is_insured == '0' ? '' : 'checked' }}>
                    <label class="custom-control-label" for="property-insured-switch">
                        <span></span>
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="card card-body mb-4 form-dz property-right-wrapper" id="property-insurance-document-wrapper" style="display: none;">
        <div class="row">
            <div class="col-md-8">
                <h5 class="required" id="property-legal-status">
                    {{ getLocale($locale_form7, 'label-10', 'Property Insurance Document') }}
                </h5>
            </div>
            <div class="col-md-4 d-flex justify-content-end">
                <a class="btn btn-link btn-add-photos mr-4" data-toggle="collapse" href="#photo-type-legal" role="button" aria-expanded="false">
                    + {{ getLocale($locale_form7, 'label-8', 'Add File') }}
                </a>
            </div>
        </div>
        <div class="collapse" id="photo-type-legal">
            <div class="upload-image-video my-drop input-pdf-dz" id="upload-media-insurance-document" data-id="insurance-document">
                <div class="preview-images" id="preview-image-insurance-document">
                    <div class="dropzone-wrap dropzone-area dropzone-button" id="dropzone-button-insurance-document"><i class="fas fa-camera"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="hide" id="mydz-pdf-template" style="display: none">
        <div class="dz-preview dz-file-preview">
            <div class="dz-details">
                <img src="/img/pdf-icon.png" />
            </div>
            <div class="dz-progress">
                <div class="progress">
                    <div class="dz-upload progress-bar progress-bar-striped progress-bar-animated bg-success" data-dz-uploadprogress role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            <div class="dz-error-message"><span data-dz-errormessage></span></div>
            <a href="#" class="dz-remove"></a>
        </div>
    </div>
    <p class="text-muted mb-5">
        {{ getLocale($locale_form7, 'label-11', "We strongly suggest that you insure the property in order to avoid unexpected events (i.e damages, accidents, theft) hindering you from marketing or leasing the property effectively.") }}
        <a data-toggle="collapse" href="#insurance-detail" >{{ getLocale($locale_form7, 'label-14', 'Insure my property now') }}.</a>
    </p>
    <div class="row">
        <div class="col-md-8">
            <div class="card card-body mb-5 collapse {{ $property->estimated_price>0 ? 'show' : '' }}" id="insurance-detail">
                <p>{{ getLocale($locale_form7, 'label-12', 'In order to process the insurance quotation for your property, please provide us the following detail?') }}</p>
                <div class="form-group d-flex justify-content-start align-items-center">
                    <label class="mb-0" for="estimated-property-type">{{ getLocale($locale_form7, 'label-13', 'IDR') }}</label>
                    <div class="col">
                        <input type="number" value="{{ $property->estimated_price }}" name="estimated_price" class="form-control required form-control-dashboard" id="estimated-property-type" placeholder="{{ getLocale($locale_form7, 'label-idr', 'Input your estimated property price') }}">
                        <span class="input-required"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="id" value="{{ $property->id }}" id="property-id"/>
    <input value="7" type="hidden" name="step" id="step">
</form>
{{-- MODAL DELETE CATEGORY CONFIRMATION --}}
{{-- modalConfirmationCategory --}}
<div class="modal fade modal-dashboard" id="modalStep7Incomplete" tabindex="-1" role="dialog">
    <input type="hidden" name="category-id" id="category-id" value="">
    <div class="modal-dialog from-right" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
                <p class="font-weight-bolder">{{ session('locale')=='id' ? 'Anda boleh melewatkan tahap ini sekarang. Namun, Anda harus mengunggah dokumen di atas saat penandatanganan kontrak dengan penyewa.' : 'You may skip this step for now. However, you will need to upload these documents when signing the lease contract with the renter.' }}</p>
                <div class="button-group">
                    <a class="btn btn-primary" data-dismiss="modal" href="{{url('')}}">{{ session('locale')=='id' ? 'Unggah Sekarang' : 'Upload Now' }}</a>
                    <a class="btn btn-primary btn-delete-category-step7-yes" data-dismiss="modal" href="#">{{ session('locale')=='id' ? 'Unggah Nanti' : 'Upload Later' }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('next_step')
<a id="link-previous" href="/create-property/{{ $property->id }}/6" class="btn btn-link btn-prev-list-property d-flex align-items-center">
    <i class="fas fa-long-arrow-alt-left mr-2"></i>
    {{ getLocale($locale_form7, 'label-previous', 'Previous') }}
</a>
<a href="" id ="submit-list-property-step-7" class="btn btn-primary btn-next-list-property">
    {{ getLocale($locale_form7, 'label-next', 'Next') }}
    <i class="fas fa-long-arrow-alt-right ml-2"></i>
</a>
@endsection
