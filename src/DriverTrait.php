<?php

/**
 * This file is part of DestinyLab.
 */

namespace DestinyLab\LotteryPoetry;

use Fuel\FileSystem\Directory;
use Indigofeather\ResourceLoader\Container;
use InvalidArgumentException;

/**
 * DriverTrait
 *
 * @package DestinyLab\LotteryPoetry
 * @author  Lance He <indigofeather@gmail.com>
 */
trait DriverTrait
{
    /**
     * @var Container
     */
    protected $container;

    protected $list = [];

    public function __construct(array $resourcePaths = [], $fileExtension)
    {
        $this->container = new Container();
        $this->container
            ->addPaths($resourcePaths)
            ->setDefaultFormat($fileExtension);

        $this->setList();
    }

    /**
     * {@inheritDoc}
     */
    public function get($poetryId)
    {
        if (! in_array($poetryId, $this->list)) {
            throw new InvalidArgumentException('Invalid poetry ID!');
        }

        return $this->container->load($poetryId);
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


    protected function setList()
    {
        $format = $this->container->getDefaultFormat();
        foreach ($this->container->getPaths() as $path) {
            $dir = new Directory($path);
            foreach ($dir->listFiles(0, ['.'.$format]) as $filePath) {
                $regex = '/^.*\/(.*)\.'.$format.'$/';
                preg_match($regex, $filePath, $matches);
                $this->list[] = $matches[1];
            }
        }
    }
}
