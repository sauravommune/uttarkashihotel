<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use App\Models\User;
use App\Traits\ConfiguresDynamicMailSettings;

class PasswordResetLinkController extends Controller
{
    use ConfiguresDynamicMailSettings;
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        // Validate input
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', 'exists:users,email'],
        ], [
            'email.required' => 'This field is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.exists' => 'This email is not registered.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->errors(),
            ], 422);
        }

        $this->configureDynamicMailSettings();
        // Attempt to send reset link
        $status = Password::sendResetLink(['email' => $request->email]);

        if ($status === Password::RESET_LINK_SENT) {
            User::where('email', $request->email)->update([
                'forgot_time' => now(),
                'expiry_link' => 0,
            ]);

            return response()->json([
                'status' => 200,
                'message' => 'Password reset link has been sent to your email.',
                'redirect' => '/',
            ], 200);
        }

        return response()->json([
            'status' => 400,
            'message' => 'Failed to send reset link. Please try again later.',
            'redirect' => '/',
        ], 400);
    }
}
