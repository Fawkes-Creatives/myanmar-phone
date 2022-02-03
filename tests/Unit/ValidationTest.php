<?php

use MyanmarPhone\Tests\Helpers\Data;

it('can be passed', function () {
    $this->assertTrue(
        $this->validator->make(
            ['phone_number' => Data::INTERNATIONAL_NUMBER],
            ['phone_number' => 'myanmar_phone']
        )->passes()
    );
});

it('should be failed', function () {
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
});
