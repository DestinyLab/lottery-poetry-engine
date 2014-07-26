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
        $this->instance = new Engine(new Suit([codecept_root_dir().'resources/'], 'yml'));
    }

    public function testConstruct()
    {
        $this->assertInstanceOf("DestinyLab\\LotteryPoetry\\Engine", $this->instance);
    }

    public function testDraw()
    {
        $this->assertArrayHasKey('title', $this->instance->draw());
    }

    public function testDrawOnlyKey()
    {
        $result = $this->instance->draw(true);
        $this->assertEquals(1, strlen($result));
    }
}
