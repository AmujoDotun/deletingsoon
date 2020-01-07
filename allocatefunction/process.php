<?php 
$hall = array("hall1" => "20", "hall2" => "10", "hall3" => "30");
$student = 20;
$dept = "computer";

function allocate($hall) {
    global $hall;
    global $student;
    global $dept;
    
    if($student<=20 && $dept=="computer"){

    }
    echo $hall;
}

allocate($hall);
?>