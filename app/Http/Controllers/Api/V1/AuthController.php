<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * @OA\Post(
     *      path="/api/v1/register",
     *      tags={"Auth"},
     *      summary="Register a new user",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreUserRequest")
     *      ),
     *      @OA\Response(
     *          response="200",
     *          description="User registered successfully",
     *          @OA\JsonContent(ref="#/components/schemas/User")
     *      ),
     *      @OA\Response(
     *          response="422",
     *          description="Validation error",
     *      )
     * )
     */
    public function register(StoreUserRequest $request)
    {
        return User::create($request->all());
    }

    /**
     * @OA\Post(
     *      path="/api/v1/login",
     *      tags={"Auth"},
     *      summary="Log in a user",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/LoginUserRequest")
     *      ),
     *      @OA\Response(
     *          response="200",
     *          description="User logged in successfully",
     *          @OA\JsonContent(
     *              @OA\Property(property="user", ref="#/components/schemas/User"),
     *              @OA\Property(property="token", type="string")
     *          )
     *      ),
     *      @OA\Response(
     *          response="401",
     *          description="Unauthorized - Wrong email or password",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Wrong email or password")
     *          )
     *      )
     * )
     */
    public function login(LoginUserRequest $request)
    {
        if (!Auth::attempt($request->only(['email', 'password']))) {
            return response()->json([
                'message' => 'Wrong email or password'
            ], 401);
        }

        $user = User::query()->where('email', $request->email)->first();
        $user->tokens()->delete();
        return response()->json([
            'user' => $user,
            'token' => $user->createToken($user->name)->plainTextToken
        ]);
    }

    /**
     * @OA\Get(
     *      path="/api/v1/logout",
     *      tags={"Auth"},
     *      summary="Log out the current user",
     *      @OA\Response(
     *          response="200",
     *          description="Token removed"
     *      )
     * )
     */
    public function logOut()
    {
        Auth::user()->currentAccessToken()->delete();
        return response()->json([
            'message' => 'Token removed'
        ]);
    }
}
