<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Add Book</h2>
    <form action="#" method="POST">
        <pre>
            Book ID :   <input type="text" name="bid"><br>
            Book Name : <input type="text" name="bn"><br>
            Type :      <select name="type">
                            <option value="001">การ์ตูน</option>
                            <option value="002">นิยาย</option> 
                            <option value="003">นิตยสาร</option> 
                        </select><br>
            Status :    <select name="status">
                            <option value="01">ปกติ</option>
                            <option value="02">ชำรุด</option> 
                            <option value="03">ส่งซ่อม</option> 
                        </select><br>
            Publish :   <input type="text" name="publish"><br>
            Price :     <input type="number" name="price"><br>
            Rent :      <input type="number" name="rent"><br>
            Day Amount: <input type="number" name="day"><br>
            Picture :   <input type="text" name="pic" value="null"><br>
            <input type="submit" name="submit">
        </pre>
    </form>
</body>
</html>
<?php
    include_once("db.php");
    if(isset($_POST["submit"])){
        echo "pass1";
        print_r($_POST);
        $sql = "INSERT INTO book VALUES('{$_POST["bid"]}','{$_POST["bn"]}','{$_POST["type"]}','{$_POST["status"]}','{$_POST["publish"]}','{$_POST["price"]}','{$_POST["rent"]}','{$_POST["day"]}','{$_POST["pic"]}',now()";
        if($conn->query($sql)) {
            header("location: show.php");
            echo "pass2";
        }
        //else die();
    }
    echo "pass3";
?>