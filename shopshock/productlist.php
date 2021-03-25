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
        <h3>Select Product to Cart</h3><br>

    <table style="text-align:center" border="1" width="60%">
        <tr>
            <th>ID</th>
            <th>Product_code</th>
            <th>Product_Name</th>
            <th>Brand</th>
            <th>Unit</th>
            <th>Cost</th>
            <th>SHOPS</th>
        </tr>
<?php
    $sql = "SELECT product.Product_id, product.Product_code, product.Product_Name, brand.Brand_name, unit.Unit_name, product.Cost FROM ((product INNER JOIN brand ON product.Brand_ID = brand.Brand_id) INNER JOIN unit ON product.Unit_ID = unit.Unit_id)";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<th>{$row["Product_id"]}</th>";
            echo "<td style='text-align:left;'>{$row["Product_code"]}</td>";
            echo "<td style='text-align:left;'>{$row["Product_Name"]}</td>";
            echo "<th>{$row["Brand_name"]}</th>";
            echo "<th>{$row["Unit_name"]}</th>";
            echo "<th>{$row["Cost"]}</th>";
            echo "<th><a href='Add_Product.php?pid={$row["Product_id"]}'>&lt;ShopShock&gt;</th>";
            echo "</tr>";
        }
    }
?>
    </table>
    </center>
    </body>
</html>