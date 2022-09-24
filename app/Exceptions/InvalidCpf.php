<?php

namespace App\Exceptions;

use Exception;

class InvalidCpf extends Exception
{
    protected $message = 'Este CPF é inválido';
    public function render()
    {
        return response()->json([
            'error' => class_basename($this),
            'message' => $this->getMessage(),
        ], 400);
    }
}
