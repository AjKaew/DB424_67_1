<?php
$server = 'db403-mysql';
$username = 'root';
$password = 'P@ssw0rd';
$db = 'northwind';
$conn = new mysqli($server, $username, $password, $db);
if ($conn->connect_errno) {
    die($conn->connect_error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MySQL First Contact</title>
</head>
<body>
    <h3>แสดงข้อมูลทั้งหมดจากตาราง categories</h3>
    <table>
        <tr>
            <th>CategoryID</th>
            <th>CategoryName</th>
        </tr>
<?php
$sql = 'SELECT * FROM categories';
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    echo '<tr>';
    echo "<td>{$row['CategoryID']}</td>";
    echo "<td>{$row['CategoryName']}</td>";
    echo '</tr>';
}
?>
    </table>
<!-- โจทย์จากวิชา DB304 -->
    <h3>แสดงข้อมูลชื่อสินค้า (ProductName)
    และราคาต่อหน่วย (UnitPrice) ของสินค้าที่มีราคามากกว่า 50 บาท 
    จากนั้นจัดเรียงตามราคาจากสูงไปต่ำ</h3>
    <table>
        <tr>
            <th>ProductName</th>
            <th>UnitPrice</th>
        </tr>
<?php
$sql = 'select ProductName, UnitPrice 
        from products
        where UnitPrice > 50
        order by UnitPrice desc';
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    echo '<tr>';
    echo "<td>{$row['ProductName']}</td>";
    echo "<td>{$row['UnitPrice']}</td>";
    echo '</tr>';
}
?>
    </table>
<?php
$conn->close();
?> 
</body>
</html>