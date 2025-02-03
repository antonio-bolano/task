<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use OpenApi\Attributes as OA;

class LoginController extends Controller
{
    /**
     * User Login Endpoint
     */
    #[OA\Post(
        path: "/api/login",
        summary: "User Login",
        description: "Authenticate user and generate access token",
        tags: ["Authentication"]
    )]
    #[OA\RequestBody(
        description: "User login credentials",
        required: true,
        content: new OA\MediaType(
            mediaType: "application/json",
            schema: new OA\Schema(
                properties: [
                    new OA\Property(
                        property: "email",
                        type: "string",
                        format: "email",
                        example: "test@example.com"
                    ),
                    new OA\Property(
                        property: "password",
                        type: "string",
                        format: "password",
                        example: "password"
                    )
                ],
                required: ["email", "password"]
            )
        )
    )]
    #[OA\Response(
        response: 200,
        description: "Successful login",
        content: new OA\MediaType(
            mediaType: "application/json",
            schema: new OA\Schema(
                properties: [
                    new OA\Property(property: "user", type: "object",
                        properties: [
                            new OA\Property(property: "id", type: "integer", example: 1),
                            new OA\Property(property: "name", type: "string", example: "John Doe"),
                            new OA\Property(property: "email", type: "string", format: "email", example: "user@example.com")
                        ]
                    ),
                    new OA\Property(property: "token", type: "string", description: "Bearer token for authentication")
                ]
            )
        )
    )]
    #[OA\Response(
        response: 401,
        description: "Invalid Credentials",
        content: new OA\MediaType(
            mediaType: "application/json",
            schema: new OA\Schema(
                properties: [
                    new OA\Property(property: "message", type: "string", example: "Invalid credentials")
                ]
            )
        )
    )]
    public function __invoke(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password)){
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }

        $token = $user->createToken('token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ], 200);
    }
}


