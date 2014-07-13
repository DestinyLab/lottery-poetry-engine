<?php

use DestinyLab\LotteryPoetry\Suit;
use DestinyLab\LotteryPoetry\Engine;

class EngineTest extends \Codeception\TestCase\Test
{
    /**
     * @var Engine
     */
    protected $instance;
    protected function _before()
    {
        $this->instance = new Engine(new Suit(__DIR__.'/../../resources', 'md'));
    }

    public function testConstruct()
    {
        $this->assertInstanceOf("DestinyLab\\LotteryPoetry\\Engine", $this->instance);
    }

    public function testDraw()
    {
        $result = $this->instance->draw();
        $this->assertEquals(5, strlen($result));
    }

    public function testDrawOnlyKey()
    {
        $result = $this->instance->draw(true);
        $this->assertEquals(1, strlen($result));
    }
}
