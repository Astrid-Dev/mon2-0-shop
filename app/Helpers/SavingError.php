<?php
namespace App\Helpers;

use Throwable;

class SavingError extends \Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        $message = $message ?: 'An error occurred while saving the data.';
        parent::__construct($message, $code, $previous);
    }

}
