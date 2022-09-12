<?php

use App\Http\Controllers\AdminCommissionController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\AdminPaymentController;
use App\Http\Controllers\Backend\AdminVideoController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\LoginController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ConnectedAccountController;
use App\Http\Controllers\ConnectedAccountInfoController;
use App\Http\Controllers\FacebookController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\ChannelController;
use App\Http\Controllers\Frontend\ConnectionsController;
use App\Http\Controllers\Frontend\HelpController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\HowItWorksController;
use App\Http\Controllers\Frontend\PersonalInfoController;
use App\Http\Controllers\Frontend\PlayListController;
use App\Http\Controllers\Frontend\PlayListvideosController;
use App\Http\Controllers\Frontend\PricePlanController;
use App\Http\Controllers\Frontend\StreamController;
use App\Http\Controllers\Frontend\StreamPlayerController;
use App\Http\Controllers\Frontend\SubscriptionsController;
use App\Http\Controllers\Frontend\SupportController;
use App\Http\Controllers\Frontend\VideosController;
use App\Http\Controllers\Frontend\VideoUploadController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\LiveStreamController;
use App\Http\Controllers\MyGalleryController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\PrivateStreamController;
use App\Http\Controllers\PrivateVideoController;
use App\Http\Controllers\Stream\StreamDashboardController;
use App\Http\Controllers\Stream\VideoLiveStreamController;
use App\Http\Controllers\StreamRecorderController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserAccountController;
use App\Http\Controllers\UserInfoController;
use App\Http\Controllers\WalletController;
use Illuminate\Support\Facades\Route;

// Home Page Route
Route::get('/', [HomeController::class, 'index'])->name('home');

// Home Category Video Search Route
Route::get('/category/{id}/{name}', [FrontendController::class, 'category_video'])->name('category_video');

// watch video Route
Route::get('/watch_video/{id}', [StreamPlayerController::class, 'watch_video'])->name('watch_video');
Route::get('/watch_private_video/{id}', [StreamPlayerController::class, 'watch_private_video'])->name('watch_private_video');
Route::get('/watch_creater_video/{id}', [StreamPlayerController::class, 'watch_creater_video'])->name('watch_creater_video');

// Channel Frontend Route
Route::get('/channel/{slug}', [FrontendController::class, 'channel'])->name('frontend_channel');

// Channel Playlist videos
Route::get('/channel_playlist/{slug}/{pid}', [FrontendController::class, 'channel_playlist'])->name('channel_playlist');

// ***Live stream listing Route For Public Video
Route::get('/stream', [StreamController::class, 'index'])->name('stream');

// ***Join public stream
Route::post('/public_stream', [StreamController::class, 'join_Public_Stream'])->name('public_stream');

// Login & Register Route
Route::group(['middleware' => 'guest'], function () {
    Route::post('register', [HomeController::class, 'register'])->name('register');
    Route::post('login_check', [HomeController::class, 'login'])->name('login_check');
});

// Sidebar Global Links start
Route::get('/about', [AboutController::class, 'index'])->name('about'); // About Page with plan
Route::get('/how_it_works', [HowItWorksController::class, 'index'])->name('how_it_works');
Route::get('/supports', [SupportController::class, 'index'])->name('supports');
Route::get('/help', [HelpController::class, 'index'])->name('help');

// Sidebar Global Links end

// Auth Route
Route::group(['middleware' => 'auth'], function () {

    /**
     * Global Routes For All user Roles
     * Free, Pro, Business Users
     */

    // User Logout Routes
    Route::get('logout', [HomeController::class, 'logout'])->name('logout');

    // User Personal Info Routes
    Route::get('/personal_info', [PersonalInfoController::class, 'index'])->name('personal_info');
    Route::post('/user_info_create', [PersonalInfoController::class, 'user_info_create'])->name('user_info_create');
    Route::get('/get_user_info', [UserInfoController::class, 'get_user_info'])->name('get_user_info');

    // Price and plan Process
    Route::get('/price_plan', [PricePlanController::class, 'index'])->name('price_plan');
    Route::get('/payments/{price}/{currentPlan}/{planName}', [PricePlanController::class, 'payments'])->name('payments');
    Route::post('/payment_process', [PricePlanController::class, 'payment_process'])->name('payment_process');
    Route::get('/successfull', [PricePlanController::class, 'success'])->name('successfull');
    Route::get('/default_user/{currentPlan}/{planName}', [PricePlanController::class, 'default_user'])->name('default_user');

    // Private video price processes routes
    Route::post('/private_video_cart', [PrivateVideoController::class, 'payment'])->name('private_video_cart');
    Route::post('/private_payment_process', [PrivateVideoController::class, 'private_payment_process'])->name('private_payment_process');
    Route::get('/video_payment_success', [PrivateVideoController::class, 'video_payment_success'])->name('video_payment_success');

    // User Purchased videos & stream Routes
    Route::get('/my_videos', [MyGalleryController::class, 'index'])->name('my_gallery');

    // User Subscribed Channels Routes
    Route::get('/subscriptions', [SubscriptionsController::class, 'index'])->name('subscriptions');

    // *** User chat with Channel Owner Routes
    // Route::get('/connections', [ConnectionsController::class, 'index'])->name('connections');

    // ***join private stream is in middleware auth
    Route::post('/private_stream', [PrivateStreamController::class, 'join_Private_Stream'])->name('private_stream');

    // ***Private stream
    Route::post('/private_stream_cart', [PrivateStreamController::class, 'private_stream_payment_process'])->name('private_stream_cart');

    // ***Private Stream Successful Page Redirection
    Route::get('/stream_payment_success', [PrivateStreamController::class, 'stream_payment_success'])->name('stream_payment_success');

    // ***Fetch each video info
    Route::post('/send_chat_req', [ChatController::class, 'send_chat_req'])->name('send_chat_req');

    // ***View all chat request listing
    Route::get('/view_chat_requests', [ChatController::class, 'index'])->name('view_chat_requests');

    // ***Update chat request
    Route::post('/update_chat_req', [ChatController::class, 'update_chat_req'])->name('update_chat_req');

    // ***List All User Friend Lists
    Route::get('/frinds_list', [ChatController::class, 'frinds_list'])->name('frinds_list');

    // ***List all msg & friend info
    Route::post('/get_all_msg', [ChatController::class, 'get_all_msg'])->name('get_all_msg');

    // ***Send The Msg To Friend
    Route::post('/ins_chat_msg', [ChatController::class, 'ins_chat_msg'])->name('ins_chat_msg');

    // ***load Auth User Msg Record In 5 Sec Interval
    Route::get('/load_auth_user_msg', [ChatController::class, 'load_auth_user_msg'])->name('load_auth_user_msg');

    // ***Chat Seen & Unseen Route
    Route::post('/unseen_count', [ChatController::class, 'unseen_count'])->name('unseen_count');

    // ***Generate link for publoc video
    Route::get('/public_video_link', [HomeController::class, 'public_video_link'])->name('public_video_link');

    // ***Like video
    Route::post('/video_like', [VideosController::class, 'videoLike'])->name('video_like');

    // ***Dislike video
    Route::post('/video_dislike', [VideosController::class, 'videoDislike'])->name('video_dislike');

    // ***Generate link for public stream
    Route::get('/public_stream_link', [StreamController::class, 'public_stream_link'])->name('public_stream_link');

    // ***view public stream
    Route::get('/share_stream/{streamId}', [StreamController::class, 'share_stream'])->name('share_stream');

    // ***Channel Search
    Route::get('/search_channel', [ChannelController::class, 'search_channel_result'])->name('search_channel');

    // Live Stream Record
    Route::get('/get_resource', [StreamRecorderController::class, 'getResource'])->name('get_resource');
    Route::get('/record_StartFun', [StreamRecorderController::class, 'recordStartFun'])->name('record_StartFun');
    Route::post('/stream_record_ins', [StreamRecorderController::class, 'streamRecordIns'])->name('stream_record_ins');
    Route::get('/fetch_stream_videos', [StreamRecorderController::class, 'fetchStreamVideos'])->name('fetch_stream_videos');
    Route::get('/watch_stream/{recorded_stream_id}', [StreamRecorderController::class, 'watchStream'])->name('watch_stream');

    // ***Create msg and store
    Route::post('/store_msg', [SupportController::class, 'create'])->name('store_msg');
});

// Free Plan Routes for users
Route::group(['middleware' => ['auth', 'role:0']], function () {
    // Currently No Route needed for free Role users
});

// Routes for Pro & Business ...
Route::group(['middleware' => ['auth', 'role:1,2']], function () {

    // User Account Info Routes
    Route::get('/user_account', [UserAccountController::class, 'index'])->name('user_account');
    Route::post('/create_payment_info', [UserAccountController::class, 'create_payment_info'])->name('create_payment_info');
    Route::post('/del_payment_info', [UserAccountController::class, 'del_payment_info'])->name('del_payment_info');
    Route::post('/edit_payment_info', [UserAccountController::class, 'edit_payment_info'])->name('edit_payment_info');
    Route::post('/update_payment_info', [UserAccountController::class, 'update_payment_info'])->name('update_payment_info');

    // User Wallet Info Routes
    // Route::get('/user_wallet', [WalletController::class, 'user_wallet'])->name('user_wallet');
    // Route::post('/credit_user_account', [WalletController::class, 'credit_user_account'])->name('credit_user_account');

    // Check If user not created Profile then Active Middleware
    Route::group(['middleware' => ['check_if_user_created_profile']], function () {
        Route::get('channel', [ChannelController::class, 'index'])->name('channel');

        Route::post('channel_create', [ChannelController::class, 'store'])->name('channel_create');
        Route::get('channel_edit', [ChannelController::class, 'edit'])->name('channel_edit');
        Route::post('channel_update', [ChannelController::class, 'update'])->name('channel_update');
        Route::post('channel_playlist_create', [ChannelController::class, 'channel_playlist_create'])->name('channel_playlist_create');

        // Video upload
        Route::get('/video_upload', [VideoUploadController::class, 'index'])->name('video_upload');
        Route::post('/video_upload_ins', [VideoUploadController::class, 'video_upload_ins'])->name('video_upload_ins');
        Route::get('/video_edit_frm', [VideoUploadController::class, 'video_edit_frm'])->name('video_edit_frm');
        Route::get('/find_video', [VideoUploadController::class, 'find_video'])->name('find_video');
        Route::post('/update_video', [VideoUploadController::class, 'update_video'])->name('update_video');

        // Playlist
        Route::get('/playlist', [PlayListController::class, 'index'])->name('playlist');
        Route::post('/playlist_create', [PlayListController::class, 'create'])->name('playlist_create');
        Route::get('/find_playlist', [PlayListController::class, 'edit'])->name('find_playlist');
        Route::post('/update_playlist', [PlayListController::class, 'update'])->name('update_playlist');

        // Video List
        Route::get('/videos', [VideosController::class, 'index'])->name('videos');

        // Playlist videos
        Route::get('/playlist_videos/{id}', [PlayListvideosController::class, 'index'])->name('playlist_videos');

        // ***Live stream single player
        Route::get('/stream_player', [StreamPlayerController::class, 'index'])->name('stream_player');

        // ***Live Stream Create
        Route::post('/live_stream_create', [LiveStreamController::class, 'create'])->name('live_stream_create');

        // ***Live Stream status update by host side Cancel || Pending
        Route::get('/stream_status', [StreamController::class, 'stream_status'])->name('stream_status');

        // ***Live Stream Edit Modal Popup and fetch single data
        Route::get('/stream_edit', [StreamController::class, 'stream_edit'])->name('stream_edit');

        // ***Live Stream update record
        Route::post('/stream_update', [StreamController::class, 'stream_update'])->name('stream_update');

        // ***Live Stream Join as a host
        Route::post('/channel/{channelSlug}/join_as_host', [StreamController::class, 'join_as_host'])->name('join_as_host');

        // ***Update Stream token based on stream Id
        Route::post('/stream_token_update', [StreamController::class, 'streamTokenUpd'])->name('stream_token_update');

        // Live Stream viewers create
        Route::post('/stream_record_create', [StreamController::class, 'stream_record_create'])->name('stream_record_create');
    });
});

// Pro Plan Routes for users
Route::group(['middleware' => ['auth', 'role:1']], function () {
    // Currently No Route needed for Pro Role users
});

// Business Routes
Route::group(['middleware' => ['auth', 'role:2']], function () {
    // Currently No Route needed for Business Role users
});


/**
 * Admin Route
 * Category Route
 **/
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin_auth'], function () {
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    // Admin Dashboard Routes
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Admin Self Profile Routes
    Route::get('/view_profile', [AdminController::class, 'view_profile'])->name('view_profile');
    Route::get('/get_admin_info', [AdminController::class, 'get_admin_info'])->name('get_admin_info');
    Route::post('/update_admin_info', [AdminController::class, 'update_admin_info'])->name('update_admin_info');

    // Admin Password Reset
    Route::get('/admin_settings', [AdminController::class, 'admin_settings'])->name('admin_settings');
    Route::post('/admin_pass_upd', [AdminController::class, 'admin_pass_upd'])->name('admin_pass_upd');

    // Admin Category Route
    Route::get('/category', [CategoryController::class, 'index'])->name('category');
    Route::post('/add_category', [CategoryController::class, 'add_category'])->name('add_category');
    Route::get('/del_category', [CategoryController::class, 'del_category'])->name('del_category');
    Route::get('/get_category', [CategoryController::class, 'get_category'])->name('get_category');
    Route::post('/update_category', [CategoryController::class, 'update_category'])->name('update_category');
    Route::get('/list_category', [CategoryController::class, 'list_category'])->name('list_category');

    // Admin Set Admin Channel Owner Commission Route
    Route::get('/add_commision', [AdminCommissionController::class, 'index'])->name('add_commision');
    Route::post('/update_commission', [AdminCommissionController::class, 'update_commission'])->name('update_commission');
    Route::get('/fetch_commission_info', [AdminCommissionController::class, 'getCommissionInfo'])->name('fetch_commission_info');
    Route::get('/view_all_commission', [AdminCommissionController::class, 'viewAllCommission'])->name('view_all_commission');

    // Admin View users uploaded video
    Route::get('/user_video', [AdminVideoController::class, 'user_video'])->name('user_video');
    // Admin Play Single View
    Route::get('/play_video/{id}', [AdminVideoController::class, 'play_video'])->name('play_video');
    // Admin Video status update
    Route::get('/video_status_update', [AdminVideoController::class, 'video_status_update'])->name('video_status_update');
    // Admin View users created channel
    Route::get('/user_channel', [AdminVideoController::class, 'user_channel'])->name('user_channel');
    // Admin View users created playlists
    Route::get('/user_playlist', [AdminVideoController::class, 'user_playlist'])->name('user_playlist');
    // Admin View all registered users
    Route::get('/all_user', [AdminVideoController::class, 'all_user'])->name('all_user');
    // Admin View each registered users info
    Route::get('/user_info/{id}', [AdminVideoController::class, 'user_info'])->name('user_info');
    // Admin playlist videos
    Route::get('/playlist_videos/{id}', [AdminVideoController::class, 'playlist_videos'])->name('playlist_videos');
    // Admin view payments
    Route::get('/payments_info', [AdminPaymentController::class, 'index'])->name('payments_info');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin_guest:admin'], function () {
    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/login_check', [LoginController::class, 'login_check'])->name('login_check');
});


// Test Controller
Route::get('/test', [TestController::class, 'test'])->name('test');

/**
 * Password Reset Routes
 * */
Route::get('/send_reset_password_email', [PasswordResetController::class, 'send_reset_password_email'])
    ->name('send_reset_password_email');
Route::get('/reset/{token}', [PasswordResetController::class, 'reset'])->name('reset');
Route::post('/reset_password', [PasswordResetController::class, 'reset_password'])->name('reset_password');

/**
 * Facebook Login Routes
 */
Route::get('/facebook_submit', [FacebookController::class, 'facebook_submit'])->name('facebook_submit');
Route::get('/facebook_callback', [FacebookController::class, 'facebook_callback'])->name('facebook_callback');

/**
 * Google Login Routes
 */
Route::get('/google_submit', [GoogleController::class, 'google_submit'])->name('google_submit');
Route::get('/google_resp', [GoogleController::class, 'google_callback'])->name('google_callback');


/**
 * Whereby Video Stream Routes
 */
// *** Stream Dashboard
Route::get('/user_dashboard', [StreamDashboardController::class, 'user_dashboard'])->name('user_dashboard');

// *** Create Meeting
Route::post('/create_meeting', [VideoLiveStreamController::class, 'create_meeting'])->name('create_meeting');

// *** Host Join Meeting
Route::post('/host_join_stream', [StreamDashboardController::class, 'host_join_stream'])->name('host_join_stream');

// *** Audience Join Meeting
Route::post('/audience_join_stream', [StreamDashboardController::class, 'audience_join_stream'])->name('audience_join_stream');


// *** Stripe Connected Account Routes

// Create Connected Account UI & Update Created Account
Route::get('/connected_account', [ConnectedAccountController::class, 'index'])->name('connected_account');

// Create Connected Account with API
Route::post('/stripe_create_account', [ConnectedAccountController::class, 'stripe_create_account'])->name('stripe_create_account');

// Update Connected Account with API
Route::post('/update_connected_account', [ConnectedAccountInfoController::class, 'update_connected_account'])->name('update_connected_account');

// Update Connected Account Bank Account Info with API
Route::post('/add_bank_account', [ConnectedAccountInfoController::class, 'add_bank_account'])->name('add_bank_account');

// User Earning Pagination
Route::get('/earning_pagination', [ConnectedAccountController::class, 'pagination'])->name('earning_pagination');
