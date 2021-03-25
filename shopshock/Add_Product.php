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
        <h1>SHOPSHOCK</h1><br>
        <h3>Select Product to Cart</h3><br>
        <i>Add Product to CART</i><br>
        <hr>
        <form action="#" method="POST">
            <table>
<?php
    include_once("db.php");
    $pid = $_GET["pid"];
    $sql = "SELECT product.Product_id, product.Product_code, product.Product_Name, brand.Brand_name, unit.Unit_name, product.Cost, product.Stock_Quantity FROM ((product INNER JOIN brand ON product.Brand_ID = brand.Brand_id) INNER JOIN unit ON product.Unit_ID = unit.Unit_id) WHERE Product_ID = $pid";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<th>Product_ID</th><td><input type='text' name='pid' value='{$row["Product_id"]}'></td></tr>";
            echo "<tr><th>Product_Code</th><td><input type='text' name='pcode' value='{$row["Product_code"]}'></td></tr>";
            echo "<tr><th>Product_Name</th><td><input type='text' name='pname' value='{$row["Product_Name"]}'></td></tr>";
            echo "<tr><th>Brand</th><td><input type='text' name='bname' value='{$row["Brand_name"]}' disabled></td></tr>";
            echo "<tr><th>Unit</th><td><input type='text' name='uname' value='{$row["Unit_name"]}'></td></tr>";
            echo "<tr><th>Cost</th><td><input type='text' name='cost' value='{$row["Cost"]}'></td></tr>";
            echo "<tr><th>Quantity</th><td><input type='number' name='quantity' value='1' style='width: 40px;' max='{$row["Stock_Quantity"]}'></td>";
            echo "</tr>";
        }
    }
?>
            </table>
            <hr>
                <input type="submit" name="submit">
                <input type="reset">
        </form>
    </center>
</body>
</html>
<?php
    if(isset($_POST["submit"])){
        $sql="SELECT * FROM bill WHERE Cus_ID='{$_SESSION["id"]}' AND Bill_Status = '0'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $sql = "INSERT INTO bill_detail VALUES('{$row["Bill_id"]}', '{$_POST["pid"]}', '{$_POST["quantity"]}', '{$_POST["cost"]}') ";
                if($conn->query($sql)){
                    header("location: PO.php");
                }
            }
        }
        else{
            $sql = "INSERT INTO bill VALUES(null , '{$_SESSION["id"]}', null, now(), '0', null);";
            if($conn->query($sql)){
                $sql = "INSERT INTO bill_detail VALUES('{$row["Bill_id"]}', '{$_POST["pid"]}', '{$_POST["quantity"]}', '{$_POST["cost"]}') ";
                if($conn->query($sql)){
                    header("location: PO.php");
                }
            }
        }
    }
?>