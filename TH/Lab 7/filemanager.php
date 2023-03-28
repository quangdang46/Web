<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>

    <style>
        tr.header {
            font-weight: bold;
            color: white;
            background-color: deepskyblue;
        }

        td {
            padding: 10px;
        }
    </style>

    <script>
        $(document).ready(function() {
            $(".rename").click(function() {
                $(".modaldelete").hide();
                $(".modalrename").show();
                let tds = $(this).closest('tr').find('td')
                let name = tds[1].innerText
                $('.fname').val(name)
                if (tds[4].innerText == '0')
                    $("#rename-title").text('Đổi tên thư mục')
                else
                    $("#rename-title").text('Đổi tên tập tin')
                $('#myModal').modal({
                    backdrop: 'static',
                    keyboard: false
                });

            });
            $(".delete").click(function() {
                $(".modalrename").hide();
                $(".modaldelete").show();
                let tds = $(this).closest('tr').find('td')
                let name = tds[1].innerText
                let type = tds[2].innerText
                $('.fname').val(name)
                if (tds[4].innerText == '0')
                    $("#delete-title").text('Xóa thư mục')
                else
                    $("#delete-title").text('Xóa tập tin')
                $('#myModal').modal({
                    backdrop: 'static',
                    keyboard: false
                });

            });

        });
    </script>


    <br>
    <div style="width: 300px; margin: auto; margin-bottom: 50px">

        <form>
            <input type="text">
            <input type="submit" value="New folder" name="submit">
        </form>

        <br>

        <form action="upload.php" method="post" enctype="multipart/form-data">
            <input type="file" name="fileToUpload" id="fileToUpload">
            <input type="submit" value="Upload" name="submit">
        </form>

    </div>



    <table border="1" cellpadding="15" cellspacing="10" style="text-align: center; margin: auto; border-collapse: collapse">
        <tr>
            <td colspan="6">
                <button>Back</button>
            </td>
        </tr>
        <tr class="header">
            <td>Icon</td>
            <td>File name</td>
            <td>Type</td>
            <td>Last modified</td>
            <td>File size</td>
            <td>Action</td>
        </tr>
        <?php
        $filestylename = array("php" => "PHP", "mp4" => "video", "pdf" => "PDF file", "mp3" => "Music", "docx" => "Word");
        $filestyleicon = array("mp4" => "images/mp4-icon", "pdf" => "images/document-compress-icon", "mp3" => "images/audio-x-generic-icon", "orther" => "images/text-x-tex-icon.png", "docx" => "images/word.png", "php" => "images/document-compress-icon.png");


        $root = $_SERVER["DOCUMENT_ROOT"];

        $files = scandir($root);
        foreach ($files as $k => $name) {
            if ($name == "." || $name == "..") continue;
            $path = $root . "/" . $name;
            $type = filetype($path);
            $size = filesize($path);
            $time = date("d/m/Y H:i:s", filemtime($path));
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            $icon = "images/folder-icon.png";
            if ($type == "file") {
                if (array_key_exists($ext, $filestyleicon)) {
                    $icon = $filestyleicon[$ext];
                } else {
                    $icon = $filestyleicon["orther"];
                }
            }
            echo "<tr>";
            echo "<td><img src='$icon' width='30px'></td>";
            echo "<td>$name</td>";
            echo "<td>$type</td>";
            echo "<td>$time</td>";
            echo "<td>$size</td>";
            echo "<td><button class='rename'>Rename</button> <button class='delete'>Delete</button></td>";
            echo "</tr>";
        }

        ?>
    </table>


    <!-- Rename dialog -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <form method="post" action="rename.php?action=rename" class="modalrename">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title" id="rename-title">Đổi tên thư mục</h4>
                    </div>
                    <div class="modal-body">
                        <p>Nhập tên mới.</p><input type="hidden" name="oldname" class="fname">
                        <input type="text" name="newname" class="fname form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-success">Lưu</button>
                    </div>
                </div>
            </form>

            <form action="rename.php?action=delete" method="post" class="modaldelete">
                <div class="modal-content">
                    <div class="modal-body">
                        <p>Xac nhan xoa</p><input type="hidden" name="oldname" class="fname">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-success">Xoa</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Rename dialog -->



</body>

</html>