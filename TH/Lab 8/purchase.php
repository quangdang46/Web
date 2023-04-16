<?php
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "database";

// Tạo kết nối đến database
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if (!$conn) {
    die("Kết nối đến database thất bại: " . mysqli_connect_error());
}

// Lấy danh sách sản phẩm từ database
$sql = "SELECT * FROM products";
$result = mysqli_query($conn, $sql);
?>

<table>
    <tr>
        <th>ID</th>
        <th>Tên sản phẩm</th>
        <th>Giá</th>
    </tr>
    <?php
    if (mysqli_num_rows($result) > 0) {
        // Hiển thị từng sản phẩm
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["name"] . "</td>";
            echo "<td>" . $row["price"] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "Không có sản phẩm nào.";
    }
    ?>
</table>

<?php
// Đóng kết nối đến database
mysqli_close($conn);
?>