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
     * @param int|string  $format
     * @return int|string
     * @throws FormatException
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
    public function normalize(string $number): string
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
     * @param  string  $number
     * @return string
     */
    public function normalizeDigits(string $number): string
    {
        return preg_replace('/[^0-9]/', '', trim($number));
    }
    
    /**
     * Remove leading zero
     * @param  string  $number
     * @return string
     */
    public function normalizeLeadingZero(string $number): string
    {
        return ltrim($number, "0");
    }
    
    public function normalizeAreaCode($number): string
    {
        return sprintf('%9d', $number);
    }
    
    /**
     * Remove country code
     * @param  string  $number
     * @return string
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
     * @param  string  $number
     * @param  string  $replacement
     * @return string|null
     */
    public function normalizeWhiteSpaceAndDash(string $number, $replacement = ''): ?string
    {
        return preg_replace('/[- )(]/', $replacement, trim($number));
    }
    
    /**
     * @param  string  $number
     * @return string
     * @throws InvalidNumber
     */
    public function parseStrPhoneNumber(string $number): string
    {
        $number = $this->normalize($number);
        $this->setStrPhoneNumber($number);
        
        return $this->getPhoneNumber(true);
    }
}