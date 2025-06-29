<?php

namespace App\Http\Controllers\Api\v1;

use App\DTO\Auth\UserCreateDTO;
use App\Http\Controllers\Controller;
use App\Service\UserService;
use App\Traits\HandlesApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use WendellAdriel\ValidatedDTO\Exceptions\CastTargetException;
use WendellAdriel\ValidatedDTO\Exceptions\MissingCastTypeException;

class AuthController extends Controller
{
    use HandlesApiResponse;

    public function __construct(private readonly UserService $userService)
    {
    }

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

        return $this->respondCreated($this->userService->createUser($data));
    }

    /**
     * @param  Request  $request
     *
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'email'    => 'required|string',
            'password' => 'required|string'
        ]);

        if (!$token = auth()->attempt([
            "email"      => $request->get('email'),
            "password"   => $request->get('password'),
            "is_blocked" => false
        ])) {
            return $this->respondUnauthorized();
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

        return $this->respondSuccess();
    }

    /**
     *
     * @param  string  $token
     *
     * @return JsonResponse
     */
    protected function respondWithToken(string $token): JsonResponse
    {
        return $this->respondSuccess([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth()->factory()->getTTL() * 60
        ]);
    }
}
