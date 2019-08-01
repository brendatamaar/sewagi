@extends('_partials.master_solid')
@section('content')
<section class="grow">
    <div class="container">
        <div class="row pt-5 pb-5">
            <div class="col-sm-6 mt-5 mb-5">
                <h1 class="mb-4 text-color-orange">{{ getLocale($locale_working_company_staff, 'label-jumbotron-1', 'Offer your employees the home away from home feeling.') }}</h1>
                <h3 class="mb-4 text-color-dark">{{ getLocale($locale_working_company_staff, 'label-jumbotron-2', 'Our platform helps your company find the right accommodation for your employees') }}
                    <span class="text-color-orange">{{ getLocale($locale_working_company_staff, 'label-jumbotron-3', 'without sacrificing flexibility or cash flow.') }}</span>
                </h3>
                <div class="row mb-3 mt-5">
                    <div class="col-lg-6 col-md-10"><a href="{{ $caption_action }}" class="btn btn-primary btn-block">{{ getLocale($locale_working_company_staff, 'label-jumbotron-4', 'Register Now') }}</a></div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="benefit">
    <div class="container text-center">
        <div class="row">
            <div class="col-12 mt-5 mb-3">
                <h3 class="mb-1 text-color-dark">{{ getLocale($locale_working_company_staff, 'label-jumbotron2-1', 'Corporate homes for your business needs') }}</h3>
                <p class="mb-4">{{ getLocale($locale_working_company_staff, 'label-jumbotron2-2', 'Costly long term hotel stays, overpriced properties on yearly down payment, frustrating daily commutes due to traffic.') }}
                        <br/>{{ getLocale($locale_working_company_staff, 'label-jumbotron2-3', 'Your company and employees deserve better!') }}
                        <br/>{{ getLocale($locale_working_company_staff, 'label-jumbotron2-4', 'Let us help you find accommodations fitting your needs.') }}
                    </p>
            </div>
        </div>
        <div class="row">
            @component('_partials.card_3')
            @endcomponent
        </div>
        <div class='text-center'>
            <a href="#" class="btn btn-primary">{{ getLocale($locale_working_company_staff, 'label-apply', 'Apply Now') }}</a>
        </div>
    </div>
</section>
<section class="process">
    <div class="container text-center">
        <div class="row">
            <div class="col-12 mt-5 mb-3">
                <h3 class="mb-4 text-color-dark">{{ getLocale($locale_working_company_staff, 'label-jumbotron4-4', 'Our business process features makes your life at work easier') }}</h3>
            </div>
        </div>
        <div class="row">
            @component('_partials.card_4')
            @endcomponent
        </div>
        <div class='text-center'>
            <a href="#" class="btn btn-primary">{{ getLocale($locale_working_company_staff, 'label-jumbotron4-5', 'Book a Demo') }}</a>
        </div>
    </div>
</section>
<section class="quote">
    <div class="container">
        <div class="row">
            <div class="text-center col-12 text-uppercase font-size-14 mb-3 mt-3 text-color-orange font-mono">
            {{ getLocale($locale_working_company_staff, 'label-recommend-1', 'They reccommend us') }}
            </div>
        </div>
        <div class="row">
            <div class="col-sm-10 offset-sm-1 text-center">
                <p class="font-size-20 mb-5">{{ getLocale($locale_working_company_staff, 'label-recommend-2', 'They reccommend us') }}</p>
                <img class="image-quote" src="{{ $reccommend['user']['image'] }}"/>
                <p class="font-size-13 mb-0">{{ $reccommend['user']['name'] }}</p>
                <p>{{ getLocale($locale_working_company_staff, 'label-recommend-3', 'They reccommend us') }}</p>
            </div>
        </div>
    </div>
</section>
<section class="question pt-5 pb-5">
    <div class="container pb-5">
        <div class="row">
            <div class="col-sm-4">
                <h3>{{ getLocale($locale_working_company_staff, 'label-question-1', 'Few questions you might have in mind') }}</h3>
            </div>
            <div class="col-sm-8" id="parent-collapse-question">
                <a href="javascript:void(0);" data-target=".collapse-faq-1" class="collapse-block font-size-20 mb-3" data-toggle="collapse">
                    {{ getLocale($locale_working_company_staff, 'label-question-2', '') }}<span class="collapse-widget"><i class="fas fa-chevron-down"></i></span>
                </a>
                <div class="collapse collapse-faq-1 show" data-parent="#parent-collapse-question">
                    {{ getLocale($locale_working_company_staff, 'label-answer-2', '') }}
                </div>
                <hr class="hr-footer"/>

                <a href="javascript:void(0);" data-target=".collapse-faq-2" class="collapse-block font-size-20 mb-3 collapsed" data-toggle="collapse">
                    {{ getLocale($locale_working_company_staff, 'label-question-3', '') }}<span class="collapse-widget"><i class="fas fa-chevron-down"></i></span>
                </a>
                <div class="collapse collapse-faq-2" data-parent="#parent-collapse-question">
                    {{ getLocale($locale_working_company_staff, 'label-answer-3', '') }}
                </div>
                <hr class="hr-footer"/>

                <a href="javascript:void(0);" data-target=".collapse-faq-3" class="collapse-block font-size-20 mb-3 collapsed" data-toggle="collapse">
                    {{ getLocale($locale_working_company_staff, 'label-question-4', '') }}<span class="collapse-widget"><i class="fas fa-chevron-down"></i></span>
                </a>
                <div class="collapse collapse-faq-3" data-parent="#parent-collapse-question">
                    {{ getLocale($locale_working_company_staff, 'label-answer-4', '') }}
                </div>
                <hr class="hr-footer"/>

            </div>
        </div>
    </div>
</section>
<section class="work position-relative" data-background-color="orange-2">
    <img class="ornament ornament-top-between ornament-right" src="{{ url('img/painting-asset.png') }}" />
    <div class="container">
        <div class="row">
            <div class="text-center col-12 text-uppercase font-size-14 mb-3 mt-3 text-color-orange font-mono">
            {{ getLocale($locale_working_company_staff, 'label-jumbotron4-1', 'RENT EMPLOYEE ACCOMMODATIONS EFFORTLESSLY') }}
            </div>
        </div>
        <div class="row">
            <div class="col-sm-10 offset-sm-1 mb-5 text-center">
                <p class="font-size-20 mb-3">{{ getLocale($locale_working_company_staff, 'label-jumbotron4-2', 'Discover our employee oriented homes') }}</p>
                <a href="#" class="btn btn-primary">{{ getLocale($locale_working_company_staff, 'label-jumbotron4-3', 'Discover') }}</a>
            </div>
        </div>
    </div>
</section>
@endsection
