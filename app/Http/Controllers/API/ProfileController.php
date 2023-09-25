<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use ReallySimpleJWT\Token;

class ProfileController extends Controller
{
    protected UserRepository $userRepository;
    protected RoleRepository $roleRepository;

    public function __construct(UserRepository $userRepository,
                                RoleRepository $roleRepository)
    {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }

    public function getProfile(): string
    {
        try {
            Log::info('Get basic info user');
            $request = Request::capture();
            $payload = Token::getPayload($request->bearerToken());

            $userId = $payload['user_id'];

            $user = $this->userRepository->getBasicInfoById($userId);

            $roleName = $this->roleRepository->getRoleNameByUserId($userId);
            return response()->json([
                'email' => $user->email,
                'full_name' => $user->full_name,
                'created_at' => $user->created_at,
                'role' => $roleName
            ]);
        } catch (\Exception $e) {
            Log::error("An error occurred during registration: " . $e->getMessage());

            return response()->json([
                'status' => STATUS_INTERNAL_SERVER_ERROR,
                'error_code' => INTERNAL_SERVER,
                'message' => 'An error occurred during registration.'
            ], STATUS_INTERNAL_SERVER_ERROR);
        }
    }
}
