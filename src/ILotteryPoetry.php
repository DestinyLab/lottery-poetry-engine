<?php

/**
 * This file is part of DestinyLab.
 */

namespace DestinyLab\LotteryPoetry;

/**
 * Interface ILotteryPoetry
 *
 * @package DestinyLab\LotteryPoetry
 * @author  Lance He <indigofeather@gmail.com>
 */
interface ILotteryPoetry
{
    /**
     * @param $poetryId
     * @return string
     */
    public function get($poetryId);

    /**
     * @return array
     */
    public function getList();

    /**
     * @return int
     */
    public function total();
}
