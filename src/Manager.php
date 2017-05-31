<?php

namespace JPC\Configuration;

use JPC\Configuration\Common\Stack;
use JPC\Configuration\Core\AbstractConfiguration;

/**
 * Description of Manager
 *
 * @author poree
 */
class Manager {
    
    private $stack;
    
    private $delimiter;
    
    public function __construct($delimiter = ".") {
        $this->stack = new Stack();
        $this->delimiter = $delimiter;
    }
    
    public function addConfiguration(AbstractConfiguration $configuration){
        $configuration->setManager($this);
        $this->stack->push($configuration);
    }
    
    public function removeLastConfiguration(){
        $this->stack->pop();
    }
    
    public function setNameDelimiter($delimiter){
        $this->delimiter = $delimiter;
    }
    
    public function getNameDelimiter(){
        return $this->delimiter;
    }
    
    public function get($name){
        foreach ($this->stack as $config) {
            if($config->exist($name)){
                return $config->get($name);
            }
        }
        
        return null;
    }
}
