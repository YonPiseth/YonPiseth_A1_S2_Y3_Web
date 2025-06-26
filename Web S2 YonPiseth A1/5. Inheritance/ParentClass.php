<?php
class ParentClass {
    public $name;

    public function __construct($name) {
        $this->name = $name;
    }

    public function greet() {
        return "Hello, my name is " . $this->name;
    }
}
?>
