<?php

use libphonenumber\PhoneNumberFormat;
use MyanmarPhone\Contracts\MyanmarPhone;
use MyanmarPhone\Facades\MyanPhone;
use MyanmarPhone\Helpers\DataSource;
use MyanmarPhone\Tests\Helpers\Data;

it('it_can_make', function () {
    $initCall = MyanPhone::make(Data::INTERNATIONAL_NUMBER);

    $this->assertInstanceOf(MyanmarPhone::class, $initCall);
});

it('its_config_default_format_is_e164', function () {
    config()->set('myanmar_phone.default_format', PhoneNumberFormat::E164);
    $phone = MyanPhone::make(Data::LOCAL_NUMBER);
    $result = $phone->format();
    $this->assertStringStartsWith("+95", $result);
});

it('its_config_default_format_is_international', function () {
    config()->set('myanmar_phone.default_format', PhoneNumberFormat::INTERNATIONAL);
    $phone = MyanPhone::make(Data::NATIONAL_NUMBER);
    $result = $phone->format();
    $this->assertStringContainsString("+95 ", $result);
});

it('its_config_default_format_is_national', function () {
    config()->set('myanmar_phone.default_format', PhoneNumberFormat::NATIONAL);
    $phone = MyanPhone::make(Data::LOCAL_NUMBER);
    $result = $phone->format();
    $this->assertStringStartsWith("09", $result);
    $this->assertStringContainsString(" ", $result);
});

it('its_config_default_format_is_rfc3966', function () {
    config()->set('myanmar_phone.default_format', PhoneNumberFormat::RFC3966);
    $phone = MyanPhone::make(Data::LOCAL_NUMBER);
    $result = $phone->format();
    $this->assertStringStartsWith("tel", $result);
    $this->assertStringContainsString("-", $result);
});

it('it_can_be_format', function () {
    $result = MyanPhone::make(Data::LOCAL_NUMBER)->format();
    $this->assertIsString($result);
});

it('it_can_be_formatE164', function () {
    $result = MyanPhone::make(Data::LOCAL_NUMBER)->formatE164();
    $this->assertStringStartsWith("+95", $result);
});

it('it_can_be_formatInternational', function () {
    $result = MyanPhone::make(Data::LOCAL_NUMBER)->formatInternational();
    $this->assertStringContainsString("+95 ", $result);
});

it('it_can_be_formatRFC3966', function () {
    $result = MyanPhone::make(Data::LOCAL_NUMBER)->formatRFC3966();
    $this->assertStringStartsWith("tel", $result);
    $this->assertStringContainsString("-", $result);

    $result = MyanPhone::make(Data::LOCAL_NUMBER)->formatRFC3966('');
    $this->assertStringNotContainsString("-", $result);
});

it('it_can_be_formatNational', function () {
    $result = MyanPhone::make(Data::LOCAL_NUMBER)->formatNational();
    $this->assertStringStartsWith("09 ", $result);

    $result = MyanPhone::make(Data::LOCAL_NUMBER)->formatNational('_');
    $this->assertStringContainsString("_", $result);
});

it('it_can_get_operator', function () {
    $result = MyanPhone::telecom(Data::MPT_NUMBER);
    $this->assertEquals(DataSource::MPT, $result);

    $result = MyanPhone::make(Data::OOREDOO_NUMBER)->telecom();
    $this->assertEquals(DataSource::OOREDOO, $result);

    $result = MyanPhone::telecom(Data::TELENOR_NUMBER);
    $this->assertEquals(DataSource::TELENOR, $result);

    $result = MyanPhone::telecom(Data::MYTEL_NUMBER);
    $this->assertEquals(DataSource::MYTEL, $result);

    $result = MyanPhone::telecom(Data::MEC_NUMBER);
    $this->assertEquals(DataSource::MEC, $result);
});

it('it_telenor_is_true', function () {
    $result = MyanPhone::make(Data::TELENOR_NUMBER)->isTelenor();

    $this->assertTrue($result);
});

it('it_telenor_is_false', function () {
    $result = MyanPhone::make(Data::MPT_NUMBER)->isTelenor();

    $this->assertFalse($result);
});

it('it_mpt_is_false', function () {
    $result = MyanPhone::make(Data::MPT_NUMBER)->isMPT();

    $this->assertTrue($result);
});

it('it_mpt_is_true', function () {
    $result = MyanPhone::make(Data::OOREDOO_NUMBER)->isMPT();

    $this->assertFalse($result);
});

it('it_ooredoo_is_true', function () {
    $result = MyanPhone::isOoredoo(Data::OOREDOO_NUMBER);

    $this->assertTrue($result);
});

it('it_ooredoo_is_false', function () {
    $result = MyanPhone::make(Data::TELENOR_NUMBER)->isOoredoo();

    $this->assertFalse($result);
});

it('it_mytel_is_true', function () {
    $result = MyanPhone::make(Data::MYTEL_NUMBER)->isMyTel();

    $this->assertTrue($result);
});

it('it_mytel_is_false', function () {
    $result = MyanPhone::isMyTel(Data::TELENOR_NUMBER);

    $this->assertFalse($result);
});

it('it_mec_is_true', function () {
    $result = MyanPhone::make(Data::MEC_NUMBER)->isMec();

    $this->assertTrue($result);
});

it('it_mec_is_false', function () {
    $result = MyanPhone::isMec(Data::OOREDOO_NUMBER);

    $this->assertFalse($result);
});
