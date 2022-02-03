<?php
/**
 * @author fawkescreatives created on 20/09/2021
 */

namespace MyanmarPhone\Contracts;

use libphonenumber\NumberParseException;
use MyanmarPhone\Exceptions\InvalidNumber;

interface MyanmarPhone
{
    /**
     * @param string $number
     * @return MyanmarPhone
     * @throws InvalidNumber
     * @throws NumberParseException
     */
    public function make(string $number): ?self;

    /**
     * @param string|int|null $format
     * @return string
     */
    public function format($format = null): string;

    /**
     * @return string
     */
    public function formatE164(): string;

    /**
     * @return string
     */
    public function formatInternational(): string;

    /**
     * @param string|null $separator
     * @return string
     */
    public function formatRFC3966(string $separator = null): string;

    /**
     * @param string|null $separator
     * @return string
     */
    public function formatNational(string $separator = null): string;

    /**
     * @param string|null $number
     * @return string
     */
    public function operator(string $number = null): string;

    /**
     * @param string|null $number
     * @return string
     */
    public function telecom(string $number = null): string;

    /**
     * @param string|null $number
     * @return bool
     */
    public function isTelenor(string $number = null): bool;

    /**
     * @param string|null $number
     * @return bool
     */
    public function isOoredoo(string $number = null): bool;

    /**
     * @param string|null $number
     * @return bool
     */
    public function isMpt(string $number = null): bool;

    /**
     * @param string|null $number
     * @return bool
     */
    public function isMyTel(string $number = null): bool;

    /**
     * @param string|null $number
     * @return bool
     */
    public function isMec(string $number = null): bool;
}
