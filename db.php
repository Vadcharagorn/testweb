<?php
    define("host","localhost");
    define("user","root");
    define("pass","");
    define("db","bookstore");

    $conn = new mysqli(host,user,pass,db);
    if($conn) die("ded");
    else echo "connected to db"
;?>