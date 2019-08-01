<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\PropertyDetailView;
use App\Models\ScheduleTour;
use App\Models\ScheduleTourOption;

class DashboardController extends Controller
{
    public function __construct(
        Property $property,
        PropertyDetailView $propertyDetailView,
        ScheduleTour $scheduleTour,
        ScheduleTourOption $scheduleTourOption)
    {
        $this->property = $property;
        $this->propertyDetailView = $propertyDetailView;
        $this->scheduleTour = $scheduleTour;
        $this->scheduleTourOption = $scheduleTourOption;
    }

    public function dashboard(Request $request)
    {
        $user = auth()->user();
        $activity = $this->scheduleTour
            ->with(['options', 'property', 'property.photos.thumb_images', 'user', 'toUser', 'tourStatus', 'bedroom'])
            ->whereUserId($user->id)
            ->orWhere('to_user_id', $user->id)
            ->orderBy('updated_at', 'DESC')
            ->first();
        
        return view('user.dashboard', compact('user', 'activity'));
    }

    public function favourites(Request $request)
    {   
        $user = auth()->user();
        return view('user.favourites', compact('user'));
    }

    public function recentView(Request $request)
    {   
        $user = auth()->user();
        return view('user.recent_view', compact('user'));
    }

    public function getFavouritesProperty(Request $request)
    {
        $limit = $request->limit ?? 2;
        return $this->property->favourites()->take($limit)->get();
    }

    public function getNearmeProperty(Request $request)
    {
        return $this->property->nearby($request->lat, $request->lng);
    }

    public function getPopularProperty()
    {
        return $this->property->popular(3);
    }

    public function getRecentViewProperty(Request $request)
    {
        return $this->propertyDetailView->findWithProperty($request->limit);
    }

    public function getRecentSearchedProperty()
    {
        return $this->property->recentSearch();
    }

    public function getMostSearchedProperty()
    {
        return $this->property->mostSearched(1)[0];
    }

    public function getMostAvailableProperty()
    {
        return $this->property->mostAvailable(1, 2);
    }

    public function updateSchedule(Request $request)
    {
        $this->scheduleTour->find($request->schedule_id)->update(['status' => 1, 'is_reschedule_tour' => 1, 'is_property_available' => null, 'confirmed_tour_id' => null]);
        return $this->scheduleTourOption->updateSchedule($request->all());
    }

    public function replyTour($id, Request $request)
    {
        return $this->scheduleTour->replyTour($id, $request->all());
    }
}
