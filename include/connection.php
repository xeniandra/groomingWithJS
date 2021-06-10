<?php
$link = new mysqli("127.0.0.1","root","root","groom");

if($link->connect_erno){
    printf("Connect failed: %s\n", $link->connect_error);
    exit();
}
?>