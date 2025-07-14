<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CoTraveler;
use App\Repositories\ProfileRepository;
use App\Repositories\SavedHotelRepository;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Exception;



class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();
        Auth::logout();
        $user->delete();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return Redirect::to('/');
    }
    public function userprofile(ProfileRepository $profileRepository, SavedHotelRepository $savedHotelRepository)
    {
        $manageBooking =  $profileRepository->manageBooking();
        $co_traveler = CoTraveler::select('id', 'name', 'dob', 'gender', DB::raw('TIMESTAMPDIFF(YEAR, dob, CURDATE()) as age'))
            ->where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();

        $savedHotel = $savedHotelRepository->getSavedHotel();

        return view('front/profile', compact('manageBooking', 'co_traveler', 'savedHotel'));
    }

    public function updateProfile(Request $request)
    {

        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|max:255',
            'phone'     => 'required|string|max:15',
            'dob'       => 'nullable|date',
            'gender'    => 'nullable|in:male,female,other',
            'address_1' => 'nullable|string|max:255',
        ]);
        try {
            $user = Auth::user();
            if (!$user) {
                return response()->json(['status' => 401, 'message' => 'Please log in to update your profile.']);
            }
            $user->update([
                'name'      => $validated['name'],
                'email'     => $validated['email'],
                'phone'     => $validated['phone'],
                'dob'       => $validated['dob'] ?? null,
                'gender'    => $validated['gender'] ?? null,
                'address_1' => $validated['address_1'] ?? null,
            ]);
            return response()->json(['status' => 200, 'message' => 'Profile updated successfully.']);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => 'An error occurred: ' . $e->getMessage()]);
        }
    }


    public function updatePassword(Request $request)
    {
        $validatedData = $request->validate([
            'password' => 'required',
            'new_password' => 'required|string|min:8',
            'confirm_password' => 'required|string|min:8|same:new_password',
        ]);
        if (!Hash::check($request->password, auth()->user()->password)) {
            throw ValidationException::withMessages([
                'password' => ['The old password is incorrect.'],
            ]);
        }
        try {
            $check_user = User::find(Auth::user()->id);
            if ($check_user) {
                $check_user->password = Hash::make($validatedData['confirm_password']);
                $check_user->save();
                return response()->json(['status' => 200, 'message' => 'Password updated successfully']);
            } else {
                return response()->json(['status' => 400, 'message' => 'Please log in to update your password']);
            }
        } catch (ValidationException $e) {
            return response()->json(['status' => 400, 'message' => $e->errors()]);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' =>  $e->getMessage()]);
        }
    }
}
