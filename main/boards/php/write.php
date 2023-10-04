<?php
require_once("dbconnect.php");
//$_GET["no]이 있을 때만 $no 변수를 사용할 수 있도록 함

// ------------------------ 수정을 위한 처리 과정 --------------------------------
if(isset($_GET["no"])){
	$no = $_GET["no"];
}
//$no 가 있으면
if(isset($no)){
	$sql = " SELECT b_subject, b_content, b_id FROM boards WHERE b_no =".$no;
	$result = $db->query($sql);
	$row = $result->fetch_array();
}
// ------------------------------------------------------------------------------------

?>
<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/style1.css">
	<title>Document</title>
</head>
<body>
	<article class="boardsArticle">
		<h3>글쓰기</h3>
		<div id="write">
			<form action="./postWrite.php" method="post">
				<?php
				// 화면에는 보이지 않지만 변수를 넘겨줌 
				//form 에서 submit 했을 때 no 가 게시글 번호도 함께 전송하기 위해 hidden사용
				//db에서 수정하고자 하는 글 번호를 알 수 있음
					if(isset($no)){
						echo "<input type='hidden' name='no' value='".$no."'>";
					}
				?>
				<table id="boardWrite">
					<tbody>
						<tr>
							
							<th scope="row"><label for="ID">아이디</label></th>
							<td class="id">
								<?php 
								// no값이 있으면 id값 넣어주고 없는경우는 그대로 사용
									if(isset($no)){
										echo $row["b_id"];
									}else{?>
									<input type="text" name="ID" id="ID"></td>
									<?php
									}
									?>
							
						</tr>
						<tr>
							<th scope="row"><label for="password">비밀번호</label></th>
							<td class="pw"><input type="password" name="password" id="password"></td>
						</tr>
						<tr>
							<th scope="row"><label for="subject">제목</label></th>
							<td class="subject">
								<!-- 제목이 있으면 제목부분 보여지고 없으면 null  -->
								<input type="text" name="subject" id="subject" value="<?=isset($row["b_subject"])?$row["b_subject"]:null?>">
							</td>
						</tr>
						<tr>
							<!-- 내용이 있으면 내용이 보여지고  없으면 null로 처리 -->
							<th scope="row"><label for="content">내용</label></th>
							<td class="content"><textarea name="content" id="content"><?=isset($row["b_content"])?($row["b_content"]):null?></textarea></td>
						</tr>
					</tbody>
				</table>
				<div class="btnSet">
					<button type="submit" class="submitBtn">
						 <?=isset($no)?"수정하기":"등록하기"?>
					</button>
					<a href="index.php" class="btnList">목록으로</a>
				</div>
			</form>
		</div>
	</article>
</body>
</html>