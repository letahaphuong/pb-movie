<?php

namespace App\Http\Controllers\API;

use App\Http\common\constants\ErrorCodes;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use App\Repositories\UserRoleRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use ReallySimpleJWT\Token;

class AuthController extends Controller
{
    protected const SECRET = "sec!ReT423*&";
    protected const EXPIRATION_ACCESS_TOKEN = 3600;
    protected const EXPIRATION_REFRESH_TOKEN = 2592000000;
    protected ErrorCodes $error_codes;
    protected UserRepository $userRepository;
    protected UserRoleRepository $userRoleRepository;
    protected RoleRepository $roleRepository;

    public function __construct(ErrorCodes         $errorCodes,
                                UserRepository     $userRepository,
                                UserRoleRepository $userRoleRepository,
                                RoleRepository     $roleRepository)
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
        $this->error_codes = $errorCodes;
        $this->userRepository = $userRepository;
        $this->userRoleRepository = $userRoleRepository;
        $this->roleRepository = $roleRepository;
    }

    public function login(Request $request)
    {
        Log::info("Login with email: " . $request->email);
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $tokenResponse = $this->createToken($request);
        $accessToken = $tokenResponse[0];
        $refreshToken = $tokenResponse[1];
        $roleName = $tokenResponse[2];

        if (!$accessToken) {
            return response()->json([
                'message' => 'emailOrPasswordInvalid',
                'error_code' => $this->error_codes::INVALID_EMAIL_OR_PASSWORD
            ], 401);
        }

        return response()->json([
            'authorization' => [
                'access_token' => $accessToken,
                'refresh_token' => $refreshToken,
                'roles' => $roleName,
                'type' => 'bearer',
            ]
        ]);
    }

    public function register(Request $request)
    {
        Log::info("Register user with email: " . $request->id);

        $this->validateBeforeCreate($request);

        $user = $this->createUser($request);

        $this->createDefaultRoleForUser($user);

        return response()->json([
            'message' => 'User created successfully',
            'user_id' => $user->id
        ], 200);
    }

    public function logout()
    {
        Auth::logout();
        return response()->json([
            'message' => 'Successfully logged out',
        ]);
    }

    public function refresh()
    {
        return response()->json([
            'user' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }

    private function createUser(Request $request)
    {
        return User::create([
            'email' => $request->email,
            'full_name' => $request->full_name,
            'password' => Hash::make($request->password),
        ]);
    }

    private function createDefaultRoleForUser(User $user)
    {
        $this->userRoleRepository->saveUserRole($user->id, 2);
    }

    /**
     * @throws ValidationException
     */
    private function validateBeforeCreate(Request $request): void
    {
    }

    private function createToken(Request $request): array
    {
        $credentials = $request->only('email', 'password');
        Auth::attempt($credentials);

        $user = Auth::user();
        $accessToken = null;
        $refreshToken = null;
        $roleName = null;
        if (!empty($user)) {
            $userId = $user->id;

            $secret = self::SECRET;
            $expiration_access_token = self::EXPIRATION_ACCESS_TOKEN * time();
            $expiration_refresh_token = self::EXPIRATION_REFRESH_TOKEN * time();
            $issuer = $user->full_name;

            $accessToken = Token::create($userId, $secret, $expiration_access_token, $issuer);
            $refreshToken = Token::create($userId, $secret, $expiration_refresh_token, $issuer);

            $roleName = $this->roleRepository->getRoleNameByUserId($userId);
        }
        return [$accessToken, $refreshToken, $roleName];
    }

}
