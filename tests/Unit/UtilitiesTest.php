<?php

use libphonenumber\PhoneNumber;
use MyanmarPhone\Facades\MyanPhone;
use MyanmarPhone\Helpers\DataSource;
use MyanmarPhone\Tests\Helpers\Data;

it('can get phone number', function () {
    $result = MyanPhone::make(Data::INTERNATIONAL_NUMBER)->getPhoneNumber();

    $this->assertIsString($result);
});

it('can get phone instance', function () {
    $result = MyanPhone::make(Data::INTERNATIONAL_NUMBER)->getPhoneInstance();

    $this->assertInstanceOf(PhoneNumber::class, $result);
});

it('can get data source', function () {
    $result = MyanPhone::make(Data::INTERNATIONAL_NUMBER)->getDataSource();

    $this->assertInstanceOf(DataSource::class, $result);
});

it('can set and get str phone number', function () {
    $result = MyanPhone::setStrPhoneNumber(Data::INTERNATIONAL_NUMBER)
        ->getStrPhoneNumber();

    $this->assertIsString($result);
});

it('can get country code', function () {
    $class = MyanPhone::make(Data::INTERNATIONAL_NUMBER);

    $this->assertSame($class->getDataSource()->getPrefixCode(), $class->getCountryCode());
});
