<?php
define("ROOT",$_SERVER["DOCUMENT_ROOT"]."/mini_board2/src/");
define("FILE_HEADER",ROOT."header2.php");
require_once(ROOT."db.php"); 

$conn = null;
$list_cnt = 5;
$page_num = 1;

try {
	// db 접속
 if(!(my_db_conn($conn))){
	throw new Exception("DB Error : PDO Instance");
 }
 //총 페이지 카운트
$boards_cnt = db_select_boards_cnt($conn);
if($boards_cnt === false){
	throw new Exception("DB Error : SELECT count");
}
//총 페이지 나누기 / 5 = 최대 페이지
$max_page_num = ceil($boards_cnt / $list_cnt);

if(isset($_GET["page"])){
	$page_num = $_GET["page"]; //기본페이지
}
$offset = ($page_num-1) * $list_cnt; //1페이지마다 보이는 페이지
$prev_page_num = $page_num -1;
// 이전버튼 0이면 1
if($prev_page_num === 0){
	$prev_page_num = 1;
}
//다음버튼 
//다음버튼을 누르면 +1 되고 최대페이지까지만.
$next_page_num = $page_num +1;
if($next_page_num === $max_page_num) {
	$next_page_num = $max_page_num;
}
//변수에 값지정
$arr_param = [
"list_cnt" => $list_cnt
,"offset" => $offset
];

$result = db_select_boards_paging($conn, $arr_param);
// 페이지에 보이는 리스트
if(!$result){
	throw new Exception("DB Error : SELECT boards");
}

} catch(Exception $e){
	echo $e->getMessage();
	exit;
} finally{
	db_destroy_conn($conn);
}


?>


<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="./css/boards.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Single+Day&display=swap" rel="stylesheet">
	
	<title>리스트페이지</title>
</head>
<body>
	<?
		require_once(FILE_HEADER);
	?>
			
		<table>
			<colgroup>
			<col width="10%">
			<col width="20%">
			<col width="10%">
			</colgroup>
			<thead>
				<th>No</th>
				<th>Title</th>
				<th>Date</th>
			</thead>
			<?php
			foreach($result as $item){
			?>
			<tr>
				<td><?php echo $item["id"]?></td>
				<td>
					<a href="/mini_board/src/detail.php/?id=<?php echo $item["id"];?>&page=<?php echo $page_num;?>">
						<?php echo $item["title"]; ?>
					</a>
				<td><?php echo $item["create_at"]?></td>
			</tr>

			<?php  } ?>
			
		</table>
		<button type="button"  id="form_btn" ><a href="/mini_board/src/insert2.php">Write</a></button>
	</form>
	<section>
		<a href="/mini_board2/src/list.php/?page=<?php echo $prev_page_num ?>">이전</a>
		<?php
			for($i = 1; $i <= $max_page_num; $i++) {
		?>
		<a href="/mini_board2/src/list.php/?page=<?php echo $i; ?>"><?php echo $i; ?></a>
		<?php
		}
		?>
		<a href="/mini_board2/src/list.php/?page=<?php echo $next_page_num ?>">다음</a>
	</section>
</body>
</html>