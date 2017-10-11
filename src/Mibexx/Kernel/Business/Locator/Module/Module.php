<?php

namespace Mibexx\Kernel\Business\Locator\Module;


use Mibexx\Kernel\Business\Config\ConfigConstants;
use Mibexx\Kernel\Business\Locator\Exception\ClassNotFound;
use Mibexx\Kernel\Business\Locator\Locator;

class Module implements ModuleInterface
{
    /**
     * @var string
     */
    private $moduleName;

    /**
     * @var Locator
     */
    private $locator;

    /**
     * @var AbstractFactory
     */
    private $factory = null;

    /**
     * @var AbstractFacade
     */
    private $facade = null;

    /**
     * Module constructor.
     *
     * @param string $moduleName
     * @param Locator $locator
     */
    public function __construct($moduleName, Locator $locator)
    {
        $this->moduleName = $moduleName;
        $this->locator = $locator;
    }

    /**
     * @return AbstractFactory
     * @throws ClassNotFound
     */
    public function Factory()
    {
        if ($this->factory === null) {
            try {
                $this->factory = $this->getModuleClass('Factory', $this->getApplicationNamespace());
            } catch (ClassNotFound $e) {
                $this->factory = $this->getModuleClass('Factory');
            }
        }

        return $this->factory;
    }

    /**
     * @return AbstractFacade
     * @throws ClassNotFound
     */
    public function Facade()
    {
        if ($this->facade === null) {
            try {
                $this->facade = $this->getModuleClass('Facade', $this->getApplicationNamespace());
            } catch (ClassNotFound $e) {
                $this->facade = $this->getModuleClass('Facade');
            }

            $this->facade->setFactory($this->Factory());
        }

        return $this->facade;
    }

    /**
     * @param string $suffix
     * @param string $namespace
     *
     * @return object
     * @throws ClassNotFound
     */
    private function getModuleClass($suffix, $namespace = 'Mibexx')
    {
        $moduleClassname = '\\' . $namespace . '\\' . $this->moduleName . '\\' . $this->moduleName . $suffix;
        if (class_exists($moduleClassname)) {
            return new $moduleClassname($this->locator);
        }

        throw new ClassNotFound("Module class not found: " . $moduleClassname);
    }

    /**
     * @return string
     */
    private function getApplicationNamespace()
    {
        return $this->locator->getConfig()->get(ConfigConstants::APPLICATION_NAMESPACE);
    }




}