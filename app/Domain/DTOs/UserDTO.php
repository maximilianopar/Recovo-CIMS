<?php

namespace App\Domain\DTOs;

class UserDTO
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
    ){}

    public static function fromData(array $data) : self{
        return new self(
            name: $data['name'],
            email: $data['email'],
            password: $data['password'],
        );
    }
}