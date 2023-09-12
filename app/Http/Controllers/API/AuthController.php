<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use App\Repositories\UserRoleRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use ReallySimpleJWT\Token;

class AuthController extends Controller
{
    protected const SECRET = "sec!ReT423*&";
    protected const EXPIRATION_ACCESS_TOKEN = 3600;
    protected const EXPIRATION_REFRESH_TOKEN = 2592000000;
    protected const DEFAULT_ROLE_USER = 2;
    protected const MIN_LENGTH_STR_EMAIL = 10;
    protected const MIN_LENGTH_STR_FULL_NAME = 3;
    protected const MAX_LENGTH_STR = 100;
    protected UserRepository $userRepository;
    protected UserRoleRepository $userRoleRepository;
    protected RoleRepository $roleRepository;

    public function __construct(UserRepository     $userRepository,
                                UserRoleRepository $userRoleRepository,
                                RoleRepository     $roleRepository)
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
        $this->userRepository = $userRepository;
        $this->userRoleRepository = $userRoleRepository;
        $this->roleRepository = $roleRepository;
    }

    public function login(Request $request)
    {
        try {
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
                    'message' => 'unauthorized',
                    'error_code' => UNAUTHORIZED
                ], STATUS_UNAUTHORIZED);
            }

            return response()->json([
                'authorization' => [
                    'access_token' => $accessToken,
                    'refresh_token' => $refreshToken,
                    'roles' => $roleName,
                    'type' => 'bearer',
                ]
            ]);
        } catch (\Exception $e) {
            Log::error("An error occurred during login: " . $e->getMessage());

            return response()->json([
                'message' => 'An error occurred during login.',
                'error_code' => INTERNAL_SERVER
            ], STATUS_INTERNAL_SERVER_ERROR);
        }
    }

    public function register(Request $request)
    {
        try {
            Log::info("Register user with email: " . $request->email);

            $valid = $this->validateBeforeCreate($request);
            $error = $valid->original;
            $field = $error['field'];
            $error_code = $error['error_code'];
            $message = $error['message'];

            if (!is_null($field) && !is_null($error_code) && !is_null($message)) {
                return response()->json([
                    'status' => STATUS_BAD_REQUEST,
                    'error_code' => BAD_REQUEST,
                    'errors' => [
                        'field' => $field,
                        'message' => $message,
                        'error_code' => $error_code
                    ]
                ], STATUS_BAD_REQUEST);
            }

            $user = $this->createUser($request);

            $this->createDefaultRoleForUser($user);

            return response()->json([
                'message' => 'User created successfully',
                'user_id' => $user->id
            ], 200);
        } catch (\Exception $e) {
            Log::error("An error occurred during registration: " . $e->getMessage());

            return response()->json([
                'status' => STATUS_INTERNAL_SERVER_ERROR,
                'error_code' => INTERNAL_SERVER,
                'message' => 'An error occurred during registration.'
            ], STATUS_INTERNAL_SERVER_ERROR);
        }
    }

    public function logout()
    {
        Auth::logout();
        return response()->json([
            'message' => 'Successfully logged out',
        ], STATUS_NO_CONTENT);
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
        $this->userRoleRepository->saveUserRole($user->id, self::DEFAULT_ROLE_USER);
    }

    private function validateBeforeCreate(Request $request): \Illuminate\Http\JsonResponse
    {
        $email = $request->email;
        $full_name = $request->full_name;
        $message = null;
        $error_code = null;
        $field = null;

        if (is_null($email)) {
            $error_code = BAD_REQUEST;
            $message = 'Email cannot leave blank';
            $field = 'email';
        }

        if (!is_string($email)) {
            $error_code = BAD_REQUEST;
            $message = 'Email cannot number';
            $field = 'email';
        }

        if (!preg_match(EMAIL_PATTERN, $email)) {
            $error_code = BAD_REQUEST;
            $message = 'Invalid email pattern';
            $field = 'email';
        }

        if (strlen($email) < self::MIN_LENGTH_STR_EMAIL) {
            $error_code = BAD_REQUEST;
            $message = 'Email must not be less than 10 characters';
            $field = 'email';
        }

        if (strlen($email) > self::MAX_LENGTH_STR) {
            $error_code = BAD_REQUEST;
            $message = 'Email must not be larger than 100 characters';
            $field = 'email';
        }

        if (is_null($full_name)) {
            $error_code = BAD_REQUEST;
            $message = 'Full name cannot leave blank';
            $field = 'full_name';
        }

        if (!is_string($full_name)) {
            $error_code = BAD_REQUEST;
            $message = 'Full name cannot number';
            $field = 'full_name';
        }

        if (!preg_match(NAME_PATTERN, $full_name)) {
            $error_code = BAD_REQUEST;
            $message = 'Do not using special character';
            $field = 'full_name';
        }

        if (strlen($full_name) > self::MAX_LENGTH_STR) {
            $error_code = BAD_REQUEST;
            $message = 'Full name must not be larger than 100 characters';
            $field = 'full_name';
        }

        if (strlen($full_name) < self::MIN_LENGTH_STR_FULL_NAME) {
            $error_code = BAD_REQUEST;
            $message = 'Full name must not be less than 3 characters';
            $field = 'full_name';
        }

        return response()->json([
            'field' => $field,
            'message' => $message,
            'error_code' => $error_code
        ], STATUS_BAD_REQUEST);
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
            $issuer = $user->full_name;
            $email = $user->email;
            $expiration_access_token = self::EXPIRATION_ACCESS_TOKEN * time();
            $expiration_refresh_token = self::EXPIRATION_REFRESH_TOKEN * time();

            $roleName = $this->roleRepository->getRoleNameByUserId($userId);

            $payloadAccessToken = [
                'email' => $email,
                'user_id' => $userId,
                'issuer' => $issuer,
                'role' => $roleName['name'],
                'exp' => $expiration_access_token
            ];

            $payloadRefreshToken = [
                'email' => $email,
                'user_id' => $userId,
                'issuer' => $issuer,
                'role' => $roleName['name'],
                'exp' => $expiration_refresh_token
            ];

            $accessToken = Token::customPayload($payloadAccessToken, $secret);
            $refreshToken = Token::customPayload($payloadRefreshToken, $secret);
        }
        return [$accessToken, $refreshToken, $roleName];
    }

}
