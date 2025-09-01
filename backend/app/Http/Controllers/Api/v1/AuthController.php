<?php

namespace App\Http\Controllers\Api\v1;

use App\DTO\Auth\UserCreateDTO;
use App\Http\Controllers\Controller;
use App\Service\UserService;
use App\Traits\HandlesApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Throwable;
use WendellAdriel\ValidatedDTO\Exceptions\CastTargetException;
use WendellAdriel\ValidatedDTO\Exceptions\MissingCastTypeException;

class AuthController extends Controller
{
    use HandlesApiResponse;

    public function __construct(private readonly UserService $userService)
    {
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     * @throws CastTargetException
     * @throws MissingCastTypeException
     * @throws ValidationException|Throwable
     */
    public function register(Request $request): JsonResponse
    {
        $data = UserCreateDTO::fromRequest($request);

        return $this->respondCreated($this->userService->createUser($data));
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $credentials = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        if (!Auth::guard("web")->attempt($credentials)) {
            return $this->respondUnauthorized();
        }

        $request->session()->regenerate();

        return $this->respondSuccess();
    }

    public function logout(Request $request): JsonResponse
    {
        Auth::guard("web")->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return $this->respondSuccess();
    }
}
