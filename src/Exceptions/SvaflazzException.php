<?php

namespace Svakode\Svaflazz\Exceptions;

use Exception;

class SvaflazzException extends Exception
{
    public static function requestFailed(string $rc, string $message, int $code)
    {
        $error = [
            'summary' => "Got error with message: `{$message}` and response code: `{$rc}`",
            'message' => $message,
            'response_code' => $rc
        ];

        return new static(json_encode($error), $code);
    }

    public function render($request)
    {
        return response(['error' => json_decode($this->getMessage())], $this->getCode());
    }
}
