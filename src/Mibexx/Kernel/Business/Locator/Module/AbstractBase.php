<?php

namespace Mibexx\Kernel\Business\Locator\Module;


use Mibexx\Dependency\Business\ContainerInterface;
use Mibexx\Kernel\Business\Locator\Locator;

abstract class AbstractBase
{
    /**
     * @var Locator
     */
    private $locator;

    /**
     * AbstractFactory constructor.
     *
     * @param Locator $locator
     */
    public function __construct(Locator $locator)
    {
        $this->locator = $locator;
    }

    /**
     * @param string $name
     *
     * @return mixed
     */
    public function getProvidedDependency($name)
    {
        return $this->locator->getDependencyProvider()->getProvidedDependency($name);
    }

    /**
     * @return Locator
     */
    public function getLocator()
    {
        return $this->locator;
    }

    /**
     * @return ContainerInterface
     */
    public function getContainer()
    {
        return $this->locator->getDependencyProvider();
    }

    /**
     * @return \Mibexx\Kernel\Business\Config\ConfigInterface
     */
    public function getConfig()
    {
        return $this->locator->getConfig();
    }
}