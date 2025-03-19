<?php
namespace App\Domain\DTOs;

class CartDetailsDTO
{
    public function __construct(
        public int $userId,
    ) {}

    public static function fromData(array $data): self
    {
        return new self(
            userId: $data['userId'],
        );
    }
}