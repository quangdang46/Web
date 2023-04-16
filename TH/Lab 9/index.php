<?php
    $conn = mysqli_connect('localhost', 'root', '','product');
?>

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
    body{
        padding-top: 50px;
    }
    table{

        text-align: center;
    }
    td{
        padding: 10px;
    }
    tr.item{
        border-top: 1px solid #5e5e5e;
        border-bottom: 1px solid #5e5e5e;
    }

    tr.item:hover{
        background-color: #d9edf7;
    }

    tr.item td{
        min-width: 150px;
    }

    tr.header{
        font-weight: bold;
    }

    a{
        text-decoration: none;
    }
    a:hover{
        color: deeppink;
        font-weight: bold;
    }
</style>


<script>
    $(document).ready(function () {
        $(".delete").click(function () {
            event.preventDefault()
            let tds = $(this).closest("tr").find("td")
            let id = $(this).attr("tag")
            console.log(id)
            let name = tds[0].innerHTML + tds[1].innerText
            $('#pproduct').html(name)
            $('#btndel').attr('tag',id)
            $('#myModal').modal({
                backdrop: 'static',
                keyboard: false
            });
        });
        $("#btndel").click(function(){
            let id = $(this).attr('tag')
            console.log(id)
            fetch('functions.php?action=delete&id='+id,{method:'DELETE'})
            .then(res=>res.json())
            .then(json=>{
                if(json.success){
                    $('#row'+id).remove()
                    $('#myModel').modal("hide")
                }
                else{
                    alert(json.message)
                }
            })
            .catch(err=>console.log(err))
        })


    });
</script>


<table cellpadding="10" cellspacing="10" border="0" style="border-collapse: collapse; margin: auto">

    <tr class="control" style="text-align: left; font-weight: bold; font-size: 20px">
        <td colspan="5">
            <a href="#">Thêm sản phẩm</a>
        </td>
    </tr>
    <tr class="header">
        <td>Image</td>
        <td>Name</td>
        <td>Price</td>
        <td>Description</td>
        <td>Action</td>
    </tr>
    <?php
        $sql = "select * from product";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()){

            ?>
                <tr class="item" id="row<?php echo $row['id']?>">
                    <td><img src="<?php echo $row["image"]?>" style="max-height: 80px"></td>
                    <td><?php echo $row["name"]?></td>
                    <td><?php echo $row["price"]?></td>
                    <td><?php echo $row["description"]?></td>
                    <td><a href="#">Edit</a> | <a href="#" action="delete" id='<?php echo $row['id']?>'>Delete</a></td>
                </tr>
            <?php
        }
    ?>
    <?php
    $sql2 = "select count(*) from product";
    $count = $conn->query($sql2);;
    ?>
        <tr class="control" style="text-align: right; font-weight: bold; font-size: 17px">
            <td colspan="5">
                <?php echo "Số sản phẩm là: 4"?>
            </td>
        </tr>
    <?php
    ?>
</table>


<!-- Delete Confirm Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modal Header</h4>
            </div>
            <div class="modal-body">
                <p id="pproduct"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button id="btndel" type="button" class="btn btn-danger">Delete</button>
            </div>

        </div>

    </div>
</div>


</body>
</html>