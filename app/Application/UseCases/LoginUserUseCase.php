<?php
namespace App\Application\UseCases;

use App\Application\Services\UserService;
use Illuminate\Support\Facades\Hash;

class LoginUserUseCase
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function execute(string $email, string $password): ?string
    {
        $user = $this->userService->findUserByEmail($email);

        if (!$user || !Hash::check($password, $user->getPassword())) {
            return null;
        }

        return 'User authenticated successfully';
    }
}
