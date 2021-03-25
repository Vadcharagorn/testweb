<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div style="margin: auto; width: 50%;">
    <form action="#" method="POST">
        ShopShock Member Register
        <table>
            <tr style="text-align: right;">
                <th>Name:</th>
                <td><input type="text" name="name" required>
            </tr>
            <tr style="text-align: right;">
                <th>NickName:</th>
                <td><input type="text" name="nname" required>
            </tr>
            <tr style="text-align: right;">
                <th>Password:</th>
                <td><input type="password" name="pass" required>
            </tr>
            <tr style="text-align: right;">
                <th>Confirm Password:</th>
                <td><input type="password" name="cpass" required>
            </tr>
        </table>
        <br>
        <hr>
        <center>
            <input type="submit" name="submit">
            <input type="reset">
        </center>
    </form>
</div>
</body>
</html>
<?php
    include_once("db.php");
    if(isset($_POST["submit"])){
        if($_POST["pass"] == $_POST["cpass"]){
            $sql = "INSERT INTO member VALUES(null, '{$_POST["name"]}', '{$_POST["nname"]}', '{$_POST["pass"]}', '01');";
            if($conn->query($sql)){
                header("location: login.php");
            }
            else{
                echo "<script> alert('error!');</script>";
            }
        }
        else{
            echo "<script> alert('Password not match!');</script>";
        }
    }
?>