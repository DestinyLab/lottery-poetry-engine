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
        $all = $this->instance->getList();
        shuffle($all);
        $key = array_shift($all);

        return $getOnlyKey === true ? $key : $this->instance->get($key);
    }
}
