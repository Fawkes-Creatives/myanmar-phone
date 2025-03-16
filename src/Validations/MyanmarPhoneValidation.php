<?php

/**
 * @author fawkescreatives created on 22/09/2021
 */

namespace MyanmarPhone\Validations;

use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Foundation\Application;
use libphonenumber\NumberParseException;
use MyanmarPhone\Exceptions\InvalidNumber;
use MyanmarPhone\MyanmarPhone;

class MyanmarPhoneValidation
{
    /**
     * @var Application|mixed|MyanmarPhone
     */
    protected $myanmarPhone;

    public function __construct()
    {
        $this->myanmarPhone = app(MyanmarPhone::class);
    }

    /**
     * @throws BindingResolutionException
     * @throws NumberParseException
     * @throws InvalidNumber
     * @throws Exception
     */
    public function validate($attribute, $value, array $parameters, $validator): bool
    {
        return $this->myanmarPhone->make($value)->check();
    }
}
