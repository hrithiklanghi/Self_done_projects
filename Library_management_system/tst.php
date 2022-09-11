<?php
class test {

    private $str = NULL;

    public function newTest(){

        $this->str .= 'function "newTest" called, ';
        return $this;
    }
    public function bigTest(){

        return $this->str . ' function "bigTest" called,';
    }
    public function smallTest(){

        return $this->str . ' function "smallTest" called,';
    }
    public function scoreTest(){

        return $this->str . ' function "scoreTest" called,';
    }
}

$test = new test;

echo $test->newTest()->bigTest();
