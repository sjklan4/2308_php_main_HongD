<?php
	// 1. 설정 정보
	define("ROOT",$_SERVER["DOCUMENT_ROOT"]."/mini_board/src/");
	define("FILE_HEADER",ROOT."header.php"); 
	require_once(ROOT."lib/lib_db.php"); 

	try {
		//2.db connect
		//2-1 connection 함수호출
		
		$conn = null; //pdo 객체변수
		if(!my_db_conn($conn)){
			//2-2 예외처리
			throw new Exception("DB Error : PDO instance");
		}
		//3. method 체크 -method 획득 
		$http_method = $_SERVER["REQUEST_METHOD"];

		//3-1 get일 경우 
		if($http_method === "GET"){
			//3-1-1 파라미터  id, page 획득
			$id = isset($_GET["id"]) ? $_GET["id"] : "";
			$page = isset($_GET["page"]) ? $_GET["page"] : "";
			$arr_err_msg = [];
			//error 메세지
			if($id === ""){
				$arr_err_msg[] = "Parameter Error : ID";
			}
			if($page === ""){
				$arr_err_msg[] = "Parameter Error : Page";
			}
			if(count($arr_err_msg)>= 1){
				throw new Exception(implode("<br>",$arr_err_msg));
			}

			//에러가 id, page 둘 다 일 경우 메세지 두개 출력
			//3-1-2 게시글 정보 획득
			$arr_param=[
				"id" => $id
			];
			$result = db_select_boards_id($conn, $arr_param);
			
			//3-1-3 예외처리
			if($result === false){
				throw new Exception("DB Error : Select id");
			}
			else if(!(count($result) === 1)){
				throw new Exception("DB Error : Select id count");
			}
			$item = $result[0];

		} else { //3-2post일 경우
			$id = isset($_POST["id"]) ? $_POST["id"] : "";
			$arr_err_msg = [];
			//error 메세지
			if($id === ""){
				$arr_err_msg[] = "Parameter Error : ID";
			}
			if(count($arr_err_msg)>= 1){
				throw new Exception(implode("<br>",$arr_err_msg));
			}
			//트랜젝션 시작
			$conn->begintransaction();

			//게시글 정보 삭제
			$arr_param = [
				"id" =>$id
			];
			//3-2-3 예외처리
			

			if(!db_delete_boards_id($conn, $arr_param)) {
				throw new Exception("DB Error : Delete Boards id");
			}
			$conn->commit();
			header("Location: list.php");
			exit;
		}
	
	} catch(Exception $e) {
		if($http_method === "POST") {
			$conn->rollBack();
		}
		echo $e->getMessage();
		exit;
	} finally {
		
	}

?>

<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="/mini_board/src/css/common.css">
	<title>삭제페이지</title>
</head>
<body>
	<?php
	require_once (FILE_HEADER);
	?>
	<main>
		<table>
			<caption> 
				삭제하면 영구적으로 복구할 수 없습니다.
				<br>
				정말로 삭제 하시겠습니까?
			</caption>
			<tr>
				<th> 게시글 번호 </th>
				<td> <?php echo $item["id"] ?> </td>
				
			</tr>
			<tr>
				<th> 작성일 </th>
				<td> <?php echo $item["create_at"] ?> </td>
				
			</tr>
			<tr>
				<th> 재목 </th>
				<td> <?php echo $item["title"] ?> </td>
				
			</tr>
			<tr>
				<th> 내용 </th>
				<td> <?php echo $item["content"] ?> </td>
				
			</tr>
		</table>
	</main>
	<section>
		<form action="/mini_board/src/delete.php" method="post">
			<input type="hidden" name="id" value="<?php echo $id; ?>">
		<button class="btn_set" type="submit">동의</button>
		<a href="/mini_board/src/detail.php/?id=<?php echo $id; ?>&page=<?php echo $page; ?>">취소</a>
		</form>
	</section>
</body>
</html>