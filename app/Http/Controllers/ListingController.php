<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Locale;

class ListingController extends Controller
{
    public function __construct(Locale $locale) {
        $this->locale = $locale;
    }

    function detail(Request $request, $id) {
        return view('detail', compact('locale_detail'));
    }
}
