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
Route::get('/', 'HomeController@index')->name('home');
Route::get('/terms-and-conditions', 'HomeController@terms')->name('terms');
Route::get('/privacy-policy', 'HomeController@privacy')->name('privacy');
Route::get('/about', 'HomeController@about')->name('about');
Route::get('/contact', 'HomeController@contact')->name('contact');
Route::get('/verify-email/{id}/{token}', 'HomeController@verify_email')->name('verify_email');

/*search------------------------------------*/
Route::get('/search-property', 'SearchProperty@index')->name('search-property');
Route::get('/category/{slug?}/{id?}', 'SearchProperty@index')->name('search.category');
Route::get('/property/{slug?}/{id?}', 'SearchProperty@single')->name('search.single');
Route::post('/do-search', 'SearchProperty@do_search')->name('do-search');
Route::post('property-add-to-fav', 'SearchProperty@add_to_fav')->name('property.add-to-fav');

Route::get('/membership', 'HomeController@membership')->name('membership');
Route::post('/do-contact-us', 'HomeController@do_contact_us')->name('do-contact-us');
Route::get('reset-password/{token}', 'AuthController@showResetPasswordForm')->name('reset.password.get');
Route::post('reset-password', 'AuthController@submitResetPasswordForm')->name('reset.password.post');
Route::get('update-inactivity', 'HomeController@UpdateInactivity')->name('update-inactivity');
Route::post('/stripe-payment', 'User\Membership@stripePost')->name('stripe.payment');

Route::middleware(['guest' , 'preventBack'])->group(function () 
{
    Route::get('login', 'AuthController@loginView')->name('login');
    Route::get('forgot', 'AuthController@forgotView')->name('forgot');
    Route::get('register', 'AuthController@registerView')->name('register');
    Route::post('/do-register', 'AuthController@doRegister')->name('do-register');
    Route::post('/do-forgot', 'AuthController@doForgot')->name('do-forgot');
    Route::post('/send-otp', 'AuthController@sendOtp')->name('send-otp');
    Route::post('/do-login', 'AuthController@doLogin')->name('do-login');
    

});  

Route::namespace('User')->prefix('user')->name('user.')->group(function()
{
    Route::middleware(['auth' , 'preventBack' ])->group(function () {
        Route::get('verification-pending', 'User@verification_pending')->name('verification-pending');
        Route::get('logout', 'User@logout')->name('logout');
    }); 
    Route::middleware(['auth' , 'preventBack' , 'email_verified'])->group(function () {
        Route::get('dashboard', 'User@dashboard')->name('dashboard');
        Route::post('do-update-profile', 'User@doUpdateProfile')->name('do-update-profile');
        Route::post('do-update-image', 'User@doUpdateImage')->name('do-update-image');
        Route::post('do-change-password', 'User@doChangePassword')->name('do-change-password');
        Route::post('/update-activity', 'User@UpdateActivity')->name('update-activity');
        Route::get('add-property', 'PostProperty@index')->name('add-property');
        Route::get('edit-property/{id}', 'PostProperty@editProperty')->name('edit-property');
        Route::get('my-properties', 'PostProperty@myProperties')->name('myproperties');
        Route::get('fav-properties', 'User@fav_properties')->name('fav-properties');
        Route::post('property-update', 'PostProperty@update')->name('property.update');
        Route::post('property-store', 'PostProperty@store')->name('property.store');
        Route::post('do-review', 'PostProperty@do_review')->name('do-review');
        Route::post('property-images-store', 'PostProperty@storeImages')->name('property.images.store');
        
        Route::post('property-image-delete', 'PostProperty@deleteImage')->name('property.image.delete');
        Route::post('property-delete', 'PostProperty@deleteProperty')->name('property.delete');
        Route::post('property-change-status', 'PostProperty@changeStatus')->name('property.changeStatus');
    });    
    
});








Route::get('/admin', function () {
    return redirect('admin/login');
});

Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function(){
    Route::namespace('Auth')->group(function(){
        Route::get('login', 'AuthController@login')->name('login');
        Route::post('login', 'AuthController@authenticateAdmin')->name('adminlogin');
        Route::get('logout', 'AuthController@destroy')->name('logout');
    });

    Route::middleware('admin')->group(function() {
        Route::get('dashboard', 'HomeController@index')->name('dashboard');
        Route::post('update-password', 'Auth\AuthController@updatePassword')->name('password.update');
        Route::get('edit-profile', 'Auth\AuthController@editProfile')->name('edit-profile');
        Route::post('update-profile', 'Auth\AuthController@updateProfile')->name('profile.update');

        Route::get('user-list', 'UserController@userList')->name('user-list');
        Route::get('block-unblock', 'UserController@blockUnblock')->name('block-unblock');

        // Route::get('client-list', 'ClientController@clientList')->name('client-list');
        Route::get('property-list', 'PropertyController@propertyList')->name('property-list');
        Route::post('make-featured', 'PropertyController@makeFeatured')->name('make-featured');

        Route::get('add-property', 'PropertyController@addProperty')->name('add-property');
        Route::get('category-list', 'PropertyController@categoryList')->name('category-list');

        Route::get('parking-types-list', 'ParkingTypesController@index')->name('parking-types-list');
        Route::post('add-parking-types', 'ParkingTypesController@addParkingTypes')->name('add-parking-types');
        Route::post('update-parking-types', 'ParkingTypesController@updateParkingTypes')->name('update-parking-types');
        Route::post('del-parking-types', 'ParkingTypesController@delParkingTypes')->name('del-parking-types');

        Route::get('plans-list', 'PlansController@index')->name('plans-list');
        Route::post('update-plans', 'PlansController@updatePlans')->name('update-plans');

        Route::get('addons-list', 'AddonsController@index')->name('addons-list');
        Route::post('update-addons', 'AddonsController@updateAddons')->name('update-addons');

        


        Route::get('contact-type-list', 'ContactController@contatTypeList')->name('contact-type-list');
        Route::post('add-contact-type', 'ContactController@addContactType')->name('add-contact-type');
        Route::post('update-contact-type', 'ContactController@updateContactType')->name('update-contact-type');
        Route::post('del-contact-type', 'ContactController@delContatType')->name('del-contact-type');

        Route::get('contact-us-list', 'ContactController@contatUsList')->name('contact-us-list');


        Route::get('animities-list', 'AnimitiesController@index')->name('animities-list');
        Route::post('add-animities', 'AnimitiesController@addAnimities')->name('add-animities');
        Route::post('update-animities', 'AnimitiesController@updateAnimities')->name('update-animities');
        Route::post('del-animities', 'AnimitiesController@delAnimities')->name('del-animities');

        Route::get('view-child-aminities/{id}', 'AnimitiesController@index')->name('view-child-aminities');

        Route::get('admin-contact', 'AdminContactDetailController@index')->name('admin-contact');
        Route::post('update-admin-contact', 'AdminContactDetailController@updateAdminContactDetail')->name('update-admin-contact');
        Route::get('admin-social', 'SocialLinksController@index')->name('admin-social');
        Route::post('update-admin-social', 'SocialLinksController@updateSocialLinks')->name('update-admin-social');

        Route::get('category-list', 'CategoryController@index')->name('category-list');
        Route::get('subscription-list', 'CategoryController@Subscription')->name('subscription-list');
        Route::post('add-category', 'CategoryController@addCategory')->name('add-category');
        Route::post('update-category', 'CategoryController@updateCategory')->name('update-category');
        Route::post('del-category', 'CategoryController@delCategory')->name('del-category');

        Route::get('ads_banner-list', 'Ads_bannerController@index')->name('ads_banner-list');
        Route::post('add-ads_banner', 'Ads_bannerController@addAds_banner')->name('add-ads_banner');
        Route::post('update-ads_banner', 'Ads_bannerController@updateAds_banner')->name('update-ads_banner');
        Route::post('del-ads_banner', 'Ads_bannerController@delAds_banner')->name('del-ads_banner');

        //property route

         Route::get('property-list', 'PropertyController@propertyList')->name('property-list');
         Route::get('view-property', 'PropertyController@viewProperty')->name('view-property');
         Route::get('edit-property', 'PropertyController@editProperty')->name('edit-property');
         Route::get('delete-property', 'PropertyController@deleteProperty')->name('delete-property');
         Route::post('update-property', 'PropertyController@updateProperty')->name('update-property');
         Route::post('block_unblock', 'PropertyController@blockStatus')->name('block_unblock');

        Route::get('fees-list', 'FeesController@feesList')->name('fees-list');
        Route::post('fees-add', 'FeesController@addFees')->name('fees-add');
        Route::get('delete-fees', 'FeesController@deleteFees')->name('delete-fees');
        Route::post('fees-edit', 'FeesController@editFees')->name('fees-edit');

        Route::get('rv-rental', 'RvrentalController@index')->name('rv-rental');
        Route::post('update-rv-rental', 'RvrentalController@updateRVrental')->name('update-rv-rental')->name('update-rv-rental');
    });
    
});
