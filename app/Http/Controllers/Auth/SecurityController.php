<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\User;
use Illuminate\Auth\AuthManager;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SecurityController extends Controller
{
    private $authManager;

    public function __construct(AuthManager $authManager)
    {
        $this->authManager = $authManager;
    }

    public function register(RegisterRequest $request)
    {
        $input = $request->only(['name', 'email', 'password', 'password_confirmation']);

        event(new Registered($user = User::registerUser($input)));

        $token = auth()->login($user);

        return response()->json($token);
    }

    public function login(LoginRequest $request)
    {
        $input = $request->only(['email', 'password']);

        $guard = $this->authManager->guard('api');
        $token = $guard->attempt($input);

        if (!$token) {
            return new JsonResponse(__('auth.failed'));
        }

        return new JsonResponse($token);
    }

    public function logout(Request $request)
    {
        auth()->logout();
        return new JsonResponse('Success logout');
    }
}
