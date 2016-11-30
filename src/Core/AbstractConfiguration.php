<?php

namespace JPC\Configuration\Core;

use JPC\Configuration\Manager;

abstract class AbstractConfiguration {
    
    protected $config = [];
    protected $manager;
    
    public function exist($name){
        $levels = explode($this->manager->getNameDelimiter(), $name);
        
        $currentItem = $this->config;
        foreach ($levels as $level) {
            if(isset($currentItem[$level])){
                $currentItem = $currentItem[$level];
            } else {
                return false;
            }
        }
        
        return true;
    }
    
    public function get($name){
        $levels = explode($this->manager->getNameDelimiter(), $name);
        
        $currentItem = $this->config;
        foreach ($levels as $level) {
            if(isset($currentItem[$level])){
                $currentItem = $currentItem[$level];
            } else {
                return null;
            }
        }
        
        return $currentItem;
    }
    
    public final function setManager(Manager $manager){
        $this->manager = $manager;
    }
}
