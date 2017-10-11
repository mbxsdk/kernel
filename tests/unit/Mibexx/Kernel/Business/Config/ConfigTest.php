<?php
namespace Mibexx\Kernel\Business\Config;



class ConfigTest extends \Codeception\Test\Unit
{
    public function testConstruction()
    {
        $config = new Config();
        $this->assertInstanceOf(Config::class, $config);
    }

    public function testConstructionWithParams()
    {
        $config = new Config(
            [
                'test' => 'unitTest'
            ]
        );

        $this->assertEquals('unitTest', $config->get('test'));
    }

    public function testSetAndGet()
    {
        $config = new Config();
        $config->set('test', 'unit1');
        $this->assertEquals('unit1', $config->get('test'));
        $config->set('test', 'unit2');
        $this->assertEquals('unit2', $config->get('test'));
    }

    public function testHas()
    {
        $config = new Config();

        $this->assertFalse($config->has('unitTest'));

        $config->set('unitTest', 'test');

        $this->assertTrue($config->has('unitTest'));
    }

    /**
     * @expectedException \Mibexx\Kernel\Business\Config\Exception\ConfigNotFoundException
     */
    public function testMissingConfig()
    {
        $config = new Config();
        $config->get('not existing');
    }
}