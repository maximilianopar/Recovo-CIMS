<?php

namespace App\Exceptions;

use Exception;

class CartItemNotFoundException extends Exception
{
    /**
     * Crea una nueva excepción de CartItem no encontrado.
     *
     * @param string $message
     * @param int $code
     */
    public function __construct($message = "The product cannot be updated because it does not exist, please add it.", $code = 404)
    {
        parent::__construct($message, $code);
    }
}
