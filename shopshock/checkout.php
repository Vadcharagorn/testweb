<?php
    session_start();
    if(isset($_SESSION["user"])){}
    else header("location: login.php");
    include_once("db.php");
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
    <center>
    <h1>ยินดีต้อนรับสู่เมนูลูกค้า</h1><br>
        |<a href="productlist.php">สั่งซื้อสินค้า</a>|<a href="PO.php">ชำระเงิน</a>|<a href="logout.php">ออกจากระบบ</a>
        <br><h1>SHOPSHOCK</h1><br>
        <h1>การสั่งซื้อสินค้าเสร็จสมบูรณ์<br>ขอบคุณที่ใช้บริการ SHOPSHOCK online</h1></center>
<?php
    if(isset($_GET["p"])){
        $sql = "UPDATE bill SET Bill_Status= '1' WHERE Bill_id='{$_GET["p"]}'";
        if($conn->query($sql)){}
    }
?>
</body>
</html>