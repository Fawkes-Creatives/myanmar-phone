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
     * @throws InvalidNumber
     * @throws NumberParseException
     */
    public function make(string $number): ?self;

    /**
     * @param  string|int|null  $format
     */
    public function format($format = null): string;

    public function formatE164(): string;

    public function formatInternational(): string;

    public function formatRFC3966(?string $separator = null): string;

    public function formatNational(?string $separator = null): string;

    public function operator(?string $number = null): string;

    public function telecom(?string $number = null): string;

    public function isTelenor(?string $number = null): bool;

    public function isOoredoo(?string $number = null): bool;

    public function isMpt(?string $number = null): bool;

    public function isMyTel(?string $number = null): bool;

    public function isMec(?string $number = null): bool;
}
