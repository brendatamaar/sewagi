<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SearchPreference;

class SearchPreferenceController extends Controller
{
    public function __construct(SearchPreference $searchPreference)
    {
        $this->searchPreference = $searchPreference;
    }

    public function store(Request $request)
    {
        $this->searchPreference->saveData($request->all());
        return response()->json([
            'status' => true
        ]);
    }
}
