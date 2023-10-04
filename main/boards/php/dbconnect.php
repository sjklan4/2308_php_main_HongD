<?php

header("Content-Type: text/html; charset=utf-8"); //인코딩을 utf8로 함
	// ---------------------db 접속 ---------------------------------
	$db = new mysqli("localhost","root","php504","boards");
	if($db->connect_error){
		die("db연결실패 시스템 관리자에게 문의 바랍니다.");
	}

	$db->set_charset("utf8");




?>