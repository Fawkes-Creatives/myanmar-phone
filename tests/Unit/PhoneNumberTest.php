<?php

use libphonenumber\PhoneNumberFormat;
use MyanmarPhone\Contracts\MyanmarPhone;
use MyanmarPhone\Facades\MyanPhone;
use MyanmarPhone\Helpers\DataSource;
use MyanmarPhone\Tests\Helpers\Data;

it('can make', function () {
    $initCall = MyanPhone::make(Data::INTERNATIONAL_NUMBER);

    $this->assertInstanceOf(MyanmarPhone::class, $initCall);
});

it('is config default format is e164', function () {
    config()->set('myanmar_phone.default_format', PhoneNumberFormat::E164);
    $phone = MyanPhone::make(Data::LOCAL_NUMBER);
    $result = $phone->format();
    $this->assertStringStartsWith('+95', $result);
});

it('is config default format is international', function () {
    config()->set('myanmar_phone.default_format', PhoneNumberFormat::INTERNATIONAL);
    $phone = MyanPhone::make(Data::NATIONAL_NUMBER);
    $result = $phone->format();
    $this->assertStringContainsString('+95 ', $result);
});

it('is config default format is national', function () {
    config()->set('myanmar_phone.default_format', PhoneNumberFormat::NATIONAL);
    $phone = MyanPhone::make(Data::LOCAL_NUMBER);
    $result = $phone->format();
    $this->assertStringStartsWith('09', $result);
    $this->assertStringContainsString(' ', $result);
});

it('is config default format is rfc3966', function () {
    config()->set('myanmar_phone.default_format', PhoneNumberFormat::RFC3966);
    $phone = MyanPhone::make(Data::LOCAL_NUMBER);
    $result = $phone->format();
    $this->assertStringStartsWith('tel', $result);
    $this->assertStringContainsString('-', $result);
});

it('can be format', function () {
    $result = MyanPhone::make(Data::LOCAL_NUMBER)->format();
    $this->assertIsString($result);
});

it('can be formatE164', function () {
    $result = MyanPhone::make(Data::LOCAL_NUMBER)->formatE164();
    $this->assertStringStartsWith('+95', $result);
});

it('can be formatInternational', function () {
    $result = MyanPhone::make(Data::LOCAL_NUMBER)->formatInternational();
    $this->assertStringContainsString('+95 ', $result);
});

it('can be formatRFC3966', function () {
    $result = MyanPhone::make(Data::LOCAL_NUMBER)->formatRFC3966();
    $this->assertStringStartsWith('tel', $result);
    $this->assertStringContainsString('-', $result);

    $result = MyanPhone::make(Data::LOCAL_NUMBER)->formatRFC3966('');
    $this->assertStringNotContainsString('-', $result);
});

it('can be formatNational', function () {
    $result = MyanPhone::make(Data::LOCAL_NUMBER)->formatNational();
    $this->assertStringStartsWith('09 ', $result);

    $result = MyanPhone::make(Data::LOCAL_NUMBER)->formatNational('_');
    $this->assertStringContainsString('_', $result);
});

it('can get operator', function () {
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

it('is telenor', function () {
    $result = MyanPhone::make(Data::TELENOR_NUMBER)->isTelenor();

    $this->assertTrue($result);
});

it('is not telenor', function () {
    $result = MyanPhone::make(Data::MPT_NUMBER)->isTelenor();

    $this->assertFalse($result);
});

it('is mpt', function () {
    $result = MyanPhone::make(Data::MPT_NUMBER)->isMPT();

    $this->assertTrue($result);
});

it('is not mpt', function () {
    $result = MyanPhone::make(Data::OOREDOO_NUMBER)->isMPT();

    $this->assertFalse($result);
});

it('is ooredoo', function () {
    $result = MyanPhone::isOoredoo(Data::OOREDOO_NUMBER);

    $this->assertTrue($result);
});

it('is not ooredoo', function () {
    $result = MyanPhone::make(Data::TELENOR_NUMBER)->isOoredoo();

    $this->assertFalse($result);
});

it('is mytel', function () {
    $result = MyanPhone::make(Data::MYTEL_NUMBER)->isMyTel();

    $this->assertTrue($result);
});

it('is not mytel', function () {
    $result = MyanPhone::isMyTel(Data::TELENOR_NUMBER);

    $this->assertFalse($result);
});

it('is mec', function () {
    $result = MyanPhone::make(Data::MEC_NUMBER)->isMec();

    $this->assertTrue($result);
});

it('is not mec', function () {
    $result = MyanPhone::isMec(Data::OOREDOO_NUMBER);

    $this->assertFalse($result);
});
