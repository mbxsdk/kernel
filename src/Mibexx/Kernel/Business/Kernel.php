<?php

namespace Mibexx\Kernel\Business;


use Mibexx\Kernel\Business\Locator\Locator;
use Mibexx\Kernel\KernelFactory;

class Kernel
{
    /**
     * @var Locator
     */
    private $locator;

    /**
     * Kernel constructor.
     *
     * @param Locator $locator
     */
    public function __construct(Locator $locator)
    {
        $this->locator = $locator;
        $this->locator->Dependency()->Facade()->loadDependencies();
        $this->locator->Dependency()->Facade()->loadInjections();
    }

    public function run()
    {
        $this->getFactory()->getRouterFacade()->defineRoutings();
        $this->getFactory()->getApplicationFacade()->runApplication();
    }

    /**
     * @return KernelFactory
     */
    private function getFactory()
    {
        return $this->locator->Kernel()->Factory();
    }

}