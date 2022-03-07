<?php

namespace App\Exception;

class ViewNotFoundException extends \Exception
{
    protected $message = "404 not found";
}