<?php
define("ROOT",$_SERVER["DOCUMENT_ROOT"]."/mini_board2/src/");
define("FILE_HEADER",ROOT."header2.php");
require_once(ROOT."db.php"); 

$http_method = $_SERVER["REQUEST_METHOD"];
if($http_method === "POST"){
	try {
		$arr_post = $_POST;
		$conn = null;
	

	if(!my_db_conn($conn)) {
		throw new Exception("DB Error : PDO Instance");
	}
	$conn->beginTransaction();

	if(!db_insert_boards($conn,$arr_post)){
		throw new Exception("DB Error : Insert Boards");
	}
	$conn->commit();

	header("Location: list.php");
} catch(Exception $e){
	$conn->rollBack();
	echo $e->getMessage();
	exit;
} finally {
	db_destroy_conn($conn);
}
}
?>