<?php
/**
 * @author naingminkhant created on 22/09/2021
 */

namespace MyanmarPhone\Tests\Unit;

use MyanmarPhone\Tests\Helpers\Data;
use MyanmarPhone\Tests\TestCase;

class ValidationTest extends TestCase
{
    protected $validator;

    protected function setUp(): void
    {
        parent::setUp();

        $this->validator = $this->app['validator'];
    }

    /** @test */
    public function it_can_be_passed()
    {
        $this->assertTrue(
            $this->validator->make(
                ['phone_number' => Data::INTERNATIONAL_NUMBER],
                ['phone_number' => 'myanmar_phone']
            )->passes()
        );
    }

    /** @test */
    public function it_should_be_failed()
    {
        $this->assertTrue(
            $this->validator->make(
                ['phone_number' => Data::INVALID_NUMBER],
                ['phone_number' => 'myanmar_phone']
            )->fails()
        );

        $this->assertFalse(
            $this->validator->make(
                ['phone_number' => ''],
                ['phone_number' => 'myanmar_phone']
            )->fails()
        );
    }
}