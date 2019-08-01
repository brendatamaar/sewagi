<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Models\Locale;

class AddPropertyFormsComposer
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    public function __construct(Locale $locale)
    {
        $this->locale = $locale;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('locale_form1', $this->locale->getLocaleByPage('add-property/form-1'));
        $view->with('locale_form2', $this->locale->getLocaleByPage('add-property/form-2'));
        $view->with('locale_form3', $this->locale->getLocaleByPage('add-property/form-3'));
        $view->with('locale_form4', $this->locale->getLocaleByPage('add-property/form-4'));
        $view->with('locale_form5', $this->locale->getLocaleByPage('add-property/form-5'));
        $view->with('locale_form6', $this->locale->getLocaleByPage('add-property/form-6'));
        $view->with('locale_form7', $this->locale->getLocaleByPage('add-property/form-7'));
        $view->with('locale_form8', $this->locale->getLocaleByPage('add-property/form-8'));
        $view->with('locale_form9', $this->locale->getLocaleByPage('add-property/form-9'));
        $view->with('locale_form10', $this->locale->getLocaleByPage('add-property/form-10'));
        $view->with('locale_form_property_create', $this->locale->getLocaleByPage('property/create'));
    }
}
