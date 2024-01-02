<?php

use Illuminate\Database\Seeder;
use App\Models\Property;
use App\Models\PhotoType;

class PropertyPhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $properties = Property::with(['bedroom'])->get();
        
        // $photoType1  = PhotoType::find(1);
        // $photoType2  = PhotoType::find(2);

        // foreach ($properties as $property) {
        //     $propertyPhoto1 = $photoType1->propertyPhoto($property->id);
        //     $propertyPhoto2 = $photoType2->propertyPhoto($property->id);

        //     $arrImages = [
        //         'https://cdn.pixabay.com/photo/2016/11/29/03/53/architecture-1867187_1280.jpg',
        //         'https://cdn.pixabay.com/photo/2017/07/08/02/16/house-2483336_1280.jpg',
        //         'https://cdn.pixabay.com/photo/2014/07/10/17/18/large-home-389271_1280.jpg',
        //         'https://cdn.pixabay.com/photo/2016/06/24/10/47/architecture-1477041_1280.jpg',
        //         'https://cdn.pixabay.com/photo/2017/06/17/12/59/luxury-home-2412145_1280.jpg',
        //         'https://cdn.pixabay.com/photo/2016/11/18/17/46/architecture-1836070_1280.jpg',
        //         'https://cdn.pixabay.com/photo/2014/11/11/22/54/bedroom-527645_1280.jpg',
        //     ];

        //     $arrLivingRooms = [
        //         'https://cdn.pixabay.com/photo/2017/03/28/12/11/chairs-2181960_1280.jpg',
        //         'https://cdn.pixabay.com/photo/2016/11/18/17/20/couch-1835923_1280.jpg',
        //         'https://cdn.pixabay.com/photo/2017/09/09/18/25/living-room-2732939_1280.jpg',
        //         'https://cdn.pixabay.com/photo/2017/08/02/01/01/living-room-2569325_1280.jpg'
        //     ];

        //     $arrMasterBedrooms = [
        //         'https://cdn.pixabay.com/photo/2017/01/28/08/13/master-bedroom-2014865_1280.jpg',
        //         'https://cdn.pixabay.com/photo/2014/07/10/17/17/bedroom-389254_1280.jpg'
        //     ];

        //     $arrStandardBedrooms = [
        //         'https://cdn.pixabay.com/photo/2016/12/30/07/55/bedroom-1940169_1280.jpg',
        //         'https://cdn.pixabay.com/photo/2016/12/30/07/55/bedroom-1940168_1280.jpg'
        //     ];

        //     $arrPocketBedrooms = [
        //         'https://cdn.pixabay.com/photo/2018/06/20/10/00/modern-minimalist-bedroom-3486163_1280.jpg',
        //         'https://cdn.pixabay.com/photo/2018/02/12/10/07/modern-minimalist-bedroom-3147893_1280.jpg'
        //     ];

        //     if (count($propertyPhoto1->images) == 0) {
        //         $propertyPhoto1->upload($arrImages[mt_rand(0,5)], ['medium', 'thumb']);
        //         $propertyPhoto1->upload($arrImages[mt_rand(0,5)], ['medium', 'thumb']);
        //         $propertyPhoto1->upload($arrImages[mt_rand(0,5)], ['medium', 'thumb']);
        //     }
            
        //     if (count($propertyPhoto2->images) == 0) {
        //         $propertyPhoto2->upload($arrLivingRooms[mt_rand(0,1)], ['medium', 'thumb']);
        //         $propertyPhoto2->upload($arrLivingRooms[mt_rand(2,3)], ['medium', 'thumb']);
        //     }

        //     if (!empty($property->bedroom)) {
        //         foreach ($property->bedroom as $bedroom) {
        //             $bedroomPhoto = $bedroom->propertyPhoto($property->id);
        //             if (count($bedroomPhoto->images) == 0) {
        //                 if ($bedroom->type == 'master') {
        //                     $bedroomPhoto->upload($arrMasterBedrooms[mt_rand(0,1)], ['medium', 'thumb']);
        //                 } elseif ($bedroom->type == 'standard') {
        //                     $bedroomPhoto->upload($arrStandardBedrooms[mt_rand(0,1)], ['medium', 'thumb']);
        //                 } else {
        //                     $bedroomPhoto->upload($arrPocketBedrooms[mt_rand(0,1)], ['medium', 'thumb']);
        //                 }
        //             }
        //         }
        //     }
        // }
    }
}
