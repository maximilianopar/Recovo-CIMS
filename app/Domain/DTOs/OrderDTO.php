<?php

namespace App\Domain\DTOs;

class OrderDTO
{
    public function __construct(
        public string $userId,
        public string $items,
        public string $total,
    ){}

    public static function fromData(array $data) : self{
        return new self(
            userId: $data['userId'],
            items: $data['items'],
            total: $data['total'],
        );
    }
}