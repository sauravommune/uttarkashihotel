<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\User;
use Carbon\Carbon;


class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     */
    public function create(Request $request)
    {
        $user = User::where('email', $request->email)->first();
    
        if (!$user) {
            return redirect()->route('home')->with('error', 'User does not exist.');
        }
    
        $datetime1 = Carbon::parse($user->forgot_time);
        $datetime2 = now();
        $diffInMinutes = $datetime1->diffInMinutes($datetime2);
    
        if ($diffInMinutes <= 10 && $user->expiry_link == 0) {
            return view('auth.reset-password', ['request' => $request]);
        } else {
            return redirect()->route('home')->with('error', 'Link has expired please try again.');
        }
    }

    /**
     * Handle an incoming new password request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {

        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],

        ]);
    
        $user = User::where('email', $request->email)->first();

        if (!$user) {          
            return redirect()->route('home')->with('error', 'User not found');
               
        }else{
                $datetime1 = Carbon::parse($user->forgot_time);
                $datetime2 = now();
                $diffInMinutes = $datetime1->diffInMinutes($datetime2);
                 if($diffInMinutes <=10 && $user->expiry_link==0){
                    $user->forceFill([
                        'password' => Hash::make($request->password),
                        'remember_token' => Str::random(60), 
                        'expiry_link'    =>  1,
                    ])->save();

                    return redirect()->route('home')->with('status', 'Password Reset Successfully.');

                }
                else{
                    return redirect()->route('home')->with('error', 'Link expiry please try again !');
                }

          }
       }
}