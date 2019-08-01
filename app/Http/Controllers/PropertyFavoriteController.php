<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PropertyFavorite;

class PropertyFavoriteController extends Controller
{
    public function __construct(PropertyFavorite $propertyFavorite)
    {
        $this->propertyFavorite = $propertyFavorite;
    }

    public function store(Request $request)
    {
        $this->propertyFavorite->create(['user_id' => auth()->user()->id, 'property_id' => $request->property_id]);
        return response()->json([
            'status' => true
        ]);
    }

    public function destroy($pid)
    {
        $this->propertyFavorite->deleteByPropertyId($pid);
        return response()->json([
            'status' => true
        ]);
    }
}
