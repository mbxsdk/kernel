<?php

namespace Mibexx\Kernel\Business\Config;

use Mibexx\Kernel\Business\Config\Exception\ConfigNotFoundException;

interface ConfigInterface
{
    /**
     * @param string $name
     * @param mixed $value
     */
    public function set($name, $value);

    /**
     * @param string $name
     *
     * @return mixed
     * @throws ConfigNotFoundException
     */
    public function get($name);
}