<?php

namespace Mibexx\Kernel\Business\Config;


use Mibexx\Kernel\Business\Config\Exception\NoDirectoryException;
use Mibexx\Kernel\Business\Config\Exception\NoFileException;

class FileLoader
{
    /**
     * @var ConfigInterface
     */
    private $config;

    /**
     * FileLoader constructor.
     *
     * @param ConfigInterface $config
     */
    public function __construct(ConfigInterface $config)
    {
        $this->config = $config;
    }

    /**
     * @param string $directory
     *
     * @throws NoDirectoryException
     */
    public function loadFromDir($directory)
    {
        if (!is_dir($directory)) {
            throw new NoDirectoryException("Is not a directory: " . $directory);
        }

        foreach (glob($directory . '/*_config.php') as $configFile) {
            $this->loadFromFile($configFile);
        }
    }

    /**
     * @param string $configFile
     *
     * @throws NoFileException
     */
    public function loadFromFile($configFile)
    {
        if (!is_file($configFile)) {
            throw new NoFileException("Not a file: " . $configFile);
        }

        $config = [];
        require $configFile;

        foreach ($config as $name => $val) {
            $this->config->set($name, $val);
        }
    }


}