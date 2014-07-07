<?php

/**
 * This file is part of DestinyLab.
 */

namespace DestinyLab\LotteryPoetry;

use Fuel\FileSystem\Directory;
use Fuel\FileSystem\File;
use InvalidArgumentException;

/**
 * DriverTrait
 *
 * @package DestinyLab\LotteryPoetry
 * @author  Lance He <indigofeather@gmail.com>
 */
trait DriverTrait
{
    protected $resourcePath;
    protected $total = 0;
    protected $poetry = [];

    public function __construct($resourcePath, $total = 0)
    {
        $dir = new Directory($resourcePath);
        if (! $dir->exists()) {
            throw new InvalidArgumentException('Invalid Path!');
        }

        $this->resourcePath = $resourcePath;
        $total === 0 and $this->total = sizeof($dir->listFiles(0, ['.md']));
    }

    /**
     * @param $poetryId
     * @return string
     */
    public function get($poetryId)
    {
        if (! isset($this->poetry[$poetryId])) {
            $this->poetry[$poetryId] = $this->getFileContent($poetryId);
        }

        return $this->poetry[$poetryId];
    }

    /**
     * @return int
     */
    public function total()
    {
        return $this->total;
    }

    /**
     * @param $poetryId
     * @return string
     */
    protected function getFileContent($poetryId)
    {
        $file = new File($this->resourcePath.$poetryId.'.md');
        if (! $file->exists()) {
            throw new InvalidArgumentException('File is Not Exist!');
        }

        return $file->getContents();
    }
}
