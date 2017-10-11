<?php

namespace Mibexx\Kernel\Business\Locator\Module;


use Mibexx\Kernel\Business\Locator\Locator;

abstract class AbstractFacade extends AbstractBase
{
    /**
     * @var AbstractFactory
     */
    private $factory;

    /**
     * AbstractFacade constructor.
     *
     * @param Locator $locator
     */
    public function __construct(Locator $locator)
    {
        parent::__construct($locator);
    }

    /**
     * @param AbstractFactory $factory
     */
    public function setFactory(AbstractFactory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @return AbstractFactory
     */
    public function getFactory()
    {
        return $this->factory;
    }
}