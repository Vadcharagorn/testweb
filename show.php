<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>ตาราง book</h2>
    <table style="text-align: center;">
        <tr>
            <th width=100px>BookID</th>
            <th width=100px>BookName</th>
            <th width=100px>TypeID</th>
            <th width=100px>StatusID</th>
            <th width=100px>Publish</th>
            <th width=100px>UnitPrice</th>
            <th width=100px>UnitRent</th>
            <th width=100px>DayAmount</th>
            <th width=100px>Picture</th>
            <th width=100px>BookDate</th>
        </tr>
<?php
    include_once("db.php");

    $sql = "SELECT book.BookID, book.BookName, typebook.TypeName, statusbook.StatusName, book.Publish, book.UnitPrice, book.UnitRent, book.DayAmount, book.Picture, book.BookDate FROM ((book INNER JOIN typebook ON book.TypeID = typebook.TypeID) INNER JOIN statusbook ON book.StatusID = statusbook.StatusID)";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row["BookID"]."</td>";
            echo "<td>".$row["BookName"]."</td>";
            echo "<td>".$row["TypeName"]."</td>";
            echo "<td>".$row["StatusName"]."</td>";
            echo "<td>".$row["Publish"]."</td>";
            echo "<td>".$row["UnitPrice"]."</td>";
            echo "<td>".$row["UnitRent"]."</td>";
            echo "<td>".$row["DayAmount"]."</td>";
            echo "<td>".$row["Picture"]."</td>";
            echo "<td>".$row["BookDate"]."</td>";
            echo "</tr>";
        }
      } else {
        echo "0 results";
      }
      $conn->close();
?>
</table>
<a href="insert.php">Add book</a>
</body>
</html>