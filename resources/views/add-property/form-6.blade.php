@extends('_partials.master_solid_nosearch')
@section('content')
<div id="newPropertyData6">
    @csrf
    <div class="mb-5">
        <h4 class="mb-4 required">{{ getLocale($locale_form6, 'label-1', 'How about uploading some photos?') }}</h4>
        <p class="text-muted fs-12">{{ getLocale($locale_form6, 'label-2', 'Upload up to 6 photos per category') }}</p>
    </div>
    @foreach ($photos as $photo)
    <div class="card card-body mb-4 form-dz">
        <div class="row">
            <div class="col-md-6">
                <h5 class="required">
                    {{ session('locale') == 'id' ? $photo->photable->id_name : $photo->photable->name }}
                </h5>
            </div>
            <div class="col-md-6 d-flex justify-content-end">
                <a class="btn btn-link btn-add-photos mr-4" data-toggle="collapse" href="#photo-type-{{ $photo->id }}" role="button" aria-expanded="false">
                    + {{ getLocale($locale_form6, 'label-9', 'Add Photos') }}
                </a>
                <div class="custom-control custom-switch custom-switch-thumbnails">
                    <input {{ $photo->is_thumbnail=='1' ? 'checked' : '' }} data-id="{{ $photo->id }}" type="checkbox" class="custom-control-input building-exterior-switch" id="building-exterior-switch{{ $photo->id }}">
                    <label class="custom-control-label" for="building-exterior-switch{{ $photo->id }}">
                        <span class="{{ $photo->is_thumbnail=='1' ? 'active' : '' }}">
                            {{ getLocale($locale_form6, 'label-11', 'Thumbnail & Highlights') }}
                        </span>
                    </label>
                </div>
                @if ($photo->photable_type == 'App\Models\AdditionalPhotoType')
                    <button class="btn btn-link ml-2 mb-2 trigger-modal-reset delete-category-step-6" data-id="{{ $photo->id }}" data-toggle="modal" data-target="#modalConfirmationCategory">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                @endif
            </div>
        </div>
        <div class="collapse" id="photo-type-{{ $photo->id }}">
            <form method="post" action="{{ url('/add-property/6') }}"  enctype="multipart/form-data">
                @csrf
                <div class="photo-indicator">
                    <p class="mb-1">{{ getLocale($locale_form6, 'label-15', 'Photos Uploaded') }}</p>
                    <ul class="list-inline mb-2">
                        <li class="list-inline-item"></li>
                        <li class="list-inline-item"></li>
                        <li class="list-inline-item"></li>
                        <li class="list-inline-item"></li>
                        <li class="list-inline-item"></li>
                        <li class="list-inline-item"></li>
                    </ul>
                </div>
                <div class="upload-image-video my-drop input-dz" id="upload-media-{{ $photo->id }}" data-id="{{ $photo->id }}">
                    <div class="preview-images" id="preview-image-{{ $photo->id }}">
                        <div class="dropzone-wrap dropzone-area dropzone-button" id="dropzone-button-{{ $photo->id }}"><i class="fas fa-camera"></i></div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endforeach
    {{-- <div class="card card-body mb-4 form-dz">
        <div class="row">
            <div class="col-md-6">
                <h5 class="required">
                    {{ getLocale($locale_form6, 'label-7', 'PDF File') }}
                </h5>
            </div>
            <div class="col-md-6 d-flex justify-content-end">
                <a class="btn btn-link btn-add-photos mr-4" data-toggle="collapse" href="#photo-type-legal" role="button" aria-expanded="false">
                    + {{ getLocale($locale_form6, 'label-10', 'Add File') }}
                </a>
            </div>
        </div>
        <div class="collapse" id="photo-type-legal">
            <form method="post" action="{{ url('/add-property/6') }}"  enctype="multipart/form-data">
                @csrf
                <div class="upload-image-video my-drop input-pdf-dz" id="upload-media-legal" data-id="legal">
                    <div class="preview-images" id="preview-image-legal">
                        <div class="dropzone-wrap dropzone-area dropzone-button" id="dropzone-button-legal"><i class="fas fa-camera"></i></div>
                    </div>
                </div>
            </form>
        </div>
    </div> --}}
    <div class="hide" id="mydz-template" style="display: none">
        <div class="dz-preview dz-file-preview">
            <div class="dz-details">
                <img data-dz-thumbnail />
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
    <div id="category-photo-wrapper">
        <div class="card card-body mb-4 template-category-photo">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="required">
                        {{ getLocale($locale_form6, 'label-16', 'Template') }}
                    </h5>
                </div>
                <div class="col-md-6 d-flex justify-content-end">
                    <a class="btn btn-link btn-add-photos mr-4" data-toggle="collapse" href="#template" role="button" aria-expanded="false">
                        + {{ getLocale($locale_form6, 'label-9', 'Add Photos') }}
                    </a>
                    <div class="custom-control custom-switch custom-switch-thumbnails">
                        <input type="checkbox" class="custom-control-input" id="template-switch">
                        <label class="custom-control-label" for="template-switch">
                            <span>
                                {{ getLocale($locale_form6, 'label-11', 'Thumbnail & Highlights') }}
                            </span>
                        </label>
                    </div>
                    <button class="btn btn-link ml-2 mb-2 trigger-modal-reset delete-category-step-6" data-id="" data-toggle="modal" data-target="#modalConfirmationCategory">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </div>
            </div>
            <div class="collapse" id="template">
                <form method="post" action="{{ url('/add-property/6') }}" enctype="multipart/form-data" class="dropzone" id="my-awesome-dropzone">
                </form>
                <div class="photo-indicator">
                    <p class="mb-1">{{ getLocale($locale_form6, 'label-15', 'Photos Uploaded') }}</p>
                    <ul class="list-inline mb-2">
                        <li class="list-inline-item"></li>
                        <li class="list-inline-item"></li>
                        <li class="list-inline-item"></li>
                        <li class="list-inline-item"></li>
                        <li class="list-inline-item"></li>
                        <li class="list-inline-item"></li>
                    </ul>
                </div>
            </div>
        </div>
        <template id="template-category-new-photo">
            <div class="card card-body mb-4"  >
            <div class="row">
                <div class="col-md-6">
                    <h5 class="required">
                        {{ getLocale($locale_form6, 'label-16', 'Template') }}
                    </h5>
                </div>
                <div class="col-md-6 d-flex justify-content-end">
                    <a class="btn btn-link btn-add-photos mr-4" data-toggle="collapse" href="#template" role="button" aria-expanded="false">
                        + {{ getLocale($locale_form6, 'label-9', 'Add Photos') }}
                    </a>
                    <div class="custom-control custom-switch custom-switch-thumbnails">
                        <input type="checkbox" class="custom-control-input" id="template-switch">
                        <label class="custom-control-label" for="template-switch">
                            <span>
                                {{ getLocale($locale_form6, 'label-11', 'Thumbnail & Highlights') }}
                            </span>
                        </label>
                    </div>
                    <button class="btn btn-link ml-2 mb-2 trigger-modal-reset delete-category-step-6" data-id="" data-toggle="modal" data-target="#modalConfirmationCategory">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </div>
            </div>
            <div class="collapse" id="template">
                <form method="post" action="{{ url('/add-property/6') }}"  enctype="multipart/form-data">
                    <div class="photo-indicator">
                        <p class="mb-1">{{ getLocale($locale_form6, 'label-15', 'Photos Uploaded') }}</p>
                        <ul class="list-inline mb-2">
                            <li class="list-inline-item"></li>
                            <li class="list-inline-item"></li>
                            <li class="list-inline-item"></li>
                            <li class="list-inline-item"></li>
                            <li class="list-inline-item"></li>
                            <li class="list-inline-item"></li>
                        </ul>
                    </div>
                    <div class="upload-image-video my-drop input-new-dz" id="upload-media-" data-id="">
                        <div class="preview-images" id="preview-image-">
                            <div class="dropzone-wrap dropzone-area dropzone-button" id="dropzone-button-"><i class="fas fa-camera"></i></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        </template>
    </div>

    <div class="card card-body mb-4 category-select" style="display: none">
        <label for="">{{ getLocale($locale_form6, 'label-12', 'CATEGORY') }}</label>
        <select class="select2 select2-list-property" name="" id="add-category-photos">
            <option value=""></option>
            @foreach ($additionalPhotoTypeMaster as $key => $value)
                <option value="{{ $value->id }}">{{ session('locale') =='id' ? $value->id_name : $value->name }}</option>
            @endforeach
        </select>
    </div>
    <button class="btn btn-outline-primary mb-4" id="add-more-category">
        {{ getLocale($locale_form6, 'label-8', 'ADD MORE CATEGORY') }}
    </button>
</div>
<input type="hidden" name="id" value="{{ $property->id }}" id="property-id"/>
<input type="hidden" name="step" value="{{ $step }}" id="step"/>

{{-- MODAL DELETE CATEGORY CONFIRMATION --}}
<div class="modal fade modal-dashboard" id="modalConfirmationCategory" tabindex="-1" role="dialog">
    <input type="hidden" name="category-id" id="category-id" value="">
    <div class="modal-dialog from-right" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
                <p class="font-weight-bolder">{{ session('locale')=='id' ? 'Apakah Anda yakin untuk menghapus kategori ini?' : 'Are you sure you want to delete this category?' }}</p>
                <div class="button-group">
                    <a class="btn btn-primary btn-delete-category-step6-yes" data-dismiss="modal" href="{{url('')}}">{{ session('locale')=='id' ? 'Ya' : 'Yes' }}</a>
                    <a class="btn btn-primary" data-dismiss="modal" href="#">{{ session('locale')=='id' ? 'Tidak' : 'No' }}</a>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- MODAL LIMIT UPLOAD EXCEEDED --}}
<div class="modal fade" id="modal-upload-limit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content text-center pt-4" data-background-color="aqua">
            <div class="modal-body text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
                <p class="font-weight-bolder">{{ session('locale')=='id' ? 'Anda hanya dapat mengunggah maksimal 6 foto per kategori.' : 'You may only upload or drop 6 photos per category.' }}</p>
            </div>
            <div class="modal-footer pl-5 pr-5">
                <button type="button" data-dismiss="modal" class="btn btn-primary btn-block">{{ session('locale')=='id' ? 'Mengerti' : 'Got It' }}</button>
            </div>
        </div>
    </div>
</div>

@endsection
@section('next_step')
<a id="link-previous" href="/create-property/{{ $property->id }}/5" class="btn btn-link btn-prev-list-property d-flex align-items-center">
    <i class="fas fa-long-arrow-alt-left mr-2"></i>
    {{ getLocale($locale_form6, 'label-previous', 'Previous') }}
</a>
<a href="/create-property/{{ $property->id }}/7" class="btn btn-primary btn-next-list-property">
    {{ getLocale($locale_form6, 'label-next', 'Next') }}
    <i class="fas fa-long-arrow-alt-right ml-2"></i>
</a>
@endsection
