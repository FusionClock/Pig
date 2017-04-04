<?php

namespace FusionClock\Pig;

use PHPUnit_Framework_TestCase;

class ValidatorTest extends PHPUnit_Framework_TestCase
{
    public function testValidValue()
    {
        $validator = new PhraseValidator();

        $this->assertEquals(true, $validator->validate('valid'));
    }

    public function testInvalidValues()
    {
        $validator = new PhraseValidator();

        $invalidValues = ['', ' '];

        foreach ($invalidValues as $invalidValue) {
            $this->assertEquals(false, $validator->validate($invalidValue));
        }
    }
}
