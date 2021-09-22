<?php
/**
 * @author fawkescreatives created on 22/09/2021
 */

namespace MyanmarPhone\Validations;

use Exception;
use Illuminate\Contracts\Foundation\Application;
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

    public function validate($attribute, $value, array $parameters, $validator): bool
    {
        try {
            return $this->myanmarPhone->make($value)->check();
        } catch (Exception $exception) {
            return false;
        }
    }
}