<?php

namespace JPC\Configuration\Core;

/**
 * Description of Memory
 *
 * @author poree
 */
class Memory extends AbstractConfiguration {
    
    function __construct($config = []) {
        $this->config = $config;
    }

    public function exist($name) {
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

    public function get($name) {
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
}
