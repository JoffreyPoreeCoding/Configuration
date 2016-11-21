<?php

namespace JPC\Configuration\Test;

use PHPUnit\Framework\TestCase;
use JPC\Configuration\Manager;

class ManagerTest extends TestCase{
    
    /**
     * Configuration manager
     * @var Manager 
     */
    private $manager;
    
    /**
     * @before
     */
    public function setManager(){
        $this->manager = new Manager();
    }
    
    public function test_addConfiguration(){
        $configuration = $this->createMock("JPC\Configuration\Core\AbstractConfiguration");
        
        $this->manager->addConfiguration($configuration);
        
        $prop = new \ReflectionProperty(get_class($this->manager), "stack");
        $prop->setAccessible(true);
        $stack = $prop->getValue($this->manager);
        
        $this->assertEquals(1, count($stack));
    }
    
    public function test_removeLastConfiguration(){
        $first = $this->createMock("JPC\Configuration\Core\AbstractConfiguration");
        $second = $this->createMock("JPC\Configuration\Core\AbstractConfiguration");
        $this->manager->addConfiguration($first);
        $this->manager->addConfiguration($second);
        $this->manager->removeLastConfiguration();
        
        $prop = new \ReflectionProperty(get_class($this->manager), "stack");
        $prop->setAccessible(true);
        $stack = $prop->getValue($this->manager);
        
        $this->assertEquals(1, count($stack));
        $this->assertEquals($first, $stack->current());
    }
    
    public function test_setNameDelimiter(){
        $this->manager->setNameDelimiter("_");
        $this->manager->getNameDelimiter();
        
        $this->assertEquals("_", $this->manager->getNameDelimiter());
    }
    
    public function test_get(){
        $config = $this->createMock("JPC\Configuration\Core\AbstractConfiguration");
        $config->method("exist")->willReturn(false);
        
        $this->manager->addConfiguration($config);
        
        $this->assertNull($this->manager->get("test"));
        
        $config = $this->createMock("JPC\Configuration\Core\AbstractConfiguration");
        $config->method("exist")->willReturn(true);
        $config->method("get")->willReturn("value");
        
        $this->manager->addConfiguration($config);
        
        $this->assertEquals("value", $this->manager->get("test"));
    }
}
