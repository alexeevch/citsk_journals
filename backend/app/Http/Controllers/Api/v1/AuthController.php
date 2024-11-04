<?php

namespace App\Http\Controllers\Api\v1;

use App\DTO\Auth\UserCreateDTO;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\Response;
use Hash;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;
use WendellAdriel\ValidatedDTO\Exceptions\CastTargetException;
use WendellAdriel\ValidatedDTO\Exceptions\MissingCastTypeException;

class AuthController extends Controller
{
    use Response;

    /**
     * @param  Request  $request
     *
     * @return JsonResponse
     * @throws CastTargetException
     * @throws MissingCastTypeException
     * @throws ValidationException
     */
    public function register(Request $request): JsonResponse
    {
        $data = UserCreateDTO::fromRequest($request);

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

        return $this->jsonSuccess($user, SymfonyResponse::HTTP_CREATED);
    }

    /**
     * @param  Request  $request
     *
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'login'    => 'required|string',
            'password' => 'required|string'
        ]);

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
     * @return JsonResponse
     */
    public function refresh(): JsonResponse
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        auth()->logout();

        return $this->jsonSuccess();
    }

    /**
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
