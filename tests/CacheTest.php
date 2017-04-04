<?php

namespace FusionClock\Pig;

use PHPUnit_Framework_TestCase;

class CacheTest extends PHPUnit_Framework_TestCase
{
    public function testSet()
    {
        $cache = new Cache();

        $cache->set('name', 'John');

        $this->assertEquals('John', $cache->get('name'));
    }

    public function testEmptyKeyWithoutDefault()
    {
        $cache = new Cache();

        $this->assertEquals(null, $cache->get('name'));
    }

    public function testEmptyKeyWithDefault()
    {
        $cache = new Cache();

        $this->assertEquals('John', $cache->get('name', 'John'));
    }

    public function testHas()
    {
        $cache = new Cache();

        $cache->set('name', 'John');

        $this->assertEquals(true, $cache->has('name'));
    }
}
