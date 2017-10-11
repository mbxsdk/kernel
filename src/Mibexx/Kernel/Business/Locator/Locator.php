<?php

namespace Mibexx\Kernel\Business\Locator;


use Mibexx\Dependency\Business\ContainerInterface;
use Mibexx\Kernel\Business\Config\ConfigInterface;
use Mibexx\Kernel\Business\Locator\Module\Module;

class Locator
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var array<Module>
     */
    private $modules;

    /**
     * Locator constructor.
     *
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->container->setLocator($this);
        $this->modules = [];
    }

    public function __call($name, $arguments)
    {
        if (!isset($this->modules[$name])) {
            $this->modules[$name] = new Module($name, $this);
        }

        return $this->modules[$name];
    }

    /**
     * @return ContainerInterface
     */
    public function getDependencyProvider()
    {
        return $this->container;
    }

    /**
     * @return ConfigInterface
     */
    public function getConfig()
    {
        return $this->getDependencyProvider()->getConfig();
    }


}