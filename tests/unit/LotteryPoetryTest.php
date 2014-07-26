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
        $this->instance = new Suit([codecept_root_dir().'/resources/'], 'yml');
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testConstructWithWrongPath()
    {
        new Suit(['path/to/resources'], 'yml');
    }

    public function testGet()
    {
        $excepted = [
            'title' => 426,
        ];
        $this->assertEquals($excepted, $this->instance->get(1));
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

    public function testGetList()
    {
        $this->assertCount(2, $this->instance->getList());
    }
}
