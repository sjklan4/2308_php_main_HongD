<?php
    function db_conn(){
        $db = new mysqli('localhost', 'root', 'php504', 'sm');

        if($db->connect_error){
            die('데이터베이스 연결에 문제가 발생했습니다. 관리자에게 문의 바랍니다!!');
        }

        $db->set_charset('utf8');
        return $db;
    }
?>

