<?php 
namespace App\Infrastructure\Controllers;

use App\Application\UseCases\LoginUserUseCase;
use App\Domain\DTOs\UserDTO;
use App\Http\Requests\LoginUserRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function __construct(
        private LoginUserUseCase $loginUserUseCase
    ) {}

    public function login(LoginUserRequest $request): JsonResponse
    {
        $credentials = $request->only('email', 'password');


        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('MyApp')->plainTextToken;
            return response()->json(['message' => 'Login successful', 'token' => $token], 200);
        } else {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
    }
}