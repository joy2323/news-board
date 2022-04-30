<?php


use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Models\User;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Authenticating User
Route::post('/register',  [AuthController::class, 'userRegister']);
Route::post('/login',     [AuthController::class, 'userLogin']);

Route::middleware(['auth:sanctum','isPostOwner'])->prefix('post')->group(function () {
    Route::post('/', [PostController::class, 'createPost'])
            ->withoutMiddleware('isPostOwner');
    Route::get('/', [PostController::class, 'getAllPost'])
            ->withoutMiddleware('isPostOwner');
    Route::put('/update', [PostController::class, 'updatePost']);
    Route::delete('/delete', [PostController::class, 'deletePost']);
});
