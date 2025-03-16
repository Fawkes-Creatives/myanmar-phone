<?php

/**
 * @author fawkescreatives created on 20/09/2021
 */

namespace MyanmarPhone\Traits;

use libphonenumber\PhoneNumberFormat;
use MyanmarPhone\Exceptions\FormatException;
use MyanmarPhone\Exceptions\InvalidNumber;
use ReflectionClass;

trait Parser
{
    /**
     * @param  int|string  $format
     * @return int|string
     *
     * @throws FormatException
     */
    public function parseFormat($format)
    {
        if (in_array($format, static::libphonenumberFormats())) {
            return $format;
        }

        throw new FormatException;
    }

    /**
     * Return phone number formats with libphonenumber
     */
    protected static function libphonenumberFormats(): array
    {
        return (new ReflectionClass(PhoneNumberFormat::class))
            ->getConstants();
    }

    /**
     * @throws InvalidNumber
     */
    public function normalize(string $number): string
    {
        if (mb_strlen($number) < $this->getDataSource()->getPureNumberMinLength()) {
            throw new InvalidNumber;
        }

        $number = $this->normalizeDigits($number);
        $number = $this->normalizeLeadingZero($number);
        $number = $this->normalizeAreaCode($number);

        return $this->normalizeCountryCode($number);
    }

    /**
     * Get only digits
     */
    public function normalizeDigits(string $number): string
    {
        return preg_replace('/[^0-9]/', '', trim($number));
    }

    /**
     * Remove leading zero
     */
    public function normalizeLeadingZero(string $number): string
    {
        return ltrim($number, '0');
    }

    public function normalizeAreaCode($number): string
    {
        return sprintf('%9d', $number);
    }

    /**
     * Remove country code
     */
    public function normalizeCountryCode(string $number): string
    {
        $max = $this->getDataSource()->getNormalizeMaxLength();
        $prefixCode = $this->getDataSource()->getPrefixCode();

        do {
            $number = preg_replace("/^\+?$prefixCode/", '', $number);
        } while (mb_strlen($number) > $max);

        return $number;
    }

    /**
     * @param  string  $replacement
     */
    public function normalizeWhiteSpaceAndDash(string $number, $replacement = ''): ?string
    {
        return preg_replace('/[- )(]/', $replacement, trim($number));
    }

    /**
     * @throws InvalidNumber
     */
    public function parseStrPhoneNumber(string $number): string
    {
        $number = $this->normalize($number);
        $this->setStrPhoneNumber($number);

        return $this->getPhoneNumber(true);
    }
}
