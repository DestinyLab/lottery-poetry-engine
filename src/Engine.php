<?php

/**
 * This file is part of DestinyLab.
 */

namespace DestinyLab\LotteryPoetry;

/**
 * Engine
 *
 * @package DestinyLab\LotteryPoetry
 * @author  Lance He <indigofeather@gmail.com>
 */
class Engine
{
    /**
     * @var ILotteryPoetry
     */
    protected $instance;

    public function __construct(ILotteryPoetry $instance)
    {
        $this->instance = $instance;
    }

    /**
     * @return string
     */
    public function draw()
    {
        mt_srand(crc32(sha1(microtime())));
        $result = mt_rand(1, $this->instance->total());

        return $this->instance->get($result);
    }
}
