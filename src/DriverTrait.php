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
    protected $list = [];

    public function __construct($resourcePath, $fileExtension)
    {
        $dir = new Directory($resourcePath);
        if (! $dir->exists()) {
            throw new InvalidArgumentException('Invalid Path!');
        }

        $this->resourcePath  = $resourcePath;
        $this->fileExtension = $fileExtension;
        $this->setList($dir);
    }

    /**
     * {@inheritDoc}
     */
    public function get($poetryId)
    {
        if (! isset($this->list[$poetryId])) {
            throw new InvalidArgumentException('Invalid poetry ID!');
        }

        return $this->list[$poetryId]->getContents();
    }

    /**
     * {@inheritDoc}
     */
    public function total()
    {
        return sizeof($this->list);
    }

    /**
     * {@inheritDoc}
     */
    public function getList()
    {
        return $this->list;
    }

    /**
     * @param Directory $dir
     */
    protected function setList(Directory $dir)
    {
        /**
         * @var File $file
         */
        foreach ($dir->listFiles(0, ['.'.$this->fileExtension], true) as $file) {
            $regex = '/^.*\/(.*)\.'.$this->fileExtension.'$/';
            preg_match($regex, $file->getPath(), $matches);
            $this->list[$matches[1]] = $file;
        }
    }
}
