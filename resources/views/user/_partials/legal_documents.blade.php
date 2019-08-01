<div class="row mb-5">
    <div class="col-md-8">
        <h3 btn-input class="py-4">{{ getLocale($locale_user_profile, 'label-legal-doc-1', "Legal documents") }}</h3>
        <p>{{ getLocale($locale_user_profile, 'label-legal-doc-2', "To process due diligence, tax status, compatible invoicing or us btn-inputing other value added services /
            partnership we need you to provide btn-inputus with the following legal documents") }}.</p>
        <p{{ getLocale($locale_user_profile, 'label-legal-doc-3', ">Any related documents you provide us with are classified and protected. We won’t be communicating them to any
            third party without your consent") }}.</p>
        <hr class="my-5">
        @if (auth()->user()->company_id)
        <div class="form-group mb-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <label class="text-muted">{{ getLocale($locale_user_profile, 'label-legal-doc-4', "INCORPORATION CERTIFICATE") }}</label>
                <a class="btn btn-link btn-input" href="#">
                    + {{ session('locale') =='id' ? 'Tambahkan dokumen' : 'Add document' }} <input type="file" class="custom-file-input" data-name="certificate">
                </a>
                <div id="docs-certificate"></div>
            </div>
        </div>
        <hr class="my-5">
        <div class="form-group mb-5">
            <div class="d-flex justify-content-between align-items-center mb-4a">
                <label class="text-muted">NIB</label>
                <a class="btn btn-link btn-input" href="#">
                    + {{ session('locale') =='id' ? 'Tambahkan dokumen' : 'Add document' }} <input type="file" class="custom-file-input" data-name="nib">
                </a>
                <div id="docs-nib"></div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <input type="text" data-type="legal" name="nib" class="form-control form-control-dashboard bg-white"
                        placeholder="{{ getLocale($locale_user_profile, 'label-legal-doc-5', "INCORPORATION CERTIFICATE") }}">
                </div>
            </div>
        </div>
        <hr class="my-5">
        <div class="form-group mb-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <label class="text-muted">{{ getLocale($locale_user_profile, 'label-legal-doc-6', "COMPANY NPWP") }}</label>
                <a class="btn btn-link btn-input" href="#">
                    + {{ session('locale') =='id' ? 'Tambahkan dokumen' : 'Add document' }} <input type="file" class="custom-file-input" data-name="company_npwp">
                </a>
                <div id="docs-company_npwp"></div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <input type="text" data-type="legal" name="company_npwp"
                        class="form-control form-control-dashboard bg-white" placeholder="{{ getLocale($locale_user_profile, 'label-legal-doc-7', "Enter Company NPWP number") }}">
                </div>
            </div>
        </div>
        <hr class="my-5">
        <div class="form-group mb-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <label class="text-muted">{{ getLocale($locale_user_profile, 'label-legal-doc-8', "FOUNDER NPWP") }}</label>
                <a class="btn btn-link btn-input" href="#">
                    + {{ session('locale') =='id' ? 'Tambahkan dokumen' : 'Add document' }} <input type="file" class="custom-file-input" data-name="founder_npwp">
                </a>
                <div id="docs-founder_npwp"></div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <input type="text" data-type="legal" name="founder_npwp"
                        class="form-control form-control-dashboard bg-white" placeholder="{{ getLocale($locale_user_profile, 'label-legal-doc-9', "Enter Founder NPWP number") }}">
                </div>
            </div>
        </div>
        <hr class="my-5">
        <div class="form-group mb-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <label class="text-muted">PKP</label>
                <a class="btn btn-link btn-input" href="#">
                    + {{ session('locale') =='id' ? 'Tambahkan dokumen' : 'Add document' }} <input type="file" class="custom-file-input" data-name="pkp">
                </a>
                <div id="docs-pkp"></div>
            </div>
        </div>
        <hr class="my-5">
        @else
        <div class="form-group mb-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <label class="text-muted">NPWP</label>
                <a class="btn btn-link btn-input" href="#">
                    + {{ session('locale') =='id' ? 'Tambahkan dokumen' : 'Add document' }} <input type="file" class="custom-file-input" data-name="personal_npwp">
                </a>
                <div id="docs-personal_npwp"></div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <input type="text" data-type="legal" name="personal_npwp"
                        class="form-control form-control-dashboard bg-white" placeholder="{{ getLocale($locale_user_profile, 'label-legal-doc-10', "Enter NPWP number") }}">
                </div>
            </div>
        </div>
        <hr class="my-5">
        <div class="form-group mb-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <label class="text-muted">{{ getLocale($locale_user_profile, 'label-legal-doc-11', "STAY PERMIT (FOR FOREIGNER ONLY)") }} </label>
                <a class="btn btn-link btn-input" href="#">
                    + {{ session('locale') =='id' ? 'Tambahkan dokumen' : 'Add document' }} <input type="file" class="custom-file-input" data-name="stay_permit">
                </a>
                <div id="docs-stay_permit"></div>
            </div>
        </div>
        <hr class="my-5">
        <div class="form-group mb-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <label class="text-muted">{{ getLocale($locale_user_profile, 'label-legal-doc-12', "KARTU KELUARGA FOR WNI") }}</label>
                <a class="btn btn-link btn-input" href="#">
                    + {{ session('locale') =='id' ? 'Tambahkan dokumen' : 'Add document' }} <input type="file" class="custom-file-input" data-name="kartu_keluarga">
                </a>
                <div id="docs-kartu_keluarga"></div>
            </div>
        </div>
        <hr class="my-5">
        @endif
    </div>
</div>

<div class="row mb-5">
    <div class="col-md-8">
        <h3 class="py-4">{{ getLocale($locale_user_profile, 'label-legal-doc-13', "Financial") }}</h3>
        <p>{{ getLocale($locale_user_profile, 'label-legal-doc-14', "In order to process your deposit return and / or other reimbursements, please provide your bank account details") }}.</p>
        <hr class="my-5">
        <div class="form-group mb-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <label class="text-muted">{{ getLocale($locale_user_profile, 'label-legal-doc-15', "FOREIGN BANK ACCOUNT") }}</label>
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="foreign-switch">
                    <label class="custom-control-label" for="foreign-switch"></label>
                </div>
            </div>
        </div>
        <hr class="my-5">
        <div id="localBank">
            <div class="form-group mb-5">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <label class="text-muted">{{ getLocale($locale_user_profile, 'label-legal-doc-16', "ACCOUNT HOLDER NAME") }}</label>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <input type="text" data-type="local" name="bank_account_holder"
                            class="form-control form-control-dashboard bg-white"
                            placeholder="{{ getLocale($locale_user_profile, 'label-legal-doc-17', "Enter account holder name") }}">
                    </div>
                </div>
            </div>
            <hr class="my-5">
            <div class="form-group mb-5">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <label class="text-muted">{{ getLocale($locale_user_profile, 'label-legal-doc-18', "BANKING ESTABLISHMENT") }}</label>
                </div>
                <select class="select2 select2-list-property" data-type="local" name="bank_name" id="legalBank">
                    <option value=""></option>
                    @foreach($banks as $bank)
                    <option value="{{$bank->name}}">{{$bank->name}}</option>
                    @endforeach
                </select>
            </div>
            <hr class="my-5">
            <div class="form-group mb-5">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <label class="text-muted">{{ getLocale($locale_user_profile, 'label-legal-doc-19', "BANK ACCOUNT NUMBER") }}</label>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <input type="text" data-type="local" name="bank_account_number"
                            class="form-control form-control-dashboard bg-white"
                            placeholder="{{ getLocale($locale_user_profile, 'label-legal-doc-20', "Enter bank account number") }}">
                    </div>
                </div>
            </div>
            <hr class="my-5">
        </div>
        <div id="foreignBank">
            <div class="form-group mb-5">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <label class="text-muted">{{ getLocale($locale_user_profile, 'label-legal-doc-16', "ACCOUNT HOLDER NAME") }}</label>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <input type="text" data-type="foreign" name="bank_account_holder"
                            class="form-control form-control-dashboard bg-white"
                            placeholder="{{ getLocale($locale_user_profile, 'label-legal-doc-17', "Enter account holder name") }}">
                    </div>
                </div>
            </div>
            <hr class="my-5">
            <div class="form-group mb-5">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <label class="text-muted">{{ getLocale($locale_user_profile, 'label-legal-doc-23', "CURRENCY") }}</label>
                </div>
                <select class="select2 select2-list-property" id="legalCurrency" data-type="foreign" name="currency">
                    <option value=""></option>
                    @foreach($currencies as $currency)
                    <option value="{{$currency->symbol}}">({{$currency->symbol}}) {{$currency->name}}</option>
                    @endforeach
                </select>
            </div>
            <hr class="my-5">
            <div class="form-group mb-5">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <label class="text-muted">{{ getLocale($locale_user_profile, 'label-legal-doc-24', "BANK COUNTRY") }}</label>
                </div>
                <select class="select2 select2-list-property" id="legalCountry" data-type="foreign" name="country">
                    <option value=""></option>
                    @foreach($countries as $country)
                    <option value="{{$country->name}}">{{$country->name}}</option>
                    @endforeach
                </select>
            </div>
            <hr class="my-5">
            <div class="form-group mb-5">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <label class="text-muted">{{ getLocale($locale_user_profile, 'label-legal-doc-25', "BANK CITY") }}</label>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <input type="text" data-type="foreign" name="city"
                            class="form-control form-control-dashboard bg-white" placeholder="{{ getLocale($locale_user_profile, 'label-legal-doc-26', "Enter bank city") }}">
                    </div>
                </div>
            </div>
            <hr class="my-5">
            <div class="form-group mb-5">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <label class="text-muted">IBAN (International Bank Account Number)</label>
                </div>
                <p>{{ getLocale($locale_user_profile, 'label-legal-doc-27', "Max 35 digit IBAN, example") }}: CH1122222999991234567890 (Switzerland IBAN)</p>
                <div class="row">
                    <div class="col-md-8">
                        <input type="text" data-type="foreign" name="iban"
                            class="form-control form-control-dashboard bg-white" placeholder="{{ getLocale($locale_user_profile, 'label-legal-doc-28', "Enter IBAN") }}">
                    </div>
                </div>
            </div>
            <hr class="my-5">
            <div class="form-group mb-5">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <label class="text-muted">{{ getLocale($locale_user_profile, 'label-legal-doc-29', "BENEFICIARY NAME") }}</label>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <input type="text" data-type="foreign" name="beneficiary_name"
                            class="form-control form-control-dashboard bg-white" placeholder="{{ getLocale($locale_user_profile, 'label-legal-doc-30', "Enter beneficiary name") }}">
                    </div>
                </div>
            </div>
            <hr class="my-5">
            <div class="form-group mb-5">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <label class="text-muted">{{ getLocale($locale_user_profile, 'label-legal-doc-31', "BANK SWIFT CODE") }}</label>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <input type="text" data-type="foreign" name="swift_code"
                            class="form-control form-control-dashboard bg-white" placeholder="{{ getLocale($locale_user_profile, 'label-legal-doc-32', "Enter bank SWIFT code") }}">
                    </div>
                </div>
            </div>
            <hr class="my-5">
            <div class="form-group mb-5">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <label class="text-muted">{{ getLocale($locale_user_profile, 'label-legal-doc-33', "BANK NAME") }}</label>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <input type="text" data-type="foreign" name="bank_name"
                            class="form-control form-control-dashboard bg-white" placeholder="{{ getLocale($locale_user_profile, 'label-legal-doc-34', "Enter bank name") }}">
                    </div>
                </div>
            </div>
            <hr class="my-5">
        </div>
    </div>
</div>

@if (auth()->user()->company_id)
<div class="row mb-5">
    <div class="col-md-8">
        <h3 class="py-4">{{ getLocale($locale_user_profile, 'label-legal-doc-35', "Company details") }}</h3>
        <p>{{ getLocale($locale_user_profile, 'label-legal-doc-36', "In order to better process contracts and facilitate communications, please provide your company details") }}.</p>
        <hr class="my-5">
        <div class="form-group mb-5">
            <div class="row">
                <div class="col-md-8">
                    <input type="text" data-type="company" name="name"
                        class="form-control form-control-dashboard bg-white" placeholder="{{ getLocale($locale_user_profile, 'label-legal-doc-37', "Company name") }}">
                </div>
            </div>
        </div>
        <div class="form-group mb-5">
            <div class="row">
                <div class="col-md-8">
                    <input type="text" data-type="company" name="street"
                        class="form-control form-control-dashboard bg-white" id="companyLocation"
                        placeholder="{{ getLocale($locale_user_profile, 'label-legal-doc-38', "Enter the street address") }}">
                </div>
            </div>
        </div>
        <div class="form-group mb-5">
            <div class="row">
                <div class="col-md-6">
                    <input type="text" data-type="company" name="street_no"
                        class="form-control form-control-dashboard bg-white"
                        placeholder="{{ getLocale($locale_user_profile, 'label-legal-doc-39', "Enter address number") }} (e.g. 7, A5)">
                </div>
                <div class="col-md-6">
                    <input type="text" data-type="company" name="detail"
                        class="form-control form-control-dashboard bg-white"
                        placeholder="{{ getLocale($locale_user_profile, 'label-legal-doc-40', "Enter details (e.g. Block, Building unit)") }}">
                </div>
            </div>
        </div>
        <div class="form-group mb-5">
            <div class="row">
                <div class="col-md-6">
                    <input type="text" data-type="company" name="city"
                        class="form-control form-control-dashboard bg-white" placeholder="{{ getLocale($locale_user_profile, 'label-legal-doc-41', "Enter city") }}">
                </div>
                <div class="col-md-6">
                    <input type="text" data-type="company" name="district"
                        class="form-control form-control-dashboard bg-white" placeholder="{{ getLocale($locale_user_profile, 'label-legal-doc-42', "Enter district") }}">
                </div>
            </div>
        </div>
        <div class="form-group mb-5">
            <div class="row">
                <div class="col-md-8">
                    <input type="text" data-type="company" name="postcode"
                        class="form-control form-control-dashboard bg-white" placeholder="{{ getLocale($locale_user_profile, 'label-legal-doc-43', "Enter post code") }}">
                </div>
            </div>
        </div>
        <hr class="my-5">
        <div class="form-group mb-5">
            <div class="row">
                <div class="col-md-8">
                    <input type="text" data-type="company" name="phone_number"
                        class="form-control form-control-dashboard bg-white" placeholder="Office phone number">
                </div>
            </div>
        </div>
        <div class="form-group mb-5">
            <div class="row">
                <div class="col-md-8">
                    <input type="text" data-type="company" name="website"
                        class="form-control form-control-dashboard bg-white" placeholder="Website">
                </div>
            </div>
        </div>
        <hr class="my-5">
    </div>
</div>
@endif

<template id="uploadedDocs">
    <div class="doc-wrap">
        <button type="button" class="close remove-docs" data-dismiss="modal" aria-label="Close">
            <img src="../img/close-big.png" alt="">
        </button>
        <h4 class="fs-14 mb-0">
            <span class="docs-name">Selfie.jpg</span>&nbsp;
            <label class="text-muted">(<span class="docs-size">25</span>MB)</label>
        </h4>
    </div>
</template>
