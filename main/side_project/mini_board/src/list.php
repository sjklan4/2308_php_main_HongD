<?php
	define("ROOT",$_SERVER["DOCUMENT_ROOT"]."/mini_board/src/");
	define("FILE_HEADER",ROOT."header.php");
	require_once(ROOT."/lib/lib_db.php"); //db관련 라이브러리

	$conn = null; 
	$list_cnt = 5; //한 페이지의 최대 표시 수
	$page_num = 1; // 페이지 번호 초기화

	try {
		// DB 접속 
		if(!my_db_conn($conn)) {
			//db instance 에러
			throw new Exception("DB Error : PDO Instance");
			// 강제 예외발생: DB instanace	
		}
		// 페이징처리
		// 총 개시글 수 검색 
		$boards_cnt = db_select_boards_cnt($conn);
		if($boards_cnt === false){
			throw new Exception("DB Error :SELECT count");
		} // 강제 예외발생 : select count

		
		$max_page_num = ceil($boards_cnt / $list_cnt); //최대 페이지 수

			// get method 확인
		if(isset($_GET["page"])){
			$page_num = $_GET["page"]; //유저 접속시 기본 페이지 셋팅
		}
		$offset = ($page_num -1) * $list_cnt; //1페이지마다 보이는 페이지 계산

		// 이전 버튼
		$prev_page_num = $page_num - 1;
		if($prev_page_num === 0){
			$prev_page_num = 1;
		}
		// 다음 버튼
		$next_page_num = $page_num + 1;
		if($next_page_num === $max_page_num) {
			$next_page_num = $max_page_num;
		} 

		// db조회 사용 데이터 배열
		$arr_param = [
			"list_cnt" => $list_cnt
			,"offset" => $offset
		];

		// 게시글 리스트 조회 
		$result = db_select_boards_paging($conn, $arr_param);

		if(!$result) {
			throw new Exception("DB Error :SELECT boards");
		} //강제 예외발생 : select boards

	} catch (Exception $e) {
		echo $e->getMessage(); //예외발생 메세지 출력
		exit; //종료
	} finally {
		db_destroy_conn($conn); //db 파기
	} 
	
?>

<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="/mini_board/src/css/common.css">
	<title>리스트 페이지</title>
</head>
<body>
	<?php
		require_once(FILE_HEADER);
	?>
	<br>
	<main>

	<table>
		<colgroup>
			<col width="25%">
			<col width="50%">
			<col width="25%">
		</colgroup>
	
		<tr class="table-title">
			<th>번호</th>
			<th>제목</th>
			<th>작성일자</th>
		</tr>
	
		<?php
		// 리스트 생성
		foreach($result as $item){	
		?>
			<tr>
			
				<td><?php echo $item["id"]; ?></td>
				<td>
					<a href="/mini_board/src/detail.php/?id=<?php echo $item["id"];?>&page=<?php echo $page_num;?>">
						<?php echo $item["title"]; ?>
					</a>
				</td>
				<td><?php echo $item["create_at"]; ?></td>
			</tr>
		<?php } ?>
		<div class = "btn_wrap">
			<a href="/mini_board/src/insert.php" clsss = write_btn>글쓰기</a>
			
			<!-- <a href="/mini_board/src/insert.php">수정</a> -->
			<!-- <a href="/mini_board/src/insert.php">삭제</a> -->
		</div>
	</table>
		
	<section>
		<a href="/mini_board/src/list.php/?page=<?php echo $prev_page_num ?>">◀</a>
		<?php
			for($i = 1; $i <= $max_page_num; $i++){
		?>	
		<a href="/mini_board/src/list.php/?page=<?php echo $i; ?>"><?php echo $i; ?></a>
		<?php
			}
		?>
		<a href="/mini_board/src/list.php/?page=<?php echo $next_page_num ?>">▶</a>
	</section>
	
	</main>
</body>
</html>