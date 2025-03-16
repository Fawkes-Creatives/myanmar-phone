<?php

/**
 * @author fawkescreatives created on 20/09/2021
 */

namespace MyanmarPhone;

use Exception;
use Illuminate\Support\Traits\Macroable;
use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumber;
use libphonenumber\PhoneNumberFormat;
use libphonenumber\PhoneNumberUtil;
use MyanmarPhone\Contracts\MyanmarPhone as MyanmarPhoneContract;
use MyanmarPhone\Exceptions\InvalidNumber;
use MyanmarPhone\Helpers\DataSource;
use MyanmarPhone\Traits\Parser;
use MyanmarPhone\Traits\Telecom;

class MyanmarPhone implements MyanmarPhoneContract
{
    use Macroable, Parser, Telecom;

    /**
     * @var PhoneNumberUtil
     */
    protected $lib;

    /**
     * @var DataSource
     */
    protected $dataSource;

    /**
     * @var PhoneNumber
     */
    protected $phoneInstance;

    /**
     * @var string|null
     */
    protected $separator = null;

    /**
     * @var string
     */
    protected $strPhoneNumber;

    /**
     * Initiative libphonenumber and DataSource class
     */
    public function __construct(DataSource $dataSource)
    {
        $this->lib = PhoneNumberUtil::getInstance();
        $this->dataSource = $dataSource;
    }

    /**
     * @throws InvalidNumber
     * @throws NumberParseException
     */
    public function make(string $number): self
    {
        $number = $this->normalize($number);

        $this->phoneInstance = $this->lib->parse($number,
            $this->getDataSource()->getRegionCode());

        return $this;
    }

    public function getPhoneInstance(): PhoneNumber
    {
        return $this->phoneInstance;
    }

    public function getDataSource(): DataSource
    {
        return $this->dataSource;
    }

    public function setStrPhoneNumber(string $number): self
    {
        $this->strPhoneNumber = $number;

        return $this;
    }

    public function getStrPhoneNumber(): ?string
    {
        return $this->strPhoneNumber;
    }

    public function getCountryCode(): ?string
    {
        return (string) $this->getPhoneInstance()->getCountryCode();
    }

    public function getPhoneNumber(bool $leadingZero = true): string
    {
        $number = $this->getStrPhoneNumber();

        if (is_null($number)) {
            $number = $this->getPhoneInstance()->getNationalNumber();
        }

        if ($leadingZero) {
            $number = "0$number";
        }

        return $number;
    }

    /**
     * @param  string|int|null  $format
     *
     * @throws Exception
     */
    public function format($format = null): string
    {
        if (is_null($format)) {
            $format = $this->getDataSource()->getDefaultFormat();
        }

        $parsedFormat = $this->parseFormat($format);

        $number = $this->lib->format(
            $this->getPhoneInstance(),
            $parsedFormat
        );

        return $this->response($number);
    }

    /**
     * @param  null  $separator
     * @return $this
     */
    public function setSeparator($separator = null): self
    {
        $this->separator = $separator;

        return $this;
    }

    public function getSeparator(): ?string
    {
        return $this->separator;
    }

    protected function response(string $number): ?string
    {
        if (! is_null($this->getSeparator())) {
            $number = $this->normalizeWhiteSpaceAndDash($number, $this->getSeparator());
        }

        return $number;
    }

    /**
     * @throws Exception
     */
    public function formatE164(): string
    {
        return $this->format(PhoneNumberFormat::E164);
    }

    /**
     * @throws Exception
     */
    public function formatInternational(): string
    {
        return $this->format(PhoneNumberFormat::INTERNATIONAL);
    }

    /**
     * @throws Exception
     */
    public function formatRFC3966(?string $separator = null): string
    {
        return $this
            ->setSeparator($separator)
            ->format(PhoneNumberFormat::RFC3966);
    }

    /**
     * @throws Exception
     */
    public function formatNational(?string $separator = null): string
    {
        return $this
            ->setSeparator($separator)
            ->format(PhoneNumberFormat::NATIONAL);
    }

    /**
     * @throws Exception
     */
    public function check(): bool
    {
        return $this->isMpt() || $this->isTelenor() || $this->isOoredoo() || $this->isMyTel() || $this->isMec();
    }
}
