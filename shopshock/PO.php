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
<?php
        echo '<h1>ยินดีต้อนรับสู่เมนูลูกค้า</h1><br>
        |<a href="productlist.php">สั่งซื้อสินค้า</a>|<a href="PO.php">ชำระเงิน</a>|<a href="logout.php">ออกจากระบบ</a>
        <br><h1>SHOPSHOCK</h1><br>
        <table border="1" width="60%" style="text-align:center;">
            <tr>
                <th>Bill_ID</th>
                <th>Cus_ID</th>
                <th>Emp_ID</th>
                <th>Bill_Date</th>
                <th>Bill_Satus</th>
                <th></th>
            </tr>
            <tr>';
    $sql="SELECT * FROM bill WHERE Cus_ID='{$_SESSION["id"]}' AND Bill_Status = '0'";
    $result = $conn->query($sql);
    $bill = "";
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $bill = $row["Bill_id"];
            echo "<td>{$row["Bill_id"]}</td>";
            echo "<td>{$row["Cus_ID"]}</td>";
            echo "<td>{$row["Emp_id"]}</td>";
            echo "<td>{$row["Bill_Date"]}</td>";
            echo "<td>{$row["Bill_Status"]}</td>";
            echo "<td><a href='checkout.php?p={$row["Bill_id"]}'>&lt;paid&gt;</td>";
        }
    }
            echo '</tr>
        </table>
        <table border="1" width="60%"  style="text-align:center;">
            <tr>
                <th>No.</th>
                <th>Product_Code</th>
                <th>Product_Name</th>
                <th>Quantity</th>
                <th>Unit_Price</th>
                <th>Total</th>
            </tr>';
    $sql="SELECT product.Product_code, product.Product_Name, bill_detail.Quantity, bill_detail.Unit_Price FROM (bill_detail INNER JOIN product ON bill_detail.Product_ID = product.Product_id) WHERE Bill_id='{$bill}'";
    $result = $conn->query($sql);
    $count = 1;
    $sum = 0;
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$count}</td>";
            $count += 1;
            echo "<td>{$row["Product_code"]}</td>";
            echo "<td>{$row["Product_Name"]}</td>";
            echo "<td>{$row["Quantity"]}</td>";
            echo "<td>{$row["Unit_Price"]}</td>";
            $total = $row["Unit_Price"] * $row["Quantity"];
            $sum += $total;
            echo "<td>{$total}</td>";
            echo "</tr>";
        }
    }
            echo '<tr>
                <th colspan="5">Total</th>
                <td>'.$sum.'</td>
            </tr>
        </table>';
?>
</body>
</html>