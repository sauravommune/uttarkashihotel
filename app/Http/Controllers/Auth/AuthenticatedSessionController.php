<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Jobs\UserRegistered;
use App\Models\GoogleLoginSettings;
use App\Models\User;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Laravel\Socialite\Facades\Socialite;
use Spatie\Permission\Models\Role;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function __construct()
    {
        $googleLogin = GoogleLoginSettings::first();

        if($googleLogin){
            Config::set('services.google.client_id', $googleLogin->client_id);
            Config::set('services.google.client_secret', $googleLogin->client_secrete);
        }
    }
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {
        session(['url.intended' => url()->previous()]);
        $request->authenticate();
        $request->session()->regenerate();

        $user = $request->user();
        $loginType = decode($request->login_type);
        $isEmployee = !$user->hasRole('User');

        if ($loginType === 'front' && !$isEmployee) {
            return response()->json([
                'status' => 200,
                'message' => 'Login Successfully',
                'redirect' => session('url.intended', '/')
            ]);
        }

        if ($request->ajax()) {
            return $this->handleAjaxLogin($request, $user, $loginType);
        }

        if ($loginType === 'back') {
            return $this->handleBackOfficeLogin($user);
        }
    }

    private function handleAjaxLogin(Request $request, $user, $loginType)
    {
        if (!$user->hasAnyRole(['Admin', 'Super Admin', 'Staff', 'Affiliate', 'Accountant']) && $loginType === 'back') {
            Auth::logout();
            return response()->json(['status' => 401, 'message' => 'Invalid Details', 'redirect' => route('login')], 401);
        }

        $redirectRoutes = [
            'Affiliate'   => 'referral.index',
            'Admin'       => 'lead.index',
            'Super Admin' => 'lead.index',
            'Staff'       => 'lead.index',
            'Accountant'  => 'transactions.index'
        ];

        foreach ($redirectRoutes as $role => $route) {
            if ($user->hasRole($role)) {
                return response()->json(['status' => 200, 'message' => 'Login Successfully', 'redirect' => route($route, absolute: false)]);
            }
        }
    }

    private function handleBackOfficeLogin($user)
    {
        if (!$user->hasAnyRole(['Admin', 'Super Admin', 'Staff', 'Affiliate', 'Accountant'])) {
            Auth::logout();
            return redirect()->route('login')->withErrors(['message' => 'Invalid Details']);
        }

        $redirectRoutes = [
            'Affiliate'   => 'referral.index',
            'Admin'       => 'lead.index',
            'Super Admin' => 'lead.index',
            'Staff'       => 'lead.index',
            'Accountant'  => 'transactions.index'
        ];

        foreach ($redirectRoutes as $role => $route) {
            if ($user->hasRole($role)) {
                return redirect()->route($route);
            }
        }
    }



    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }

    public function signInwithGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callbackToGoogle()
    {
        session(['url.intended' => url()->previous()]);

        try {
            $user = Socialite::driver('google')->stateless()->user();
            $finduser = User::where('email', $user->email)->first();

            if ($finduser) {
                Auth::login($finduser);
                if( Auth::user()->hasRole('User')){
                    return redirect(url(session('url.intended','/')));
                }elseif(Auth::user()->hasRole('Admin')){
                    return redirect(route('lead.index', absolute: false));
                }

            } else {
                $password = randomPassword();
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'password' => Hash::make($password),
                ]);
                UserRegistered::dispatch($newUser, $password);
                $role = Role::where(['name' => 'User'])->first();
                if (empty($role)) {
                    $role = Role::create(['name' => 'User']);
                }
                $newUser->assignRole([$role->id]);

                if ($user->avatar) {
                    $client = new Client([
                        'verify' => false, // Disable SSL verification
                        'timeout' => 120,
                    ]);

                    try {
                        $response = $client->get($user->avatar);
                        if ($response->getStatusCode() == 200) {
                            $imageData = $response->getBody()->getContents();
                            // Generate a unique filename for the uploaded image
                            $contentType = $response->getHeader('Content-Type')[0];
                            $extension = explode('/', $contentType)[1];
                            $filename = uniqid() . '.' . $extension;

                            $storagePath = storage_path("uploads/avatar");
                            //create folder if doesnt exist
                            is_dir($storagePath) or mkdir($storagePath, 0755, true);

                            Storage::disk('public')->put('uploads/avatar/' . $filename, $imageData);

                            // Get the URL of the uploaded image
                            $imageUrl = 'storage/avatar/' . $filename;
                            $newUser->avatar = $imageUrl;
                            $newUser->save();
                        }
                    } catch (\Exception $e) {

                    }
                }

                Auth::login($newUser);
                if( Auth::user()->hasRole('User') )
                    return redirect(url(session('url.intended','/')));
            }

        } catch (Exception $e) {
            return redirect(url(session('url.intended','/')))->withErrors(['message' => $e->getMessage()]);
        }
    }
}
