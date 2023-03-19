<?php
$db = new mysqli('localhost', 'root', '', 'dbstudent');

if ($db->connect_errno)
    die("Lỗi kết nối: " . $db->connect_error);
// $selected = $_GET['malop'];
$selected = null;
$delete = null;

if (isset($_GET['delete'])) {
    $delete = $_GET['delete'];
}
if (isset($_GET['lop'])) {
    $selected = $_GET['lop'];
}
$stm = $db->prepare("select * from lop");
$stm->execute();
$stm->bind_result($ms, $tenlop);
$options = '';
$first_ms = null;
$found = false;
while ($stm->fetch()) {
    if (!$selected)
        $selected = $ms;
    if (!$first_ms)
        $first_ms = $ms;
    $sel = '';
    if ($selected == $ms) {
        $found = true;
        $sel = ' selected';
    }
    $options .= "<option value='$ms'$sel>$tenlop</option>";
}
if (!$found) {
    $selected = $first_ms;
}
$msg = '';
if (isset($_POST['btn'])) {
    $ms = $_POST['mssv'];
    $ht = $_POST['hoten'];
    $ns = $_POST['namsinh'];
    $malop = $_POST['malop'];
    //phải nhập đủ ms, ht
    //kiểm tra trùng mssv trong CSDL, kiểm tra malop có trong bảng lop hay không.
    if (!empty($_POST['mssv']) and !empty($_POST['hoten'])  && !empty($_POST['namsinh']) && !empty($_POST['malop'])) {
        # kiểm tra thông tin: không trùng mã với sv đang có
        # $_SESSION['dssv'][] = array('ms'=>$ms, 'ht'=>$ht);
        $sql = "";
        // check exist
        $sql = "select * from sinhvien where mssv='$ms'";
        if ($db->query($sql)->num_rows > 0) {
            $sql = "update sinhvien set hoten='$ht', namsinh='$ns', malop='$malop' where mssv='$ms'";
        } else {
            $sql = "insert into sinhvien (mssv,hoten,namsinh,malop) values ('$ms', '$ht', '$ns', '$malop')";
        }
        if ($db->query($sql) === TRUE) {
            $msg = "Đã lưu";
        } else {
            $msg = "Lỗi lưu: " . $db->error;
        }
    } else {
        $msg = "Chưa nhập đủ thông tin";
    }
}
# mysqli_escape_string()
?>
<!DOCTYPE html>
<!--We can mix HTML, CSS, JS commands inside PHP file -->
<html lang="en">

<head>
    <?php echo '<title>Quản lý SV</title>'; ?>
    <script>
        function change_class(cbo) {
            //lấy mã lớp đang chọn
            let ml = cbo.options[cbo.selectedIndex].value; //$(cbo).val() // 
            window.location.href = 'qlsv.php?lop=' + ml
        }
        document.addEventListener('DOMContentLoaded', function() {
            let btns = document.querySelectorAll('.delete');
            let btnsEdit = document.querySelectorAll('.edit');
            btns.forEach(function(btn) {
                btn.addEventListener('click', function() {
                    let tr = this.parentNode.parentNode;
                    let mssv = tr.children[0].innerText;
                    let hoten = tr.children[1].innerText;
                    if (confirm('Bạn có muốn xóa ' + hoten + ' không?')) {
                        window.location.href = 'qlsv.php?delete=' + mssv;
                    }

                })
            })
            btnsEdit.forEach(function(btn) {
                btn.addEventListener('click', function() {
                    let tr = this.parentNode.parentNode;
                    let mssv = tr.children[0].innerText;
                    let hoten = tr.children[1].innerText;
                    let namsinh = tr.children[2].innerText;
                    let malop = tr.children[3].innerText;
                    document.querySelector('input[id="mssv"]').value = mssv;
                    document.querySelector('input[id="hoten"]').value = hoten;
                    document.querySelector('input[id="namsinh"]').value = namsinh;
                    document.querySelector('select[id="malop"]').value = malop;
                    document.querySelector('input[name="btn"]').value = 'Sửa';
                
                })
            })
        })
    </script>
</head>

<body>
    <form method="post">
        MSSV: <input type="text" name="mssv" id='mssv' /> <br />
        Họ tên: <input type="text" name="hoten" id="hoten" /> <br />
        Năm sinh: <input type="text" name="namsinh" id="namsinh" /> <br />
        Lớp: <select name="malop" id="malop">
            <?php echo $options ?>
        </select> <br />
        <div style="color:red"><?php echo $msg ?></div>
        <input type="submit" name="btn" value="Thêm" /> <br />
    </form>
    <div>Danh sách sinh viên</div>
    Chọn lớp: <select name="malop" onchange="change_class(this)">
        <?php echo $options ?>
    </select>
    <table border="1">
        <thead>
            <tr>
                <th>MSSV</th>
                <th>Họ tên</th>
                <th>nam sinh</th>
                <th>Lớp</th>
                <th>Xoa</th>
                <th>Sua</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "select sv.mssv, sv.hoten,sv.namsinh, l.tenlop from sinhvien sv, lop l where sv.malop=l.ms and sv.malop='$selected'";
            $res = $db->query($sql);
            while ($row = mysqli_fetch_assoc($res)) {
                $ms = $row['mssv'];
                $ht = $row['hoten'];
                $ns = $row['namsinh'];
                $tl = $row['tenlop'];
                echo "<tr><td>$ms</td><td>$ht</td><td>$ns</td><td>$tl</td><td><button class='delete'>Xoa</button></td><td><button class='edit'>Sua</button></td></tr>";
            }

            if ($delete) {
                $sql = "delete from sinhvien where mssv='$delete'";
                if ($db->query($sql) === TRUE) {
                    $msg = "Đã xóa";
                    header('Location: qlsv.php');
                } else {
                    $msg = "Lỗi xóa: " . $db->error;
                }
                echo $msg;
            }
            ?>
        </tbody>
    </table>
</body>

</html>
<?php
$db->close();
?>