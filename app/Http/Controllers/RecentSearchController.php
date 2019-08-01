<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RecentSearch;

class RecentSearchController extends Controller
{
    public function __construct(RecentSearch $recentSearch)
    {
        $this->recentSearch = $recentSearch;
    }

    public function findByUserId(Request $request)
    {
        return response()->json(['items' => $this->recentSearch->findByUserId($request->all())]);
    }

    public function store(Request $request)
    {
        $this->recentSearch->saveSearch($request->all());
        return response()->json([
            'status' => true
        ]);
    }
}
