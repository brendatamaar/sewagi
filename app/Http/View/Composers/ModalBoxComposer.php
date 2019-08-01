<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Models\Country;
use App\Models\WorkingField;
use App\Models\Locale;

class ModalBoxComposer
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $country;

    public function __construct(Country $country, WorkingField $workingField, Locale $locale)
    {
        $this->country = $country;
        $this->workingField = $workingField;
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
        $view->with('countries', $this->country->getAll());
        $view->with('workingFields', $this->workingField->getAll());
        $view->with('locale_modalbox', $this->locale->getLocaleByPage('_partials/modalbox'));
    }
}

