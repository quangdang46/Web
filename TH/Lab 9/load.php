<?php
    $action = $_GET['action'];
    if($action === 'delete'){
        $id = $_GET['id'];
        if($_SERVER['REQUEST_METHOD']== 'DELETE'){
            require_once('db.php');
            $result = $conn->query("delete from product where id = $id");
            if(!$result){
                $res = array("success"=>false, "message"=> $mysql->error);
                die(json_encode($res));
            }
            else{
                die('{"success":true}');
            }
        }
    }
    die('{"success":false, "message":"Truy cập không hợp lệ"}');
?>