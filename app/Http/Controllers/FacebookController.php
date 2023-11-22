<?php

namespace App\Http\Controllers;

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
