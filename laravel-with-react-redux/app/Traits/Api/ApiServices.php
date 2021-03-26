<?php

namespace App\Traits\Api;

use Carbon\Carbon;
use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Auth;

trait ApiServices
{
    
   /**
     * Create a new personal access token
     * 
     * @return string
     */
    public function getPersonalAccessToken($request)
    {
        if ($request->remember_me === 'true')
        {
            Passport::personalAccessTokensExpireIn(Carbon::now()->addDays(15));
        }

        return $this->guard()
            ->user()
            ->createToken(env('PERSONAL_ACCESS_TOKEN'));
    }


    /**
     * Guard
     */
    public function guard()
    {
        return Auth::guard();
    }
}