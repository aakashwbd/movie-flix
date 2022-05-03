<?php

use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\UploaderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('auth')->group(function () {
//    Route::post('signup', [AuthController::class, "userRegister"]);
    Route::post('register', [AuthController::class, "register"]);
    Route::post('login', [AuthController::class, "login"]);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('profile', [AuthController::class, "profileInfo"]);
    });
});

Route::get('member/profile/{id}', [AuthController::class, 'show']);
Route::post('profile/visit', [\App\Http\Controllers\ProfileVisitCountController::class, 'store']);
Route::get('profile/visitors', [\App\Http\Controllers\ProfileVisitCountController::class, 'show']);

Route::post('search-user', [AuthController::class, 'searchUser']);

Route::post('user/get-all', [AuthController::class, 'getAll']);
Route::post('user/fetch-all', [AuthController::class, 'getByUnAuth']);
Route::post('user/send-flash', [\App\Http\Controllers\FlashController::class, 'sendFlash']);

Route::get('user/{id}', [AuthController::class, 'show']);

Route::post('forgot-password', [AuthController::class, 'checkEmail']);
Route::post('recover-password', [AuthController::class, 'updatePassword']);

Route::get('/share-website',[\App\Http\Controllers\SocialShareController::class, 'index']);


Route::post('favourite/store', [\App\Http\Controllers\FavouriteController::class, 'store']);
Route::get('favourite', [\App\Http\Controllers\FavouriteController::class, 'index']);

Route::post('block/store', [\App\Http\Controllers\BlockController::class, 'store']);
Route::get('block', [\App\Http\Controllers\BlockController::class, 'index']);


Route::post('alert/store', [\App\Http\Controllers\AlertController::class, 'store']);

Route::post('rating/store', [\App\Http\Controllers\RatingController::class, 'store']);
Route::post('video/comment', [\App\Http\Controllers\VideoCommentController::class, 'store']);
Route::get('video/comment/{id}', [\App\Http\Controllers\VideoCommentController::class, 'show']);
Route::get('rating/count/{id}', [\App\Http\Controllers\RatingController::class, 'count']);

Route::post('testimony/store', [\App\Http\Controllers\TestimonyController::class, 'store']);
Route::get('testimony/{id}', [\App\Http\Controllers\TestimonyController::class, 'show']);
Route::get('testimony/all', [\App\Http\Controllers\TestimonyController::class, 'getAll']);


Route::post('send-messages', [\App\Http\Controllers\MessengerController::class, 'store']);
Route::get('get-message/{id}', [\App\Http\Controllers\MessengerController::class, 'getMessage']);
Route::get('get-message/all', [\App\Http\Controllers\MessengerController::class, 'getAllMessage']);




//Route::get('/check', [AuthController::class, 'userOnlineStatus']);




Route::prefix('admin')->group(function () {

    Route::get('/{user_role_id}', [\App\Http\Controllers\AdminController::class, 'index']);


    Route::post('/banner-image/store', [BannerController::class, 'store']);
    Route::get('/banner-image/index', [BannerController::class, 'index']);
//    Route::get('/banner-image', [AuthController::class, 'index']);

    Route::get('user/get-all', [AuthController::class, 'index']);
    Route::post('setting/store', [\App\Http\Controllers\SettingController::class, 'store']);
    Route::get('setting/get-all', [\App\Http\Controllers\SettingController::class, 'index']);
    Route::post('category/store', [\App\Http\Controllers\CategoryController::class, 'store']);
    Route::get('category/all', [\App\Http\Controllers\CategoryController::class, 'getAll']);
    Route::post('invite-code/store', [\App\Http\Controllers\InviteCodeController::class, 'store']);
    Route::post('invite-code/get-all', [\App\Http\Controllers\InviteCodeController::class, 'index']);
    Route::post('notification/store', [\App\Http\Controllers\NotificationController::class, 'store']);

    Route::get('package', [\App\Http\Controllers\PackageController::class, 'show']);
    Route::get('package/{id}', [\App\Http\Controllers\PackageController::class, 'getSingle']);
    Route::post('package/update', [\App\Http\Controllers\PackageController::class, 'update']);

    Route::post('/blog/store', [\App\Http\Controllers\BlogController::class, 'store']);
    Route::get('/blog/get-all', [\App\Http\Controllers\BlogController::class, 'show']);
    Route::get('/blog/{id}', [\App\Http\Controllers\BlogController::class, 'index']);

    Route::post('/flash', [\App\Http\Controllers\FlashController::class, 'store']);
    Route::get('/flash/get', [\App\Http\Controllers\FlashController::class, 'show']);

});
Route::post('/blog/comment', [\App\Http\Controllers\BlogCommentController::class, 'store']);
Route::post('file/store', [\App\Http\Controllers\FileController::class, 'store']);
Route::get('file/video', [\App\Http\Controllers\FileController::class, 'getVideo']);
Route::get('file/video/{id}', [\App\Http\Controllers\FileController::class, 'singleVideo']);
Route::post('file/video/search', [\App\Http\Controllers\FileController::class, 'search']);
Route::post('video/store', [\App\Http\Controllers\VideoController::class, 'store']);
Route::get('video/get-all', [\App\Http\Controllers\VideoController::class, 'index']);
Route::get('video/id', [\App\Http\Controllers\VideoController::class, 'update']);
Route::get('video/{id}', [\App\Http\Controllers\VideoController::class, 'getSingle']);
Route::post('video/search', [\App\Http\Controllers\VideoController::class, 'search']);
Route::post('place/store', [\App\Http\Controllers\AdController::class, 'store']);
Route::post('place/update', [\App\Http\Controllers\AdController::class, 'update']);
Route::get('place/get-all', [\App\Http\Controllers\AdController::class, 'getAll']);
Route::post('/news/search', [\App\Http\Controllers\AdController::class, 'search']);

Route::post('checkout', [\App\Http\Controllers\CheckoutController::class, 'store']);

Route::post('image-uploader', [UploaderController::class, 'imgUploader']);
Route::post('set-location', [\App\Http\Controllers\LocationController::class, 'store']);
Route::get('get-location', [\App\Http\Controllers\LocationController::class, 'getall']);

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
