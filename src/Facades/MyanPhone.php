<?php
/**
 * @author fawkescreatives created on 20/09/2021
 */

namespace MyanmarPhone\Facades;

use Illuminate\Support\Facades\Facade;

use MyanmarPhone\Contracts\MyanmarPhone;

class MyanPhone extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return MyanmarPhone::class;
    }
}