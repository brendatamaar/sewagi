<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\User;
use App\Models\ScheduleTour;
use App\Models\ScheduleTourOption;
use App\Models\Amenity;
use App\Models\Bedroom;
use App\Models\Style;
use App\Models\Facility;
use App\Models\PropertyPhoto;
use App\Models\Image;
use App\Models\PropertyStyle;
use App\Models\PropertyAmenity;
use App\Models\PropertyFacility;
use App\Models\PhotoType;
use App\Models\PropertyPrice;
use App\Models\PropertyPriceDetail;
use App\Models\File;
use App\Models\AdditionalPhotoType;
use App\Http\Requests\AddProperyStep5Request;

class AddPropertyController extends Controller
{
    public function __construct(
        Property $property,
        ScheduleTour $scheduleTour,
        ScheduleTourOption $scheduleTourOption,
        User $user,
        Amenity $amenity,
        Bedroom $bedroom,
        Style $style,
        Facility $facility,
        PropertyStyle $propertyStyle,
        PropertyAmenity $propertyAmenity,
        PropertyFacility $propertyFacility,
        PhotoType $photoType,
        PropertyPhoto $propertyPhoto,
        PropertyPrice $propertyPrice,
        PropertyPricedetail $propertyPriceDetail,
        Image $image,
        File $file,
        AdditionalPhotoType $additionalPhotoType
    )
    {
        $this->property = $property;
        $this->scheduleTour = $scheduleTour;
        $this->scheduleTourOption = $scheduleTourOption;
        $this->user = $user;
        $this->amenity = $amenity;
        $this->bedroom = $bedroom;
        $this->style = $style;
        $this->facility = $facility;
        $this->propertyPhoto = $propertyPhoto;
        $this->propertyStyle = $propertyStyle;
        $this->propertyAmenity = $propertyAmenity;
        $this->propertyFacility = $propertyFacility;
        $this->photoType = $photoType;
        $this->propertyPrice = $propertyPrice;
        $this->propertyPriceDetail = $propertyPriceDetail;
        $this->image = $image;
        $this->file = $file;
        $this->additionalPhotoType = $additionalPhotoType;
    }

    public function index($property = null, $step = null)
    {
        $step = 1;
        return view("add-property.form-1", compact('property', 'step'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type'        => 'required',
            'size'        => 'required',
            'living_cond' => 'required',
        ]);

        if (!isset($request->id)){
            $property = $this->property->createNew($request->all());
        }
        else{
            $user = auth()->user();
            $property = $this->property->find($request->id);
            if ($user->id != $property->user_id)
                return redirect('create-property');
            $property = $this->property->saveData($request->all());
        }

        return redirect("create-property/{$property->id}/2");
    }

    public function edit($id, $step)
    {
        $user = auth()->user();
        $property = $this->property->find($id);
        if (!isset($property))
            return redirect('create-property');
        if ($user->id != $property->user_id)
            return redirect('create-property');

        switch ($step) {
            case '1':
                return $this->index($property, $step);
                break;
            case '2':
                return $this->showFormStep2($property, $step);
                break;
            case '3':
                return $this->showFormStep3($property, $step);
                break;
            case '4':
                return $this->showFormStep4($property, $step);
                break;
            case '5':
                return $this->showFormStep5($property, $step);
                break;
            case '6':
                return $this->showFormStep6($property, $step);
                break;
            case '7':
                return $this->showFormStep7($property, $step);
                break;
            case '8':
                return $this->showFormStep8($property, $step);
                break;
            case '9':
                return $this->showFormStep9($property, $step);
                break;
            case '10':
                return $this->showFormStep10($property, $step);
                break;
        }
    }

    public function showFormStep2($property, $step)
    {
        $amenityList = $this->amenity->where('entity', 'bedroom')->get();
        $bedrooms    = $this->bedroom->getPropertyBedrooms($property->id);
        return view("add-property.form-2", compact('property', 'amenityList', 'step', 'bedrooms'));
    }

    public function showFormStep3($property, $step)
    {
        return view("add-property.form-3", compact('property', 'step'));
    }

    public function showFormStep4($property, $step)
    {
        $style = $this->style->all();
        return view("add-property.form-4", compact('property', 'step', 'style'));
    }

    public function showFormStep5($property, $step)
    {
        $propertyAmenity = $this->amenity->where('entity', 'property')->get();
        $facility = $this->facility->all();
        return view("add-property.form-5", compact('property', 'step', 'propertyAmenity', 'facility'));
    }

    public function showFormStep6($property, $step)
    {
        $photos = $this->propertyPhoto->getPhotos($property->id);
        $additionalPhotoTypeMaster = $this->additionalPhotoType->all();
        return view("add-property.form-6", compact('property', 'step', 'photos', 'additionalPhotoTypeMaster', 'bedrooms'));
    }

    public function showFormStep7($property, $step)
    {
        return view("add-property.form-7", compact('property', 'step'));
    }

    public function showFormStep8($property, $step)
    {
        if ($property->is_entire_space == 0){
            return redirect("create-property/{$property->id}/9");
        }
        $propertyPrice = $this->propertyPrice->where('property_id', $property->id)->where('living_condition', 'entire-space')->first();
        $propertyPriceDetail = $this->propertyPriceDetail->where('property_id', $property->id)->whereNull('bedroom_id')->get();
        return view("add-property.form-8", compact('property', 'step', 'propertyPrice', 'propertyPriceDetail'));
    }

    public function showFormStep9($property, $step)
    {
        if ($property->is_co_living == 0){
            return redirect("create-property/{$property->id}/10");
        }
        $bedrooms = $this->bedroom->where('property_id', $property->id)->get();
        $propertyPrice = $this->propertyPrice->where('property_id', $property->id)->where('living_condition', 'co-living')->first();
        $propertyPriceDetail = $this->propertyPriceDetail->where('property_id', $property->id)->whereNotNull('bedroom_id')->get();
        $lengthStay = [];
        foreach($propertyPriceDetail as $key => $value){
            array_push($lengthStay, $value->length);
        }
        $lengthStay = array_unique($lengthStay);

        return view("add-property.form-9", compact('property', 'step', 'bedrooms', 'propertyPrice', 'propertyPriceDetail', 'lengthStay'));
    }

    public function showFormStep10($property, $step)
    {
        $reviewPropertyTypeLivingCondition = false;
        $reviewBedroomBathroom = false;
        $reviewLocation = false;
        $reviewDescriptionHouseRules = false;
        $reviewAmenitiesFacilities = false;
        $reviewPhotos = false;
        $reviewLegalDetails = false;
        $reviewPaymentPreferenceForCoLiving = false;
        $reviewOwnershipCertificate = false;
        $reviewInsuranceDocument = false;
        $reviewPaymentPreferenceForEntireSpace = false;

        if ($property->type != '' && ($property->is_co_living == 1 || $property->is_co_living == 1)){
            $reviewPropertyTypeLivingCondition = true;
        }
        if ($property->bedrooms > 0 && $property->bathrooms > 0){
            $reviewBedroomBathroom = true;
        }
        if (!empty($property->address)){
            $reviewBedroomBathroom = true;
        }
        if (!empty($property->address)){
            $reviewLocation = true;
        }
        if (!empty($property->description)){
            $reviewDescriptionHouseRules = true;
        }
        if ($property->amenities->count() > 0 && $property->facilities->count() > 0){
            $reviewAmenitiesFacilities = true;
        }
        if ($property->photos->count() > 0){
            $reviewPhotos = true;
        }
        if (!empty($property->belong_to)){
            $reviewLegalDetails = 1;
        }
        if ($property->propertyPrice->count() > 0){
            $reviewPaymentPreferenceForCoLiving = true;
            $reviewPaymentPreferenceForEntireSpace = true;
        }
        if ($property->files->where('type', 'legal-certificate')->count() > 0){
            $reviewOwnershipCertificate = true;
        }
        if ($property->files->where('type', 'insurance-document')->count() > 0){
            $reviewInsuranceDocument = true;
        }

        return view("add-property.form-10", compact('property', 'step', 'reviewPropertyTypeLivingCondition', 'reviewBedroomBathroom', 'reviewLocation', 'reviewDescriptionHouseRules', 'reviewAmenitiesFacilities', 'reviewPhotos', 'reviewLegalDetails', 'reviewPaymentPreferenceForCoLiving', 'reviewPaymentPreferenceForEntireSpace', 'reviewOwnershipCertificate', 'reviewInsuranceDocument'));
    }

    public function update(Request $request, $step)
    {
        $user = auth()->user();
        if($step!=10)
        {
            $property = $this->property->find($request->id);
            if ($user->id != $property->user_id)
                return redirect('create-property');

            switch ($step) {
                case '2':
                    return $this->actionStep2($request);
                    break;
                case '3':
                    return $this->actionStep3($request);
                    break;
                case '4':
                    return $this->actionStep4($request);
                    break;
                case '5':
                    return $this->actionStep5($request);
                    break;
                case '6':
                    return $this->actionStep6($request);
                    break;
                case '7':
                    return $this->actionStep7($request);
                    break;
                case '8':
                    return $this->actionStep8($request);
                    break;
                case '9':
                    return $this->actionStep9($request);
                    break;
                case '10':
                    return $this->actionStep10($request);
                    break;
            }
        }
        if($step=10)
        {
            return $this->actionStep10($request);
        }
    }

    public function actionStep2($request)
    {
        $check = $this->bedroom->checkValidate($request->id);
        if (!$check) {
            return redirect()->back()->withErrors(['msg' => session('locale')=='id' ? 'Mohon isi setidaknya 1 kamar' : 'Please complete the data at least 1 bedroom']);
        }
        $bedroomData = [
            'total_room'     => $request->total_bedroom,
            'available_room' => $request->total_bedroom,
            'rented_room'    => 0,
            'bedrooms'       => $request->total_bedroom,
            'bathrooms'      => $request->total_bathroom,
        ];
        $property = $this->property->updateById($request->id, $bedroomData);
        return redirect("create-property/{$property->id}/3");
    }

    public function actionStep3($request){
        $property = $this->property->saveData($request->all());
        return redirect("create-property/{$property->id}/4");
    }

    public function actionStep4($request){
        $this->propertyStyle->deleteByPropertyId($request->id);
        $input_style= $this->propertyStyle->createNew($request->all());
        $property = $this->property->saveData($request->all());
        return redirect("create-property/{$property->id}/5");
    }

    public function actionStep5(Request $request){
        $validator = \Validator::make($request->all(), [
            'amenity_id'     => 'required',
            'furniture'     => 'required',
            'step'     => 'required',
            'facility_id'     => 'required',
        ]);

        if ($validator->fails()) {
            return redirect("create-property/{$request->post('id')}/5")->withErrors($validator)->withInput();
        }


        $this->propertyAmenity->deleteByPropertyId($request->id);
        $this->propertyFacility->deleteByPropertyId($request->id);
        $input_amenity= $this->propertyAmenity->createNew($request->all());
        $input_facility= $this->propertyFacility->createNew($request->all());
        $property = $this->property->saveData($request->all());
        return redirect("create-property/{$property->id}/6");
    }

    public function actionStep6($request){
        $property = $this->property->saveData($request->all());
        return redirect("create-property/{$property->id}/7");
    }

    public function actionStep7($request){
        $property = $this->property->saveData($request->all());
        if ($property->is_entire_space == 1){
            return redirect("create-property/{$property->id}/8");
        } else {
            return redirect("create-property/{$property->id}/9");
        }
    }

    public function actionStep8($request){
        $this->propertyPrice->deleteByPropertyIdAndLivingCondition($request->id, 'entire_space');
        $this->propertyPriceDetail->deleteByPropertyIdAndLivingCondition($request->id, 'entire_space');
        $propertyPrice = $this->propertyPrice->createNew($request->all());
        $propertyPriceDetail = $this->propertyPriceDetail->createNew($request->all());
        $property = $this->property->where('id', $request->id)->first();
        if ($property->is_co_living == 1){
            return redirect("create-property/{$property->id}/9");
        }
        else{
            return redirect("create-property/{$property->id}/10");
        }
    }

    public function actionStep9($request){
        $this->propertyPrice->deleteByPropertyIdAndLivingCondition($request->id, 'co_living');
        $this->propertyPriceDetail->deleteByPropertyIdAndLivingCondition($request->id, 'co_living');
        $propertyPrice = $this->propertyPrice->createNew($request->all());
        $propertyPriceDetail = $this->propertyPriceDetail->createNew($request->all());
        $property = $this->property->where('id', $request->id)->first();
        return redirect("create-property/{$property->id}/10");
    }

    public function actionStep10($request){
        $property = $this->property->saveData($request->all());
    }

    public function uploadImage(Request $request)
    {
        $propertyPhoto = $this->propertyPhoto->find($request->id);
        $image = $propertyPhoto->upload( $request->file, ['medium', 'thumb']);
        return $image;
    }

    public function uploadFile(Request $request)
    {
        $property = $this->property->find($request->id);
        $file = $property->upload($request->file, $request->documentId);
        return $file;
    }

    public function photos(Request $request)
    {
        $propertyPhoto = $this->propertyPhoto->find($request->id);
        return $propertyPhoto->thumb_images()->get();
    }

    public function files(Request $request)
    {
        $property = $this->property
            ->with('files')
            ->find($request->id);
        return $property->files;
    }

    public function deletePhotos($id)
    {
        $this->image->where('parent_id', $id)->delete();
        return $this->image->destroy($id);
    }

    public function deleteFiles($id)
    {
        $this->file->where('id', $id)->delete();
        return $this->file->destroy($id);
    }

    public function addBedroom(Request $request)
    {
        $bedroomData = $request->all();
        $bedroomData['quantity'] = (empty($request->quantity) ? 1 : $request->quantity);
        $bedroom = $this->bedroom->create($bedroomData);
        return $bedroom;
    }

    public function updateBedroom(Request $request)
    {
        $bedroomName = $this->bedroom->generateName($request);
        $bedroomData = array_merge($request->all(), ['name' => $bedroomName]);
        $bedroom = $this->bedroom->updateById($request->id, $bedroomData);
        $bedroom->saveAmenities($request->amenities);
        return $bedroom;
    }

    public function deleteBedroom(Request $request)
    {
        $id = $request->id;
        $delete = $this->bedroom->deleteById($id);
        return ['status' => $delete];
    }

    /**
     * [saveAmenitiesStep5 to save property's amenities]
     * @param  Request $request [object of Request class]
     * @return [boolean]           [indicate that save is fail or success]
     */
    public function saveAmenitiesStep5(Request $request)
    {
        $this->propertyAmenity->deleteByPropertyId($request->id);
        if ($request->has('amenity_id')) {
            return $this->propertyAmenity->createNew($request->all());
        }
    }

    /**
     * [saveFacilitiesStep5 save property's facility_id]
     * @param  Request $request [object of Request class]
     * @return [boolean]           [indicate that save is fail or success]
     */
    public function saveFacilitiesStep5(Request $request)
    {
        $this->propertyFacility->deleteByPropertyId($request->id);
        if ($request->has('facility_id')) {
            return $this->propertyFacility->createNew($request->all());
        }
    }

    /**
     * [setAsThumbnailStep6 set image type as main image]
     * @param Request $request [object of Request class]
     */
    public function setAsThumbnailStep6(Request $request)
    {
        $update = $this->propertyPhoto->setAsThumbnail($request->post('id'));
        return ['status' => $update];
    }

    /**
     * [addAdditionalCategory To add additional property category in step 6 (create-property/$id_property/6) ]
     * @param Request $request [object of Request class]
     */
    public function addAdditionalCategory(Request $request)
    {
        $arr = $request->all();
        $arr['photable_type'] = 'App\Models\AdditionalPhotoType';
        $save = $this->propertyPhoto->create($arr);
        return $save ? $save->id : 0 ;
    }

    /**
     * [deleteAdditionalCategory To delete additional property category in step 6 (create-property/$id_property/6)]
     * @param  Request $request [object of Request class]
     * @return [int]           [return value]
     */
    public function deleteCategory(Request $request)
    {
        return $this->propertyPhoto->findOrFail($request->post('id'))->delete() ? 1 : 0 ;
    }

    /**
     * [savePropertyStatus save property ownership status in step 7]
     * @param  Request $request [object of Request class]
     * @return [int]           [return value]
     */
    public function savePropertyStatus(Request $request)
    {
        return $this->property->saveData($request->all()) ? 1 : 0 ;
    }
}
