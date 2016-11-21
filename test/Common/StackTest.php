<?php

namespace JPC\Configuration\Test\Common;

use PHPUnit\Framework\TestCase;
use JPC\Configuration\Common\Stack;

class StackTest extends TestCase {
    public function test_foreachStack(){
        $stack = new Stack([1,2,3,4,5,6]);
        
        $expected = 6;
        
        foreach ($stack as $value) {
            $this->assertEquals($expected, $value);
            $expected--;
        }
    }
}
