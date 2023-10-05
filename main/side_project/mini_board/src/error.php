<?php
define("ROOT",$_SERVER["DOCUMENT_ROOT"]."/mini_board/src/");
define("FILE_HEADER",ROOT."header.php");
require_once(ROOT."/lib/lib_db.php"); //db관련 라이브러리
$err_msg = isset($_GET["err_msg"]) ? $_GET["err_msg"] : "";


?>

<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="/mini_board/src/css/common.css">
	<title>에러 페이지</title>
</head>
<body>
	<?php
	require_once (FILE_HEADER);
	?>
	<br>
	<main class= "container">
		<p>에러입니다</p>
		<p>관리자에게 문의하세요</p>
		<p><?php echo $err_msg ?></p>
		<p> Code : E01</p>
		<a href="/mini_board/src/list.php" class ="btn_set btn_cancel"> 메인으로 이동 </a>
	</main>
	
	<!-- <form action="/mini_board/src/insert.php" method="post">
		<label for="title"> 제목  </label><br>
		<input type="text" name="title" id="title">
		<br>
		<br>
		<label for="content">내용 </label><br>
		
		<textarea name="content" id="content" cols="40" rows="10"></textarea>
		<br>
		<button class="btn_set"type="submit" class ="btn_gray">작성</button>
		<a href="/mini_board/src/list.php" class ="btn_set btn_cancel"> 취소 </a>
		
	</form> -->
</body>
</html>