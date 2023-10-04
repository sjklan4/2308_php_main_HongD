<?php
	define("ROOT",$_SERVER["DOCUMENT_ROOT"]."/mini_board/src/");
	define("FILE_HEADER",ROOT."header.php"); // 헤더 패스
	require_once(ROOT."lib/lib_db.php"); //db관련 라이브러리

	// post 로 request 가 왔을 때 처리 
	$http_method = $_SERVER["REQUEST_METHOD"];
	if($http_method === "POST") {
		try {
			$arr_post = $_POST;
			$conn = null;

			// db 접속
			if(!my_db_conn($conn)) {
				throw new Exception("DB Error : PDO Instance");
			}
			
			// insert
			$conn->beginTransaction(); //트랜잭션 시작
			
			if(!db_insert_boards($conn, $arr_post)){
				throw new Exception("DB Error : Insert Boards");
			}
			$conn->commit();

			// 리스트 페이지로 이동
			header("Location: list.php");
			exit;

		} catch (Exception $e){
			$conn->rollBack();
			echo $e->getMessage();
			exit;

		} finally {
			db_destroy_conn($conn);
		}
	}	
	
?>

<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="/mini_board/src/css/common.css">
	<title>작성 페이지</title>
</head>
<body>
	<?php
	require_once (FILE_HEADER);
	?>
	<br>
	
	<form action="/mini_board/src/insert.php" method="post">
		<label for="title"> 제목  </label><br>
		<input type="text" name="title" id="title">
		<br>
		<br>
		<label for="content">내용 </label><br>
		
		<textarea name="content" id="content" cols="40" rows="10"></textarea>
		<br>
		<button class="btn_set"type="submit" class ="btn_gray">작성</button>
		<a href="/mini_board/src/list.php" class ="btn_set btn_cancel"> 취소 </a>
		
	</form>
</body>
</html>