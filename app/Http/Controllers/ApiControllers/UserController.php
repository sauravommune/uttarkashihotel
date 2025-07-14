<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUser(Request $request)
    {
        try {
            $user =  User::find($request->user_id);
            $response['user'] = new UserResource($user);
            return $this->sendResponse('Found', $response, 200);
        } catch (Exception $e) {
            return $this->sendError('Not Found', 'User Not Found', 500);
        }
    }

    public function deactivateUser(Request $request)
    {
        try {
            $request->user()->delete();
            return $this->sendResponse('Account Deleted Successfully', [], 200);
        } catch (Exception $e) {
            return $this->sendError('Not Found', 'User Not Found', 500);
        }
    }
}
