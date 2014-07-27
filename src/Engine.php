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
     * @param bool $getOnlyKey
     * @return mixed|string
     */
    public function draw($getOnlyKey = false)
    {
        mt_srand(crc32(time() ^ posix_getpid()));
        $rand = mt_rand(0, $this->instance->total() - 1);
        $key = $this->instance->getList()[$rand];

        return $getOnlyKey === true ? $key : $this->instance->get($key);
    }
}
