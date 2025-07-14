<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Traits\FileUpload;
use Exception;

class ProfileController extends Controller
{
    //
    use FileUpload;
    public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required',
            'dob' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'avatar' => 'mimes:jpeg,png',
        ]);

        try {
            $avatar = null;
            $id  = Auth::user()->id;
            $user = User::find($id);
            if ($request->avatar) {
                $removePath = asset('storage/' . $user->avatar);
                $avatar =  FileUpload::fileUpload('avatar', 'uploads/avatar', false, $removePath);
            }
            $user->name = $request->name;
            $user->phone = $request->phone;
            $user->address_1 = $request->address;
            $user->gender = $request->gender;
            $user->dob = $request->dob;
            $user->avatar = $avatar;
            $user->save();
            $response['user'] = new UserResource($user);
            return $this->sendResponse('Updated Successfully', $response, 200);
        } catch (Exception $e) {
            return $this->sendError($validator->errors(), $e->getMessage(), 404);
        }

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 'Validation Error', 422);
        }
    }
}
