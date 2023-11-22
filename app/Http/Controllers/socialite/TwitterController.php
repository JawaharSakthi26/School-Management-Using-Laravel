<?php

namespace App\Http\Controllers\socialite;

use App\Http\Controllers\Controller;
use App\Http\Traits\SocialiteLoginTrait;

class TwitterController extends Controller
{
    use SocialiteLoginTrait;

    public function redirectToTwitter()
    {
        return $this->redirectToSocialite('twitter');
    }

    public function handleTwitterCallback()
    {
        return $this->handleSocialiteCallback('twitter');
    }
}
