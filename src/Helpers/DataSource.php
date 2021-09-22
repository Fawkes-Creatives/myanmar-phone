<?php
/**
 * @author fawkescreatives created on 20/09/2021
 */

namespace MyanmarPhone\Helpers;

use Illuminate\Config\Repository;
use Illuminate\Contracts\Foundation\Application;

class DataSource
{
    /**
     * Regular expression pattern of variable. Check for Network Providers.
     */
    const MEC_PATTERN_FOR_MATCHING = '/^(09|\+?959)3\d{7}$/';
    const MPT_PATTERN_FOR_MATCHING = '/^(09|\+?959)(2[0-4]\d{5}|5[0-6]\d{5}|8[13-7]\d{5}|4[1379]\d{6}|73\d{6}|91\d{6}|25\d{7}|26[0-5]\d{6}|40[0-4]\d{6}|42\d{7}|44[0-589]\d{6}|45\d{7}|87\d{7}|89[6789]\d{6})$/';
    const TELENOR_PATTERN_FOR_MATCHING = '/^(09|\+?959)7\d{8}$/';
    const OOREDOO_PATTERN_FOR_MATCHING = '/^(09|\+?959)9\d{8}$/';
    const MYTEL_PATTERN_FOR_MATCHING = '/^(09|\+?959)6\d{8}$/';

    const MPT = 'MPT';
    const MEC = 'MEC';
    const TELENOR = 'TELENOR';
    const OOREDOO = 'OOREDOO';
    const MYTEL = 'MYTEL';

    protected $regionCode = 'MM';
    protected $prefixCode = '95';
    protected $normalizeMaxLength = 11;
    protected $pureNumberMinLength = 7;

    /**
     * @return string
     */
    public function getRegionCode(): string
    {
        return $this->regionCode;
    }

    /**
     * @return string
     */
    public function getPrefixCode(): string
    {
        return $this->prefixCode;
    }

    /**
     * @return int
     */
    public function getNormalizeMaxLength(): int
    {
        return $this->normalizeMaxLength;
    }

    /**
     * @return int
     */
    public function getPureNumberMinLength(): int
    {
        return $this->pureNumberMinLength;
    }

    /**
     * @return Repository|Application|mixed
     */
    public function getDefaultFormat()
    {
        return config('myanmar_phone.default_format');
    }

    public function getMyanmarTelecoms(): array
    {
        return [
            self::MPT,
            self::OOREDOO,
            self::MYTEL,
            self::TELENOR,
            self::MEC
        ];
    }
}