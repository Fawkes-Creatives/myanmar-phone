<?php

/**
 * @author fawkescreatives created on 20/09/2021
 */

namespace MyanmarPhone\Exceptions;

class FormatException extends AbstractMyanmarPhoneException
{
    protected $code = 400;

    protected $message = 'Invalid format type';
}
