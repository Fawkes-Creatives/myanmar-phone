<?php

use libphonenumber\PhoneNumber;
use MyanmarPhone\Facades\MyanPhone;
use MyanmarPhone\Helpers\DataSource;
use MyanmarPhone\Tests\Helpers\Data;

it('it_can_get_phone_number', function () {
    $result = MyanPhone::make(Data::INTERNATIONAL_NUMBER)->getPhoneNumber();

    $this->assertIsString($result);
});

it('it_can_get_phone_instance', function () {
    $result = MyanPhone::make(Data::INTERNATIONAL_NUMBER)->getPhoneInstance();

    $this->assertInstanceOf(PhoneNumber::class, $result);
});

it('it_can_get_data_source', function () {
    $result = MyanPhone::make(Data::INTERNATIONAL_NUMBER)->getDataSource();

    $this->assertInstanceOf(DataSource::class, $result);
});

it('it_can_set_and_get_str_phone_number', function () {
    $result = MyanPhone::setStrPhoneNumber(Data::INTERNATIONAL_NUMBER)
        ->getStrPhoneNumber();

    $this->assertIsString($result);
});

it('it_can_get_country_code', function () {
    $class = MyanPhone::make(Data::INTERNATIONAL_NUMBER);

    $this->assertSame($class->getDataSource()->getPrefixCode(), $class->getCountryCode());
});
