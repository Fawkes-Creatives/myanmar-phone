<?php
/**
 * @author fawkescreatives created on 20/09/2021
 */

namespace MyanmarPhone\Traits;

use Exception;
use libphonenumber\PhoneNumberFormat;
use MyanmarPhone\Exceptions\FormatException;
use MyanmarPhone\Exceptions\InvalidNumber;
use ReflectionClass;

trait Parser
{
    /**
     * @param string|int $format
     * @return int|string
     * @throws Exception
     */
    public function parseFormat($format)
    {
        if (in_array($format, static::libphonenumberFormats())) {
            return $format;
        }

        throw new FormatException();
    }

    /**
     * Return phone number formats with libphonenumber
     * @return array
     */
    protected static function libphonenumberFormats(): array
    {
        return with(new ReflectionClass(PhoneNumberFormat::class))
            ->getConstants();
    }

    /**
     * @throws InvalidNumber
     */
    public function normalize($number): string
    {
        if (mb_strlen($number) < $this->getDataSource()->getPureNumberMinLength()) {
            throw new InvalidNumber();
        }

        $number = $this->normalizeDigits($number);
        $number = $this->normalizeLeadingZero($number);
        $number = $this->normalizeAreaCode($number);

        return $this->normalizeCountryCode($number);
    }

    /**
     * Get only digits
     * @param $number
     * @return string
     */
    public function normalizeDigits($number): string
    {
        return preg_replace('/[^0-9]/', '', trim($number));
    }

    /**
     * Remove leading zero
     * @param $number
     * @return string
     */
    public function normalizeLeadingZero($number): string
    {
        return ltrim($number, "0");
    }

    public function normalizeAreaCode($number): string
    {
        if (!preg_match("/\b9\d+/", $number)) {
            $number = "9$number";
        }

        return $number;
    }

    /**
     * Remove country code
     * @param $number
     * @return string
     */
    public function normalizeCountryCode($number): string
    {
        $max = $this->getDataSource()->getNormalizeMaxLength();
        $prefixCode = $this->getDataSource()->getPrefixCode();

        do {
            $number = preg_replace("/^\+?$prefixCode/", '', $number);
        } while (mb_strlen($number) > $max);

        return $number;
    }

    /**
     * @param $number
     * @param string $replacement
     * @return string|null
     */
    public function normalizeWhiteSpaceAndDash($number, $replacement = ''): ?string
    {
        return preg_replace('/[- )(]/', $replacement, trim($number));
    }

    /**
     * @param $number
     * @return string
     * @throws InvalidNumber
     */
    public function parseStrPhoneNumber($number): string
    {
        $number = $this->normalize($number);
        $this->setStrPhoneNumber($number);

        return $this->getPhoneNumber(true);
    }
}