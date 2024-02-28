<?php

namespace App\Services\Auth;

use Illuminate\Http\Request;

interface AuthenticationInterface
{
    public function securityCreditialUsername($request);

    public function authWithToken($request);

    public function expires_in_remember();

    public function auth($request);

    public function authSso($request);

    public function authSsoApi($request);
}
