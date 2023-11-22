<?php

namespace App\Http\Controllers\socialite;

use App\Http\Controllers\Controller;
use App\Http\Traits\SocialiteLoginTrait;

class GoogleController extends Controller
{
    use SocialiteLoginTrait;

    public function redirectToGoogle()
    {
        return $this->redirectToSocialite('google');
    }

    public function handleGoogleCallback()
    {
        return $this->handleSocialiteCallback('google');
    }
}
