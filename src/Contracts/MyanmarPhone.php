<?php
/**
 * @author fawkescreatives created on 20/09/2021
 */

namespace MyanmarPhone\Contracts;

interface MyanmarPhone
{
    /**
     * @param string $number
     * @return $this
     */
    public function make($number): self;

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
    public function operator($number = null): string;

    /**
     * @param string|null $number
     * @return string
     */
    public function telecom($number = null): string;

    /**
     * @param string|null $number
     * @return bool
     */
    public function isTelenor($number = null): bool;

    /**
     * @param string|null $number
     * @return bool
     */
    public function isOoredoo($number = null): bool;

    /**
     * @param string|null $number
     * @return bool
     */
    public function isMpt($number = null): bool;

    /**
     * @param string|null $number
     * @return bool
     */
    public function isMyTel($number = null): bool;

    /**
     * @param string|null $number
     * @return bool
     */
    public function isMec($number = null): bool;
}