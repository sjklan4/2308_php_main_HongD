<?php
require_once("./dbconnect.php");

$no = $_GET["no"];

if(!empty($no) && empty($_COOKIE["bHit".$no])){
	$sql = " UPDATE boards SET b_hit=b_hit+1 WHERE b_no = ".$no;
	$result = $db->query($sql);
	if(empty($result)){
		?>
		<script>
			alerty("문제가 발생 했습니다.")
			history.back();
		</script>
	<?php	
	} else {
		setcookie("bHit".$no, "true", time() + (60 * 60 * 24)); //쿠키생성 
		//1번 조회 한 이후에는 실행하지 않음
	}
}
$sql = 'SELECT b_subject, b_content, b_date, b_hit, b_id FROM boards WHERE b_no = ' . $no;
$result = $db->query($sql);
$row = $result->fetch_array();

//조회한 결과 데이터를 가져오는 방법
//	1. mysqli_fetch_array(),2. fetch_assoc, 3. fetch_row
//	1. 변수 $row에 받아오면 $row["b_no"] 또는 $row[0]
//	2. $row["b_row"]
//	3. $row[0]

?>

<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/style1.css">
	<title>게시판</title>
</head>
<body>
	<article class="boardsArticle">
		<h2>게시글 보기</h2>
		<div id="boardView">
			<div id="bSubject"><?=$row["b_subject"] ?></div>
		
		<div id="bInfo">
			<span id="ID">작성자 : <?= $row["b_id"]?></span>
			<span id="bDate">작성일 : <?=$row["b_date"]?></span>
			<span id="bHit">조회수 : <?=$row["b_hit"]?></span>
			<div id="bContent"><?=$row["b_content"]?></div>
		</div>
		</div>
		<div class="btnSet">
			<a href="./write.php?no=<?=$no?>">수정</a>
			<a href="./delete.php?no=<?=$no?>">삭제</a>
			<a href="./">목록으로</a>

		</div>
	</article>
</body>
</html>