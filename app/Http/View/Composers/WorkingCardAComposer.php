<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Models\Locale;

class WorkingCardAComposer
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
        $view->with('locale_working_card3', $this->locale->getLocaleByPage('_partials/card_3'));
    }
}

