<?php
    include_once("db.php");
    include_once("util.php");
    $debug_mode = true;

    if($_SERVER["REQUEST_METHOD"]=="GET"){
        if(isset($_GET["id"])){
            echo json_encode(read_one_data($_GET["id"]));
        }
        else if(isset($_GET["oid"])){
            echo json_encode(read_order());
        }
        else if(isset($_GET["odid"])){
            echo json_encode(read_order_detail($_GET["odid"]));
        }
        else{
            echo json_encode(read_data());
        } 
    }
    else if($_SERVER["REQUEST_METHOD"]=="POST"){
        debug_text("POST Method Proc...",$debug_mode);
        $message = array("Status"=>print_r($_POST));
        echo json_encode($message);
        if(isset($_POST["id"])){
            update_data($_POST["id"],$_POST["name"],$_POST["price"],$_POST["quantity"]);
        }
        else if(isset($_POST["did"])){
            delete_data($_POST["did"]);
        }
        else if(isset($_POST["pid"])){
            buy($_POST["pid"],$_POST["quantity"],$_POST["q"]);
            add_order();
            add_order_detail($_POST["q"],$_POST["total"]);
        }
        else{
            add_data($_POST["name"],$_POST["price"],$_POST["quantity"],$_POST["pic"]);
        }
    }
    else{
        debug_text("Error not support this request");
        http_response_code(405);
    }

    function read_data(){
        $mydb = new db("root","","crud", false);
        $data = $mydb->query("SELECT * FROM product");
        //print_r($data);
        $mydb->close();
        return $data;
    }

    function read_one_data($id){
        $mydb = new db("root","","crud", false);
        $data = $mydb->query("SELECT * FROM product WHERE p_id='{$id}'");
        //print_r($data);
        $mydb->close();
        return $data;
    }

    function read_order(){
        $mydb = new db("root","","crud", false);
        $data = $mydb->query("SELECT * FROM order_data");
        //print_r($data);
        $mydb->close();
        return $data;
    }

    function read_order_detail($id){
        $mydb = new db("root","","crud", false);
        $data = $mydb->query("SELECT * FROM order_detail WHERE order_id='{$id}'");
        $mydb->close();
        return $data;
    }

    function add_data($name, $price, $quantity, $pic){
        $mydb = new db("root","","crud", true);
        $mydb->query("INSERT INTO product VALUES(null, '{$name}', '{$price}', '{$quantity}', '{$pic}')");
        $mydb->close();
    }

    function buy($pid,$quantity,$q){
        $mydb = new db("root","","crud", true);
        $remain = $quantity - $q;
        $mydb->query_set("UPDATE product SET quantity='{$remain}' WHERE p_id='{$pid}';");
        $mydb->close();
    }

    function add_order(){
        $mydb = new db("root","","crud", true);
        $mydb->query_set("INSERT INTO order_data VALUES(null, now());");
        $mydb->close();
    }

    function add_order_detail($q, $total){
        $mydb = new db("root","","crud", true);
        $mydb->query_set("INSERT INTO order_detail VALUES(null, '{$q}', '{$total}');");
        $mydb->close();
    }

    function update_data($p_id,$p_name,$price,$quantity){
        $mydb = new db("root","","crud",true);
        $mydb->query("UPDATE product SET p_name='{$p_name}',price='{$price}', quantity='{$quantity}' WHERE p_id='{$p_id}'");
        $mydb->close();
    }

    function delete_data($id){
        $mydb = new db("root","","crud",true);
        $mydb->query("DELETE FROM product WHERE p_id={$id}");
        $mydb->close();
    }
?>