<?php

namespace Mibexx\Kernel\Business\Config;


class FileLoaderTest extends \Codeception\Test\Unit
{
    public function testLoadFromDirectoryIntegration()
    {
        $config = $this->getMockBuilder(ConfigInterface::class)
                       ->setMethods(
                           [
                               'set',
                               'get'
                           ]
                       )
                       ->getMock();

        $config->expects($this->once())
               ->method('set')
               ->with(
                   $this->equalTo('unit'),
                   $this->equalTo('test')
               );

        $fileLoader = new FileLoader($config);
        $fileLoader->loadFromDir(__DIR__ . '/_data');
    }

    public function testLoadFromDirectory()
    {
        $config = $this->getMockBuilder(ConfigInterface::class)
                       ->setMethods(
                           [
                               'set',
                               'get'
                           ]
                       )
                       ->getMock();

        $fileLoader = $this->getMockBuilder(FileLoader::class)
                           ->setMethods(['loadFromFile'])
                           ->setConstructorArgs([$config])
                           ->getMock();

        $fileLoader->expects($this->once())
                   ->method('loadFromFile')
                   ->with($this->equalTo(__DIR__ . '/_data/example_config.php'));

        $fileLoader->loadFromDir(__DIR__ . '/_data');
    }

    public function testLoadFromFile()
    {
        $config = $this->getMockBuilder(ConfigInterface::class)
                       ->setMethods(
                           [
                               'set',
                               'get'
                           ]
                       )
                       ->getMock();

        $config->expects($this->at(0))
               ->method('set')
               ->with(
                   $this->equalTo('dist'),
                   $this->equalTo('disting')
               );

        $config->expects($this->at(1))
               ->method('set')
               ->with(
                   $this->equalTo('unit'),
                   $this->equalTo('test2')
               );


        $fileLoader = new FileLoader($config);
        $fileLoader->loadFromFile(__DIR__ . '/_data/example_config.dist.php');
    }

    /**
     * @expectedException \Mibexx\Kernel\Business\Config\Exception\NoDirectoryException
     */
    public function testLoadFromDirectoryFail()
    {
        $config = $this->getMockBuilder(ConfigInterface::class)
                       ->setMethods(
                           [
                               'set',
                               'get'
                           ]
                       )
                       ->getMock();

        $fileLoader = new FileLoader($config);
        $fileLoader->loadFromDir(__DIR__ . '/FileLoaderTest.php');
    }

    /**
     * @expectedException \Mibexx\Kernel\Business\Config\Exception\NoFileException
     */
    public function testLoadFromFileFail()
    {
        $config = $this->getMockBuilder(ConfigInterface::class)
                       ->setMethods(
                           [
                               'set',
                               'get'
                           ]
                       )
                       ->getMock();

        $fileLoader = new FileLoader($config);
        $fileLoader->loadFromFile(__DIR__);
    }
}