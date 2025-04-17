<?php
use PHPUnit\Framework\TestCase;
require_once 'Calculator.php';
class CalculatorTest extends TestCase {
    public function testAdd() {
        $calc = new Calculator();
        $this->assertEquals(5, $calc->add(2,3));
    }
    public function testSub() {
        $calc = new Calculator();
        $this->assertEquals(1, $calc->sub(3,2));
    }
}
