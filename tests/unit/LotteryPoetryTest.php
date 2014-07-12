<?php

use DestinyLab\LotteryPoetry\Suit;

class LotteryPoetryTest extends \Codeception\TestCase\Test
{
    /**
     * @var Suit
     */
    protected $instance;
    protected function _before()
    {
        $this->instance = new Suit(__DIR__.'/../../resources/', 'md');
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testConstructWithWrongPath()
    {
        new Suit('path/to/resources/', 'md');
    }

    public function testGet()
    {
        $this->assertEquals('# 426', $this->instance->get(1));
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testGetNotExistFile()
    {
        $this->instance->get(999);
    }

    public function testTotal()
    {
        $this->assertEquals(2, $this->instance->total());
    }
}
