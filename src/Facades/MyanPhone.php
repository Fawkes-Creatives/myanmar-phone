<?php
/**
 * @author fawkescreatives created on 20/09/2021
 */

namespace MyanmarPhone\Facades;

use Illuminate\Support\Facades\Facade;
use MyanmarPhone\Contracts\MyanmarPhone;
use MyanmarPhone\Helpers\DataSource;

/**
 * @method static \MyanmarPhone\MyanmarPhone make(string $number))
 * @method static \libphonenumber\PhoneNumber getPhoneInstance()
 * @method static DataSource getDataSource()
 * @method static \MyanmarPhone\MyanmarPhone setStrPhoneNumber(string $number)
 * @method static string|null getStrPhoneNumber()
 * @method static string|null getCountryCode()
 * @method static string getPhoneNumber(bool $leadingZero = true)
 * @method static string format($format = null)
 * @method static \MyanmarPhone\MyanmarPhone setSeparator($separator = null)
 * @method static string|null getSeparator()
 * @method static string|null response(string $number)
 * @method static string formatE164()
 * @method static string formatInternational()
 * @method static string formatRFC3966(string $separator = null)
 * @method static string formatNational(string $separator = null)
 * @method static bool check()
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
