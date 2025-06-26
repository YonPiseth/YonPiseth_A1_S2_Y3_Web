<?php
require 'ChildClass.php'; // or include 'ChildClass.php'

$child = new ChildClass("SETH");
echo $child->greet(); 
echo "<br>";
echo $child->sayGoodbye(); 
?>
