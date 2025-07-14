<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Exception;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if ($validate->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validate->errors()
                ], 422);
            }

            $remember_me = !empty($request->remember_me) ? true : false;

            if (!Auth::attempt($request->only(['email', 'password'], $remember_me))) {
                return response()->json([
                    'status' => false,
                    'message' => 'Email & Password does not match with our record!'
                ], 401);
            }

            $user = Auth::user();
            // $userRoles = $user->roles->pluck('name');

            return response()->json([
                'status' => true,
                'message' => 'User Logged In Successfully.',
                'user' => new UserResource($user),
                // 'roles' => $userRoles,
                'token' => $user->createToken("HottelApi")->accessToken
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function register(Request $request)
    {
        if (!empty(User::withTrashed()->where('email', $request->email)->first()?->id)) {
            $user = User::withTrashed()->where('email', $request->email)->first();
            if ($user->trashed()) {
                $user->restore();
            }

            $user->update([
                'name' => $request->name,
                'password' => Hash::make($request->password),
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
                'password_confirmation' => 'required|same:password'
            ]);

            if ($validator->fails()) {
                return $this->sendError($validator->errors(), 'Validation Error', 422);
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
        }

        $user->syncRoles(['User']);

        $token = $user->createToken('HottelApi')->accessToken;
        $data['user'] = new UserResource($user);
        $data['token'] = $token;
        return $this->sendResponse('Registration Successful', $data, 201);
    }

    public function socialLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'social_type' => 'required|in:google,apple',
            'social_id' => 'required|string', // Social platform unique ID
        ]);

        try {
            $email = $request->input('email');
            $socialType = $request->input('social_type');
            $socialId = $request->input('social_id');

            $user = User::where('social_id', $socialId)->where('social_type', $socialType)->first();
            if (!$user) {
                $user = User::withTrashed()->where('email', $email)->first();
                if (!$user) {
                    $user = User::create([
                        'name'  => $email,
                        'email' => $email,
                        'social_type' => $socialType,
                        'social_id' => $socialId,
                    ]);
                } else {
                    if ($user->trashed()) {
                        $user->restore();
                    }
                    $user->update([
                        'social_type' => $socialType,
                        'social_id' => $socialId,
                    ]);
                }
            }
            return response()->json([
                'status' => true,
                'message' => 'User Logged In Successfully.',
                'user' => new UserResource($user),
                'token' => $user->createToken("HottelApi")->accessToken
            ], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
    public function logout(Request $request)
    {
        try {
            $request->user()->tokens()->delete();
            return response()->json(['status' => true, 'message' => 'User logged out successfully.'], 200);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
