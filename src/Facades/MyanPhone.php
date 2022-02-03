<?php
/**
 * @author fawkescreatives created on 20/09/2021
 */

namespace MyanmarPhone\Facades;

use Illuminate\Support\Facades\Facade;
use MyanmarPhone\Contracts\MyanmarPhone;

/**
 * @method make(string $number))
 * @method getPhoneInstance()
 * @method getDataSource()
 * @method setStrPhoneNumber(string $number)
 * @method getStrPhoneNumber()
 * @method getCountryCode()
 * @method getPhoneNumber(bool $leadingZero = true)
 * @method format($format = null)
 * @method setSeparator($separator = null)
 * @method getSeparator()
 * @method response(string $number)
 * @method formatE164()
 * @method formatInternational()
 * @method formatRFC3966(string $separator = null)
 * @method formatNational(string $separator = null)
 * @method check()
 *
 * @see \MyanmarPhone\MyanmarPhone
 */

class MyanPhone extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return MyanmarPhone::class;
    }
}
