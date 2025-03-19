<?php

namespace App\Application\Services;

use App\Domain\Repositories\UserRepositoryInterface;
use App\Domain\Entities\User;
use App\Domain\DTOs\UserDTO;
use Illuminate\Support\Facades\Hash;

class UserService
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Busca un usuario por su dirección de correo electrónico.
     *
     * @param string $email Correo electrónico del usuario.
     * @return User|null Retorna el usuario si se encuentra, de lo contrario null.
     */
    public function findUserByEmail(string $email): ?User
    {
        return $this->userRepository->findByEmail($email);
    }
}
