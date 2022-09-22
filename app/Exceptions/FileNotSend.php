<?php

namespace App\Exceptions;

use Exception;

class FileNotSend extends Exception
{
    protected $message = 'A imagem não foi enviada';
    public function render()
    {
        return response()->json([
            'error' => class_basename($this),
            'message' => $this->getMessage(),
        ], 400);
    }
}
