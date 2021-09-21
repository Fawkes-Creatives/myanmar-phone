<?php
/**
 * @author fawkescreatives created on 20/09/2021
 */

namespace MyanmarPhone\Tests\Unit;

use libphonenumber\PhoneNumberFormat;
use MyanmarPhone\Contracts\MyanmarPhone as MyanmarPhoneContract;
use MyanmarPhone\Facades\MyanPhone;
use MyanmarPhone\Helpers\DataSource;
use MyanmarPhone\Tests\Helpers\Data;
use MyanmarPhone\Tests\TestCase;

class PhoneNumberTest extends TestCase
{
    /** @test */
    public function it_can_make()
    {
        $initCall = MyanPhone::make(Data::INTERNATIONAL_NUMBER);

        $this->assertInstanceOf(MyanmarPhoneContract::class, $initCall);
    }

    /** @test */
    public function its_config_default_format_is_e164()
    {
        config()->set('myanmar_phone.default_format', PhoneNumberFormat::E164);
        $phone = MyanPhone::make(Data::LOCAL_NUMBER);
        $result = $phone->format();
        $this->assertStringStartsWith("+95", $result);
    }

    /** @test */
    public function its_config_default_format_is_international()
    {
        config()->set('myanmar_phone.default_format', PhoneNumberFormat::INTERNATIONAL);
        $phone = MyanPhone::make(Data::NATIONAL_NUMBER);
        $result = $phone->format();
        $this->assertStringContainsString("+95 ", $result);
    }

    /** @test */
    public function its_config_default_format_is_national()
    {
        config()->set('myanmar_phone.default_format', PhoneNumberFormat::NATIONAL);
        $phone = MyanPhone::make(Data::LOCAL_NUMBER);
        $result = $phone->format();
        $this->assertStringStartsWith("09", $result);
        $this->assertStringContainsString(" ", $result);
    }

    /** @test */
    public function its_config_default_format_is_rfc3966()
    {
        config()->set('myanmar_phone.default_format', PhoneNumberFormat::RFC3966);
        $phone = MyanPhone::make(Data::LOCAL_NUMBER);
        $result = $phone->format();
        $this->assertStringStartsWith("tel", $result);
        $this->assertStringContainsString("-", $result);
    }

    /** @test */
    public function it_can_be_format()
    {
        $result = MyanPhone::make(Data::LOCAL_NUMBER)->format();
        $this->assertIsString($result);
    }

    /** @test */
    public function it_can_be_formatE164()
    {
        $result = MyanPhone::make(Data::LOCAL_NUMBER)->formatE164();
        $this->assertStringStartsWith("+95", $result);
    }

    /** @test */
    public function it_can_be_formatInternational()
    {
        $result = MyanPhone::make(Data::LOCAL_NUMBER)->formatInternational();
        $this->assertStringContainsString("+95 ", $result);
    }

    /** @test */
    public function it_can_be_formatRFC3966()
    {
        $result = MyanPhone::make(Data::LOCAL_NUMBER)->formatRFC3966();
        $this->assertStringStartsWith("tel", $result);
        $this->assertStringContainsString("-", $result);

        $result = MyanPhone::make(Data::LOCAL_NUMBER)->formatRFC3966('');
        $this->assertStringNotContainsString("-", $result);
    }

    /** @test */
    public function it_can_be_formatNational()
    {
        $result = MyanPhone::make(Data::LOCAL_NUMBER)->formatNational();
        $this->assertStringStartsWith("09 ", $result);

        $result = MyanPhone::make(Data::LOCAL_NUMBER)->formatNational('_');
        $this->assertStringContainsString("_", $result);
    }

    /** @test */
    public function it_can_get_operator()
    {
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
    }

    /** @test */
    public function it_can_get_telecom()
    {
        $this->it_can_get_operator();
    }

    /** @test */
    public function it_telenor_is_true()
    {
        $result = MyanPhone::make(Data::TELENOR_NUMBER)->isTelenor();

        $this->assertTrue($result);
    }

    /** @test */
    public function it_telenor_is_false()
    {
        $result = MyanPhone::make(Data::MPT_NUMBER)->isTelenor();

        $this->assertFalse($result);
    }

    /** @test */
    public function it_mpt_is_false()
    {
        $result = MyanPhone::make(Data::MPT_NUMBER)->isMPT();

        $this->assertTrue($result);
    }

    /** @test */
    public function it_mpt_is_true()
    {
        $result = MyanPhone::make(Data::OOREDOO_NUMBER)->isMPT();

        $this->assertFalse($result);
    }

    /** @test */
    public function it_ooredoo_is_true()
    {
        $result = MyanPhone::isOoredoo(Data::OOREDOO_NUMBER);

        $this->assertTrue($result);
    }

    /** @test */
    public function it_ooredoo_is_false()
    {
        $result = MyanPhone::make(Data::TELENOR_NUMBER)->isOoredoo();

        $this->assertFalse($result);
    }

    /** @test */
    public function it_mytel_is_true()
    {
        $result = MyanPhone::make(Data::MYTEL_NUMBER)->isMyTel();

        $this->assertTrue($result);
    }

    /** @test */
    public function it_mytel_is_false()
    {
        $result = MyanPhone::isMyTel(Data::TELENOR_NUMBER);

        $this->assertFalse($result);
    }

    /** @test */
    public function it_mec_is_true()
    {
        $result = MyanPhone::make(Data::MEC_NUMBER)->isMec();

        $this->assertTrue($result);
    }

    /** @test */
    public function it_mec_is_false()
    {
        $result = MyanPhone::isMec(Data::OOREDOO_NUMBER);

        $this->assertFalse($result);
    }
}