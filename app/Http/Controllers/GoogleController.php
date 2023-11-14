<?php
  
namespace App\Http\Controllers;
  
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();

            $findUser = User::where('email', $user->email)->first();

            if ($findUser) {
                Auth::login($findUser);
                if ($findUser->hasRole('Admin')) {
                    return redirect()->route('admin-dashboard.index')->with('message','Admin logged in Successfully');
                } elseif ($findUser->hasRole('Teacher')) {
                    return redirect()->route('teacher-dashboard.index')->with('message','Teacher logged in Successfully');
                } elseif ($findUser->hasRole('Student')) {
                    return redirect()->route('student-dashboard.index')->with('message','Student logged in Successfully');
                } 
            } else {
                return redirect()->route('login')->with('error', 'No user found with this Google account, Kindly contact the administrator');
            }
        } catch (Exception $e) {
            return redirect()->route('login')->with('error', 'Error during Google login. Please try again.');
        }
    }
}
