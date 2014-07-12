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
    protected $fileExtension;
    protected $total = 0;
    protected $poetry = [];

    public function __construct($resourcePath, $fileExtension)
    {
        $dir = new Directory($resourcePath);
        if (! $dir->exists()) {
            throw new InvalidArgumentException('Invalid Path!');
        }

        $this->resourcePath = $resourcePath;
        $this->fileExtension = $fileExtension;
        $this->total = sizeof($dir->listFiles(0, ['.md']));
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
        $file = new File($this->resourcePath.$poetryId.'.'.$this->fileExtension);
        if (! $file->exists()) {
            throw new InvalidArgumentException('File is Not Exist!');
        }

        return $file->getContents();
    }
}
