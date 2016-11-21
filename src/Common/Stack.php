<?php

namespace JPC\Configuration\Common;

/**
 * Description of Stack
 *
 * @author poree
 */
class Stack implements \Iterator, \Countable{

    private $stack;
    private $position = 0;

    public function __construct($initial = []) {
        if (!is_array($initial)) {
            throw new \Exception("Stack initial value must be an array");
        }
        $this->init = $initial;
    }

    /**
     * Retourne l'élément courant du tableau.
     */
    public function current() {
        return $this->stack[$this->position];
    }

    /**
     * Retourne la clé actuelle (c'est la même que la position dans notre cas).
     */
    public function key() {
        return $this->position;
    }

    /**
     * Déplace le curseur vers l'élément suivant.
     */
    public function next() {
        $this->position--;
    }

    /**
     * Remet la position du curseur à 0.
     */
    public function rewind() {
        $this->position = count($this->stack) - 1;
    }

    /**
     * Permet de tester si la position actuelle est valide.
     */
    public function valid() {
        return isset($this->stack[$this->position]);
    }
    
    public function push($value){
        $this->stack[] = $value;
        $this->rewind();
    }
    
    public function pop(){
        $this->rewind();
        unset($this->stack[$this->key()]);
        $this->rewind();
    }

    public function count() {
        return count($this->stack);
    }

}
