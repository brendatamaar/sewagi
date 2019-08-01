<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('_partials.modalbox', 'App\Http\View\Composers\ModalBoxComposer');
        View::composer('_partials.footer', 'App\Http\View\Composers\SiteFooterComposer');
        View::composer('search', 'App\Http\View\Composers\SiteFooterComposer');
        View::composer('working.showing_agent', 'App\Http\View\Composers\WorkingShowingAgentComposer');
        View::composer('_partials.recommend_us', 'App\Http\View\Composers\WorkingRecommendUsComposer');
        View::composer('_partials.question', 'App\Http\View\Composers\WorkingQuestionComposer');
        View::composer('_partials.*', 'App\Http\View\Composers\IndexPageComposer');
        View::composer('homepage.index', 'App\Http\View\Composers\IndexPageComposer');
        View::composer('search', 'App\Http\View\Composers\IndexPageComposer');
        View::composer('search', 'App\Http\View\Composers\SearchPageComposer');
        View::composer('property.index', 'App\Http\View\Composers\PropertyIndexPageComposer');
        View::composer('working.company_staff', 'App\Http\View\Composers\WorkingCompanyStaffComposer');
        View::composer('_partials.card_3', 'App\Http\View\Composers\WorkingCardAComposer');
        View::composer('_partials.card_4', 'App\Http\View\Composers\WorkingCardBComposer');
        View::composer('rent_details', 'App\Http\View\Composers\RentDetailsComposer');
        View::composer('property.detail', 'App\Http\View\Composers\DetailPropertyComposer');
        View::composer('property.detail', 'App\Http\View\Composers\IndexPageComposer');
        View::composer('auth.passwords.reset', 'App\Http\View\Composers\ResetPassComposer');
        View::composer('detail', 'App\Http\View\Composers\DetailComposer');
        View::composer('user._partials.*', 'App\Http\View\Composers\DashboardIndexComposer');
        View::composer('user.*', 'App\Http\View\Composers\DashboardUserProfileComposer');
        View::composer('_partials.master_solid_nosearch', 'App\Http\View\Composers\MasterNoSearchComposer');
        View::composer('_partials.navbar_list_property', 'App\Http\View\Composers\NavbarListPropertyComposer');
        View::composer('_partials.sidebar_list_property', 'App\Http\View\Composers\SidebarListPropertyComposer');
        View::composer('add-property.form*', 'App\Http\View\Composers\AddPropertyFormsComposer');
        View::composer('property.create', 'App\Http\View\Composers\AddPropertyFormsComposer');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
