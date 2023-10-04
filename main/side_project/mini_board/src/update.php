<?php
define("ROOT",$_SERVER["DOCUMENT_ROOT"]."/mini_board/src/");
define("FILE_HEADER",ROOT."header.php");
require_once(ROOT."/lib/lib_db.php"); //db관련 라이브러리

$conn = null; //db 연결용 변수
$id = isset($_GET["id"]) ? $_GET["id"] : $_POST["id"]; //id셋팅
$page = isset($_GET["page"]) ? $_GET["page"] : $_POST["page"];

$http_method = $_SERVER["REQUEST_METHOD"]; //method 확인
try {
	//db연결
	if(!my_db_conn($conn)) {
		throw new Exception("DB Error : PDO Instance");
	}
	//GET메소드
	if($http_method === "GET") {
		// 게시글 데이터 조회를 위한 파라미터 셋팅
		$arr_param = [
			"id" => $id
		]; //id를 이용해서 특정 게시글 불러오기
		$result = db_select_boards_id($conn, $arr_param);
		if($result === false){
			throw new Exception("DB Error : PDO Select_id");
		} else if(!(count($result) === 1)){
			throw new Exception ("DB Error : PDO select_id count, ".count($result));
		}
		$item = $result[0];
	}else {
		//post메소드
		//게시글 수정( 파라미터 셋팅)
		$arr_param = [
			"id" => $id
			,"title" => $_POST["title"]
			,"content" => $_POST["content"]
		];

		// 게시글 수정 처리
		$conn->begintransaction(); //트랜잭션시작
		if(!db_update_boards_id($conn, $arr_param)){
			throw new Exception("DB Error : Update_Boards_id");
		}
		$conn->commit(); //커밋

		header("Location: detail.php/?id={$id}&page={$page}"); //디테일페이지로이동
		exit;
	}
	
} catch(Exception $e) {
	if($http_method === "POST"){
		$conn->rollBack(); //롤백
	}
	echo $e->getMessage(); //예외 메세지 출력
	exit; //처리종료
} finally{
	db_destroy_conn($conn);
}

?>
<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="/mini_board/src/css/common.css">
	<title>수정 페이지</title>
</head>
<body>
	<?php
		require_once(FILE_HEADER);
	?>
	<form action="/mini_board/src/update.php" method="post">
		<table>
			<input type="hidden" name="id" value="<?php echo $id ?>">
			<input type="hidden" name="page" value="<?php echo $page ?>">
			<tr>
				<th>글 번호 </th>
				<td><?php echo $item["id"]; ?></td>
			</tr>
			<tr>
				<th>제목</th>
				<td>
					<input type="text" name="title" value="<?php echo $item["title"]; ?>">
					
				</td>
			</tr>
			<tr>
				<th>내용</th>
				<td>
					<textarea name="content" id="content" cols="30" rows="10"><?php echo $item["content"]; ?></textarea>
				</td>
			</tr>


		</table>
		<div class ="detail_a">
			<button class="btn_set" type="submit">수정확인</button>
			
			<a class="up_btn_a"href="/mini_board/src/detail.php/?id=<?php echo $id;?>&page=<?php echo $page;?>">수정취소</a>
		</div>
	</form>

</body>
</html>