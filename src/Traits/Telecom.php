<?php

/**
 * @author fawkescreatives created on 21/09/2021
 */

namespace MyanmarPhone\Traits;

use Exception;
use MyanmarPhone\Exceptions\InvalidTelecom;
use MyanmarPhone\Helpers\DataSource;

trait Telecom
{
    /**
     * @throws Exception
     */
    protected function isOperator(?string $number, string $pattern): bool
    {
        if (is_null($number)) {
            $number = $this->formatE164();
        } else {
            $number = $this->parseStrPhoneNumber($number);
        }

        return (bool) preg_match($pattern, $number);
    }

    /**
     * @throws Exception
     */
    public function isTelenor(?string $number = null): bool
    {
        return $this->isOperator($number, DataSource::TELENOR_PATTERN_FOR_MATCHING);
    }

    /**
     * @throws Exception
     */
    public function isOoredoo(?string $number = null): bool
    {
        return $this->isOperator($number, DataSource::OOREDOO_PATTERN_FOR_MATCHING);
    }

    /**
     * @throws Exception
     */
    public function isMpt(?string $number = null): bool
    {
        return $this->isOperator($number, DataSource::MPT_PATTERN_FOR_MATCHING);
    }

    /**
     * @throws Exception
     */
    public function isMyTel(?string $number = null): bool
    {
        return $this->isOperator($number, DataSource::MYTEL_PATTERN_FOR_MATCHING);
    }

    /**
     * @throws Exception
     */
    public function isMec(?string $number = null): bool
    {
        return $this->isOperator($number, DataSource::MEC_PATTERN_FOR_MATCHING);
    }

    /**
     * @throws InvalidTelecom
     * @throws Exception
     */
    public function telecom(?string $number = null): string
    {
        if ($this->isMpt($number)) {
            return DataSource::MPT;
        }
        if ($this->isOoredoo($number)) {
            return DataSource::OOREDOO;
        }
        if ($this->isTelenor($number)) {
            return DataSource::TELENOR;
        }
        if ($this->isMec($number)) {
            return DataSource::MEC;
        }
        if ($this->isMyTel($number)) {
            return DataSource::MYTEL;
        }

        throw new InvalidTelecom;
    }

    /**
     * @throws InvalidTelecom
     */
    public function operator(?string $number = null): string
    {
        return $this->telecom($number);
    }
}
