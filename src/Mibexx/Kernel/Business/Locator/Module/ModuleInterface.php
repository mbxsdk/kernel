<?php

namespace Mibexx\Kernel\Business\Locator\Module;

use Mibexx\Kernel\Business\Locator\Exception\ClassNotFound;

interface ModuleInterface
{
    /**
     * @return AbstractFactory
     * @throws ClassNotFound
     */
    public function Factory();

    /**
     * @return AbstractFacade
     * @throws ClassNotFound
     */
    public function Facade();
}