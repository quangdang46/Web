<?php
class SinhVienController
{
    private $db;
    public function __construct()
    {
        $this->db = new mysqli("", "root", "", "dbstudent");
        if ($this->db->connect_errno)
            die("Lỗi: " . $this->db->connect_error);
    }
    public function __destruct()
    {
        $this->db->close();
    }
    public function get_list()
    {
        $res = $this->db->query("select s.*, l.tenlop from sinhvien s inner join lop l on s.malop=l.ms");
        $rows = [];
        while ($row = mysqli_fetch_assoc($res)) {
            $rows[] = $row;
        }
        return $rows;
    }
    public function get_one($mssv)
    {
        $res = $this->db->query("select s.*, l.tenlop from sinhvien s inner join lop l on s.malop=l.ms where s.mssv='$mssv'");
        $row = mysqli_fetch_assoc($res);
        return $row;
    }
    public function add($mssv, $hoten, $malop, $diachi, $sdt, $email)
    {
        $sql = "insert into sinhvien values('$mssv', '$hoten', '$malop', '$diachi', '$sdt', '$email')";
        if ($this->db->query($sql))
            return true;
        else
            return false;
    }
    public function update($mssv, $hoten, $malop, $diachi, $sdt, $email)
    {
        $sql = "update sinhvien set hoten='$hoten', malop='$malop', diachi='$diachi', sdt='$sdt', email='$email' where mssv='$mssv'";
        if ($this->db->query($sql)) {
            return true;
        }
        return false;
    }
    public function delete($mssv)
    {
        $sql = "delete from sinhvien where mssv='$mssv'";
        if ($this->db->query($sql)) {
            return true;
        }
        return false;
    }
}
header("Content-Type: application/json; charset=utf-8");
$sv = new SinhVienController();
//thêm, xoá, sửa, lấy ds, lấy 1sv
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //thêm
    if (isset($_POST['btn'])) {
        $mssv = $_POST['mssv'];
        $hoten = $_POST['hoten'];
        $malop = $_POST['malop'];
        $diachi = $_POST['diachi'];
        $sdt = $_POST['sdt'];
        $email = $_POST['email'];
        $kq = $sv->add($mssv, $hoten, $malop, $diachi, $sdt, $email);
        if ($kq)
            echo '{"success": true, "message": "Thêm thành công"}';
        else
            echo '{"success": false, "message": "Thêm thất bại"}';
    } else {
        echo '{"success": false, "message": "Thiếu dữ liệu"}';
    }
} else if ($_SERVER["REQUEST_METHOD"] == "PUT") {
    //sửa
    if (isset($_POST['btn'])) {
        $mssv = $_POST['mssv'];
        $hoten = $_POST['hoten'];
        $malop = $_POST['malop'];
        $diachi = $_POST['diachi'];
        $sdt = $_POST['sdt'];
        $email = $_POST['email'];
        $kq = $sv->update($mssv, $hoten, $malop, $diachi, $sdt, $email);
        if ($kq)
            echo '{"success": true, "message": "Sửa thành công"}';
        else
            echo '{"success": false, "message": "Sửa thất bại"}';
    } else {
        echo '{"success": false, "message": "Thiếu dữ liệu"}';
    }
} else if ($_SERVER["REQUEST_METHOD"] == "GET") {
    //lấy 1sv, lấy dssv
    if (isset($_GET['id']))
        $kq = $sv->get_one($_GET['id']);
    else
        $kq = $sv->get_list();
    echo '{"success": true, "data": ' . json_encode($kq) . '}';
} else if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
    //xoá
    if (isset($_GET['id'])) {
        $kq = $sv->delete($_GET['id']);
        if ($kq)
            echo '{"success": true, "message": "Xoá thành công"}';
        else
            echo '{"success": false, "message": "Xoá thất bại"}';
    } else {
        echo '{"success": false, "message": "Thiếu dữ liệu"}';
    }
} else {
    echo '{"success": false, "message": "Method không hỗ trợ"}';
}
