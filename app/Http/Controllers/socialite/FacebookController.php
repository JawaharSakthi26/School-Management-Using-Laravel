<?php

namespace App\Http\Controllers\socialite;

use App\Http\Controllers\Controller;
use App\Http\Traits\SocialiteLoginTrait;

class FacebookController extends Controller
{
    use SocialiteLoginTrait;

    public function redirectToFacebook()
    {
        return $this->redirectToSocialite('facebook');
    }

    public function handleFacebookCallback()
    {
        return $this->handleSocialiteCallback('facebook');
    }
}
