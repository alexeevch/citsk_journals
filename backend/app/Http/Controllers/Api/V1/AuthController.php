<?php

namespace App\Http\Controllers\Api\V1;

use App\DTO\Auth\UserCreateDTO;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\Response;
use Hash;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class AuthController extends Controller
{
    use Response;

    public function register(Request $request): JsonResponse
    {
        try {
            $data = UserCreateDTO::fromRequest($request);
        } catch (ValidationException $e) {
            return $this->jsonError(0, $e->getMessage(), 400);
        }

        $user = new User;
        $user->email = $data->email;
        $user->login = $data->login;
        $user->password = Hash::make($data->password);
        $user->first_name = $data->first_name;
        $user->last_name = $data->last_name;
        $user->patronymic = $data->patronymic ?? null;
        $user->phone = $data->phone;
        $user->is_blocked = $data->is_blocked ?? false;
        $user->post = $data->post;
        $user->save();

        return $this->jsonSuccess($user, 201);
    }

    public function login(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'login'    => 'required|string',
                'password' => 'required|string'
            ]);
        } catch (ValidationException $e) {
            return $this->jsonError(0, $e->getMessage(), SymfonyResponse::HTTP_BAD_REQUEST);
        }

        if (!$token = auth()->attempt([
            "login"      => $request->get('login'),
            "password"   => $request->get('password'),
            "is_blocked" => false
        ])) {
            return $this->jsonUnathorized();
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the token array structure.
     *
     * @param  string  $token
     *
     * @return JsonResponse
     */
    protected function respondWithToken(string $token): JsonResponse
    {
        return $this->jsonSuccess([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth()->factory()->getTTL() * 60
        ]);
    }
}
