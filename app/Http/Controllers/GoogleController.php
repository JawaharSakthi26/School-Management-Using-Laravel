<?php

namespace App\Http\Controllers;

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
