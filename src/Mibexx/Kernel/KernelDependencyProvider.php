<?php

namespace Mibexx\Kernel;


use Mibexx\Dependency\Business\ContainerInterface;
use Mibexx\Dependency\Business\Provider\AbstractDependencyProvider;
use Mibexx\Kernel\Business\Shared\KernelConstants;

class KernelDependencyProvider extends AbstractDependencyProvider
{
    /**
     * @param ContainerInterface $container
     */
    public function defineDependencies(ContainerInterface $container)
    {
        $container[KernelConstants::APPLICATION_FACADE] = function () use ($container) {
            return $container->getLocator()->Application()->Facade();
        };

        $container[KernelConstants::ROUTER_FACADE] = function () use ($container) {
            return $container->getLocator()->Router()->Facade();
        };
    }

}