<?php

namespace Modules\Test\Controllers ;

class Test
{

    /**
     * To handle insert and Update requests
     */
    public function Divide($args){
        if ($args[0] == 0) {
            throw new \Exception ("You are trying to divide a number by 0") ;
        }
        echo 100 / $args[0] ;
    }

    public function IsObj(){
        $testObj = new MyClass() ;
        if (is_object ($testObj)) {
            echo "Yes, it is an object" ;
        }
    }
}
class MyClass
{
    
}