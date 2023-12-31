<?php
	require_once("dbConnect.php");
	if(isset($_GET["no"])){
		$no = $_GET["no"];
	}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/style1.css">
	<title>반응형 게시판</title>
</head>
<body>
	<h3>글 삭제</h3>
	<?php
	if(isset($no)){
		$sql = " SELECT COUNT(b_no) AS cnt FROM boards WHERE b_no=".$no;
		$result = $db->query($sql);
		$row = $result->fetch_array();
		if(empty($row["cnt"])){
	?>
	<script>
		alert("삭제할 글이 존재하지 않습니다");
		history.back();
	</script>
	<?php
		exit;
			}
			$sql = " SELECT b_subject FROM boards WHERE b_no=".$no;
			$result = $db->query($sql);
			$row = $result->fetch_array();
	
	?>
	<div id="boardDelete">
		<form action="./postDel.php" method="post">
			<input type="hidden" name="no" value="<?=$no?>">
			<table>
				<thead>
					<tr>
						<th scope="col" colspan="2">게시글 삭제하기</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<th scope="row">제목</th>
						<td><?=$row["b_subject"]?></td>
					</tr>
					<tr>
						<tr>
							<th scope="row"><label for="pw">비밀번호</label></th>
							<td><input type="password" name="pw" id="pw"></td>
					
						</tr>
					</tr>
				</tbody>
			</table>
			<div class="btnSet">
				<button type="submit" class="btnSubmit">삭제</button>
				<a href="./index.php" class="btnList">목록으로</a> 
			</div>
		</form>
	</div>
	<?php
// 비정상적으로 넘어오는 경우
		} else {
	?>
		<script>
			alert("정상적인 경로가 아닙니다.");
			history.back();
		</script>
		<?php
		exit;
		}
	?>
</body>
</html>