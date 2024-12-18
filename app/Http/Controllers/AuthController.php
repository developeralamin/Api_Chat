<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\ProfileResource;
use App\Repository\AuthRepository;

class AuthController extends Controller
{

    private AuthRepository $auth;

    public function __construct(AuthRepository $auth)
    {
        $this->auth = $auth;
    }


    /**
     * User login.
     *
     * @param LoginRequest $request
     *
     * @return JsonResponse|Response
     */
    public function login(LoginRequest $request): JsonResponse|Response
    {
        $user = $this->auth->login($request->email, $request->password);

        if (!$user) {
            return $this->fail('Incorrect email address. Please use correct email');
        }

        $token = $user->createToken('authToken')->plainTextToken;
        $response = [
            'user'  => new ProfileResource($user),
            'token' => $token,
        ];

        return $this->success($response, 200);

    }

    /**
     * User registration.
     *
     * @param RegistrationRequest $request
     *
     * @return Response
     */
    public function register(RegistrationRequest $request)
    {
        $this->auth->register($request->only(['name', 'email', 'password']));

        return $this->success('Thanks for Registration.', 201);
    }
}
