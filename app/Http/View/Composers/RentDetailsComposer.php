<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Models\Locale;

class RentDetailsComposer
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
        $view->with('locale_rent_detail', $this->locale->getLocaleByPage('rent_details'));
    }
}
