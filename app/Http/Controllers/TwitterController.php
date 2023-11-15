<?php
  
namespace App\Http\Controllers;
  
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
  
class TwitterController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToTwitter()
    {
        return Socialite::driver('twitter')->redirect();
    }
          
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleTwitterCallback()
    {
        try {
        
            $user = Socialite::driver('twitter')->user();
         
            $finduser = User::where('email', $user->email)->first();
         
            if ($finduser) {
                Auth::login($finduser);
                if ($finduser->hasRole('Admin')) {
                    return redirect()->route('admin-dashboard.index')->with('message','Admin logged in Successfully');
                } elseif ($finduser->hasRole('Teacher')) {
                    return redirect()->route('teacher-dashboard.index')->with('message','Teacher logged in Successfully');
                } elseif ($finduser->hasRole('Student')) {
                    return redirect()->route('student-dashboard.index')->with('message','Student logged in Successfully');
                } 
            } else {
                return redirect()->route('login')->with('error', 'No user found with this Google account, Kindly contact the administrator');
            }
        
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}