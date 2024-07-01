<?php
/**
 * @OA\OpenApi(
 *     @OA\Info(
 *         version="1.0.0",
 *         title="API Documentation",
 *         description="API Documentation for the application",
 *         @OA\Contact(
 *             email="support@example.com"
 *         ),
 *         @OA\License(
 *             name="Apache 2.0",
 *             url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *         )
 *     ),
 *     @OA\Server(
 *         url=L5_SWAGGER_CONST_HOST,
 *         description="API Server"
 *     )
 * )
 */

use App\Http\Controllers\Api\V1\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->middleware('throttle:api')->group(function () {
   Route::post('register', [AuthController::class, 'register']);
   Route::post('login', [AuthController::class, 'login']);
});

Route::prefix('v1')->middleware(['throttle:api', 'auth:sanctum'])->group( function () {
   Route::apiResource('categories', \App\Http\Controllers\Api\V1\CategoryController::class);
   Route::apiResource('products', \App\Http\Controllers\Api\V1\ProductController::class);

   Route::get('logout', [AuthController::class, 'logOut']);
});
