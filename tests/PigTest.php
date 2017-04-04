<?php

namespace FusionClock\Pig;

use PHPUnit_Framework_TestCase;

class PigTest extends PHPUnit_Framework_TestCase
{
    public function testSingleWords()
    {
        $pig = new Pig();

        $words = [
            'pig' => 'igpay',
            'latin' => 'atinlay',
            'banana' => 'ananabay',
            'trash' => 'ashtray',
            'happy' => 'appyhay',
            'duck' => 'uckday',
            'glove' => 'oveglay',
            'dopest' => 'opestday',
            'me' => 'emay',
            'too' => 'ootay',
            'thanks' => 'anksthay',
            'will' => 'illway',
            'moist' => 'oistmay',
            'wet' => 'etway',
            'cheers' => 'eerschay',
            'smile' => 'ilesmay',
            'eat' => 'eatway',
            'omelet' => 'omeletway',
            'are' => 'areway',
            'egg' => 'eggway',
        ];

        foreach ($words as $original => $expected) {
            $this->assertEquals($expected, $pig->squeel($original));
        }
    }

    public function testPhrase()
    {
        $pig = new Pig();

        $this->assertEquals('ananabay angomay', $pig->squeel('banana mango'));
    }

    public function testUppercase()
    {
        $pig = new Pig();

        $this->assertEquals('Ananabay angomay', $pig->squeel('Banana mango'));
    }

    public function testPunctuation()
    {
        $pig = new Pig();

        $this->assertEquals('Ananabay, angomay.', $pig->squeel('Banana, mango.'));
    }

    public function testInvalidWord()
    {
        $pig = new Pig();

        $this->assertEquals('', $pig->squeel(' '));
    }

    public function testCache()
    {
        $pig = new Pig();

        $pig->squeel('banana');

        $this->assertEquals('ananabay', $pig->squeel('banana'));
    }
}
