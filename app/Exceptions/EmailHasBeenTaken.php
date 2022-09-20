<?php

namespace App\Exceptions;

use Exception;

class EmailHasBeenTaken extends Exception
{
    protected $message = 'Este e-mail já existe';
    public function render()
    {
        return response()->json([
            'error' => class_basename($this),
            'message' => $this->getMessage(),
        ], 400);
    }
}
