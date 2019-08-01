@extends('_partials.master_solid')
@section('content')
    <div class="container rent-detail">
        <span class="title">{{ getLocale($locale_rent_detail, 'label-title', 'Rent Details') }}</span>
        <div class="row">
            <div class="col-md-7">
                <div class="row">
                    <div class="col-md-4">
                        <img src="{{ url('images/Group-rent-detail.png') }}" class="img-fluid pt-3 pb-3" alt="">
                    </div>
                    <div class="col-md-8 align-self-center">
                        <h3 class="font-weight-bold font-size-20">Amazing city scape - Cipete Utara</h3>
                        <span class="location">Cipete, Jakarta Selatan</span>
                    </div>
                </div>
                <hr>
                <table class="table table-borderless table-sm">
                    <tr>
                        <td width="150"><span class="title-head text-uppercase">{{ getLocale($locale_rent_detail, 'label-left-1', 'Length of stay') }}</span></td>
                        <td width="50">:</td>
                        <td><span class="content">1 {{ getLocale($locale_rent_detail, 'label-left-11', 'Year') }}</span></td>
                    </tr>
                    <tr>
                        <td><span class="title-head text-uppercase">{{ getLocale($locale_rent_detail, 'label-left-2', 'Payment Option') }}</span></td>
                        <td>:</td>
                        <td><span class="content">1 {{ getLocale($locale_rent_detail, 'label-left-12', 'Year in advance') }}</span></td>
                    </tr>
                    <tr>
                        <td><span class="title-head text-uppercase">{{ getLocale($locale_rent_detail, 'label-left-3', 'Room Type') }}</span></td>
                        <td>:</td>
                        <td><span class="content">{{ getLocale($locale_rent_detail, 'label-left-13', 'Master Bedroom') }}</span></td>
                    </tr>
                </table>
                <hr>
                <table class="table table-borderless table-sm">
                    <tr>
                        <td width="150"><span class="title-head text-uppercase">{{ getLocale($locale_rent_detail, 'label-left-4', 'Number of Guest') }}</span></td>
                        <td width="50">:</td>
                        <td><span class="content">1 {{ getLocale($locale_rent_detail, 'label-left-14', 'Person') }}</span></td>
                    </tr>
                </table>
                <div>
                    <span class="title-head text-uppercase">{{ getLocale($locale_rent_detail, 'label-left-5', 'Move in Date') }}</span>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">A</span>
                        </div>
                        <select class="form-control" name="" id="">
                            <option value=""></option>
                        </select>
                    </div>
                </div>
                <hr>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="insuranceCheck">
                    <label class="form-check-label content" for="insuranceCheck">{{ getLocale($locale_rent_detail, 'label-left-6', 'Insurance') }}</label>
                </div>
                <hr>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="insuranceCheck">
                    <label class="form-check-label content" for="insuranceCheck">12 {{ getLocale($locale_rent_detail, 'label-left-7', 'months installment plan') }}</label>
                </div>
                <hr>
                <div class="form-group">
                    <span class="title-head text-uppercase">{{ getLocale($locale_rent_detail, 'label-left-8', 'Additional Wishlist') }}</span>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="{{ getLocale($locale_rent_detail, 'label-left-9', 'e.g. Due to my dust allergy, please take out the fur carpet in the living room.') }}"></textarea>
                </div>
                <a href="" class="btn btn-primary mb-5">{{ getLocale($locale_rent_detail, 'label-left-10', 'Continue') }}</a>
            </div>
            <div class="col-md-5">
                <div class="price-detail-box">
                    <span class="title-head text-uppercase mb-3">{{ getLocale($locale_rent_detail, 'label-right-1', 'Price Details') }}</span>
                    <table class="table table-borderless table-sm">
                        <tr>
                            <td style="text-align: left"><span class="">1 {{ getLocale($locale_rent_detail, 'label-right-1', 'year in advance') }}</span></td>
                            <td style="text-align: right"><span class="content">{{ getLocale($locale_rent_detail, 'label-right-3', 'IDR') }} 120.000.000</span></td>
                        </tr>
                        <tr>
                            <td colspan="2"><small class="text-color-gray-6">{{ getLocale($locale_rent_detail, 'label-right-3', 'IDR') }} 10.000.000 x 12 {{ getLocale($locale_rent_detail, 'label-right-4', 'months') }}<small></td>
                        </tr>
                        <tr>
                            <td colspan="2"><hr></td>
                        </tr>
                        <tr>
                            <td style="text-align: left"><span class="font-weight-600">{{ getLocale($locale_rent_detail, 'label-right-5', 'Total Price') }}</span></td>
                            <td style="text-align: right"><span class="content">{{ getLocale($locale_rent_detail, 'label-right-3', 'IDR') }} 120.000.000</span></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
