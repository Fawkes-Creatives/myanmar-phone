<?php
/**
 * @author fawkescreatives created on 20/09/2021
 */

namespace MyanmarPhone\Tests\Unit;

use libphonenumber\PhoneNumber;
use MyanmarPhone\Facades\MyanPhone;
use MyanmarPhone\Helpers\DataSource;
use MyanmarPhone\Tests\Helpers\Data;
use MyanmarPhone\Tests\TestCase;

class FunctionTest extends TestCase
{
    /** @test */
    public function it_can_get_phone_number()
    {
        $result = MyanPhone::make(Data::INTERNATIONAL_NUMBER)->getPhoneNumber();

        $this->assertIsString($result);
    }

    /** @test */
    public function it_can_get_phone_instance()
    {
        $result = MyanPhone::make(Data::INTERNATIONAL_NUMBER)->getPhoneInstance();

        $this->assertInstanceOf(PhoneNumber::class, $result);
    }

    /** @test */
    public function it_can_get_data_source()
    {
        $result = MyanPhone::make(Data::INTERNATIONAL_NUMBER)->getDataSource();

        $this->assertInstanceOf(DataSource::class, $result);
    }

    /** @test */
    public function it_can_set_and_get_str_phone_number()
    {
        $result = MyanPhone::setStrPhoneNumber(Data::INTERNATIONAL_NUMBER)
                           ->getStrPhoneNumber();

        $this->assertIsString($result);
    }

    /** @test */
    public function it_can_get_country_code()
    {
        $class = MyanPhone::make(Data::INTERNATIONAL_NUMBER);

        $this->assertSame($class->getDataSource()->getPrefixCode(), $class->getCountryCode());
    }
}