<?php

namespace Mibexx\Kernel;


use Mibexx\Application\ApplicationFacade;
use Mibexx\Kernel\Business\Locator\Module\AbstractFactory;
use Mibexx\Kernel\Business\Shared\KernelConstants;
use Mibexx\Router\RouterFacade;

class KernelFactory extends AbstractFactory
{
    /**
     * @return ApplicationFacade
     */
    public function getApplicationFacade()
    {
        return $this->getProvidedDependency(KernelConstants::APPLICATION_FACADE);
    }

    /**
     * @return RouterFacade
     */
    public function getRouterFacade()
    {
        return $this->getProvidedDependency(KernelConstants::ROUTER_FACADE);
    }
}