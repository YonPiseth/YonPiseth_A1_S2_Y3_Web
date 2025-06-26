<?php
require 'ParentClass.php'; // or include 'ParentClass.php';

class ChildClass extends ParentClass {
    public function sayGoodbye() {
        return "Goodbye from " . $this->name;
    }
}
?>
