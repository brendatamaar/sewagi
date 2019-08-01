<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Property;
use App\Notifications\EmailVerification;
use App\Notifications\SmsVerification;
use App\Models\PropertyPhoto;
use App\Models\PhotoType;

class ToolController extends Controller
{
    public function __construct(User $user, Property $property, PropertyPhoto $propertyPhoto, PhotoType $photoType)
    {
        $this->user = $user;
        $this->property = $property;
        $this->propertyPhoto = $propertyPhoto;
        $this->photoType = $photoType;
    }

    public function email(Request $request)
    {
        $email = $request->email;
        $user = $this->user->findByColumn('email', $email);
        $user->notify(new EmailVerification());
        return ['status' => true];
    }

    public function sms(Request $request)
    {
        $email = $request->email;
        $user = $this->user->findByColumn('email', $email);
        $user->notify(new SmsVerification());
        return ['status' => true];
    }

    public function image(Request $request)
    {
        $property = $this->property->find(1);
        $photoType = $this->photoType->find(2);

        $propertyPhoto = $photoType->propertyPhoto($property->id);

        $arrImages = [
            'https://cdn.pixabay.com/photo/2016/11/29/03/53/architecture-1867187_1280.jpg',
            'https://cdn.pixabay.com/photo/2017/07/08/02/16/house-2483336_1280.jpg',
            'https://cdn.pixabay.com/photo/2014/07/10/17/18/large-home-389271_1280.jpg',
            'https://cdn.pixabay.com/photo/2016/06/24/10/47/architecture-1477041_1280.jpg',
            'https://cdn.pixabay.com/photo/2017/06/17/12/59/luxury-home-2412145_1280.jpg',
            'https://cdn.pixabay.com/photo/2016/11/18/17/46/architecture-1836070_1280.jpg',
        ];

        $propertyPhoto->upload($arrImages[rand(0,5)], ['medium', 'thumb']);
        return $propertyPhoto;
    }

    public function property($id)
    {
        $property = $this->property
                        ->with('photos', 'photos.thumb_images')
                        ->find($id);
        return $property;
    }
}
