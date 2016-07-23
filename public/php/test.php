<?php
function __autoload($url){
    echo "call here<hr>";
    require $url.".php";   
}
$test = new ABC();
$test->demo();
$test2 = new DEF();