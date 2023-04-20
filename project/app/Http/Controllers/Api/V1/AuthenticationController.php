<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
// usecases
use App\UseCase\Authentication\LoginUseCase;
use App\UseCase\Authentication\LogoutUseCase;
use App\UseCase\Authentication\MeUseCase;
// service
use App\Services\AuthenticationService;
// openapi
use App\OpenAPI;
use App\Libs\OpenAPIUtility;

class AuthenticationController extends Controller
{
    private AuthenticationService $authentication_service;
    public function __construct()
    {
        $this->authentication_service = new AuthenticationService();
    }

    /**
     * ログイン
     *
     * @param  Request $request
     * @return JsonResponse
     */
    public function login(Request $request, LoginUseCase $acion): JsonResponse
    {
        $requestBody = new OpenAPI\Model\AuthenticationLoginPostRequest($request->all());
        $user = $acion($requestBody->getEmail(), $requestBody->getPassword(), $requestBody->getRemember());
        if ($user) {
            return response()->json(
                OpenAPIUtility::dicstionaryToModelContainer(OpenAPI\Model\User::class, $user->toArray()),
                Response::HTTP_OK
            );
        }
        return response()->json(
            [],
            Response::HTTP_UNAUTHORIZED
        );
    }

    /**
     * ログアウト
     *
     * @param  Request $request
     * @return JsonResponse
     */
    public function logout(Request $request, LogoutUseCase $action): JsonResponse
    {
        $action();
        return response()->json(
            [],
            Response::HTTP_OK
        );
    }

    /**
     * ログイン中のユーザー情報を返す
     *
     * @param  Request $request
     * @return JsonResponse
     */
    public function me(Request $request, MeUseCase $acion): JsonResponse
    {
        $user = $acion();
        if ($user) {
            return response()->json(
                OpenAPIUtility::dicstionaryToModelContainer(OpenAPI\Model\User::class, $user->toArray()),
                Response::HTTP_OK
            );
        }
        return response()->json(
            [],
            Response::HTTP_NO_CONTENT
        );
    }
}
