<?php
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "shopping";

// Tạo kết nối đến database
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối đến database thất bại: " . $conn->connect_error);
}

$sql = "SELECT * FROM products";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>ID</th><th>Tên sản phẩm</th><th>Giá</th></tr>";
    // Hiển thị từng sản phẩm dưới dạng một dòng trong bảng
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["id"]. "</td><td>" . $row["name"]. "</td><td>" . $row["price"]. "</td></tr>";
    }
    echo "</table>";
} else {
    echo "Không có sản phẩm nào.";
}

$conn->close();
?>