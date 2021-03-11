<?php
    define("host","localhost");
    define("user","root");
    define("pass","");
    define("db","bookstore");

    $conn = new mysqli(host,user,pass,db);
    $conn->set_charset("utf8");
    //if(!$conn) die("ded");
    //else echo "connected to db"
;?>