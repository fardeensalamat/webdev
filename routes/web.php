<?php

//use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OnlinePaymentController;
use App\Http\Controllers\User\UserDashborad\UserDashboardController;
use App\Http\Controllers\XmlSitemapController;
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

//Route::get('/', function () {
//    // \Artisan::call('storage:link');
//    return view('welcome');
//});

Route::get('/', ['uses' => 'AutocompleteSearchController@index', 'as' => 'user.user.user']);

// Razib work
Route::post('search-user', ['uses' => 'AutocompleteSearchController@autosearchUser', 'as' => 'search.user']);
Route::post('search-user-short-cart', ['uses' => 'AutocompleteSearchController@autosearchUserShortCart', 'as' => 'search.user.short.cart']);
Route::post('search-user-short-cart-favorite', ['uses' => 'AutocompleteSearchController@autosearchUserShortCartFavorite', 'as' => 'search.user.short.cart.favorite']);

Route::post('search-user-product', ['uses' => 'AutocompleteSearchController@autosearchUserProduct', 'as' => 'search.user.product']);

//languages route
Route::get('/sc-bd-login', [AuthController::class, 'scbdLogin']);
Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'LanguageController@switchLang']);

// Route::get('/workcheck', function () {
//     return view('workcheck');
// });

// // Route::get('/getProduct', [
// //     'uses' => 'User\UserDashboard\UserDashboardController@getProduct',
// //     'as' => 'auth.getProduct'
// // ]);
// Route::post('/getProduct', [UserDashboardController::class,'getProduct']);


Route::get('/forgetpassword', [
    'uses' => 'Auth\UserCheckController@passwordRecoverByMobile',
    'as' => 'auth.passwordRecoverByMobile'
]);

Route::get('/unsave-mobile', [
    'uses' => 'Auth\UserCheckController@unsaveMobile',
    'as' => 'auth.unsaveMobile'
]);

Route::get('reffer/{reffer}', [
    'uses' => 'Welcome\WelcomeController@pf',
    'as' => 'welcome.pf'
]);
Route::get('my/pf/reffer', [
    'uses' => 'Welcome\WelcomeController@myPF',
    'as' => 'welcome.myPF'
]);
//Post Need Start
Route::get('post/a/need', [
    'uses' => 'Welcome\WelcomeController@postNeed',
    'as' => 'welcome.postNeed'
]);
Route::post('need/search/ajax', [
    'uses' => 'Welcome\WelcomeController@searchCategoryAjax',
    'as' => 'welcome.searchCategoryAjax'
]);
Route::post('need/store/from/guest', [
    'uses' => 'Welcome\WelcomeController@storeNewNeedFromGuest',
    'as' => 'welcome.storeNewNeedFromGuest'
]);
// Post Need End
//Opinion Start
Route::get('opinions', [
    'uses' => 'Welcome\WelcomeController@guestOpinions',
    'as' => 'welcome.guestOpinions'
]);

//Opinion End

// blog Start
Route::get('/{type}', [
    'uses' => 'Blog\BlogController@index',
    'as' => 'welcome.blog'
]);
Route::get('blog/{blog}/{title?}', [
    'uses' => 'Blog\BlogController@blogDetails',
    'as' => 'welcome.blogDetails'
]);
Route::get('event/{event}/{title?}', [
    'uses' => 'Blog\BlogController@eventDetails',
    'as' => 'welcome.eventDetails'
]);

Route::get('news/{news}/{title?}', [
    'uses' => 'Blog\BlogController@newsDetails',
    'as' => 'welcome.newsDetails'
]);
Route::get('news/cat/{cat}/name/{title?}', [
    'uses' => 'Blog\BlogController@catWiseNews',
    'as' => 'welcome.catWiseNews'
]);
Route::get('blog/cat/{cat}/name/{title?}', [
    'uses' => 'Blog\BlogController@catWiseBlog',
    'as' => 'welcome.catWiseBlog'
]);
Route::get('event/cat/{cat}/name/{title?}', [
    'uses' => 'Blog\BlogController@catWiseEvent',
    'as' => 'welcome.catWiseEvent'
]);
Route::get('{type}/{title?}/tag/{tag?}', [
    'uses' => 'Blog\BlogController@tagWisePost',
    'as' => 'welcome.tagWisePost'
]);

//Blog Search

Route::get('{type}/search/{in}/{search}', [
    'uses' => 'Blog\BlogController@blogSearch',
    'as' => 'welcome.blogSearch'
]);

//Blog End


// for User
Route::get('blog/make/new/post', [
    'uses' => 'Blog\BlogController@addNewBlog',
    'as' => 'welcome.addNewBlog'
]);
Route::get('blog/select/tag/or/add/new', [
    'uses' => 'Blog\BlogController@selectTagsOrAddNew',
    'as' => 'welcome.selectTagsOrAddNew'
]);
Route::post('blog/store/new/blog/from/user', [
    'uses' => 'Blog\BlogController@storeNewBlogFromUser',
    'as' => 'welcome.storeNewBlogFromUser'
]);

// blog Start

Route::get('profile/{profile}/details/subscription/{reffer}', [
    'uses' => 'Welcome\WelcomeController@profileShare',
    'as' => 'welcome.profileShare'
]);

//Model Shop code
Route::get('softcommerce/modelshop/list', [
    'uses' => 'Welcome\WelcomeController@ModelShopList',
    'as' => 'welcome.ModelShopList'
]);


//Model Shop End

Route::get('product/{product}/details/subscription/{reffer}/profile/{profile}', [
    'uses' => 'Welcome\WelcomeController@productShare',
    'as' => 'welcome.productShare'
]);

//Course Item

Route::get('course/{product}/details/subscription/{reffer}/profile/{profile}', [
    'uses' => 'Welcome\WelcomeController@courseShare',
    'as' => 'welcome.courseShare'
]);

//Service Item
Route::get('service-item/{item}/details/subscription/{reffer}/profile/{profile}', [
    'uses' => 'Welcome\WelcomeController@serviceItemShare',
    'as' => 'welcome.serviceItemShare'
]);
Route::any('add/negotiation/item/{item}/type/{type}', [
    'uses' => 'Welcome\WelcomeController@addNegotiation',
    'as' => 'welcome.addNegotiation'
]);
Route::any('add/negotiation/item/{item}/customer/{customer}', [
    'uses' => 'Welcome\WelcomeController@addNegotiationByOwner',
    'as' => 'welcome.addNegotiationByOwner'
]);
Route::get('update/negotiation/item/{item}/customer/{customer}', [
    'uses' => 'Welcome\WelcomeController@updateNegotiationByOwner',
    'as' => 'welcome.updateNegotiationByOwner'
]);
Route::post('service-item/{item}/pay/now', [
    'uses' => 'Welcome\WelcomeController@serviceItemPayment',
    'as' => 'welcome.serviceItemPayment'
]);
Route::post('payment/{payment}/order-status/update', [
    'uses' => 'Welcome\WelcomeController@orderStatusUpdate',
    'as' => 'welcome.orderStatusUpdate'
]);
//Service Item


//Nagad Payment
Route::get('/nagad/{amount}', [OnlinePaymentController::class, 'getNagad'])->name('paymentNagad');
Route::get('/nagad/add/{amount}', [UserDashboardController::class, 'addNagAddMoney'])->name('addNagAddMoney');


Route::get('/successNagadPaynow/{order_id}/{payment_ref_id}', [OnlinePaymentController::class, 'successnagad'])->name('successpaynow.page');

Route::get('/errorNagadPaynow/{order_id}', [OnlinePaymentController::class, 'errornagadpaynow'])->name('errornagadpaynow.page');
//End Nagad Payment

// Route::get('/newsfeed',[
//     'uses' =>'Newsfeed\NewsfeedController@newsfeed',
//     'as' => 'welcome.newsfeed'
// ])->middleware(['auth']);

Route::get('/newsfeed/details/post/{post}', [
    'uses' => 'Newsfeed\NewsfeedController@detailsPost',
    'as' => 'newsfeed.detailsPost'
])->middleware(['auth']);

Route::post('/newsfeed/new/post/{post}', [
    'as' => 'newsfeed.updatePost',
    'uses' => 'Newsfeed\NewsfeedController@updatePost'
])->middleware(['auth']);

Route::post('/newsfeed/new/post/workstation/{workstation}/post/{post}', [
    'as' => 'newsfeed.updateWorkStationPost',
    'uses' => 'Newsfeed\NewsfeedController@updateWorkStationPost'
])->middleware(['auth']);

Route::post('/newsfeed/new/post/workstation/{workstation}/category/{cat}/post/{post}', [
    'as' => 'newsfeed.updateWorkStationCategory',
    'uses' => 'Newsfeed\NewsfeedController@updateWorkStationCategory'
])->middleware(['auth']);

Route::get('/newsfeed/workstation/{workstation}', [
    'as' => 'welcome.allnews',
    'uses' => 'Newsfeed\NewsfeedController@allnews'
])->middleware(['auth']);

Route::get('/newsfeed/workstation/{workstation}/workstation/category/{cat}', [
    'as' => 'welcome.workstationCategoryNews',
    'uses' => 'Newsfeed\NewsfeedController@workstationCategoryNews'
])->middleware(['auth']);

Route::get('/neesfeed/delete/post/{post}', [
    'as' => 'newsfeed.delete',
    'uses' => 'Newsfeed\NewsfeedController@delete'

])->middleware(['auth']);

Route::get('workstation/{workstaion}/get-workscat', [
    'uses' => 'Newsfeed\NewsfeedController@getCategoryByWorkstation',
    'as' => 'newsfeed.getCategoryByWorkstation'
]);

Route::get('workstation/details/workstation/{workstation}', [
    'uses' => 'Welcome\WelcomeController@workstationDetails',
    'as' => 'welcome.workstationDetails'
]);

Route::get('page/{page}', [
    'uses' => 'Welcome\WelcomeController@welcomePage',
    'as' => 'welcome.welcomePage'
]);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


require __DIR__ . '/auth.php';



//mobile international
Route::post('user/check/by/mobile', [
    'uses' => 'Auth\UserCheckController@userCheckByMobile',
    'as' => 'auth.userCheckByMobile'
])->middleware('guest');


Route::post('login-by-mobile', [
    'uses' => 'Auth\UserCheckController@loginByMobile',
    'as' => 'auth.loginByMobile'
])->middleware('guest');

Route::post('save-new-mobile', [
    'uses' => 'Auth\UserCheckController@saveNewMobile',
    'as' => 'auth.saveNewMobile'
])->middleware('guest');




Route::post('register-by-mobile', [
    'uses' => 'Auth\UserCheckController@registerByMobile',
    'as' => 'auth.registerByMobile'
])->middleware('guest');


// Route::get('password-recover-by-mobile', [
//     'uses' => 'Auth\UserCheckController@passwordRecoverByMobile',
//     'as' => 'auth.passwordRecoverByMobile'
// ])->middleware('guest');

Route::post('password-save-by-mobile', [
    'uses' => 'Auth\UserCheckController@passwordSaveByMobile',
    'as' => 'auth.passwordSaveByMobile'
])->middleware('guest');










Route::group(['middleware' => ['auth']], function () {

    //test by masud
    Route::get('pay-with-bkash', function () {
        return view('bkash-payment');
    });



    // Payment Routes for bKash
    Route::post('bkash/get-token', 'BkashController@getToken')->name('bkash-get-token');
    Route::post('bkash/create-payment', 'BkashController@createPayment')->name('bkash-create-payment');
    Route::post('bkash/execute-payment', 'BkashController@executePayment')->name('bkash-execute-payment');
    Route::get('bkash/query-payment', 'BkashController@queryPayment')->name('bkash-query-payment');
    Route::post('bkash/success', 'BkashController@bkashSuccess')->name('bkash-success');

    // Refund Routes for bKash
    Route::get('bkash/refund', 'BkashRefundController@index')->name('bkash-refund');
    Route::post('bkash/refund', 'BkashRefundController@refund')->name('bkash-refund');
});


// subscriber

Route::group(['middleware' => ['auth', 'role:subscriber'], 'prefix' => 'mypanel'], function () {

    Route::get('subscription/dashboard/subscription/{subscription}', [
        'uses' => 'Subscirber\UserSubscriberDashboardController@subscriptionDashboard',
        'as' => 'user.subscriptionDashboard'
    ]);

    //  Route::get('devtest/s/{subscription}', [
    //     'uses' =>'Admin\DevTestController@devtest',
    //     'as' => 'user.devtests'
    // ]);
      Route::get('devtest/s/use/exipired', [
        'uses' =>'Admin\DevTestController@SubscriptionExpired',
        'as' => 'user.SubscriptionExpired'
    ]);




    // upgrade account
    Route::get('subscriber/upgrade/newsubscription-paid/{subscription}/category/{cat}', [
        'uses' => 'Subscirber\UserSubscriberDashboardController@updateubscriptionPaid',
        'as' => 'subscription.updateubscriptionPaid'
    ]);

    Route::post('subscriber/upgrade/post/{subscription}/category/{cat}', [
        'as' => 'subscriber.updateSubscriptionOldAccount',
        'uses' => 'Subscirber\UserSubscriberDashboardController@updateSubscriptionOldAccount',
    ]);

    Route::get('subscription/find/jobs/subscription/{subscription}', [
        'uses' => 'Subscirber\UserSubscriberDashboardController@subscriptionFindJob',
        'as' => 'subscriber.subscriptionFindJob'
    ]);

    Route::get('subscription/find/softcommerce/jobs/subscription/{subscription}', [
        'uses' => 'Subscirber\UserSubscriberDashboardController@subscriptionFindJobsoftcommerce',
        'as' => 'subscriber.subscriptionFindJobsoftcommerce'
    ]);

    Route::get('subscription/find/softcommerce/freelancer/jobs/subscription/{subscription}', [
        'uses' => 'Subscirber\UserSubscriberDashboardController@subscriptionFindJobsoftcommerceFreelancer',
        'as' => 'subscriber.subscriptionFindJobsoftcommerceFreelancer'
    ]);

    Route::get('subscription/find/softcommerce/vendor/jobs/subscription/{subscription}', [
        'uses' => 'Subscirber\UserSubscriberDashboardController@subscriptionFindJobsoftcommerceVendor',
        'as' => 'subscriber.subscriptionFindJobsoftcommerceVendor'
    ]);

    Route::get('subscription/search/jobs/subscribe/{subscription}', [
        'uses' => 'Subscirber\UserSubscriberDashboardController@subscriptionJobSearch',
        'as' => 'subscriber.subscriptionJobSearch'
    ]);



    Route::get('subscription/move/balance/to/wallet/subscription/{subscription}', [
        'uses' => 'Subscirber\UserSubscriberDashboardController@moveBalanceToWallet',
        'as' => 'subscriber.moveBalanceToWallet'
    ]);

    Route::get('subscription/post/job/subscription/{subscription}', [
        'uses' => 'Subscirber\UserSubscriberDashboardController@subscriptionPostJob',
        'as' => 'subscriber.subscriptionPostJob'
    ]);
    Route::get('subscription/post/special/job/subscription/{subscription}', [
        'uses' => 'Subscirber\UserSubscriberDashboardController@subscriptionSpecialPostJob',
        'as' => 'subscriber.subscriptionSpecialPostJob'
    ]);

    Route::get('subscription/my/posted/job/subscription/{subscription}', [
        'uses' => 'Subscirber\UserSubscriberDashboardController@subscriptionPostedJob',
        'as' => 'subscriber.subscriptionPostedJob'
    ]);

    Route::get('subscription/my/job/work/subscription/{subscription}', [
        'uses' => 'Subscirber\UserSubscriberDashboardController@subscriptionMyJobWork',
        'as' => 'subscriber.subscriptionMyJobWork'
    ]);

    Route::get('category/{category}/get-subcat', [
        'uses' => 'Subscirber\UserSubscriberDashboardController@getSubCategoryByCategory',
        'as' => 'subscriber.getSubCategoryByCategory'
    ]);

    Route::get('subcategory/{subcategory}/get-subcat-price', [
        'uses' => 'Subscirber\UserSubscriberDashboardController@getSubCategoryPriceBySubCategory',
        'as' => 'subscriber.getSubCategoryPriceBySubCategory'
    ]);

    Route::get('subcategory/{subcategory}/get-subcat-instraction', [
        'uses' => 'Subscirber\UserSubscriberDashboardController@getSubCategoryInstractionBySubCategory',
        'as' => 'subscriber.getSubCategoryInstractionBySubCategory'
    ]);

    Route::post('subscription/new/job/post/job/subscription/{subscription}/worksation/{worksation}', [
        'uses' => 'Subscirber\UserSubscriberDashboardController@subscriptionNewPostJob',
        'as' => 'subscriber.subscriptionNewPostJob'
    ]);

    Route::get('subscription/submitted/own/work/status/freelancejobWork/{freelancejobWork}/subscription/{subscription}', [
        'uses' => 'Subscirber\UserSubscriberDashboardController@OwnWorkApprove',
        'as' => 'subscriber.OwnWorkApprove'
    ]);



    Route::get('subscription/edit/job/details/freelanceJob/{freelanceJob}/subscription/{subscription}', [
        'uses' => 'Subscirber\UserSubscriberFreeLanceJobController@subscriptionEditJob',
        'as' => 'subscriber.subscriptionEditJob'
    ]);

    Route::post('subscription/update/job/details/freelanceJob/{job}/subscription/{subscription}/worksation/{worksation}', [
        'uses' => 'Subscirber\UserSubscriberFreeLanceJobController@subscriptionUpdateJobpost',
        'as' => 'subscriber.subscriptionUpdateJobpost'
    ]);

    Route::get('subscription/job/details/freelancerJob/{freelanceJob}/subscription/{subscription}', [
        'uses' => 'Subscirber\UserSubscriberFreeLanceJobController@freelanceJobDetails',
        'as' => 'subscriber.freelanceJobDetails'
    ]);

    Route::get('subscription/job/lock/freelancerJob/{freelanceJob}/subscription/{subscription}', [
        'uses' => 'Subscirber\UserSubscriberFreeLanceJobController@freelanceWorkLock',
        'as' => 'subscriber.freelanceWorkLock'
    ]);

    Route::post('subscription/job/submit/work/prove/freelancerJob/{freelanceJob}/subscription/{subscription}', [
        'uses' => 'Subscirber\UserSubscriberFreeLanceJobController@freelanceWorkSubmit',
        'as' => 'subscriber.freelanceWorkSubmit'
    ]);

    Route::get('subscription/submitted/work/subscription/{subscription}', [
        'uses' => 'Subscirber\UserSubscriberFreeLanceJobController@subscriptionSubmittedWork',
        'as' => 'subscriber.subscriptionSubmittedWork'
    ]);

    Route::get('subscription/submitted/work/list/{freelanceJob}/subscription/{subscription}', [
        'uses' => 'Subscirber\UserSubscriberFreeLanceJobController@subscriptionWorksList',
        'as' => 'subscriber.subscriptionWorksList'
    ]);

    Route::get('action/change/freelanceJob/subscription/{subscription}', [
        'uses' => 'Subscirber\UserSubscriberFreeLanceJobController@actionChange',
        'as' => 'subscriber.actionChange'
    ]);

    Route::get('subscription/submitted/work/details/freelancejobWork/{freelancejobWork}/subscription/{subscription}', [
        'uses' => 'Subscirber\UserSubscriberFreeLanceJobController@subscriptionSubmittedWorkDetails',
        'as' => 'subscriber.subscriptionSubmittedWorkDetails'
    ]);

    Route::post('subscription/submitted/work/approve/freelancejobWork/{freelancejobWork}/subscription/{subscription}', [
        'uses' => 'Subscirber\UserSubscriberFreeLanceJobController@subscriptionSubmittedWorkApprove',
        'as' => 'subscriber.subscriptionSubmittedWorkApprove'
    ]);

    Route::get('subscription/submitted/work/status/freelancejobWork/{freelancejobWork}/subscription/{subscription}', [
        'uses' => 'Subscirber\UserSubscriberFreeLanceJobController@subscriptionSubmittedWorkStatus',
        'as' => 'subscriber.subscriptionSubmittedWorkStatus'
    ]);

    Route::get('post/business-profile-of/subscription/{subscription}', [
        'as' => 'subscriber.subscriptionPostBusinessProfile',
        'uses' => 'Subscirber\UserSubscriberFreeLanceJobController@subscriptionPostBusinessProfile',
    ]);

    Route::get('post/personal-profile-of/subscription/{subscription}', [
        'as' => 'subscriber.subscriptionPostPersonalProfile',
        'uses' => 'Subscirber\UserSubscriberFreeLanceJobController@subscriptionPostPersonalProfile',
    ]);

    Route::post('post/profile-details/subscription/{subscription}', [
        'as' => 'subscriber.postProfileService',
        'uses' => 'Subscirber\UserSubscriberFreeLanceJobController@postProfileService',
    ]);


    Route::get('find/profile-for/subscription/{subscription}', [
        'as' => 'subscriber.subscriptionfindProfile',
        'uses' => 'Subscirber\UserSubscriberFreeLanceJobController@subscriptionfindProfile',
    ]);

    Route::get('find/profile/details/subscription/{subscription}/profile/{profile}', [
        'as' => 'subscriber.findProfileDetails',
        'uses' => 'Subscirber\UserSubscriberFreeLanceJobController@findProfileDetails',
    ]);
    Route::get('find/profile/details/subscription/{subscription}/profile/{profile}/paid_type/{paid_type}', [
        'as' => 'subscriber.profilePaidPortionView',
        'uses' => 'Subscirber\UserSubscriberFreeLanceJobController@profilePaidPortionView',
    ]);

    Route::get('visitor/profile/details/subscription/{subscription}/visitor/{visitor}', [
        'as' => 'subscriber.visitorProfileDetails',
        'uses' => 'Subscirber\UserSubscriberFreeLanceJobController@visitorProfileDetails',
    ]);
    Route::get('my/profile/details/subscription/{subscription}/profile-type/{profile_type}', [
        'as' => 'subscriber.myProfileDetails',
        'uses' => 'Subscirber\UserSubscriberFreeLanceJobController@myProfileDetails',
    ]);

    Route::get('my/profile/subscription/{subscription}/qrcode/{profile}', [
        'as' => 'subscriber.ShopQrcode',
        'uses' => 'Subscirber\UserSubscriberFreeLanceJobController@ShopQrcode',
    ]);
    Route::get('my/profile/subscription/{subscription}/customerlist/{profile}', [
        'as' => 'subscriber.CustomerList',
        'uses' => 'Subscirber\UserSubscriberFreeLanceJobController@CustomerList',
    ]);


    // 05-10-2021
    Route::get('my/profile/subscription/{subscription}/edit/profile/{profile}', [
        'as' => 'subscriber.myProfileEdit',
        'uses' => 'Subscirber\UserSubscriberFreeLanceJobController@myProfileEdit',
    ]);
    Route::post('my/profile/update/subscription/{subscription}', [
        'as' => 'subscriber.myProfileUpdate',
        'uses' => 'Subscirber\UserSubscriberFreeLanceJobController@myProfileUpdate',
    ]);
    // 05-10-2021
    Route::get('profile/details/subscription/{subscription}/profile/{profile}', [
        'as' => 'subscriber.profileDetails',
        'uses' => 'Subscirber\UserSubscriberFreeLanceJobController@profileDetails',
    ]);

//Course Add start

Route::get('all/course-item/of/profile/{profile}/subscription/{subscription}', [
    'as' => 'subscriber.allcourseitems',
    'uses' => 'Subscirber\Course\CourseController@allCourseItems',
]);


Route::get('add/new/course-item/of/profile/{profile}/subscription/{subscription}', [
    'as' => 'subscriber.newCourse',
    'uses' => 'Subscirber\Course\CourseController@newCourse',
]);

Route::post('store/course-item/of/profile/{profile}/subscription/{subscription}', [
    'as' => 'subscriber.storeCourse',
    'uses' => 'Subscirber\Course\CourseController@storeCourse',
]);

Route::get('/course-item/{item}/edit/of/profile/{profile}/subscription/{subscription}', [
    'as' => 'subscriber.editCourseItems',
    'uses' => 'Subscirber\Course\CourseController@editCourseItems',
]);
Route::post('/course-item/{item}/update/of/profile/{profile}/subscription/{subscription}', [
    'as' => 'subscriber.updateCourseItems',
    'uses' => 'Subscirber\Course\CourseController@updateCourseItems',
]);

Route::get('/course-item/{item}/delete', [
    'as' => 'subscriber.courseItemsDelete',
    'uses' => 'Subscirber\Course\CourseController@courseItemsDelete',
]);

//Service Add Start
    Route::get('all/sevice-item/of/profile/{profile}/subscription/{subscription}', [
        'as' => 'subscriber.allServiceItems',
        'uses' => 'Subscirber\ServiceItems\ServiceItemController@allServiceItems',
    ]);

    Route::get('add/new/sevice-item/of/profile/{profile}/subscription/{subscription}', [
        'as' => 'subscriber.newServiceItem',
        'uses' => 'Subscirber\ServiceItems\ServiceItemController@newServiceItem',
    ]);
    Route::post('store/sevice-item/of/profile/{profile}/subscription/{subscription}', [
        'as' => 'subscriber.storeServiceItem',
        'uses' => 'Subscirber\ServiceItems\ServiceItemController@storeServiceItem',
    ]);
    Route::get('/sevice-item/{item}/edit/of/profile/{profile}/subscription/{subscription}', [
        'as' => 'subscriber.editServiceItems',
        'uses' => 'Subscirber\ServiceItems\ServiceItemController@editServiceItems',
    ]);
    Route::post('/sevice-item/{item}/update/of/profile/{profile}/subscription/{subscription}', [
        'as' => 'subscriber.updateServiceItems',
        'uses' => 'Subscirber\ServiceItems\ServiceItemController@updateServiceItems',
    ]);

    // Route::get('profile/details/new/service-item/subscription/{subscription}/profile/{profile}', [
    //     'as' => 'subscriber.newServiceItem',
    //     'uses' => 'Subscirber\ServiceItems\ServiceItemController@newServiceItem',
    // ]);
    // Route::post('profile/details/new/service-item/subscription/{subscription}/profile/{profile}', [
    //     'as' => 'subscriber.StoreServiceItem',
    //     'uses' => 'Subscirber\ServiceItems\ServiceItemController@StoreServiceItem',
    // ]);
    // Route::get('profile/subscription/{subscription}/edit/service-item/{item}', [
    //     'as' => 'subscriber.editServiceItems',
    //     'uses' => 'Subscirber\UserSubscriberFreeLanceJobController@newServiceItem',
    // ]);
    //Service add End



    //Shop Products Start
    Route::get('profile/details/new/product/subscription/{subscription}/profile/{profile}', [
        'as' => 'subscriber.newProfileProduct',
        'uses' => 'Subscirber\UserSubscriberFreeLanceJobController@newProfileProduct',
    ]);
    Route::get('profile/subscription/{subscription}/edit/product/{product}', [
        'as' => 'subscriber.editProfileServiceProduct',
        'uses' => 'Subscirber\UserSubscriberFreeLanceJobController@editProfileServiceProduct',
    ]);

    Route::post('profile/create/new/order', [
        'as' => 'subscriber.createServiceProduct',
        'uses' => 'Subscirber\UserSubscriberFreeLanceJobController@createServiceProduct',
    ]);
    Route::get('profile/delete/images/image/{image}', [
        'as' => 'subscriber.deleteServiceProductImages',
        'uses' => 'Subscirber\UserSubscriberFreeLanceJobController@deleteServiceProductImages',
    ]);

    Route::get('profile/my/all/products/subscription/{subscription}/profile/{profile}', [
        'as' => 'subscriber.myAllServiceProfileProducts',
        'uses' => 'Subscirber\UserSubscriberFreeLanceJobController@myAllServiceProfileProducts',
    ]);
    Route::get('profile/view/product/{product}/subscription/{subscription}/profile/{profile}', [
        'as' => 'subscriber.viewServiceProfileProduct',
        'uses' => 'Subscirber\UserSubscriberFreeLanceJobController@viewServiceProfileProduct',
    ]);
    Route::get('profile/delete/product/{product}/subscription/{subscription}', [
        'as' => 'subscriber.deleteServiceProfileProduct',
        'uses' => 'Subscirber\UserSubscriberFreeLanceJobController@deleteServiceProfileProduct',
    ]);
    //Service Products Start

    //Wishlist Start\
    Route::get('my/wishlist/service/products', [
        'as' => 'subscriber.WishlistServiceProfileProduct',
        'uses' => 'Subscirber\UserSubscriberFreeLanceJobController@WishlistServiceProfileProduct',
    ]);
    Route::get('add/wishlist/service/product/{product}', [
        'as' => 'subscriber.addWishlistServiceProfileProduct',
        'uses' => 'Subscirber\UserSubscriberFreeLanceJobController@addWishlistServiceProfileProduct',
    ]);
    //Wishlist End

    //Carts
    Route::get('carts/service/product', [
        'as' => 'subscriber.cartsServiceProfileProduct',
        'uses' => 'Subscirber\UserSubscriberFreeLanceJobController@cartsServiceProfileProduct',
    ]);


    //Carts
    //Course add and enroll
    Route::get('add/to/cart/profile/{profile}/course/{product}/subscription/{subscription}', [
        'as' => 'subscriber.addToCartCourse',
        'uses' => 'Subscirber\Course\CourseController@addToCartCourse',
    ]);

    Route::get('checkout/course/profile/{profile}/subscription/{subscription}', [
        'as' => 'subscriber.checkoutCourse',
        'uses' => 'Subscirber\Course\CourseController@checkoutCourse',
    ]);

    Route::post('order/course/profile/{profile}/subscription/{subscription}', [
        'as' => 'subscriber.courseOrderSubmit',
        'uses' => 'Subscirber\Course\CourseController@courseOrderSubmit',
    ]);

    Route::get('all/course/orders/profile/{profile}/subscription/{subscription}', [
        'as' => 'subscriber.allordersOfCourse',
        'uses' => 'Subscirber\Course\CourseController@allordersOfCourse',
    ]);

    Route::get('orders/details/course/{order}/profile/{profile}/subscription/{subscription}', [
        'as' => 'subscriber.orderDetailsOfCourse',
        'uses' => 'Subscirber\Course\CourseController@orderDetailsOfCourse',
    ]);


    //Service Products Cart Start
    // Route::get('add/to/cart/serivce/profile/{profile}/product/{product}',[])
    Route::get('add/to/cart/service/profile/{profile}/product/{product}/subscription/{subscription}', [
        'as' => 'subscriber.addToCartProduct',
        'uses' => 'Subscirber\ServiceProfileProduct\ServiceProductCartController@addToCartProduct',
    ]);
    Route::get('delete/cart/{cart}/from/service/profile/{profile}/product/subscription/{subscription}', [
        'as' => 'subscriber.deleteCartProduct',
        'uses' => 'Subscirber\ServiceProfileProduct\ServiceProductCartController@deleteCartProduct',
    ]);
    Route::post('update/cart/{cart}/from/service/product', [
        'as' => 'subscriber.updateCartProduct',
        'uses' => 'Subscirber\ServiceProfileProduct\ServiceProductCartController@updateCartProduct',
    ]);

    Route::get('all/cart/products/profile/{profile}/subscription/{subscription}', [
        'as' => 'subscriber.allCartProducts',
        'uses' => 'Subscirber\ServiceProfileProduct\ServiceProductCartController@allCartProducts',
    ]);



    Route::get('checkout/profile/{profile}/subscription/{subscription}', [
        'as' => 'subscriber.checkoutServiceProducts',
        'uses' => 'Subscirber\ServiceProfileProduct\ServiceProductCartController@checkoutServiceProducts',
    ]);
    // Route::post('order/profile/{profile}/subscription/{subscription}', [
    //     'as' => 'subscriber.serviceProductsOrderSubmit',
    //     'uses' => 'Subscirber\ServiceProfileProduct\ServiceProductCartController@serviceProductsOrderSubmit',
    // ]);

    Route::post('order/profile/{profile}/subscription/{subscription}', [
        'as' => 'subscriber.serviceProductsOrderSubmit',
        'uses' => 'Subscirber\ServiceProfileProduct\ServiceProductCartController@serviceProductsOrderSubmit',
    ]);
    Route::get('all/orders/profile/{profile}/subscription/{subscription}', [
        'as' => 'subscriber.allordersOfServiceProducts',
        'uses' => 'Subscirber\ServiceProfileProduct\ServiceProductCartController@allordersOfServiceProducts',
    ]);

    Route::get('orders/details/order/{order}/profile/{profile}/subscription/{subscription}', [
        'as' => 'subscriber.orderDetailsOfServiceProducts',
        'uses' => 'Subscirber\ServiceProfileProduct\ServiceProductCartController@orderDetailsOfServiceProducts',
    ]);

    Route::post('order/item/status/update', [
        'as' => 'subscriber.orderItemStatusUpdateOfServiceProducts',
        'uses' => 'Subscirber\ServiceProfileProduct\ServiceProductCartController@orderItemStatusUpdateOfServiceProducts',
    ]);
    Route::post('order/status/update', [
        'as' => 'subscriber.orderStatusUpdateOfServiceProducts',
        'uses' => 'Subscirber\ServiceProfileProduct\ServiceProductCartController@orderStatusUpdateOfServiceProducts',
    ]);

    Route::post('order/select/deliveryman', [
        'as' => 'subscriber.orderSelectDeliveryman',
        'uses' => 'Subscirber\ServiceProfileProduct\ServiceProductCartController@orderSelectDeliveryman',
    ]);

    Route::get('all/my/orders/in/products/profile/{profile}/subscription/{subscription}', [
        'as' => 'subscriber.allOrdersOfServieProfileProducts',
        'uses' => 'Subscirber\ServiceProfileProduct\ServiceProductCartController@allOrdersOfServieProfileProducts',
    ]);
    Route::get('my/order/{order}/details/profile/{profile}/subscription/{subscription}', [
        'as' => 'subscriber.OrdersOfServieProfileProducts',
        'uses' => 'Subscirber\ServiceProfileProduct\ServiceProductCartController@OrdersOfServieProfileProducts',
    ]);

    //Service Product Cart End
});

// user

Route::group(['middleware' => ['auth'], 'prefix' => 'mypanel'], function () {


    //notification //like //comment start

    Route::any('notify/main/delete', [
        'uses' => 'User\Notification\NotificationController@deleteMainNoti',
        'as' => 'user.deleteMainNoti'
    ]);


    //likers
    Route::any('likers/type/{type}/id/{id?}', [
        'uses' => 'User\Like\LikeController@likers',
        'as' => 'user.likers'
    ]);

    //like create
    Route::get('like/create/type/{type}/id/{id}', [
        'uses' => 'User\Like\LikeController@likeCreate',
        'as' => 'user.likeCreate'
    ]);

    //comment create
    Route::any('comment/create/type/{type}/id/{id?}', [
        'uses' => 'User\Comment\CommentController@commentCreate',
        'as' => 'user.commentCreate'
    ]);

    //delete item
    Route::any('item/delete/type/{type?}/id/{id?}', [
        'uses' => 'User\DeleteController@itemDelete',
        'as' => 'user.itemDelete'
    ]);

    //notification //like //comment end

   //job and vacancy announcee

   //Drop  Cv

   Route::get('jobdashboard', [
        'uses' => 'User\UserDashborad\UserDashboardController@jobdashboard',
        'as' => 'user.jobdashboard'
    ]);



    Route::get('jobs/dropcv/dashboard', [
        'uses' => 'Softjobs\DropCvController@dashboard',
        'as' => 'dropcv.dashboard'
    ]);

    Route::get('jobs/createcvprofile', [
        'uses' => 'Softjobs\DropCvController@createjobprofile',
        'as' => 'dropcv.createcvprofile'
    ]);
    Route::post('jobs/jobseekerprimaryinfostore', [
        'uses' => 'Softjobs\DropCvController@storejobseekerprimaryinfo',
        'as' => 'dropcv.storejobseekerprimaryinfo'
    ]);

    //Vacancy Announce

    Route::get('jobs/createjobcompanyprofile', [
        'uses' => 'Softjobs\VacancyAnnounceController@createjobcompanyprofile',
        'as' => 'vacancyannounce.createjobcompanyprofile'
    ]);

    Route::post('jobs/jobannouncerprimaryinfostore', [
        'uses' => 'Softjobs\VacancyAnnounceController@jobannouncerprimaryinfostore',
        'as' => 'vacancyannounce.jobannouncerprimaryinfostore'
    ]);

    Route::get('jobs/vacancyannounce/dashboard', [
        'uses' => 'Softjobs\VacancyAnnounceController@dashboard',
        'as' => 'vacancyannounce.dashboard'
    ]);


    Route::get('jobs/createvacancyannouncejobpost', [
        'uses' => 'Softjobs\VacancyAnnounceController@createvacancyannouncejobpost',
        'as' => 'vacancyannounce.createvacancyannouncejobpost'
    ]);



   //end jobs




//Soft commerce candidate apply

Route::get('user/softcommerce/candidate/apply/list', [
    'uses' => 'User\UserDashborad\UserDashboardController@SoftcomJobApplyList',
    'as' => 'user.SoftcomJobApplyList'
]);
Route::get('user/softcommerce/candidate/applyform', [
    'uses' => 'User\UserDashborad\UserDashboardController@SoftcomJobApplyForm',
    'as' => 'user.SoftcomJobApplyForm'
]);


Route::post('user/softcommerce/candidate/applyform/store/', [
    'uses' => 'User\UserDashborad\UserDashboardController@SoftcomJobApplyStore',
    'as' => 'user.SoftcomJobApplyStore'
]);

Route::get('user/softcommerce/candidate/applyform/delete/{id}', [
    'uses' => 'User\UserDashborad\UserDashboardController@SoftcomJobApplyDelete',
    'as' => 'user.SoftcomJobApplyDelete'
]);


Route::get('user/softcommerce/candidate/apply/approved/list', [
    'uses' => 'User\UserDashborad\UserDashboardController@SoftcomJobCandidateApprovedList',
    'as' => 'user.SoftcomJobCandidateApprovedList'
]);


//End Soft commerce candidate apply

//Assign Worker For Service Profile

Route::get('user/softcommerce/profile/worker/assign/{workerid}', [
    'uses' => 'User\UserDashborad\UserDashboardController@AssignApplicantforServiceprofile',
    'as' => 'user.AssignApplicantforServiceprofile'
]);

Route::post('user/softcommerce/profile/worker/assign/store', [
    'uses' => 'User\UserDashborad\UserDashboardController@AssignApplicantforServiceprofileStore',
    'as' => 'user.AssignApplicantforServiceprofileStore'
]);

Route::get('user/softcommerce/myprofile/worker/list', [
    'uses' => 'User\UserDashborad\UserDashboardController@MyProfileworkerlist',
    'as' => 'user.MyProfileworkerlist'
]);

Route::get('user/softcommerce/myprofile/worker/details/{id}', [
    'uses' => 'User\UserDashborad\UserDashboardController@MyProfileworkerdetails',
    'as' => 'user.MyProfileworkerdetails'
]);

Route::get('user/softcommerce/myworked/profile/list', [
    'uses' => 'User\UserDashborad\UserDashboardController@MyworkedProfilelist',
    'as' => 'user.MyworkedProfilelist'
]);

Route::get('user/softcommerce/myworked/get/salary/{id}', [
    'uses' => 'User\UserDashborad\UserDashboardController@WorkerGetSalary',
    'as' => 'user.WorkerGetSalary'
]);


Route::get('user/softcommerce/myprofile/worker/renew/{id}', [
    'uses' => 'User\UserDashborad\UserDashboardController@WorkerRenew',
    'as' => 'user.WorkerRenew'
]);

Route::get('user/softcommerce/myprofile/worker/edit/{id}', [
    'uses' => 'User\UserDashborad\UserDashboardController@editworkeraccess',
    'as' => 'user.editworkeraccess'
]);

Route::post('user/softcommerce/myprofile/worker/update/{id}', [
    'uses' => 'User\UserDashborad\UserDashboardController@updateworkeraccess',
    'as' => 'user.updateworkeraccess'
]);


//End sign Worker For Service Profile



Route::get('user/product/deliveryman/create', [
    'uses' => 'User\UserDashborad\UserDashboardController@createdeliveryman',
    'as' => 'user.createdeliveryman'
]);

Route::get('user/product/deliveryman/edit/{id}', [
    'uses' => 'User\UserDashborad\UserDashboardController@editdeliveryman',
    'as' => 'user.editdeliveryman'
]);

Route::get('user/product/deliveryman/index', [
    'uses' => 'User\UserDashborad\UserDashboardController@listdeliveryman',
    'as' => 'user.listdeliveryman'
]);

Route::post('user/product/deliveryman/store/', [
    'uses' => 'User\UserDashborad\UserDashboardController@storedeliveryman',
    'as' => 'user.storedeliveryman'
]);


Route::post('user/product/deliveryman/update/{id}', [
    'uses' => 'User\UserDashborad\UserDashboardController@updatedeliveryman',
    'as' => 'user.updatedeliveryman'
]);

Route::get('user/product/deliveryman/delete/{id}', [
    'uses' => 'User\UserDashborad\UserDashboardController@deletedeliveryman',
    'as' => 'user.deletedeliveryman'
]);



//User Review and rating
Route::post('profile/review/rating/store', [
    'uses' => 'User\UserDashborad\UserDashboardController@ratingstore',
    'as' => 'user.ratingstore'
]);

Route::get('profile/review/rating/delete/{id}', [
    'uses' => 'User\UserDashborad\UserDashboardController@ratingdelete',
    'as' => 'user.ratingdelete'
]);





    Route::get('dashboard', [
        'uses' => 'User\UserDashborad\UserDashboardController@dashboard',
        'as' => 'user.dashboard'
    ]);
    Route::get('/page', [
        'uses' => 'User\UserDashborad\UserDashboardController@getUsers',
        'as' => 'user.ajax'
    ]);
    Route::get('dashboard/login/as/admin/user/{user}', [
        'uses' => 'User\UserDashborad\UserDashboardController@loginAsAdmin',
        'as' => 'user.loginAsAdmin'
    ]);
    // Favourate Start
    Route::any('dashboard/add/to/favourite/type/{type}/typeid/{typeid}', [
        'uses' => 'User\UserDashborad\UserDashboardController@addTofavourite',
        'as' => 'user.addTofavourite'
    ]);
    Route::get('dashboard/favourite', [
        'uses' => 'User\UserDashborad\UserDashboardController@favourite',
        'as' => 'user.favourite'
    ]);


    //Order Notifications

    Route::get('dashboard/notificationslist', [
        'uses' => 'User\UserNotificationsController@notificationslist',
        'as' => 'user.notificationslist'
    ]);

    Route::get('dashboard/notificationsdetails/{id}', [
        'uses' => 'User\UserNotificationsController@notificationsdetails',
        'as' => 'user.notificationsdetails'
    ]);


    // Favourate Start

    Route::get('dashboard/my/needs', [
        'uses' => 'User\UserDashborad\UserDashboardController@myNeeds',
        'as' => 'user.myNeeds'
    ]);

    Route::get('dashboard/my/needs/{need}/details', [
        'uses' => 'User\UserDashborad\UserDashboardController@myNeedDetails',
        'as' => 'user.myNeedDetails'
    ]);
    Route::post('dashboard/my/needs/update', [
        'uses' => 'User\UserDashborad\UserDashboardController@myNeedUpdate',
        'as' => 'user.myNeedUpdate'
    ]);
    Route::get('dashboard/my/needs/{need}/edit', [
        'uses' => 'User\UserDashborad\UserDashboardController@myNeedEdit',
        'as' => 'user.myNeedEdit'
    ]);
    Route::get('dashboard/my/needs/{need}/bid/{bid}', [
        'uses' => 'User\UserDashborad\UserDashboardController@myNeedBidDetails',
        'as' => 'user.myNeedBidDetails'
    ]);
    Route::post('dashboard/update/my/needs/bid', [
        'uses' => 'User\UserDashborad\UserDashboardController@myNeedBidUpdate',
        'as' => 'user.myNeedBidUpdate'
    ]);
    Route::get('dashboard/my/bids/status/{status}', [
        'uses' => 'User\UserDashborad\UserDashboardController@myBids',
        'as' => 'user.myBids'
    ]);
    Route::get('dashboard/my/bid/{bid}/details/', [
        'uses' => 'User\UserDashborad\UserDashboardController@myBidDetails',
        'as' => 'user.myBidDetails'
    ]);
    Route::post('dashboard/update/bid/status', [
        'uses' => 'User\UserDashborad\UserDashboardController@updateBidStatus',
        'as' => 'user.updateBidStatus'
    ]);
    Route::get('dashboard/softcode-freelancing', [
        'uses' => 'User\UserDashborad\UserDashboardController@softcodeFreelancing',
        'as' => 'user.softcodeFreelancing'
    ]);

    Route::get('dashboard/softcommerce', [
        'uses' => 'User\UserDashborad\UserDashboardController@softcommerce',
        'as' => 'user.softcommerce'
    ]);
    Route::get('dashboard/softcommerce/userwithdrawdetails', [
        'uses' => 'User\UserDashborad\UserDashboardController@userwithdrawdetails',
        'as' => 'user.userwithdrawdetails'
    ]);
    Route::get('dashboard/softcommerce/userdepositdetails', [
        'uses' => 'User\UserDashborad\UserDashboardController@userdepositdetails',
        'as' => 'user.userdepositdetails'
    ]);

    //publish and unpublish service

    Route::get('dashboard/user/publishservice', [
        'uses' => 'User\UserDashborad\UserDashboardController@userpublishservice',
        'as' => 'user.userpublishservice'
    ]);

    Route::get('dashboard/user/unpublishservice', [
        'uses' => 'User\UserDashborad\UserDashboardController@userunpublishservice',
        'as' => 'user.userunpublishservice'
    ]);

    Route::get('dashboard/user/usertrialservice', [
        'uses' => 'User\UserDashborad\UserDashboardController@usertrialservice',
        'as' => 'user.usertrialservice'
    ]);

    Route::get('dashboard/user/vendorlist', [
        'uses' => 'User\UserDashborad\UserDashboardController@uservendorlist',
        'as' => 'user.uservendorlist'
    ]);







    Route::get('dashboard/purchase', [
        'uses' => 'User\UserDashborad\UserDashboardController@purchase',
        'as' => 'user.purchase'
    ]);
    Route::get('dashboard/sales', [
        'uses' => 'User\UserDashborad\UserDashboardController@sales',
        'as' => 'user.sales'
    ]);




    //Make Service Profile
    Route::get('create/service/profile', [
        'uses' => 'User\UserDashborad\UserDashboardController@makeServiceProfile',
        'as' => 'user.makeServiceProfile'
    ]);

    Route::post('create/user/for/service/profile', [
        'uses' => 'User\UserDashborad\UserDashboardController@makeUserCreateForServiceProfile',
        'as' => 'user.makeUserCreateForServiceProfile'
    ]);
    Route::post('store/service/profile/info/from/user', [
        'uses' => 'User\UserDashborad\UserDashboardController@storeServiceProfileFromUser',
        'as' => 'user.storeServiceProfileFromUser'
    ]);

    Route::get('dashboard/service/items', [
        'uses' => 'User\UserDashborad\UserDashboardController@ServieItems',
        'as' => 'user.ServieItems'
    ]);
    Route::get('dashboard/service/orders', [
        'uses' => 'User\UserDashborad\UserDashboardController@ServieItemOrders',
        'as' => 'user.ServieItemOrders'
    ]);



    Route::get('dashboard/service/details/order/{order}/type/{type}', [
        'uses' => 'User\UserDashborad\UserDashboardController@ServieItemOrderDetails',
        'as' => 'user.ServieItemOrderDetails'
    ]);

    Route::get('dashboard/service/orders/get', [
        'uses' => 'User\UserDashborad\UserDashboardController@getServieItemOrders',
        'as' => 'user.getServieItemOrders'
    ]);


    //Enroll Course
    Route::get('dashboard/course/enrolled', [
        'uses' => 'User\UserDashborad\UserDashboardController@EnrollCourse',
        'as' => 'user.EnrollCourse'
    ]);

    Route::get('dashboard/my/course/{order}', [
        'uses' => 'User\UserDashborad\UserDashboardController@EnrollCourseDetails',
        'as' => 'user.EnrollCourseDetails'
    ]);

    // Route::get('create/service/profile', [
    //     'uses' => 'Admin\AdminController@makeServiceProfile',
    //     'as' => 'admin.makeServiceProfile'
    // ]);
    //Make Service Profile

    //sharif
    Route::get('dashboard/connecting-friends', [
        'uses' => 'User\UserDashborad\UserDashboardController@connectingfriends',
        'as' => 'user.connectingfriends'
    ]);
    Route::get('dashboard/share-link', [
        'uses' => 'User\UserDashborad\UserDashboardController@sharelink',
        'as' => 'user.sharelink'
    ]);
    //end
    Route::get('softcode/freelanching/dashboard', [
        'uses' => 'User\UserDashborad\UserDashboardController@softcodeFreelanchingDashboard',
        'as' => 'user.softcodeFreelanching'
    ]);
    //Reffer History And Modify for User. if the admin allow  ===>> Start
    Route::get('dashboard/reffer', [
        'uses' => 'User\UserDashborad\UserDashboardController@reffer',
        'as' => 'user.reffer'
    ]);
    Route::get('dashboard/reffer/details', [
        'uses' => 'User\UserDashborad\UserDashboardController@reffersaleshistory',
        'as' => 'user.reffersaleshistory'
    ]);
    Route::get('dashboard/reffer/subscription/{subscription}/edit', [
        'uses' => 'User\UserDashborad\UserDashboardController@subscriberEdit',
        'as' => 'user.subscriberEdit'
    ]);
    //Reffer History And Modify for User. if the admin allow  ===>> End
    Route::get('dashboard/softcommerce/my/profile', [
        'uses' => 'User\UserDashborad\UserDashboardController@myProfile',
        'as' => 'user.myProfile'
    ]);
    //Employee Routes

    Route::get('dashboard/employee/createprofile', [
        'uses' => 'User\UserDashborad\EmployeeDashboardController@EmployeeCreateProfileList',
        'as' => 'user.employecreateprofilelist'
    ]);
    Route::get('dashboard/categorylist/commissioncheck', [
        'uses' => 'User\UserDashborad\EmployeeDashboardController@categorycommissioncheck',
        'as' => 'user.categorycommissioncheck'
    ]);

    Route::get('dashboard/employee/createprofile/{user}/filter/{type}', [
        'uses' => 'User\UserDashborad\EmployeeDashboardController@EmployeeCreateProfileListFilter',
        'as' => 'user.employecreateprofilelistfilter'
    ]);

    Route::get('dashboard/employee/myteam', [
        'uses' => 'User\UserDashborad\EmployeeDashboardController@myteam',
        'as' => 'user.myteam'
    ]);

    Route::get('myteam/history/employee/{user}/type/{type}/status/{status?}', [
        'uses' => 'User\UserDashborad\EmployeeDashboardController@EmployeeHistoryInfo',
        'as' => 'user.EmployeeHistoryInfo'
    ]);





    //Get Auto lat lng in user Table Start
    Route::get('dashboard/user/location/set', [
        'uses' => 'User\UserDashborad\UserDashboardController@dashboard',
        'as' => 'user.locationSet'
    ]);

    //What Do you want Start

    Route::get('dashboard/what/do/you/want', [
        'uses' => 'User\UserDashborad\UserDashboardController@whatDoYouWant',
        'as' => 'user.whatDoYouWant'
    ]);
    Route::post('dashboard/store/needs', [
        'uses' => 'User\UserDashborad\UserDashboardController@storeNeeds',
        'as' => 'user.storeNeeds'
    ]);
    Route::get('dashboard/need/{need}', [
        'uses' => 'User\UserDashborad\UserDashboardController@needDetails',
        'as' => 'user.needDetails'
    ]);
    Route::post('dashboard/store/bid', [
        'uses' => 'User\UserDashborad\UserDashboardController@storeBid',
        'as' => 'user.storeBid'
    ]);
    //Whtat Do you want End

    //Complain or Suggessions START

    Route::get('dashboard/suggessions', [
        'uses' => 'User\UserDashborad\UserDashboardController@suggesions',
        'as' => 'user.suggesions'
    ]);
    Route::post('dashboard/store-suggessions', [
        'uses' => 'User\UserDashborad\UserDashboardController@storeSuggesion',
        'as' => 'user.storeSuggesion'
    ]);
    Route::get('dashboard/store-suggession/{suggession}', [
        'uses' => 'User\UserDashborad\UserDashboardController@viewSuggesion',
        'as' => 'user.viewSuggesion'
    ]);
    Route::post('dashboard/suggessions/by/chat/parent/{parent}/type/{type}', [
        'uses' => 'User\UserDashborad\UserDashboardController@addSuggesionsPost',
        'as' => 'user.addSuggesionsPost'
    ]);
    Route::get('dashboard/suggessions/by/chat/parent/{parent}/closed', [
        'uses' => 'User\UserDashborad\UserDashboardController@CloseSuggesionsPost',
        'as' => 'user.CloseSuggesionsPost'
    ]);

    Route::get('dashboard/suggessions/by/chat/parent/{parent}/open', [
        'uses' => 'User\UserDashborad\UserDashboardController@OpenSuggesionsPost',
        'as' => 'user.OpenSuggesionsPost'
    ]);

    Route::get('dashboard/suggessions/closed/chat', [
        'uses' => 'User\UserDashborad\UserDashboardController@ClosedSuggestionChat',
        'as' => 'user.ClosedSuggestionChat'
    ]);
    Route::get('dashboard/suggessions/closed/chat/details', [
        'uses' => 'User\UserDashborad\UserDashboardController@closedSuggestionChatDetails',
        'as' => 'user.closedSuggestionChatDetails'
    ]);

    Route::any('dashboard/service-product-search-ajax', [
        'uses' => 'User\UserDashborad\UserDashboardController@ServiceProductSearchAjax',
        'as' => 'user.ServiceProductSearchAjax'
    ]);

    Route::any('dashboard/service-profile-cat-search-ajax/{cat}', [
        'uses' => 'User\UserDashborad\UserDashboardController@ServiceProfileCatSearchAjax',
        'as' => 'user.ServiceProfileCatSearchAjax'
    ]);

    Route::any('dashboard/course-search-ajax', [
        'uses' => 'User\UserDashborad\UserDashboardController@courseSearchAjax',
        'as' => 'user.courseSearchAjax'
    ]);


    Route::any('dashboard/service-category-search-ajax', [
        'uses' => 'User\UserDashborad\UserDashboardController@ServiceCategorySearchAjax',
        'as' => 'user.ServiceCategorySearchAjax'
    ]);
    // Route::get('search/product/ajax', [
    //     'uses' => 'Admin\UserDashboardController@ServiceProductSearchAjax',
    //     'as' => 'user.ServiceProductSearchAjax'
    // ]);

    //Complain or Suggessions END


    //Get Auto lat lng in user Table End
    //Date 10-04-2021 Start

    Route::get('dashboard/my/services', [
        'uses' => 'User\UserDashborad\UserDashboardController@myServicesDashboard',
        'as' => 'user.myServicesDashboard'
    ]);
    Route::get('dashboard/my/services/profile/{profile}/update/open/{open}', [
        'uses' => 'User\UserDashborad\UserDashboardController@myServicesprofileUpdate',
        'as' => 'user.myServicesprofileUpdate'
    ]);

    Route::get('dashboard/services/search', [
        'uses' => 'User\UserDashborad\UserDashboardController@servicesSearchDashboard',
        'as' => 'user.servicesSearchDashboard'
    ]);
    Route::post('dashboard/services/search/ajax', [
        'uses' => 'User\UserDashborad\UserDashboardController@searchCategoryAjax',
        'as' => 'user.searchCategoryAjax'
    ]);

    Route::get('dashboard/services/search/filter', [
        'uses' => 'User\UserDashborad\UserDashboardController@servicesSearchFilterDashboard',
        'as' => 'user.servicesSearchFilterDashboard'
    ]);
    Route::get('dashboard/type/{type}', [
        'uses' => 'User\UserDashborad\UserDashboardController@postPaidOrFullPaidDashboard',
        'as' => 'user.postPaidOrFullPaidDashboard'
    ]);

    Route::get('dashboard/all/service/station', [
        'uses' => 'User\UserDashborad\UserDashboardController@allSubscribersStation',
        'as' => 'user.allSubscribersStation'
    ]);

    Route::get('dashboard/create/acc/inall/categories', [
        'uses' => 'User\UserDashborad\UserDashboardController@createPostpaidAccountInAllCat',
        'as' => 'user.createPostpaidAccountInAllCat'
    ]);
    //Add Service Products
    Route::get('dashboard/add/service/product', [
        'uses' => 'User\UserDashborad\UserDashboardController@addServiceProduct',
        'as' => 'user.addServiceProduct'
    ]);
    Route::post('dashboard/order/wise/category', [
        'uses' => 'User\UserDashborad\UserDashboardController@searchOrderwiseCategoryAjax',
        'as' => 'user.searchOrderwiseCategoryAjax'
    ]);

    Route::post('dashboard/submit/profile/product', [
        'uses' => 'User\UserDashborad\UserDashboardController@submitServiceProduct',
        'as' => 'user.submitServiceProduct'
    ]);


    Route::post('dashboard/check/service/profile/', [
        'uses' => 'User\UserDashborad\UserDashboardController@checkServiceProfile',
        'as' => 'user.checkServiceProfile'
    ]);
    //Openion
    Route::get('dashboard/all/opinions', [
        'uses' => 'User\UserDashborad\UserDashboardController@allOpinions',
        'as' => 'user.allOpinions'
    ]);
    Route::get('dashboard/add/opinions', [
        'uses' => 'User\UserDashborad\UserDashboardController@addOpinions',
        'as' => 'user.addOpinions'
    ]);
    Route::post('dashboard/store/opinion', [
        'uses' => 'User\UserDashborad\UserDashboardController@storeOpinions',
        'as' => 'user.storeOpinions'
    ]);
    Route::get('dashboard/view/opinion/{opinion}', [
        'uses' => 'User\UserDashborad\UserDashboardController@viewOpinion',
        'as' => 'user.viewOpinion'
    ]);
    Route::get('dashboard/edit/opinion/{opinion}', [
        'uses' => 'User\UserDashborad\UserDashboardController@editOpinion',
        'as' => 'user.editOpinion'
    ]);
    Route::post('dashboard/update/opinion', [
        'uses' => 'User\UserDashborad\UserDashboardController@updateOpinion',
        'as' => 'user.updateOpinion'
    ]);

    Route::get('dashboard/my/opinions', [
        'uses' => 'User\UserDashborad\UserDashboardController@myOpinions',
        'as' => 'user.myOpinions'
    ]);
    Route::get('dashboard/delete/opinion/{opinion}', [
        'uses' => 'User\UserDashborad\UserDashboardController@deleteOpinion',
        'as' => 'user.deleteOpinion'
    ]);

    //My Orders
    Route::get('dashboard/my/all/orders', [
        'uses' => 'User\UserDashborad\UserDashboardController@myOrders',
        'as' => 'user.myOrders'
    ]);
    Route::get('dashboard/my/order/{order}', [
        'uses' => 'User\UserDashborad\UserDashboardController@myOrderDetails',
        'as' => 'user.myOrderDetails'
    ]);
    Route::post('dashboard/my/order/update', [
        'uses' => 'User\UserDashborad\UserDashboardController@myOrderDetailsUpdate',
        'as' => 'user.myOrderDetailsUpdate'
    ]);

    Route::get('dashboard/my/service/profile/orders', [
        'uses' => 'User\UserDashborad\UserDashboardController@myServieProfileOrders',
        'as' => 'user.myServieProfileOrders'
    ]);

    Route::get('dashboard/my/service/profile/orders/pending/balance', [
        'uses' => 'User\UserDashborad\UserDashboardController@orderpendingbalancedetails',
        'as' => 'user.orderpendingbalancedetails'
    ]);

    Route::get('dashboard/my/service/profile/{profile}/orders/order/{order}', [
        'uses' => 'User\UserDashborad\UserDashboardController@myProfileOrderDetails',
        'as' => 'user.myProfileOrderDetails'
    ]);
    Route::get('dashboard/my/service/profile/products', [
        'uses' => 'User\UserDashborad\UserDashboardController@myServieProfileProducts',
        'as' => 'user.myServieProfileProducts'
    ]);
    Route::get('dashboard/edit/my/service/profile/product/{product}', [
        'uses' => 'User\UserDashborad\UserDashboardController@editMyServieProfileProducts',
        'as' => 'user.editMyServieProfileProducts'
    ]);
    Route::get('dashboard/my/service/profile/product/{product}/activation/{active}', [
        'uses' => 'User\UserDashborad\UserDashboardController@myServieProfileProductsUpdateActive',
        'as' => 'user.myServieProfileProductsUpdateActive'
    ]);


    Route::get('dashboard/delete/my/service/profile/product/{product}', [
        'uses' => 'User\UserDashborad\UserDashboardController@deleteMyServieProfileProducts',
        'as' => 'user.deleteMyServieProfileProducts'
    ]);

    Route::post('dashboard/my/service/profile/products/priceupdate', [
        'uses' => 'User\UserDashborad\UserDashboardController@updateproductpricelist',
        'as' => 'user.updateproductpricelist'
    ]);

    Route::get('dashboard/softmarket', [
        'uses' => 'User\UserDashborad\UserDashboardController@softmarket',
        'as' => 'user.softmarket'
    ]);

//Auto search in laravel

Route::get('search', ['uses' => 'AutocompleteSearchController@autosearch', 'as' => 'search']);



    Route::get('dashboard/softmarket/cat/{cat}', [
        'uses' => 'User\UserDashborad\UserDashboardController@catwiseShop',
        'as' => 'user.catwiseShop'
    ]);

    Route::get('dashboard/softmarket/cat/product/{cat}', [
        'uses' => 'User\UserDashborad\UserDashboardController@catwiseProduct',
        'as' => 'user.catwiseProduct'
    ]);
    Route::get('dashboard/softmarket/category/{category}', [
        'uses' => 'User\UserDashborad\UserDashboardController@softmarketSearch',
        'as' => 'user.softmarketSearch'
    ]);

    Route::get('dashboard/check/subscription/profile/{profile}', [
        'uses' => 'User\UserDashborad\UserDashboardController@profileCheckForShop',
        'as' => 'user.profileCheckForShop'
    ]);

    Route::get('dashboard/products', [
        'uses' => 'User\UserDashborad\UserDashboardController@serviceProducts',
        'as' => 'user.serviceProducts'
    ]);

    Route::get('dashboard/course', [
        'uses' => 'User\UserDashborad\UserDashboardController@Courseitem',
        'as' => 'user.Courseitem'
    ]);
    Route::get('dashboard/service', [
        'uses' => 'User\UserDashborad\UserDashboardController@userService',
        'as' => 'user.userService'
    ]);
    Route::any('dashboard/service/search/ajax', [
        'uses' => 'User\UserDashborad\UserDashboardController@serviceSearchAjax',
        'as' => 'user.serviceSearchAjax'
    ]);
    Route::get('dashboard/service/products/check/profile/{profile}/for/product/{product}/type/{type}', [
        'uses' => 'User\UserDashborad\UserDashboardController@serviceProductsCheckForAddToCart',
        'as' => 'user.serviceProductsCheckForAddToCart'
    ]);

    //Date 10-04-2021 End

    //MY Blog Start
    Route::get('dashboard/my/blogs', [
        'uses' => 'User\UserDashborad\UserDashboardController@myBlog',
        'as' => 'user.myBlog'
    ]);
    Route::get('dashboard/my/blog/{blog}/edit', [
        'uses' => 'User\UserDashborad\UserDashboardController@editMyBlog',
        'as' => 'user.editMyBlog'
    ]);
    Route::post('dashboard/my/blog/{blog}/update', [
        'uses' => 'User\UserDashborad\UserDashboardController@updateMyBlog',
        'as' => 'admin.updateMyBlog'
    ]);



    //MY blog end


    Route::get('user/balance/info', [
        'uses' => 'User\UserDashborad\UserDashboardController@userBalance',
        'as' => 'user.userBalance'
    ]);
    Route::get('user/due/balance/pay', [
        'uses' => 'User\UserDashborad\UserDashboardController@userpaydue',
        'as' => 'user.userpaydue'
    ]);

    Route::post('add/balance/to/wallet', [
        'as' => 'user.addBalanceToWallet',
        'uses' => 'User\UserDashborad\UserDashboardController@addBalanceToWallet'
    ]);

    Route::post('user/add/balance/to/account/order/{order}', [
        'uses' => 'User\UserDashborad\UserDashboardController@balaceRechargeRequest',
        'as' => 'user.balaceRechargeRequest'
    ]);


    Route::get('tenant/edit/info', [
        'uses' => 'User\UserDashborad\UserDashboardController@userEdit',
        'as' => 'user.userEdit'
    ]);

    Route::get('tenant/pin/change', [
        'uses' => 'User\UserDashborad\UserDashboardController@userPinChange',
        'as' => 'user.userPinChange'
    ]);
    Route::get('tenant/check/pin', [
        'uses' => 'User\UserDashborad\UserDashboardController@userPinCheck',
        'as' => 'user.userPinCheck'
    ]);
    Route::get('tenant/pin/set', [
        'uses' => 'User\UserDashborad\UserDashboardController@userPinSet',
        'as' => 'user.userPinSet'
    ]);

    Route::get('tenant/settings', [
        'uses' => 'User\UserDashborad\UserDashboardController@userSettings',
        'as' => 'user.userSettings'
    ]);
    Route::post('tenant/pass/check', [
        'uses' => 'User\UserDashborad\UserDashboardController@userPassCheck',
        'as' => 'user.userPassCheck'
    ]);
    Route::post('tenant/OTP/check', [
        'uses' => 'User\UserDashborad\UserDashboardController@userOTPCheck',
        'as' => 'user.userOTPCheck'
    ]);

    Route::post('tenant/pin/update', [
        'uses' => 'User\UserDashborad\UserDashboardController@userPinUpdate',
        'as' => 'user.userPinUpdate'
    ]);


    Route::get('tenant/password/change', [
        'uses' => 'User\UserDashborad\UserDashboardController@userPasswordChange',
        'as' => 'user.userPasswordChange'
    ]);

    Route::post('tenant/password/update', [
        'uses' => 'User\UserDashborad\UserDashboardController@userPasswordUpdate',
        'as' => 'user.userPasswordUpdate'
    ]);

    Route::post('user/update', [
        'uses' => 'User\UserDashborad\UserDashboardController@userUpdate',
        'as' => 'user.userUpdate'
    ]);

    Route::post('user/newsubscription/category/{cat}', [
        'uses' => 'User\UserDashborad\UserDashboardController@newsubscription',
        'as' => 'user.newsubscription'
    ]);

    Route::get('user/newsubscription-paid/category/{cat}', [
        'uses' => 'User\UserDashborad\UserDashboardController@newsubscriptionPaid',
        'as' => 'user.newsubscriptionPaid'
    ]);



    Route::get('user/newsubscription-postpaid/category/{cat}', [
        'uses' => 'User\UserDashborad\UserDashboardController@newsubscriptionFree',
        'as' => 'user.newsubscriptionFree'
    ]);

    //user withdrawal account add

    Route::get('user/addwithdrawalaccount', [
        'uses' => 'User\UserDashborad\UserDashboardController@addwithdrawalaccount',
        'as' => 'user.addwithdrawalaccount'
    ]);


    Route::get('user/withdrawalaccountlist', [
        'uses' => 'User\UserDashborad\UserDashboardController@withdrawalaccountlist',
        'as' => 'user.withdrawalaccountlist'
    ]);

    Route::post('user/withdrawalaaccountstore', [
        'uses' => 'User\UserDashborad\UserDashboardController@withdrawalaaccountstore',
        'as' => 'user.withdrawalaaccountstore'
    ]);

    Route::post('user/withdrawalaaccountupdate/{id}', [
        'uses' => 'User\UserDashborad\UserDashboardController@withdrawalaaccountupdate',
        'as' => 'user.withdrawalaaccountupdate'
    ]);


    Route::get('user/withdrawalaccountedit/{id}', [
        'uses' => 'User\UserDashborad\UserDashboardController@withdrawalaccountedit',
        'as' => 'user.withdrawalaccountedit'
    ]);

    Route::get('user/withdrawalaccountdelete/{id}', [
        'uses' => 'User\UserDashborad\UserDashboardController@withdrawalaccountdelete',
        'as' => 'user.withdrawalaccountdelete'
    ]);


    //end user withdrawal account

    // user withdraw

    Route::get('balance/withdraw', [
        'uses' => 'User\Withdraw\UserBalanceWithdrawController@commissionWithdraw',
        'as' => 'user.commissionWithdraw'
    ]);

    Route::get('pin/check', [
        'uses' => 'User\Withdraw\UserBalanceWithdrawController@pinCheck',
        'as' => 'user.pinCheck'
    ]);

    Route::get('new/pin/send', [
        'uses' => 'User\Withdraw\UserBalanceWithdrawController@newPinSend',
        'as' => 'user.newPinSend'
    ]);

    Route::post('commission/withdraw/post', [
        'uses' => 'User\Withdraw\UserBalanceWithdrawController@commissionWithdrawPost',
        'as' => 'user.commissionWithdrawPost'
    ]);

    Route::post('commission/directwithdraw/post', [
        'uses' => 'User\Withdraw\UserBalanceWithdrawController@directwithdraw',
        'as' => 'user.directwithdraw'
    ]);

    // Route::post('withdraw/list', [
    //     'uses' =>'User\Withdraw\UserBalanceWithdrawController@withdrawList',
    //     'as' => 'user.withdrawList'
    // ]);

    Route::get('commission/transfer-states', [
        'uses' => 'User\Withdraw\UserBalanceWithdrawController@commissionTransferStates',
        'as' => 'user.commissionTransferStates'
    ]);

    Route::get('commission/withdraw-states', [
        'uses' => 'User\Withdraw\UserBalanceWithdrawController@commissionWithdrawStates',
        'as' => 'user.commissionWithdrawStates'
    ]);

    //job
    Route::get('find/jobs/all', [
        'uses' => 'User\UserDashborad\UserDashboardController@job',
        'as' => 'user.job'
    ]);

    Route::get('post/jobs/all', [
        'uses' => 'User\UserDashborad\UserDashboardController@postJob',
        'as' => 'user.postJob'
    ]);


    Route::get('search/left-category/ajax', [
        'uses' => 'User\UserDashborad\UserDashboardController@searchLeftCategoryAjax',
        'as' => 'user.searchLeftCategoryAjax'
    ]);






    //post //like


    // Route::get('like/create/{type}/{item_id}', [
    // 'uses' =>'UserController@likeCreate',
    // 'as' => 'user.likeCreate'
    // ]);

    // Route::get('post/likers/{post}', [
    //     'uses' =>'UserController@postLikers',
    //     'as' => 'user.postLikers'
    //     ]);
    //      Route::get('post-likers/all/{post}', [
    //     'uses' =>'UserController@postLikersAll',
    //     'as' => 'user.postLikersAll'
    //     ]);

    // Route::get('all/likers/{type}/{item_id}', [
    //     'uses' =>'UserController@allLikers',
    //     'as' => 'user.allLikers'
    //     ]);
    // Route::get('all-likers/listing/{type}/{item_id}', [
    //     'uses' =>'UserController@allLikersListing',
    //     'as' => 'user.allLikersListing'
    //     ]);

    //post //like



});



//Add New Service/Business Profile Mobile search   oli write this code


Route::get('select/new/role', [
    'as' => 'admin.selectNewRole',
    'uses' => 'Admin\AdminController@selectNewRole'
]);

Route::post('fetch/wt/cat/for/service/profile', [
    'uses' => 'Admin\AdminController@fetchAjaxData',
    'as' => 'admin.fetchAjaxData'
]);



//admin
Route::group(['middleware' => ['role:admin', 'auth'], 'prefix' => 'admin'], function () {

    Route::get('dashboard', [
        'uses' => 'Admin\AdminController@dashboard',
        'as' => 'admin.dashboard'
    ]);


    Route::get('dashboardmain', [
        'uses' => 'Admin\AdminController@dashboardmain',
        'as' => 'admin.dashboardmain'
    ]);
    Route::get('dashboardsalesinfo', [
        'uses' => 'Admin\AdminController@dashboardsalesinfo',
        'as' => 'admin.dashboardsalesinfo'
    ]);
    Route::get('dashboardtenantinfo', [
        'uses' => 'Admin\AdminController@dashboardtenantinfo',
        'as' => 'admin.dashboardtenantinfo'
    ]);

// route added by oli ullah and admin details dashboard route is write here


// Unit Routes
Route::get('admin/product/unit/create', [
    'uses' => 'Admin\AdminProductVariationController@createunit',
    'as' => 'admin.createunit'
]);

Route::get('admin/product/unit/edit/{id}', [
    'uses' => 'Admin\AdminProductVariationController@editunit',
    'as' => 'admin.editunit'
]);

Route::get('admin/product/unit/index', [
    'uses' => 'Admin\AdminProductVariationController@listunit',
    'as' => 'admin.listunit'
]);

Route::post('admin/product/unit/store/', [
    'uses' => 'Admin\AdminProductVariationController@storeunit',
    'as' => 'admin.storeunit'
]);


Route::post('admin/product/unit/update/{id}', [
    'uses' => 'Admin\AdminProductVariationController@updateunit',
    'as' => 'admin.updateunit'
]);

Route::get('admin/product/unit/delete/{id}', [
    'uses' => 'Admin\AdminProductVariationController@deleteunit',
    'as' => 'admin.deleteunit'
]);



// Size Routes
Route::get('admin/product/size/create', [
    'uses' => 'Admin\AdminProductVariationController@createsize',
    'as' => 'admin.createsize'
]);

Route::get('admin/product/size/edit/{id}', [
    'uses' => 'Admin\AdminProductVariationController@editsize',
    'as' => 'admin.editsize'
]);

Route::get('admin/product/size/index', [
    'uses' => 'Admin\AdminProductVariationController@listsize',
    'as' => 'admin.listsize'
]);

Route::post('admin/product/size/store/', [
    'uses' => 'Admin\AdminProductVariationController@storesize',
    'as' => 'admin.storesize'
]);


Route::post('admin/product/size/update/{id}', [
    'uses' => 'Admin\AdminProductVariationController@updatesize',
    'as' => 'admin.updatesize'
]);

Route::get('admin/product/size/delete/{id}', [
    'uses' => 'Admin\AdminProductVariationController@deletesize',
    'as' => 'admin.deletesize'
]);


// Color Routes
Route::get('admin/product/color/create', [
    'uses' => 'Admin\AdminProductVariationController@createcolor',
    'as' => 'admin.createcolor'
]);

Route::get('admin/product/color/edit/{id}', [
    'uses' => 'Admin\AdminProductVariationController@editcolor',
    'as' => 'admin.editcolor'
]);

Route::get('admin/product/color/index', [
    'uses' => 'Admin\AdminProductVariationController@listcolor',
    'as' => 'admin.listcolor'
]);

Route::post('admin/product/color/store/', [
    'uses' => 'Admin\AdminProductVariationController@storecolor',
    'as' => 'admin.storecolor'
]);


Route::post('admin/product/color/update/{id}', [
    'uses' => 'Admin\AdminProductVariationController@updatecolor',
    'as' => 'admin.updatecolor'
]);

Route::get('admin/product/color/delete/{id}', [
    'uses' => 'Admin\AdminProductVariationController@deletecolor',
    'as' => 'admin.deletecolor'
]);


// District Routes
Route::get('admin/district/create', [
    'uses' => 'Admin\AdminProductVariationController@createdistrict',
    'as' => 'admin.createdistrict'
]);

Route::get('admin/district/edit/{id}', [
    'uses' => 'Admin\AdminProductVariationController@editdistrict',
    'as' => 'admin.editdistrict'
]);

Route::get('admin/district/index', [
    'uses' => 'Admin\AdminProductVariationController@listdistrict',
    'as' => 'admin.listdistrict'
]);

Route::post('admin/district/store/', [
    'uses' => 'Admin\AdminProductVariationController@storedistrict',
    'as' => 'admin.storedistrict'
]);


Route::post('admin/district/update/{id}', [
    'uses' => 'Admin\AdminProductVariationController@updatedistrict',
    'as' => 'admin.updatedistrict'
]);

Route::get('admin/district/delete/{id}', [
    'uses' => 'Admin\AdminProductVariationController@deletedistrict',
    'as' => 'admin.deletedistrict'
]);

// Thana Routes
Route::get('admin/thana/create', [
    'uses' => 'Admin\AdminProductVariationController@createthana',
    'as' => 'admin.createthana'
]);

Route::get('admin/thana/edit/{id}', [
    'uses' => 'Admin\AdminProductVariationController@editthana',
    'as' => 'admin.editthana'
]);

Route::get('admin/thana/index', [
    'uses' => 'Admin\AdminProductVariationController@listthana',
    'as' => 'admin.listthana'
]);

Route::post('admin/thana/store/', [
    'uses' => 'Admin\AdminProductVariationController@storethana',
    'as' => 'admin.storethana'
]);


Route::post('admin/thana/update/{id}', [
    'uses' => 'Admin\AdminProductVariationController@updatethana',
    'as' => 'admin.updatethana'
]);

Route::get('admin/thana/delete/{id}', [
    'uses' => 'Admin\AdminProductVariationController@deletethana',
    'as' => 'admin.deletethana'
]);


// Post Office Routes
Route::get('admin/postoffice/create', [
    'uses' => 'Admin\AdminProductVariationController@createpostoffice',
    'as' => 'admin.createpostoffice'
]);

Route::get('admin/postoffice/edit/{id}', [
    'uses' => 'Admin\AdminProductVariationController@editpostoffice',
    'as' => 'admin.editpostoffice'
]);

Route::get('admin/postoffice/index', [
    'uses' => 'Admin\AdminProductVariationController@listpostoffice',
    'as' => 'admin.listpostoffice'
]);

Route::post('admin/postoffice/store/', [
    'uses' => 'Admin\AdminProductVariationController@storepostoffice',
    'as' => 'admin.storepostoffice'
]);


Route::post('admin/postoffice/update/{id}', [
    'uses' => 'Admin\AdminProductVariationController@updatepostoffice',
    'as' => 'admin.updatepostoffice'
]);

Route::get('admin/postoffice/delete/{id}', [
    'uses' => 'Admin\AdminProductVariationController@deletepostoffice',
    'as' => 'admin.deletepostoffice'
]);

//Add Softcom Applicant category

Route::get('admin/applicantcategory/create', [
    'uses' => 'Admin\AdminSetupController@createapplicantcategory',
    'as' => 'admin.createapplicantcategory'
]);

Route::get('admin/applicantcategory/edit/{id}', [
    'uses' => 'Admin\AdminSetupController@editapplicantcategory',
    'as' => 'admin.editapplicantcategory'
]);

Route::get('admin/applicantcategory/index', [
    'uses' => 'Admin\AdminSetupController@listapplicantcategory',
    'as' => 'admin.listapplicantcategory'
]);

Route::post('admin/applicantcategory/store/', [
    'uses' => 'Admin\AdminSetupController@storeapplicantcategory',
    'as' => 'admin.storeapplicantcategory'
]);


Route::post('admin/applicantcategory/update/{id}', [
    'uses' => 'Admin\AdminSetupController@updateapplicantcategory',
    'as' => 'admin.updateapplicantcategory'
]);

Route::get('admin/applicantcategory/delete/{id}', [
    'uses' => 'Admin\AdminSetupController@deleteapplicantcategory',
    'as' => 'admin.deleteapplicantcategory'
]);


// Special link Routes
Route::get('admin/speciallink/create', [
    'uses' => 'Admin\AdminSetupController@createspeciallink',
    'as' => 'admin.createspeciallink'
]);

Route::get('admin/speciallink/edit/{id}', [
    'uses' => 'Admin\AdminSetupController@editspeciallink',
    'as' => 'admin.editspeciallink'
]);

Route::get('admin/speciallink/index', [
    'uses' => 'Admin\AdminSetupController@listspeciallink',
    'as' => 'admin.listspeciallink'
]);

Route::post('admin/speciallink/store/', [
    'uses' => 'Admin\AdminSetupController@storespeciallink',
    'as' => 'admin.storespeciallink'
]);


Route::post('admin/speciallink/update/{id}', [
    'uses' => 'Admin\AdminSetupController@updatespeciallink',
    'as' => 'admin.updatespeciallink'
]);

Route::get('admin/speciallink/delete/{id}', [
    'uses' => 'Admin\AdminSetupController@deletespeciallink',
    'as' => 'admin.deletespeciallink'
]);





// Special link Routes
Route::get('admin/specialcategory/create', [
    'uses' => 'Admin\AdminSetupController@createspecialcategory',
    'as' => 'admin.createspecialcategory'
]);

Route::get('admin/specialcategory/edit/{id}', [
    'uses' => 'Admin\AdminSetupController@editspecialcategory',
    'as' => 'admin.editspecialcategory'
]);

Route::get('admin/specialcategory/index', [
    'uses' => 'Admin\AdminSetupController@listspecialcategory',
    'as' => 'admin.listspecialcategory'
]);

Route::post('admin/specialcategory/store/', [
    'uses' => 'Admin\AdminSetupController@storespecialcategory',
    'as' => 'admin.storespecialcategory'
]);


Route::post('admin/specialcategory/update/{id}', [
    'uses' => 'Admin\AdminSetupController@updatespecialcategory',
    'as' => 'admin.updatespecialcategory'
]);

Route::get('admin/specialcategory/delete/{id}', [
    'uses' => 'Admin\AdminSetupController@deletespecialcategory',
    'as' => 'admin.deletespecialcategory'
]);



Route::get('dashborad/totalcashindetails', [
    'uses' => 'Admin\AdmindashboarddetailsController@totalcashindetails',
    'as' => 'admin.dashboard.totalcashindetails'
]);

Route::get('dashborad/totalsoftcodeindetails', [
    'uses' => 'Admin\AdmindashboarddetailsController@totalsoftcodeindetails',
    'as' => 'admin.dashboard.totalsoftcodeindetails'
]);

Route::get('dashborad/totalsoftcodeoutdetails', [
    'uses' => 'Admin\AdmindashboarddetailsController@totalsoftcodeoutdetails',
    'as' => 'admin.dashboard.totalsoftcodeoutdetails'
]);

Route::get('dashborad/todaysoftcodeindetails', [
    'uses' => 'Admin\AdmindashboarddetailsController@todaysoftcodeindetails',
    'as' => 'admin.dashboard.todaysoftcodeindetails'
]);

Route::get('dashborad/todaysoftcodeoutdetails', [
    'uses' => 'Admin\AdmindashboarddetailsController@todaysoftcodeoutdetails',
    'as' => 'admin.dashboard.todaysoftcodeoutdetails'
]);

Route::get('dashborad/todaytotalcashindetails', [
    'uses' => 'Admin\AdmindashboarddetailsController@todaytotalcashindetails',
    'as' => 'admin.dashboard.todaytotalcashindetails'
]);
Route::get('dashborad/todaytotalwitdrawdetails', [
    'uses' => 'Admin\AdmindashboarddetailsController@todaytotalwitdrawdetails',
    'as' => 'admin.dashboard.todaytotalwitdrawdetails'
]);

Route::get('dashborad/totalwitdrawdetails', [
    'uses' => 'Admin\AdmindashboarddetailsController@totalwitdrawdetails',
    'as' => 'admin.dashboard.totalwitdrawdetails'
]);

Route::get('dashborad/rentaldetails', [
    'uses' => 'Admin\AdmindashboarddetailsController@rentaldetails',
    'as' => 'admin.dashboard.rentaldetails'
]);

Route::get('dashborad/depositdetails', [
    'uses' => 'Admin\AdmindashboarddetailsController@depositdetails',
    'as' => 'admin.dashboard.depositdetails'
]);


Route::get('dashborad/tenantwalletdetails', [
    'uses' => 'Admin\AdmindashboarddetailsController@tenantwalletdetails',
    'as' => 'admin.dashboard.tenantwalletdetails'
]);

Route::get('dashborad/pfbalancedetails', [
    'uses' => 'Admin\AdmindashboarddetailsController@pfbalancedetails',
    'as' => 'admin.dashboard.pfbalancedetails'
]);


Route::get('dashborad/details/get/by/date/interval/{type?}', [
    'uses' => 'Admin\AdmindashboarddetailsController@detailsGetByDateInterval',
    'as' => 'admin.detailsGetByDateInterval'
]);


Route::get('dashborad/tenentbalanceaddbyadmin', [
    'uses' => 'Admin\AdmindashboarddetailsController@tenentbalanceaddbyadmin',
    'as' => 'admin.dashboard.tenentbalanceaddbyadmin'
]);

Route::get('dashborad/tenentinfobyadmin', [
    'uses' => 'Admin\AdmindashboarddetailsController@tenentinfobyadmin',
    'as' => 'admin.dashboard.tenentinfobyadmin'
]);

Route::get('dashborad/tenentinformation/{type}', [
    'uses' => 'Admin\AdmindashboarddetailsController@tenantserviceprofiledetails',
    'as' => 'admin.dashboard.tenentinformation'
]);







// oli added route end here











    //Blog
    Route::get('allblogs', [
        'uses' => 'Admin\AdminController@allBlogs',
        'as' => 'admin.allBlogs'
    ]);
    Route::get('allblogs/addnew/blog', [
        'uses' => 'Admin\AdminController@addNewBlog',
        'as' => 'admin.addNewBlog'
    ]);
    Route::post('allblogs/store', [
        'uses' => 'Admin\AdminController@StoreBlog',
        'as' => 'admin.StoreBlog'
    ]);
    Route::get('allblogs/edit/blog/{blog}', [
        'uses' => 'Admin\AdminController@blogEdit',
        'as' => 'admin.blogEdit'
    ]);
    Route::get('allblogs/update/to/publish/blog/{blog}', [
        'uses' => 'Admin\AdminController@blogUpdateToPublished',
        'as' => 'admin.blogUpdateToPublished'
    ]);


    Route::post('allblogs/edit/blog/{blog}', [
        'uses' => 'Admin\AdminController@postUpdate',
        'as' => 'admin.postUpdate'
    ]);
    Route::get('allblogs/update/blog/{blog}', [
        'uses' => 'Admin\AdminController@postDelete',
        'as' => 'admin.postDelete'
    ]);




    Route::get('allblogs/selectTagsOrAddNew', [
        'uses' => 'Admin\AdminController@selectTagsOrAddNew',
        'as' => 'admin.selectTagsOrAddNew'
    ]);

    Route::get('allblogs/categories', [
        'uses' => 'Admin\AdminController@categories',
        'as' => 'admin.categories'
    ]);
    Route::post('allblogs/add/category', [
        'uses' => 'Admin\AdminController@addCategory',
        'as' => 'admin.addCategory'
    ]);
    Route::get('allblogs/category/{category}/edit', [
        'uses' => 'Admin\AdminController@editCategory',
        'as' => 'admin.editCategory'
    ]);
    Route::post('allblogs/category/update', [
        'uses' => 'Admin\AdminController@updateCategory',
        'as' => 'admin.updateCategory'
    ]);
    Route::get('allblogs/category/{category}/delete', [
        'uses' => 'Admin\AdminController@deleteCategory',
        'as' => 'admin.deleteCategory'
    ]);


    Route::get('allblogs/tags', [
        'uses' => 'Admin\AdminController@tags',
        'as' => 'admin.tags'
    ]);
    Route::post('allblogs/add/tags', [
        'uses' => 'Admin\AdminController@addTags',
        'as' => 'admin.addTags'
    ]);
    Route::get('allblogs/tag/{tag}/edit', [
        'uses' => 'Admin\AdminController@editTags',
        'as' => 'admin.editTags'
    ]);
    Route::post('allblogs/tag/update', [
        'uses' => 'Admin\AdminController@updateTags',
        'as' => 'admin.updateTags'
    ]);
    Route::get('allblogs/tag/{tag}/delete', [
        'uses' => 'Admin\AdminController@deleteTags',
        'as' => 'admin.deleteTags'
    ]);

    //Service Products START
    Route::get('service/products/list', [
        'uses' => 'Admin\AdminController@serviceProductslist',
        'as' => 'admin.serviceProductslist'
    ]);
    Route::get('service/products/list/{type}/product/{product}', [
        'uses' => 'Admin\AdminController@serviceProductUpdate',
        'as' => 'admin.serviceProductUpdate'
    ]);

    Route::get('service/products/list/product/{product}', [
        'uses' => 'Admin\AdminController@serviceProductDetails',
        'as' => 'admin.serviceProductDetails'
    ]);
    //Service Products End

    //Service Items Start
    Route::get('service/item/list', [
        'uses' => 'Admin\AdminController@serviceItems',
        'as' => 'admin.serviceItems'
    ]);
    Route::get('service/item/{item}/delete', [
        'uses' => 'Admin\AdminController@serviceItemsDelete',
        'as' => 'admin.serviceItemsDelete'
    ]);
    Route::get('service/item/{item}/edit', [
        'uses' => 'Admin\AdminController@serviceItemsEdit',
        'as' => 'admin.serviceItemsEdit'
    ]);
    Route::post('service/item/{item}/update', [
        'uses' => 'Admin\AdminController@updateServiceItem',
        'as' => 'admin.updateServiceItem'
    ]);

    Route::get('service/item/{item}/details', [
        'uses' => 'Admin\AdminController@serviceItemsDetails',
        'as' => 'admin.serviceItemsDetails'
    ]);

    Route::get('service/item/{item}/status/{status}', [
        'uses' => 'Admin\AdminController@serviceItemsStatusUpdate',
        'as' => 'admin.serviceItemsStatusUpdate'
    ]);

    Route::get('service/item/orders/list', [
        'uses' => 'Admin\AdminController@serviceItemOrders',
        'as' => 'admin.serviceItemOrders'
    ]);
    Route::get('service/item/order/{order}/details', [
        'uses' => 'Admin\AdminController@serviceItemOrdersDetails',
        'as' => 'admin.serviceItemOrdersDetails'
    ]);
    //Service Items End




    //Course Item
    Route::get('course/item/list', [
        'uses' => 'Admin\AdminController@courseItems',
        'as' => 'admin.courseItems'
    ]);

    Route::get('course/item/orders/list', [
        'uses' => 'Admin\AdminController@courseItemOrders',
        'as' => 'admin.courseItemOrders'
    ]);
    Route::get('course/item/order/{order}/details', [
        'uses' => 'Admin\AdminController@courseOrdersDetails',
        'as' => 'admin.courseOrdersDetails'
    ]);


    Route::get('course/item/{item}/delete', [
        'uses' => 'Admin\AdminController@courseItemsDelete',
        'as' => 'admin.courseItemsDelete'
    ]);
    Route::get('course/item/{item}/edit', [
        'uses' => 'Admin\AdminController@courseItemsEdit',
        'as' => 'admin.courseItemsEdit'
    ]);
    Route::post('course/item/{item}/update', [
        'uses' => 'Admin\AdminController@updatecourseItem',
        'as' => 'admin.updatecourseItem'
    ]);



    //Course Item End


    //Needs Start
    Route::get('needs', [
        'uses' => 'Admin\AdminController@needs',
        'as' => 'admin.needs'
    ]);
    Route::get('needs/{need}/details', [
        'uses' => 'Admin\AdminController@detailsNeeds',
        'as' => 'admin.detailsNeeds'
    ]);
    Route::get('needs/{need}/edit', [
        'uses' => 'Admin\AdminController@editNeeds',
        'as' => 'admin.editNeeds'
    ]);
    Route::post('needs/update/edit', [
        'uses' => 'Admin\AdminController@updateNeed',
        'as' => 'admin.updateNeed'
    ]);


    //Needs End

        //user send sms

        Route::get('service/category', [
            'uses' => 'Admin\AdminController@categorylist',
            'as' => 'admin.servicecategory'
        ]);
        Route::post('service/category/update/', [
            'uses' => 'Admin\AdminController@updatecategorylist',
            'as' => 'admin.updatecategorylist'
        ]);

        //user sms send end

    //user send sms

    Route::get('user/smssend', [
        'uses' => 'Admin\AdminController@usersmssendpage',
        'as' => 'admin.usersmssendpage'
    ]);
    Route::post('user/smssend/store', [
        'uses' => 'Admin\AdminController@usersmssend',
        'as' => 'admin.usersmssend'
    ]);

    //user sms send end




     //user send sms

     Route::get('user/notificatioonsend', [
        'uses' => 'Admin\AdminController@usernotificatioonsendpage',
        'as' => 'admin.usernotificatioonsendpage'
    ]);
    Route::post('user/notificatioonsend/store', [
        'uses' => 'Admin\AdminController@usernotificatioonsend',
        'as' => 'admin.usernotificatioonsend'
    ]);

    //user sms send end



      //Log Activity

        Route::get('admin/logactivitylist', [
        'uses' => 'Admin\AdminController@LogActivityList',
        'as' => 'admin.LogActivityList'
        ]);

        Route::get('admin/logactivitydelete/{id}', [
        'uses' => 'Admin\AdminController@LogActivityDelete',
        'as' => 'admin.LogActivityDelete'
        ]);

      //Order Notifications

      Route::get('admin/notificationslist', [
        'uses' => 'Admin\AdminController@adminnotificationslist',
        'as' => 'admin.adminnotificationslist'
    ]);

    Route::get('admin/notificationsdetails/{id}', [
        'uses' => 'Admin\AdminController@adminnotificationsdetails',
        'as' => 'admin.adminnotificationsdetails'
    ]);

    //Social Groups Start
    Route::get('social/groups', [
        'uses' => 'Admin\AdminController@socialGroups',
        'as' => 'admin.socialGroups'
    ]);
    Route::post('social/groups/store', [
        'uses' => 'Admin\AdminController@socialGroupsStore',
        'as' => 'admin.socialGroupsStore'
    ]);
    Route::get('social/{social}/group/type/{type}', [
        'uses' => 'Admin\AdminController@socialGroupsStatusUpdate',
        'as' => 'admin.socialGroupsStatusUpdate'
    ]);
    Route::post('social/{social}/group/update', [
        'uses' => 'Admin\AdminController@socialGroupsUpdate',
        'as' => 'admin.socialGroupsUpdate'
    ]);
    //Socail Groups End

    //Service Products Orders Start
    Route::get('service/products/orders/list', [
        'uses' => 'Admin\AdminController@serviceProductOrderList',
        'as' => 'admin.serviceProductOrderList'
    ]);
    Route::get('service/products/orders/{order}/details/profile/{profile}', [
        'uses' => 'Admin\AdminController@serviceProductOrderDetails',
        'as' => 'admin.serviceProductOrderDetails'
    ]);
    //Service Products Orders End


    Route::get('service/profile/list', [
        'uses' => 'Admin\AdminController@serviceProfilelist',
        'as' => 'admin.serviceProfilelist'
    ]);

    Route::get('employe/service/profile/list', [
        'uses' => 'Admin\Employee\AdminEmployeeController@employeserviceProfilelist',
        'as' => 'admin.employeserviceProfilelist'
    ]);
    Route::get('employe/service/profile/list/filter', [
        'uses' => 'Admin\Employee\AdminEmployeeController@employeserviceProfilelistfilter',
        'as' => 'admin.employeserviceProfilelistfilter'
    ]);

    Route::get('freelancer/work/list', [
        'uses' => 'Admin\Employee\AdminEmployeeController@freelancerworklist',
        'as' => 'admin.freelancerworklist'
    ]);

    Route::get('freelancer/work/list/filter', [
        'uses' => 'Admin\Employee\AdminEmployeeController@freelancerworklistfilter',
        'as' => 'admin.freelancerworklistfilter'
    ]);

    Route::get('freelancer/work/list/{id}', [
        'uses' => 'Admin\Employee\AdminEmployeeController@freelanncerWorklist',
        'as' => 'admin.freelanncerWorklist'
    ]);

    Route::get('service/profile/{profile}', [
        'uses' => 'Admin\AdminController@serviceProfileDetails',
        'as' => 'admin.serviceProfileDetails'
    ]);

    Route::get('service/profile/{profile}/edit', [
        'as' => 'admin.serviceProfileEdit',
        'uses' => 'Admin\AdminController@serviceProfileEdit',
    ]);
    Route::post('service/profile/update', [
        'as' => 'admin.serviceProfileUpdate',
        'uses' => 'Admin\AdminController@serviceProfileUpdate',
    ]);


    Route::get('service/profile/{profile}/delete', [
        'uses' => 'Admin\AdminController@serviceProfileDelete',
        'as' => 'admin.serviceProfileDelete'
    ]);

    Route::get('service/status/profile/{profile}/status/{status}', [
        'uses' => 'Admin\AdminController@profileStatusChange',
        'as' => 'admin.profileStatusChange'
    ]);



    Route::get('devtest', [
        'uses' => 'Admin\DevTestController@devtest',
        'as' => 'admin.devtest'
    ]);

    Route::get('search/ajax/type/{type}/status/{status?}', [
        'uses' => 'Admin\AdminSearchController@searchAjax',
        'as' => 'admin.searchAjax'
    ]);



    // Route::get('purposeChange', [
    // 'uses' =>'Admin\AdminController@purposeChangeToWithdraw',
    // 'as' => 'admin.purposeChangeToWithdraw'
    // ]);
///Suggession Box START
Route::get('suggession-complain/all', [
    'uses' => 'Admin\AdminController@suggessionAll',
    'as' => 'admin.suggessionAll'
]);
Route::get('suggession-complain/chat/{chat}', [
    'uses' => 'Admin\AdminController@suggessionChat',
    'as' => 'admin.suggessionChat'
]);
///Suggession Box START



    Route::get('tenants/all', [
        'uses' => 'Admin\AdminController@usersAll',
        'as' => 'admin.usersAll'
    ]);

    Route::get('employee/all', [
        'uses' => 'Admin\AdminController@employeeAll',
        'as' => 'admin.employeeAll'
    ]);
    Route::get('freelancer/all', [
        'uses' => 'Admin\AdminController@freelancerAll',
        'as' => 'admin.freelancerAll'
    ]);

    Route::get('new/tenant/create', [
        'uses' => 'Admin\AdminController@newUserCreate',
        'as' => 'admin.newUserCreate'
    ]);

    Route::post('new/user/create/post', [
        'uses' => 'Admin\AdminController@newUserCreatePost',
        'as' => 'admin.newUserCreatePost'
    ]);

    Route::get('user/edit/user/{user}', [
        'uses' => 'Admin\AdminController@userEdit',
        'as' => 'admin.userEdit'
    ]);
    Route::post('store/user/{user}/note', [
        'uses' => 'Admin\AdminController@addUserNote',
        'as' => 'admin.addUserNote'
    ]);
    Route::post('update/user/{user}/note/{note}', [
        'uses' => 'Admin\AdminController@noteUpdate',
        'as' => 'admin.noteUpdate'
    ]);
    Route::get('delete/user/{user}/note/{note}', [
        'uses' => 'Admin\AdminController@deleteUserNote',
        'as' => 'admin.deleteUserNote'
    ]);


    Route::post('user/update/user/{user}/referrals', [
        'uses' => 'Admin\AdminController@updateReferrals',
        'as' => 'admin.updateReferrals'
    ]);
    Route::get('get/all/referrars', [
        'uses' => 'Admin\AdminController@selectNewReffer',
        'as' => 'admin.selectNewReffer'
    ]);
    Route::post('user/update/user/{user}/status/{status}', [
        'uses' => 'Admin\AdminController@userUpdate',
        'as' => 'admin.userUpdate'
    ]);


    Route::post('new/temp/password/send/post/user/{user}', [
        'uses' => 'Admin\AdminController@newTempPassSendPost',
        'as' => 'admin.newTempPassSendPost'
    ]);

    Route::get('user/companies/user/{user}', [
        'uses' => 'Admin\AdminController@userCompanies',
        'as' => 'admin.userCompanies'
    ]);
    //Opinion Start
    Route::get('/opinions', [
        'uses' => 'Admin\AdminController@opinions',
        'as' => 'admin.opinions'
    ]);

    Route::get('opinions/view/{opinion}', [
        'uses' => 'Admin\AdminController@viewOpinion',
        'as' => 'admin.viewOpinion'
    ]);
    Route::get('opinions/edit/{opinion}', [
        'uses' => 'Admin\AdminController@editOpinion',
        'as' => 'admin.editOpinion'
    ]);
    Route::post('opinions/update/', [
        'uses' => 'Admin\AdminController@updateOpinion',
        'as' => 'admin.updateOpinion'
    ]);
    Route::get('opinions/delete/{opinion}', [
        'uses' => 'Admin\AdminController@deleteOpinion',
        'as' => 'admin.deleteOpinion'
    ]);
    Route::get('opinions/{opinion}/status/{status}', [
        'uses' => 'Admin\AdminController@updateOpinionStatus',
        'as' => 'admin.updateOpinionStatus'
    ]);
    //Opinion End




    //Review And Rating

    Route::get('/review/ratinglist', [
        'uses' => 'Admin\AdminController@ratinglist',
        'as' => 'admin.ratinglist'
    ]);

    Route::get('review/delete/{id}', [
        'uses' => 'Admin\AdminController@deleterating',
        'as' => 'admin.deleterating'
    ]);

    Route::get('review/edit/{id}', [
        'uses' => 'Admin\AdminController@editrating',
        'as' => 'admin.editrating'
    ]);

    Route::post('review/update/{id}', [
        'uses' => 'Admin\AdminController@updaterating',
        'as' => 'admin.updaterating'
    ]);



    //end review and rating


    //applicant Application list

    Route::get('/applicant/applicantionlist/', [
        'uses' => 'Admin\AdminController@applicationlist',
        'as' => 'admin.applicationlist'
    ]);

    Route::get('/applicant/applicantiondetails/{id}', [
        'uses' => 'Admin\AdminController@applicationdetails',
        'as' => 'admin.applicationdetails'
    ]);

    Route::get('/applicant/applicantiondetails/{type}/update/{id}', [
        'uses' => 'Admin\AdminController@applicationupdate',
        'as' => 'admin.applicationupdate'
    ]);


    //End Applicant Application List


    //media
    Route::get('media/all', [
        'uses' => 'Admin\AdminMediaController@mediaAll',
        'as' => 'admin.mediaAll'
    ]);
    Route::post('media/upload/post', [
        'uses' => 'Admin\AdminMediaController@mediaUploadPost',
        'as' => 'admin.mediaUploadPost'
    ]);

    Route::get('media/delete/{media}', [
        'uses' => 'Admin\AdminMediaController@mediaDelete',
        'as' => 'admin.mediaDelete'
    ]);

    //media


    // orders
    Route::get('workstation/orders/list/{type}', [
        'uses' => 'Admin\Order\AdminOrderController@ordersAll',
        'as' => 'admin.orders'
    ]);

    Route::get('workstation/subscribe/payment/approved/order/{payment}', [
        'uses' => 'Admin\Order\AdminOrderController@paymentApproved',
        'as' => 'admin.paymentApproved'
    ]);

    Route::get('workstation/subscribe/payment/approved/with/migrate/order/{payment}', [
        'uses' => 'Admin\Order\AdminOrderController@paymentApprovedWithMigrate',
        'as' => 'admin.paymentApprovedWithMigrate'
    ]);

    Route::get('workstation/subscribe/payment/delete/order/{payment}', [
        'uses' => 'Admin\Order\AdminOrderController@paymentDelete',
        'as' => 'admin.paymentDelete'
    ]);

    // ./orders
    //Subscription all Postpaid Account Start
    Route::get('workstation/subscription/all/prepaid/account/user/{user}/payment/{payment}', [
        'uses' => 'Admin\Order\AdminOrderController@subscriptionAllPostpaidAccount',
        'as' => 'admin.subscriptionAllPostpaidAccount'
    ]);
    //Subscription all Postpaid Account Start


    // BALANCE ORDER
    Route::get('balance/orders/all', [
        'uses' => 'Admin\Order\AdminOrderController@balanceOrdersAll',
        'as' => 'admin.balanceOrdersAll'
    ]);
    Route::get('balance/withdraw/list/all', [
        'uses' => 'Admin\Order\AdminOrderController@withdrawListAll',
        'as' => 'admin.withdrawListAll'
    ]);

    Route::get('balance/withdraw/last/balance/transaction/{amount}/details/{id}', [
        'uses' => 'Admin\Order\AdminOrderController@LastWithdrawlastbalancetransactionDetails',
        'as' => 'admin.LastWithdrawlastbalancetransactionDetails'
    ]);
    Route::post('decline/withdraw/{withdraw}/amount/user/{user}', [
        'uses' => 'Admin\Order\AdminOrderController@withdrawDecline',
        'as' => 'admin.withdrawDecline'
    ]);
    Route::post('balance/withdraw/list/post', [
        'uses' => 'Admin\Order\AdminOrderController@withdrawListpost',
        'as' => 'admin.withdrawListpost'
    ]);

    Route::get('balance/approve/order/{order}', [
        'uses' => 'Admin\Order\AdminOrderController@balanceApprovedOrder',
        'as' => 'admin.balanceApprovedOrder'
    ]);

    Route::get('balance/order/delete/order/{order}', [
        'uses' => 'Admin\Order\AdminOrderController@balanceOrderDelete',
        'as' => 'admin.balanceOrderDelete'
    ]);

    // Job post orders
    Route::get('all/job/post/order/list', [
        'uses' => 'Admin\Order\AdminOrderController@jobPostOrder',
        'as' => 'admin.jobPostOrder'
    ]);

    // honorarium


    Route::get('honoraria/all/list', [
        'uses' => 'Admin\Honorarium\AdminHonorariumController@honorarialist',
        'as' => 'admin.honorarialist'
    ]);

    Route::get('honorarium/create/honorarium/', [
        'uses' => 'Admin\Honorarium\AdminHonorariumController@addhonorarium',
        'as' => 'admin.addhonorarium'
    ]);

    Route::get('honorarium/edit/honorarium/{honorarium}', [
        'uses' => 'Admin\Honorarium\AdminHonorariumController@honorariumEdit',
        'as' => 'admin.honorariumEdit'
    ]);


    Route::post('honorarium/update/honorarium/{honorarium}', [
        'uses' => 'Admin\Honorarium\AdminHonorariumController@honorariumUpdate',
        'as' => 'admin.honorariumUpdate'
    ]);

    Route::get('honorarium/delete/honorarium/{honorarium}', [
        'uses' => 'Admin\Honorarium\AdminHonorariumController@honorariumDelete',
        'as' => 'admin.honorariumDelete'
    ]);


    Route::post('honorarium/add/new/honorarium/post', [
        'uses' => 'Admin\Honorarium\AdminHonorariumController@addHonorariumPost',
        'as' => 'admin.addHonorariumPost'
    ]);

    Route::get('workstation/honoraria/list/workstation/{workstation}', [
        'uses' => 'Admin\Honorarium\AdminHonorariumController@HonorariaLists',
        'as' => 'admin.HonorariaLists'
    ]);
    // category

    Route::get('add/new/category/workstation/{workstation}', [
        'uses' => 'Admin\Category\AdminCategoryController@addNewCategory',
        'as' => 'admin.addNewCategory'
    ]);


    Route::post('categpry/update/personal/profile/post/category/{cat}', [
        'uses' => 'Admin\Category\AdminCategoryController@updatePersonalProfilePost',
        'as' => 'admin.updatePersonalProfilePost'

    ]);

    Route::post('category/added/new/workstation/{workstation}', [
        'uses' => 'Admin\Category\AdminCategoryController@addNewCategoryPost',
        'as' => 'admin.addNewCategoryPost'
    ]);

    Route::get('categpry/edit/category/{cat}', [
        'uses' => 'Admin\Category\AdminCategoryController@categoryEdit',
        'as' => 'admin.categoryEdit'

    ]);

    Route::post('category/update/category/{cat}', [
        'uses' => 'Admin\Category\AdminCategoryController@categoryUpdatePost',
        'as' => 'admin.categoryUpdatePost'
    ]);

    Route::post('category/business/profile/update/category/{cat}', [
        'uses' => 'Admin\Category\AdminCategoryController@categoryBusinessProfileUpdatePost',
        'as' => 'admin.categoryBusinessProfileUpdatePost'
    ]);


    Route::post('category/service/profile/add/category/{cat}', [
        'uses' => 'Admin\Category\AdminCategoryController@serviceProfileInfo',
        'as' => 'admin.serviceProfileInfo'
    ]);

    Route::get('category/service/profile/edit/serviceProfileInfo/{serviceProfileInfo}', [
        'uses' => 'Admin\Category\AdminCategoryController@serviceProfileInfosEdit',
        'as' => 'admin.serviceProfileInfosEdit'
    ]);

    Route::post('category/service/profile/update/serviceProfileInfo/{serviceProfileInfo}', [
        'uses' => 'Admin\Category\AdminCategoryController@serviceProfileInfoUpdate',
        'as' => 'admin.serviceProfileInfoUpdate'
    ]);

    Route::post('category/profile/profile/add/category/{cat}', [
        'uses' => 'Admin\Category\AdminCategoryController@personalProfileInfo',
        'as' => 'admin.personalProfileInfo'
    ]);


    Route::get('service/profile/delete/serviceProfileInfo/{serviceProfileInfo}', [
        'uses' => 'Admin\Category\AdminCategoryController@serviceProfileInfosDelete',
        'as' => 'admin.serviceProfileInfosDelete'
    ]);




    Route::get('category/delete/{catagory}', [
        'uses' => 'Admin\Category\AdminCategoryController@categoryDelete',
        'as' => 'admin.categoryDelete'
    ]);

    // subcategory

    Route::get('categories/all', [
        'uses' => 'Admin\Category\AdminCategoryController@addNewSubategory',
        'as' => 'admin.addNewSubategory'
    ]);

    Route::post('add/new/subcategory/workstation/{workstation}', [
        'uses' => 'Admin\Category\AdminCategoryController@addsubcategoryPost',
        'as' => 'admin.addsubcategoryPost'
    ]);

    Route::get('subcategpry/edit/subcategory/{subcat}', [
        'uses' => 'Admin\Category\AdminCategoryController@subcategoryEdit',
        'as' => 'admin.subcategoryEdit'

    ]);

    Route::post('subcategory/update/subcategory/{subcat}', [
        'uses' => 'Admin\Category\AdminCategoryController@subcategoryUpdatePost',
        'as' => 'admin.subcategoryUpdatePost'
    ]);

    Route::any('subcategory/delete/subcategory/{subcatagory}', [
        'uses' => 'Admin\Category\AdminCategoryController@subcategoryDelete',
        'as' => 'admin.subcategoryDelete'
    ]);

    // jobcategory
    Route::get('subcategories/all', [
        'uses' => 'Admin\JobCategory\AdminJobCategoryController@jobCategory',
        'as' => 'admin.jobcategory'
    ]);

    Route::post('add/new/job/category', [
        'uses' => 'Admin\JobCategory\AdminJobCategoryController@addNewJobCategory',
        'as' => 'admin.addNewJobCategory'
    ]);

    Route::get('jobCategory/edit/jobcategory/{cat}', [
        'uses' => 'Admin\JobCategory\AdminJobCategoryController@jobcategoryEdit',
        'as' => 'admin.jobcategoryEdit'
    ]);

    Route::post('jobcategory/update/jobcategory/{cat}', [
        'uses' => 'Admin\JobCategory\AdminJobCategoryController@jobcategoryUpdatePost',
        'as' => 'admin.jobcategoryUpdatePost'
    ]);

    Route::get('jobcategory/delete/jobcategory/{catagory}', [
        'uses' => 'Admin\JobCategory\AdminJobCategoryController@jobcategoryDelete',
        'as' => 'admin.jobcategoryDelete'
    ]);


    // jobsubcategory

    Route::post('add/new/job/subcategory/category/{category}', [
        'uses' => 'Admin\JobCategory\AdminJobCategoryController@jobSubcategory',
        'as' => 'admin.jobSubcategory'
    ]);

    Route::get('jobsubcategpry/edit/jobsubcategory/{subcat}', [
        'uses' => 'Admin\JobCategory\AdminJobCategoryController@jobsubcategoryEdit',
        'as' => 'admin.jobsubcategoryEdit'

    ]);

    Route::post('jobsubcategory/update/jobsubcategory/{subcat}', [
        'uses' => 'Admin\JobCategory\AdminJobCategoryController@jobsubcategoryUpdatePost',
        'as' => 'admin.jobsubcategoryUpdatePost'
    ]);



    Route::any('jobsubcategory/delete/jobsubcategory/{subcatagory}', [
        'uses' => 'Admin\JobCategory\AdminJobCategoryController@jobsubcategoryDelete',
        'as' => 'admin.jobsubcategoryDelete'
    ]);


    // product brand

    Route::get('product/create/new/brand/', [
        'uses' => 'Admin\Brand\AdminBrandController@addNewBrand',
        'as' => 'admin.addNewBrand'
    ]);

    Route::get('brand/rearrange', [
        'uses' => 'Admin\Brand\AdminBrandController@brandRearrange',
        'as' => 'admin.brandRearrange'
    ]);

    Route::any('/brand/sort', [
        'uses' => 'Admin\Brand\AdminBrandController@brandSort',
        'as' => 'admin.brandSort'
    ]);

    Route::post('product/brands/update/post', [
        'uses' => 'Admin\Brand\AdminBrandController@brandPost',
        'as' => 'admin.brandPost'
    ]);

    Route::get('brand/edit/{brand}', [
        'uses' => 'Admin\Brand\AdminBrandController@brandEdit',
        'as' => 'admin.brandEdit'
    ]);

    Route::post('brand/update/{brand}', [
        'uses' => 'Admin\Brand\AdminBrandController@brandUpdate',
        'as' => 'admin.brandUpdate'
    ]);

    Route::post('brand/delete/{brand}', [
        'uses' => 'Admin\Brand\AdminBrandController@brandDelete',
        'as' => 'admin.brandDelete'
    ]);


    // admin products

    Route::get('product/create/new/product', [
        'uses' => 'Admin\Product\AdminProductController@createNewProduct',
        'as' => 'admin.createNewProduct'
    ]);

    Route::post('product/add/product/information/product/{product}', [
        'uses' => 'Admin\Product\AdminProductController@productInformationAdd',
        'as' => 'admin.productInformationAdd'
    ]);

    Route::post('product/update/product/information/product/{product}', [
        'uses' => 'Admin\Product\AdminProductController@productInformationUpdate',
        'as' => 'admin.productInformationUpdate'
    ]);

    Route::get('product/update/information/product/{product}', [
        'uses' => 'Admin\Product\AdminProductController@editProduct',
        'as' => 'admin.editProduct'
    ]);

    Route::get('Product/all/list', [
        'as' => 'admin.allProductList',
        'uses' => 'Admin\Product\AdminProductController@allProductList'
    ]);

    Route::post('product/delete/product/{product}', [
        'as' => 'admin.deleteProduct',
        'uses' => 'Admin\Product\AdminProductController@deleteProduct'
    ]);
    //////

    Route::post('product-feature-image/change/product/{product}', [
        'uses' => 'Admin\Product\AdminProductImageController@productFeatureImageChange',
        'as' => 'admin.productFeatureImageChange'
    ]);


    //fi of lead
    Route::get('product-feature-img/delete/product/{product}', [
        'uses' => 'Admin\Product\AdminProductImageController@productFeatureImageDelete',
        'as' => 'admin.productFeatureImageDelete'
    ]);

    Route::get('product-extra-image-change/modal-open/product/{product}', [
        'uses' => 'Admin\Product\AdminProductImageController@productExtraImageChangeModalOpen',
        'as' => 'admin.productExtraImageChangeModalOpen'
    ]);

    Route::post('product-extra-image/change-post/product/{product}', [
        'uses' => 'Admin\Product\AdminProductImageController@productExtraImageChangePost',
        'as' => 'admin.productExtraImageChangePost'
    ]);

    Route::get('product-extra-img/delete/media/{media}', [
        'uses' => 'Admin\Product\AdminProductImageController@productExtraImageDelete',
        'as' => 'admin.productExtraImageDelete'
    ]);


    //admin role




    Route::post('admin/add/new/post', [
        'uses' => 'Admin\AdminController@adminAddNewPost',
        'as' => 'admin.adminAddNewPost'
    ]);
    Route::get('admins/all', [
        'uses' => 'Admin\AdminController@adminsAll',
        'as' => 'admin.adminsAll'
    ]);
    Route::get('add/new/role', [
        'uses' => 'Admin\AdminController@addNewRole',
        'as' => 'admin.addNewRole'
    ]);

    Route::any('edit/new/role/{id}', [
        'uses' => 'Admin\AdminController@editNewRole',
        'as' => 'admin.editNewRole'
    ]);


    Route::get('all/role/list', [
        'uses' => 'Admin\AdminController@allRoleUser',
        'as' => 'admin.allRoleUser'
    ]);

    Route::post('add/new/role/post', [
        'uses' => 'Admin\AdminController@roleAddNewPost',
        'as' => 'admin.roleAddNewPost'
    ]);

    Route::any('admin/delete/{role}', [
        'uses' => 'Admin\AdminController@adminDelete',
        'as' => 'admin.adminDelete'
    ]);

    //admin role

    //Make Service Profile of any user Start

    Route::get('make/service/profile', [
        'uses' => 'Admin\AdminController@createServiceProfile',
        'as' => 'admin.createServiceProfile'
    ]);

    Route::post('make/user/for/service/profile', [
        'uses' => 'Admin\AdminController@newUserCreateForServiceProfile',
        'as' => 'admin.newUserCreateForServiceProfile'
    ]);
    // Route::post('fetch/wt/cat/for/service/profile', [
    //     'uses' => 'Admin\AdminController@fetchAjaxData',
    //     'as' => 'admin.fetchAjaxData'
    // ]);

    Route::post('store/service/profile/info/from/admin', [
        'uses' => 'Admin\AdminController@storeServiceProfileFromAdmin',
        'as' => 'admin.storeServiceProfileFromAdmin'
    ]);

    //Make Service Profile of any user End

    Route::get('all/report/of/{type?}', [
        'uses' => 'Admin\AdminReportController@report',
        'as' => 'admin.report'
    ]);

    Route::get('details/of/reports/get/by/date', [
        'uses' => 'Admin\AdminReportController@reportsGetByDate',
        'as' => 'admin.reportsGetByDate'
    ]);

    Route::get('details/reports/get/by/date/interval/{type?}', [
        'uses' => 'Admin\AdminReportController@reportsGetByDateInterval',
        'as' => 'admin.reportsGetByDateInterval'
    ]);

    // website parameters
    Route::get('/website-parameters', [
        'uses' => 'Admin\AdminPageController@webParams',
        'as' => 'admin.websiteParameters'
    ]);
    Route::post('/website-parameters', [
        'uses' => 'Admin\AdminPageController@webParamsSave',
        'as' => 'admin.websiteParameterUpdate'
    ]);

    Route::get('admin/website/slider/create', [
        'uses' => 'Admin\AdminPageController@createslider',
        'as' => 'admin.createslider'
    ]);

    Route::get('admin/website/slider/edit/{id}', [
        'uses' => 'Admin\AdminPageController@editslider',
        'as' => 'admin.editslider'
    ]);

    Route::get('admin/website/slider/index', [
        'uses' => 'Admin\AdminPageController@listslider',
        'as' => 'admin.listslider'
    ]);

    Route::post('admin/website/slider/store/', [
        'uses' => 'Admin\AdminPageController@storeslider',
        'as' => 'admin.storeslider'
    ]);


    Route::post('admin/website/slider/update/{id}', [
        'uses' => 'Admin\AdminPageController@updateslider',
        'as' => 'admin.updateslider'
    ]);

    Route::get('admin/website/slider/delete/{id}', [
        'uses' => 'Admin\AdminPageController@deleteslider',
        'as' => 'admin.deleteslider'
    ]);

    //pages
    Route::get('/pages/all', [
        'uses' => 'Admin\AdminPageController@pagesAll',
        'as' => 'admin.pagesAll'
    ]);


    Route::get('new/menu', [
        'uses' => 'Admin\AdminPageController@newMenu',
        'as' => 'admin.newMenu'
    ]);

    Route::post('new/menu/post', [
        'uses' => 'Admin\AdminPageController@newMenuPost',
        'as' => 'admin.newMenuPost'
    ]);

    Route::get('all/menus', [
        'uses' => 'Admin\AdminPageController@allMenus',
        'as' => 'admin.allMenus'
    ]);

    Route::get('menu/delete/{menu}', [
        'uses' => 'Admin\AdminPageController@menuDelete',
        'as' => 'common1.menuDelete'
    ]);

    Route::post('/page/add/new/post', [
        'uses' => 'Admin\AdminPageController@pageAddNewPost',
        'as' => 'admin.pageAddNewPost'
    ]);

    Route::get('page/edit/{page}', [
        'uses' => 'Admin\AdminPageController@pageEdit',
        'as' => 'admin.pageEdit'
    ]);

    Route::post('page/edit/post/{page}', [
        'uses' => 'Admin\AdminPageController@pageEditPost',
        'as' => 'admin.pageEditPost'
    ]);

    Route::post('/page/sort', [
        'uses' => 'Admin\AdminPageController@pageSort',
        'as' => 'admin.pageSort'
    ]);

    Route::get('page/delete/{page}', [
        'uses' => 'Admin\AdminPageController@pageDelete',
        'as' => 'admin.pageDelete'
    ]);

    Route::get('page/items/{page}', [
        'uses' => 'Admin\AdminPageController@pageItems',
        'as' => 'admin.pageItems'
    ]);


    Route::post('page-item/add/post/{page}', [
        'uses' => 'Admin\AdminPageController@pageItemAddPost',
        'as' => 'admin.pageItemAddPost'
    ]);

    Route::get('page-item/delete/{item}', [
        'uses' => 'Admin\AdminPageController@pageItemDelete',
        'as' => 'admin.pageItemDelete'
    ]);



    Route::get('page-item/edit/{item}', [
        'uses' => 'Admin\AdminPageController@pageItemEdit',
        'as' => 'admin.pageItemEdit'
    ]);

    Route::post('page-item/update/post/{item}', [
        'uses' => 'Admin\AdminPageController@pageItemUpdate',
        'as' => 'admin.pageItemUpdate'
    ]);

    Route::get('page-item/edit-editor/{item}', [
        'uses' => 'Admin\AdminPageController@pageItemEditEditor',
        'as' => 'admin.pageItemEditEditor'
    ]);

    //subscribers
    Route::get('subscribers/list', [
        'uses' => 'Admin\AdminController@subscribersList',
        'as' => 'admin.subscribersList'
    ]);

    Route::get('subscriber/history/subscriber/{subscriber}/type/{type}/status/{status?}', [
        'uses' => 'Admin\History\AdminSubscriberHistoryController@subscriberHistoryInfo',
        'as' => 'admin.subscriberHistoryInfo'
    ]);

    Route::get('user/history/user/{user}/type/{type}/status/{status?}', [
        'uses' => 'Admin\History\AdminSubscriberHistoryController@userHistoryInfo',
        'as' => 'admin.userHistoryInfo'
    ]);
    //Employee routes
    Route::get('employee/history/employee/{user}/type/{type}/status/{status?}', [
        'uses' => 'Admin\Employee\AdminEmployeeController@EmployeeHistoryInfo',
        'as' => 'admin.EmployeeHistoryInfo'
    ]);
    Route::get('details/of/serviceprofile/by/employee/get/by/date', [
        'uses' => 'Admin\Employee\AdminEmployeeController@employeeserviceprofilefixeddatefilter',
        'as' => 'admin.serviceprofileGetByDate'
    ]);

 //---------------fardeen employee report----------------
 Route::get('dashboard/employee/employeereport/list/', [
    'uses' => 'User\UserDashborad\EmployeeDashboardController@EmployeeReport',
    'as' => 'user.employeeReport'
]);

Route::get('dashboard/employee/employeereport/add', [
    'uses' => 'User\UserDashborad\EmployeeDashboardController@EmployeeReportAdd',
    'as' => 'user.employeeReportAdd'
]);

Route::post('dashboard/employee/employeereport/store', [
    'uses' => 'User\UserDashborad\EmployeeDashboardController@EmployeeReportStore',
    'as' => 'user.storeemployeereport'
]);

 //---------------end fardeen employee report----------------

    Route::get('user/history/of/sales/user/{user}', [
        'uses' => 'Admin\History\AdminSubscriberHistoryController@userSalesHistoryInfo',
        'as' => 'admin.userSalesHistoryInfo'
    ]);
    Route::get('user/history/of/sales/user/{user}/order/{order}', [
        'uses' => 'Admin\History\AdminSubscriberHistoryController@orderItemHistoryInfo',
        'as' => 'admin.orderItemHistoryInfo'
    ]);

    Route::get('user/status/update/user/{user}/type/{type}', [
        'uses' => 'Admin\History\AdminSubscriberHistoryController@userStatusUpdate',
        'as' => 'admin.userStatusUpdate'
    ]);

    Route::get('login/as/user/{user}', [
        'uses' => 'Admin\History\AdminSubscriberHistoryController@LoginAsUser',
        'as' => 'admin.LoginAsUser'
    ]);


    Route::get('subcriber/edit/subcriber/{subcriber}', [
        'uses' => 'Admin\AdminController@subcriberEdit',
        'as' => 'admin.subcriberEdit'
    ]);

    Route::post('update/subcriber/{subcriber}/pf/reffer/type/{type}', [
        'uses' => 'Admin\AdminController@updatePfReffer',
        'as' => 'admin.updatePfReffer'
    ]);
    // Route::get('get/all/referrars/without/current/reffer', [
    //     'uses' => 'Admin\AdminController@selectNewRefferFromSubscriber',
    //     'as' => 'admin.selectNewRefferFromSubscriber'
    // ]);
    ///Need Confirm via Masud Vai
    Route::get('get/all/referrars/without/current/reffer/2/6/{subscription}', [
        'uses' => 'Admin\AdminController@selectNewRefferFromSubscriber2',
        'as' => 'admin.selectNewRefferFromSubscriber2'
    ]);

    Route::post('subcriber/update/subcriber/{subcriber}', [
        'as' => 'admin.substcribeUpdate',
        'uses' => 'Admin\AdminController@subcriberUpdate',
    ]);

    Route::get('workstation/list', [
        'uses' => 'Admin\WorkStation\AdminWorkStationController@workStationList',
        'as' => 'admin.workStationList'
    ]);

    Route::get('workstation/edit/workstation/{workstation}', [
        'uses' => 'Admin\WorkStation\AdminWorkStationController@workStationEdit',
        'as' => 'admin.workStationEdit'
    ]);

    Route::post('workstation/update/workstation/{workstation}', [
        'as' => 'admin.workStationUpdate',
        'uses' => 'Admin\WorkStation\AdminWorkStationController@workStationUpdate',
    ]);

    // pending request for job approvel

    Route::get('all/pending/job/post/from/subscribers', [
        'uses' => 'Admin\JobCategory\AdminJobCategoryController@pendingJobs',
        'as' => 'admin.pendingJobs'
    ]);

    Route::get('pending/job/post/details/freelancerjob/{job}', [
        'uses' => 'Admin\JobCategory\AdminJobCategoryController@pendingJobDetails',
        'as' => 'admin.pendingJobDetails'
    ]);

    Route::post('pending/job/worker/number/update/{job}', [
        'uses' => 'Admin\JobCategory\AdminJobCategoryController@editJobPostWorkerNum',
        'as' => 'admin.editJobPostWorkerNum'
    ]);

    Route::post('make/job/remote/update/{job}', [
        'uses' => 'Admin\JobCategory\AdminJobCategoryController@makeJobRemote',
        'as' => 'admin.makeJobRemote'
    ]);

    Route::post('pending/job/post/description/update/{job}', [
        'uses' => 'Admin\JobCategory\AdminJobCategoryController@pendingJobDescriptionUpdate',
        'as' => 'admin.pendingJobDescriptionUpdate'
    ]);

    Route::get('approved/job/post/freelancerjob/{job}', [
        'uses' => 'Admin\JobCategory\AdminJobCategoryController@approvedJob',
        'as' => 'admin.approvedJob'
    ]);

    Route::get('suspend/job/post/freelancerjob/{job}', [
        'uses' => 'Admin\JobCategory\AdminJobCategoryController@suspendJob',
        'as' => 'admin.suspendJob'
    ]);

    // posted job
    //latest pending job
    Route::get('all/posted/latest/job/from/subscribers/status/{status?}', [
        'uses' => 'Admin\JobCategory\AdminJobCategoryController@allPostedlatestJob',
        'as' => 'admin.allPostedlatestJob'
    ]);

    Route::get('all/posted/job/modified/by/admin/{status?}', [
        'uses' => 'Admin\JobCategory\AdminJobCategoryController@allPostedJobModifiedByAdmin',
        'as' => 'admin.allPostedJobModifiedByAdmin'
    ]);

    Route::get('all/posted/custom/jobs/modified/by/admin/{status?}', [
        'uses' => 'Admin\JobCategory\AdminJobCategoryController@allPostedCustomJobModifiedByAdmin',
        'as' => 'admin.allPostedCustomJobModifiedByAdmin'
    ]);


    Route::get('all/posted/job/from/subscribers/status/{status?}', [
        'uses' => 'Admin\JobCategory\AdminJobCategoryController@allPostedJob',
        'as' => 'admin.allPostedJob'
    ]);

    Route::get('all/works/of-job/job/{job}/status/{status?}', [
        'uses' => 'Admin\JobCategory\AdminJobCategoryController@allWorksOfJob',
        'as' => 'admin.allWorksOfJob'
    ]);

    Route::get('job/work/status/update/work/{work}/status/{status?}', [
        'uses' => 'Admin\JobCategory\AdminJobCategoryController@jobWorkStatusUpdate',
        'as' => 'admin.jobWorkStatusUpdate'
    ]);

    Route::post('job/work/reject/reason/work/{work}/', [
        'as' => 'admin.rejectReason',
        'uses' => 'Admin\JobCategory\AdminJobCategoryController@rejectReason'
    ]);

    //details works of job
    Route::get('job/work/details/works/of-job/woke/{work}', [
        'uses' => 'Admin\JobCategory\AdminJobCategoryController@jobWorkDetails',
        'as' => 'admin.jobWorkDetails'
    ]);

    //newsfeed start


    //newsfeed end


    //fardeen Codee Top Priority Ad

     //---------------- fardeen code ----------------------

//Emploee Report

Route::get('dashboard/employee/employeereport', [
    'uses' => 'Admin\AdminController@EmployeeReport',
    'as' => 'admin.employeeReport'
]);

Route::get('admin/employee/employeereport/delete/{id}', [
    'uses' => 'Admin\AdminController@deleteEmployeeReport',
    'as' => 'admin.deleteEmployeeReport'
]);

     Route::get('admin/addvaluedcustomer', [
        'uses' => 'Admin\AdminSetupController@addValuedCustomers',
        'as' => 'admin.addValuedCustomer'
    ]);

    Route::get('admin/valuedcustomerlist', [
        'uses' => 'Admin\AdminSetupController@valuedCustomers',
        'as' => 'admin.valuedCustomerList'
    ]);

    Route::post('admin/storevaluedcustomer/store', [
        'uses' => 'Admin\AdminSetupController@storeValuedCustomer',
        'as' => 'admin.storeValuedCustomer'
    ]);

    Route::get('admin/valuedcustomerlist/delete/{id}', [
        'uses' => 'Admin\AdminSetupController@deleteValuedCustomer',
        'as' => 'admin.deleteValuedCustomer'
    ]);

    Route::get('admin/valuedcustomerlist/edit/{id}', [
        'uses' => 'Admin\AdminSetupController@editValuedCustomer',
        'as' => 'admin.editvaluedCustomer'
    ]);

    Route::post('admin/valuedcustomerlist/editstore/{id}', [
        'uses' => 'Admin\AdminSetupController@storeEditedValuedCustomer',
        'as' => 'admin.storeEditedValuedCustomer'
    ]);


    //Valued Customer


    Route::get('admin/addtoppriority', [
        'uses' => 'Admin\AdminSetupController@addTopPriorities',
        'as' => 'admin.addTopPriority'
    ]);


    Route::get('admin/topprioritylist', [
        'uses' => 'Admin\AdminSetupController@allPriority',
        'as' => 'admin.topPriorityList'
    ]);
    Route::post('admin/storetoppriority/store', [
        'uses' => 'Admin\AdminSetupController@storeTopPriority',
        'as' => 'admin.storeTopPriority'
    ]);
    Route::get('admin/topprioritylist/delete/{id}', [
        'uses' => 'Admin\AdminSetupController@deleteTopPriority',
        'as' => 'admin.deleteTopPriority'
    ]);

    Route::get('admin/topprioritylist/edit/{id}', [
        'uses' => 'Admin\AdminSetupController@editTopPriority',
        'as' => 'admin.editTopPriority'
    ]);

    Route::post('admin/topprioritylist/editstore/{id}', [
        'uses' => 'Admin\AdminSetupController@storeEditedTopPriority',
        'as' => 'admin.storeEditedTopPriority'
    ]);



    //End fardeen Codee Top Priority Ad





});
