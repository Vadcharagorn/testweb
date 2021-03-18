<?php
    include_once("db.php");
    include_once("util.php");
    $debug_mode = true;

    if($_SERVER["REQUEST_METHOD"]=="GET"){
        debug_text("GET Method Proc...",$debug_mode);
        echo json_encode(show_data());
    }
    else if($_SERVER["REQUEST_METHOD"]=="POST"){
        debug_text("POST Method Proc...",$debug_mode);
        $message = array("Status"=>print_r($_POST));
        echo json_encode($message);
        add_data($_POST["name"],$_POST["age"]);
    }
    else{
        debug_text("Error not support this request");
        http_response_code(405);
    }

    function show_data(){
        $mydb = new db("root","","personal", true);
        $data = $mydb->query("select * from person");
        //print_r($data);
        $mydb->close();
        return $data;
    }

    function add_data($name, $age){
        $mydb = new db("root","","personal", true);
        $mydb->query("INSERT INTO person VALUES(null, '{$name}', '{$age}', null)");
        //print_r($data);
        $mydb->close();
    }
?>