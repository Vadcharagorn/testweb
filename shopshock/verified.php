<?php
    session_start();
    include_once("db.php");

    $sql="SELECT * FROM member WHERE user='{$_POST["user"]}' AND password='{$_POST["pass"]}'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $_SESSION["user"] = $row["user"];
            $_SESSION["id"] = $row["member_id"];
        }
        header("location: productlist.php");
    }
    else header("location: login.php");
?>