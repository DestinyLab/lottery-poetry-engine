<?php

/**
 * This file is part of DestinyLab.
 */

namespace DestinyLab\LotteryPoetry;

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

    protected $resourcePaths = [];

    protected $list = [];

    /**
     * Constructor
     *
     * @param array  $resourcePaths
     * @param string $fileExtension
     */
    public function __construct(array $resourcePaths = [], $fileExtension)
    {
        $this->container = new Container();
        $this->container
            ->addPaths($resourcePaths)
            ->setDefaultFormat($fileExtension);

        $this->resourcePath = $resourcePaths;
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

    /**
     * Set list
     */
    protected function setList()
    {
        $format = $this->container->getDefaultFormat();
        $finder = $this->container->getFinder()->create();
        $finder->files()
            ->in($this->resourcePath)
            ->name('*.'.$format);

        foreach ($finder as $file) {
            $regex = '/^(.*)\.'.$format.'$/';
            preg_match($regex, $file->getFilename(), $matches);
            $this->list[] = $matches[1];
        }
    }
}
