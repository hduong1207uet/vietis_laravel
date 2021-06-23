<?php

namespace App\Services;

use App;
use Auth;
use Config;
use Request;
use App\User;
use Exception;

/**
 * Class AuthService
 * @package App\Services
 */
class AuthService
{
    public function requestToken($passportConfig)
    {
        $token = Request::create('/oauth/token', 'POST', $passportConfig);
        $response = App::handle($token);

        if ($response->getStatusCode() != 200) {
            return [];
        }

        return json_decode($response->getContent(), true);
    }

    public function register(array $inputs = [])
    {
        try {
            $user = User::create([
                'name' => $inputs['name'],
                'email' => $inputs['email'],
                'password' => bcrypt($inputs['password']),
            ]);
        } catch (Exception $e) {
            report($e);
            $user = null;
        }

        return $user;
    }

    public function login(array $inputs = [])
    {
        $passportConfig = Config::get('services.passport');
        $passportConfig['email'] = $inputs['email'];
        $passportConfig['password'] = $inputs['password'];

        if (!Auth::attempt($inputs)) {
            return [];
        }

        return $this->requestToken($passportConfig);
    }
}