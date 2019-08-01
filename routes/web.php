<?php
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', ['as' => 'homepage', 'uses' => 'HomeController@index']);
Route::post('/login', ['as' => 'login.post', 'uses' => 'Auth\LoginController@login']);
Route::get('/logout', ['as' => 'logout.get', 'uses' => 'Auth\LoginController@logout']);
Route::get('/set-cookie', ['as' => 'set-cookie.get', 'uses' => 'HomeController@setCookie']);
Route::get('/get-cookie', ['as' => 'get-cookie.get', 'uses' => 'HomeController@getCookie']);
Route::post('/send-property-request', ['as' => 'send-property-request.post', 'uses' => 'HomeController@sendPropertyRequest']);
Route::post('/register', ['as' => 'register.post', 'uses' => 'Auth\RegisterController@create']);
Route::get('/register/check-email', ['as' => 'register.check-email', 'uses' => 'Auth\RegisterController@checkEmail']);
Route::get('/register/check-dob', ['as' => 'register.check-dob', 'uses' => 'Auth\RegisterController@checkDob']);

Route::post('/register-social', ['as' => 'register-social.post', 'uses' => 'Auth\RegisterController@registerSocial']);
Route::post('/forgot-password', ['as' => 'forgot-password.post', 'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail']);
Route::post('/forgot-password-phone-number', ['as' => 'forgot-password-phone-number.post', 'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmailByPhoneNumber']);
Route::get('/reset-password/{token}', ['as' => 'password.reset', 'uses' => 'Auth\ResetPasswordController@showResetForm']);
Route::post('/reset-password', ['as' => 'reset-password.post', 'uses' => 'Auth\ResetPasswordController@resetPassword']);
Route::post('/check-email', ['as' => 'check-email.post', 'uses' => 'Auth\ForgotPasswordController@checkEmail']);
Route::post('/check-phone-number', ['as' => 'check-phone-number.post', 'uses' => 'Auth\ForgotPasswordController@checkPhoneNumber']);
Route::post('/check-password', ['as' => 'check-password.post', 'uses' => 'Auth\ForgotPasswordController@checkPassword']);
Route::post('/register-company', ['as' => 'register-company.post', 'uses' => 'Auth\RegisterController@registerCompany']);

/* Login Social */
Route::get('/login/{provider}', 'Auth\LoginController@redirectToProvider')->where('facebook', 'google', 'linkedin');
Route::get('/login/{provider}/callback', 'Auth\LoginController@handleProviderCallback')->where('facebook', 'google', 'linkedin');
Route::get('/register/{provider}', 'Auth\RegisterController@redirectToProvider')->where('facebook', 'google', 'linkedin');
Route::get('/register/{provider}/callback', 'Auth\RegisterController@handleProviderCallback')->where('facebook', 'google', 'linkedin');
Route::get('/social-account/{id}', ['as' => 'social-account.get', 'uses' => 'SocialAccountController@show']);

/* Verification Account */
Route::get('/verify/{code}', ['as' => 'verify-email.get', 'uses' => 'VerificationController@verifyEmail']);
Route::post('/verify-phone-number', ['as' => 'verify-phone-number.post', 'uses' => 'VerificationCodeController@verifyPhoneNumber']);
Route::post('/resend-verification-code', ['as' => 'resend-verification-code.post', 'uses' => 'VerificationCodeController@resendVerificationCode']);
Route::post('/change-phone-number', ['as' => 'change-phone-number.post', 'uses' => 'VerificationCodeController@changePhoneNumber']);

/* User Preference */
Route::post('/save-user-preferences', ['as' => 'save-user-preferences.post', 'uses' => 'UserPreferenceController@saveData']);

Route::get('/property-lister/homeowner', 'HomeController@homeowner')->name('property-lister.homeowner');
Route::get('/property-lister/agent', 'HomeController@property_agent')->name('property-lister.agent');
Route::get('/property-lister/building-management', 'HomeController@building_management')->name('property-lister.building-management');
Route::get('/property-lister/housemate', 'HomeController@housemate')->name('property-lister.housemate');
Route::get('/join/agent', 'HomeController@showing_agent')->name('join.agent');
Route::get('/working/company-staff', 'WorkingController@company_staff')->name('working.company-staff');
Route::get('/join/company-client', 'HomeController@company_client')->name('join.company-client');
Route::get('/detail/{id}', 'ListingController@detail')->name('detail');
Route::get('/rent-details', 'RentdetailsController@index')->name('rent_details');
Route::get('/place-auto-complete', 'GooglePlaceAPIController@getPlaceAutoComplete')->name('place-auto-complete');
Route::get('/place-details', 'GooglePlaceAPIController@getPlaceDetails')->name('place-details');
Route::post('/register-community', ['as' => 'register-community.post', 'uses' => 'HomeController@registerCommunity']);
Route::get('/property/{id}/{slug}', 'PropertyController@detail')->name('property-detail.detail');
Route::post('/schedule-tours', ['as' => 'schedule-tours.post', 'uses' => 'PropertyController@scheduleTours']);
Route::post('/get-bedroom-price', ['as' => 'get-bedroom-price.post', 'uses' => 'PropertyController@getBedroomPrice']);
Route::post('/get-length-of-stay', ['as' => 'get-length-of-stay.post', 'uses' => 'PropertyController@getLengthOfStay']);
Route::post('/get-bedroom-type', ['as' => 'get-bedroom-type.post', 'uses' => 'PropertyController@getBedroomType']);
Route::post('/instant-booking', ['as' => 'instant-booking.post', 'uses' => 'PropertyController@instantBooking']);


Route::get('/add-property/{step}/{id?}', 'PropertyController@create')->name('add-property');
Route::post('/add-property/{step}', 'PropertyController@store')->name('add-property.store');

/* Search */
Route::post('/search', 'SearchController@doSearch')->name('search.post');
Route::get('/search', 'SearchController@index')->name('search');
Route::post('/search/init', 'SearchController@doSearchAjax')->name('search.init');
Route::post('/search/ajax', 'SearchController@doReSearchAjax')->name('search.ajax');
Route::post('/search/price', 'SearchController@getPrice')->name('search.price');
Route::match(['get', 'post'],' /search/{param?}', 'SearchController@index')
    ->where('param', '.*');

Route::get('/amenities', 'SearchController@getAmenities')->name('search.amenity');
Route::get('/facilities', 'SearchController@getFacilities')->name('search.facility');
Route::get('/styles', 'SearchController@getStyles')->name('search.style');
Route::get('/options', 'SearchController@getSearchOptions')->name('search.option');

Route::get('/set-lang/{lang}', 'HomeController@setLang')->name('set-lang');

/* Property Favorite */
Route::post('/property-favorite', ['middleware' => 'auth', 'as' => 'property-favorite.store', 'uses' => 'PropertyFavoriteController@store']);
Route::delete('/property-favorite/{pid}', ['middleware' => 'auth', 'as' => 'property-favorite.destroy', 'uses' => 'PropertyFavoriteController@destroy']);

Route::post('/search-preference', ['as' => 'search-preference.store', 'uses' => 'SearchPreferenceController@store']);

/* Recent search */
Route::post('/recent-search', ['as' => 'recent-search.store', 'uses' => 'RecentSearchController@store']);
Route::post('/recent-search/find', ['as' => 'recent-search.find', 'uses' => 'RecentSearchController@findByUserId']);

/* Admin Dashboard */
Route::group(['prefix' => 'admin', 'middleware' => ['role:administrator']], function() {
    Route::get('/', ['as' => 'admin-dashboard', 'uses' => 'Admin\HomeController@index']);
    /* Profile */
    Route::get('/profile', ['as' => 'admin.profile', 'uses' => 'Admin\ProfileController@index']);
    Route::post('/profile/update', ['as' => 'admin.profile.update', 'uses' => 'Admin\ProfileController@update']);

    Route::get('/active-worker', ['as' => 'active-worker.index', 'uses' => 'Admin\ActiveWorkerController@index']);
    Route::post('/active-worker', ['as' => 'active-worker.store', 'uses' => 'Admin\ActiveWorkerController@store']);
    Route::get('/active-worker/ajax', ['as' => 'active-worker.ajax', 'uses' => 'Admin\ActiveWorkerController@ajax']);
    Route::get('/active-worker/create', ['as' => 'active-worker.create', 'uses' => 'Admin\ActiveWorkerController@create']);
    Route::get('/active-worker/{id}/edit', ['as' => 'active-worker.edit', 'uses' => 'Admin\ActiveWorkerController@edit']);
    Route::put('/active-worker/{data}', ['as' => 'active-worker.update', 'uses' => 'Admin\ActiveWorkerController@update']);
    Route::delete('/active-worker/{id}', ['as' => 'active-worker.destroy', 'uses' => 'Admin\ActiveWorkerController@destroy']);

    /* Manage Admin */
    Route::get('/manage-admin', ['as' => 'manage-admin.index', 'uses' => 'Admin\UserController@indexAdmin']);
    Route::get('/manage-admin/ajax', ['as' => 'manage-admin.ajax', 'uses' => 'Admin\UserController@ajaxAdmin']);

    /* Manage User  */
    Route::get('/manage-user', ['as' => 'manage-user.index', 'uses' => 'Admin\UserController@indexUser']);
    Route::get('/manage-user/ajax', ['as' => 'manage-user.ajax', 'uses' => 'Admin\UserController@ajaxUser']);
    Route::put('/manage-user/update-status/{id}', ['as' => 'manage-user.update-status', 'uses' => 'Admin\UserController@updateStatus']);
    Route::get('/working-field', ['as' => 'working-field.index', 'uses' => 'Admin\WorkingFieldController@index']);
    Route::get('/working-field/ajax', ['as' => 'working-field.ajax', 'uses' => 'Admin\WorkingFieldController@ajax']);
    Route::get('/working-field/create', ['as' => 'working-field.create', 'uses' => 'Admin\WorkingFieldController@create']);
    Route::post('/working-field', ['as' => 'working-field.store', 'uses' => 'Admin\WorkingFieldController@store']);
    Route::get('/working-field/{id}/edit', ['as' => 'working-field.edit', 'uses' => 'Admin\WorkingFieldController@edit']);
    Route::put('/working-field/{data}', ['as' => 'working-field.update', 'uses' => 'Admin\WorkingFieldController@update']);
    Route::delete('/working-field/{id}', ['as' => 'working-field.destroy', 'uses' => 'Admin\WorkingFieldController@destroy']);

    /* Content - Services */
    Route::get('/content-service', ['as' => 'content-service.index', 'uses' => 'Admin\ContentServiceController@index']);
    Route::post('/content-service', ['as' => 'content-service.store', 'uses' => 'Admin\ContentServiceController@store']);
    Route::get('/content-service/ajax', ['as' => 'content-service.ajax', 'uses' => 'Admin\ContentServiceController@ajax']);
    Route::get('/content-service/create', ['as' => 'content-service.create', 'uses' => 'Admin\ContentServiceController@create']);
    Route::get('/content-service/{id}/edit', ['as' => 'content-service.edit', 'uses' => 'Admin\ContentServiceController@edit']);
    Route::put('/content-service/{data}', ['as' => 'content-service.update', 'uses' => 'Admin\ContentServiceController@update']);
    Route::delete('/content-service/{id}', ['as' => 'content-service.destroy', 'uses' => 'Admin\ContentServiceController@destroy']);

    /* Config Category */
    Route::group(['prefix' => 'configuration-category'], function() {
        Route::get('/', ['as' => 'configuration-category.index', 'uses' => 'Admin\ConfigurationCategoryController@index']);
        Route::post('/', ['as' => 'configuration-category.store', 'uses' => 'Admin\ConfigurationCategoryController@store']);
        Route::get('/ajax', ['as' => 'configuration-category.ajax', 'uses' => 'Admin\ConfigurationCategoryController@ajax']);
        Route::get('/create', ['as' => 'configuration-category.create', 'uses' => 'Admin\ConfigurationCategoryController@create']);
        Route::get('/{id}/edit', ['as' => 'configuration-category.edit', 'uses' => 'Admin\ConfigurationCategoryController@edit']);
        Route::put('/{data}', ['as' => 'configuration-category.update', 'uses' => 'Admin\ConfigurationCategoryController@update']);
        Route::delete('/{id}', ['as' => 'configuration-category.destroy', 'uses' => 'Admin\ConfigurationCategoryController@destroy']);
    });

    /* Config */
    Route::group(['prefix' => 'configuration'], function() {
        Route::get('/', ['as' => 'configuration.index', 'uses' => 'Admin\ConfigurationController@index']);
        Route::post('/', ['as' => 'configuration.store', 'uses' => 'Admin\ConfigurationController@store']);
        Route::get('/ajax', ['as' => 'configuration.ajax', 'uses' => 'Admin\ConfigurationController@ajax']);
        Route::get('/create', ['as' => 'configuration.create', 'uses' => 'Admin\ConfigurationController@create']);
        Route::get('/{id}/edit', ['as' => 'configuration.edit', 'uses' => 'Admin\ConfigurationController@edit']);
        Route::put('/{data}', ['as' => 'configuration.update', 'uses' => 'Admin\ConfigurationController@update']);
        Route::delete('/{id}', ['as' => 'configuration.destroy', 'uses' => 'Admin\ConfigurationController@destroy']);
    });

    /* Client Review */
    Route::get('/client-review', ['as' => 'client-review.index', 'uses' => 'Admin\ClientReviewController@index']);
    Route::post('/client-review', ['as' => 'client-review.store', 'uses' => 'Admin\ClientReviewController@store']);
    Route::get('/client-review/ajax', ['as' => 'client-review.ajax', 'uses' => 'Admin\ClientReviewController@ajax']);
    Route::get('/client-review/create', ['as' => 'client-review.create', 'uses' => 'Admin\ClientReviewController@create']);
    Route::get('/client-review/{id}/edit', ['as' => 'client-review.edit', 'uses' => 'Admin\ClientReviewController@edit']);
    Route::put('/client-review/{data}', ['as' => 'client-review.update', 'uses' => 'Admin\ClientReviewController@update']);
    Route::delete('/client-review/{id}', ['as' => 'client-review.destroy', 'uses' => 'Admin\ClientReviewController@destroy']);


    /* Property */
    Route::group(['prefix' => 'property'], function() {
        Route::get('/', ['as' => 'property.index', 'uses' => 'Admin\PropertyController@index']);
        Route::post('/', ['as' => 'property.store', 'uses' => 'Admin\PropertyController@store']);
        Route::get('/ajax', ['as' => 'property.ajax', 'uses' => 'Admin\PropertyController@ajax']);
        Route::get('/{id}/view', ['as' => 'property.view', 'uses' => 'Admin\PropertyController@view']);
        Route::put('/{data}', ['as' => 'property.update', 'uses' => 'Admin\PropertyController@update']);
        Route::delete('/{id}', ['as' => 'property.destroy', 'uses' => 'Admin\PropertyController@destroy']);
    });

});

/* Linked account with social */
Route::get('/connect/{provider}', 'Dashboard\ProfileController@redirectToProvider')->where('facebook', 'google', 'linkedin');
Route::get('/connect/{provider}/callback', 'Dashboard\ProfileController@handleProviderCallback')->where('facebook', 'google', 'linkedin');

/* User Dashboard */
Route::group(['prefix' => 'dashboard', 'middleware' => ['role:user']], function() {
    Route::get('/profile', 'Dashboard\ProfileController@profile')->name('profile');
    Route::put('/profile', 'Dashboard\ProfileController@update')->name('profile.update');
    Route::put('/profile/email', 'Dashboard\ProfileController@updateEmail')->name('profile.update-email');
    Route::put('/profile/phone', 'Dashboard\ProfileController@updatePhone')->name('profile.update-phone');
    Route::put('/profile/password', 'Dashboard\ProfileController@updatePassword')->name('profile.update-password');
    Route::post('/profile/photo', 'Dashboard\ProfileController@savePhoto')->name('profile.photo');
    Route::post('/profile/information', 'Dashboard\ProfileController@saveAdditionalInformation')->name('profile.information');
    Route::post('/profile/language', 'Dashboard\ProfileController@saveAdditionalInformation')->name('profile.information');
    Route::delete('/profile/photo', 'Dashboard\ProfileController@deletePhotoProfile')->name('profile.photo-delete');
    Route::delete('/profile/identity/{id}', 'Dashboard\ProfileController@deletePhoto')->name('profile.identity-delete');
    Route::post('/profile/document', 'Dashboard\ProfileController@saveDocument')->name('profile.document');
    Route::delete('/profile/document/{id}', 'Dashboard\ProfileController@deleteDocument')->name('profile.document-delete');
    Route::post('/profile/legal', 'Dashboard\ProfileController@saveLegal')->name('profile.save-legal');
    Route::post('/profile/company', 'Dashboard\ProfileController@updateCompany')->name('profile.update-company');
    Route::post('/profile/verify-identity', 'Dashboard\ProfileController@verifyIdentity')->name('profile.verify-identity');
    Route::post('/deactivate-account', 'Dashboard\ProfileController@deactivateAccount')->name('deactivate-account');

    Route::get('/', 'Dashboard\DashboardController@dashboard')->name('dashboard');
    Route::get('/my-favourites', 'Dashboard\DashboardController@favourites')->name('my-favourites');
    Route::get('/recent-view', 'Dashboard\DashboardController@recentView')->name('dashboard.recent-view');
    Route::post('/nearme-property', 'Dashboard\DashboardController@getNearmeProperty')->name('nearby-property');
    Route::get('/popular-property', 'Dashboard\DashboardController@getPopularProperty')->name('popular-property');
    Route::get('/favourites-property', 'Dashboard\DashboardController@getFavouritesProperty')->name('favourites-property');
    Route::get('/recent-view-property', 'Dashboard\DashboardController@getRecentViewProperty')->name('recent-view-property');
    Route::get('/recent-searched-property', 'Dashboard\DashboardController@getRecentSearchedProperty')->name('recent-searched-property');
    Route::get('/most-searched-property', 'Dashboard\DashboardController@getMostSearchedProperty')->name('most-searched-property');
    Route::get('/most-available-property', 'Dashboard\DashboardController@getMostAvailableProperty')->name('most-available-property');
    Route::post('/update-schedule-time', 'Dashboard\DashboardController@updateSchedule')->name('dashboard.update-schedule');
    Route::put('/reply-tour/{id}', 'Dashboard\DashboardController@replyTour')->name('dashboard.reply-tour');
});
/* Create Property */
Route::group(['middleware' => ['role:user']], function () {
    Route::get('/create-property', 'AddPropertyController@index')->name('create-property');
    Route::post('/create-property/upload-image', 'AddPropertyController@uploadImage')->name('create-property.upload-image');
    Route::post('/create-property/upload-file', 'AddPropertyController@uploadFile')->name('create-property.upload-file');
    Route::post('/create-property/upload-file-insurance-document', 'AddPropertyController@uploadFileInsuranceDocument')->name('create-property.upload-file');
    /*Step 6*/
    Route::post('/create-property/set-as-thumbnail', 'AddPropertyController@setAsThumbnailStep6')->name('create-property.set-as-thumbnail');
    Route::post('/create-property/add-additional-category', 'AddPropertyController@addAdditionalCategory')->name('create-property.add-additional-category');
    Route::delete('/create-property/delete-category', 'AddPropertyController@deleteCategory')->name('create-property.delete-category');
    /*Step 7*/
    Route::post('/create-property/save-property-status', 'AddPropertyController@savePropertyStatus')->name('create-property.save-property-status');

    Route::post('/property/photos', 'AddPropertyController@photos')->name('create-property.photos');
    Route::post('/property/files', 'AddPropertyController@files')->name('create-property.files');
    Route::post('/property/files-insurance-document', 'AddPropertyController@filesInsuranceDocument')->name('create-property.files');
    Route::delete('/property/photos/{id}', 'AddPropertyController@deletePhotos')->name('create-property.photos.delete');
    Route::delete('/property/files/{id}', 'AddPropertyController@deleteFiles')->name('create-property.files.delete');

    /* Add Property */
    Route::post('/create-property/add-bedroom', 'AddPropertyController@addBedroom')->name('create-property.add-bedroom');
    Route::post('/create-property/update-bedroom', 'AddPropertyController@updateBedroom')->name('create-property.update-bedroom');
    Route::delete('/create-property/delete-bedroom', 'AddPropertyController@deleteBedroom')->name('create-property.delete-bedroom');
    Route::post('/create-property/save-amenities', 'AddPropertyController@saveAmenitiesStep5')->name('create-property.save-amenities');
    Route::post('/create-property/save-facilities', 'AddPropertyController@saveFacilitiesStep5')->name('create-property.save-facilities');

    Route::get('/create-property/{id}/{step}', 'AddPropertyController@edit')->name('create-property.step');
    Route::post('/create-property', 'AddPropertyController@store')->name('create-property.store');
    Route::post('/create-property/{step}', 'AddPropertyController@update')->name('create-property.update');
});
Route::get('/tool/preview', 'ToolController@previewPdf');
Route::get('/tool/elastic', 'ToolController@elastic');
