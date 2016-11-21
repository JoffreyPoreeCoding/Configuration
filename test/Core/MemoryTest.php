<?php

namespace JPC\Configuration\Test\Common;

use PHPUnit\Framework\TestCase;
use JPC\Configuration\Core\Memory;

class MemoryTest extends TestCase {
    
    private $config;
    
    public function setUp(){
        $manager = $this->createMock("JPC\Configuration\Manager");
        $manager->method("getNameDelimiter")->willReturn(".");
        
        $this->config = new Memory([
            "value" => "simple_value",
            "embedded" => [
                "value" => "embedded_value"
            ]
        ]);
        
        $this->config->setManager($manager);
    }
    
    public function test_exisit_inexisting(){
        $this->assertFalse($this->config->exist("inexisting"));
    }
    
    public function test_exisit_existing(){
        $this->assertTrue($this->config->exist("value"));
    }
    
    public function test_get_inexisting(){
        $this->assertNull($this->config->get("inexisting"));
    }
    
    public function test_get_existing_simple(){
        $this->assertEquals("simple_value", $this->config->get("value"));
    }
    
    public function test_get_existing_embedded(){
        $this->assertEquals("embedded_value", $this->config->get("embedded.value"));
    }
}
