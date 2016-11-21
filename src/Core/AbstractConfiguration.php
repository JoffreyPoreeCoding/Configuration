<?php

namespace JPC\Configuration\Core;

use JPC\Configuration\Manager;

abstract class AbstractConfiguration {
    
    protected $config = [];
    protected $manager;
    
    public abstract function exist($name);
    
    public abstract function get($name);
    
    public final function setManager(Manager $manager){
        $this->manager = $manager;
    }
}
