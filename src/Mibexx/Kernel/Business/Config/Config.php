<?php

namespace Mibexx\Kernel\Business\Config;


use Mibexx\Kernel\Business\Config\Exception\ConfigNotFoundException;

class Config implements ConfigInterface
{
    /**
     * @var array
     */
    private $configs;

    /**
     * Config constructor.
     *
     * @param array $configs
     */
    public function __construct(array $configs = [])
    {
        $this->configs = $configs;
    }

    /**
     * @param string $name
     * @param mixed $value
     */
    public function set($name, $value)
    {
        $this->configs[$name] = $value;
    }

    /**
     * @param string $name
     *
     * @return mixed
     * @throws ConfigNotFoundException
     */
    public function get($name)
    {
        if (!isset($this->configs[$name])) {
            throw new ConfigNotFoundException("Config " . $name . " not found");
        }

        return $this->configs[$name];
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function has($name)
    {
        return isset($this->configs[$name]);
    }

}