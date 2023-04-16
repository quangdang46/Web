<?php
if ($conn->connect_error) {
    die("Kết nối đến database thất bại: " . $conn->connect_error);
}

// Xác định ID của sản phẩm cần xóa
$product_id = $_POST["id"];

// Xóa sản phẩm khỏi database
$sql = "DELETE FROM products WHERE id = $product_id";
if ($conn->query($sql) === TRUE) {
    echo "Sản phẩm đã được xóa thành công.";
} else {
    echo "Lỗi khi xóa sản phẩm: " . $conn->error;
}

$conn->close();
?>