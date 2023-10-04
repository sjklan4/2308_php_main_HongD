<?php
require_once("./dbconnect.php");

//페이징처리
if(isset($_GET["page"])){
	$page = $_GET["page"];
} else {
	$page = 1; //페이지의 시작부분
} 
$sql = " SELECT COUNT(*) AS cnt FROM boards "; //전체 게시글 수 
$result = $db->query($sql);
$row = $result->fetch_Array();

$allArticle = $row["cnt"]; //전체 게시글 수 

$displayArticle = 3;  //한 페이지당 보여지는 게시글 수 

$allPage = ceil($allArticle/$displayArticle); //전체 페이지 수 구하기

	//올림 내림 반올림 함수 
	// ceil , floor , round

	//페이지가 1보다 작거나 페이지가 전체 페이지보다 클 경우
if($page < 1 || ($allPage && $page > $allPage)){
?>
<script>
	alrert("존재하지 않는 페이지 입니다");
	history.back();
</script>
<?php
	exit;
	} 

$block = 3; //보여지는 페이지 수 ex.(1,2,3)(4,5,6)

$currentBlock = ceil($page/$block); // 페이지/블럭 = 현재 페이지가 있는 블럭
$allBlock = ceil($allPage/$block); //전체 블럭 수 
//ex . 총5개 페이지 에서 한 페이지에 3개만 보여지는 것을 나눔 = 2블럭

$firstPage = ($currentBlock*$block)-($block-1);// 현재의 블럭에서 첫 페이지 

if ($currentBlock == $allBlock){
	$lastPage = $allPage; //현재 블럭이 마지막 블럭이면 $allPage가 마지막 페이지
} else {
	$lastPage = $currentBlock * $block; // 마지막 페이지
}

$prevPage = (($currentBlock-1) * $block); //이전 페이지
$nextPage = (($currentBlock+1) * $block)-($block-1); //다음 페이지
// ex/ 2 + 1) *3 - (3-1) = 9-2 = 7페이지로 이동

$paging = "<ul>";
//첫 페이지가 아닌 경우 처음 버튼을 생성
if($page != 1){
	$paging.="<li class = 'startPage'><a href='./index.php?page=1'>처음</a></li>";
}


//첫 페이지가 아닌 경우에는 이전 버튼 생성
if($currentBlock != 1){
	$paging.="<li class='prevPage'><a href='./index.php?page={$prevPage}'>이전</a></li>";
}

for($i=$firstPage; $i<=$lastPage; $i++){
	if($i==$page){
		$paging .= "<li class='currentPage'>{$i}</li>";
	} else {
		$paging .= "<li class='prevPage'><a href='./index.php?page={$i}'>{$i}</a></li>";
	}
}

// 마지막 블럭이 아닌 경우에는 다음 버튼 생성

if($currentBlock != $allPage){
	$paging .= "<li class='nextPage'><a href='./index.php?page={$nextPage}'>다음</a></li>";
}

// 마지막 페이지가 아니라면 끝 버튼 생성
if($page != $allPage){
	$paging.="<li class = 'endPage'><a href='./index.php?page={$allPage}'> 끝 </a></li>";
}
$paging.="</ul>";

$currentLimit = ($displayArticle * $page) - $displayArticle; // 3개의 게시글 가져오는 첫번째 위치 설정 
// 첫번째 레코드는 0,1,2,3 순서 ex. 0,3 = 1,2,3 -3개 /3,3 =4,5,6-3개
$sqlLimit = " LIMIT " . $currentLimit . ", " . $displayArticle;

$sql = " SELECT * FROM boards ORDER BY b_no DESC " . $sqlLimit; //3개의 게시글 가져옴
$result = $db->query($sql);

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
		<div id="list">
			<h3> 반응형 게시판 </h3>
			<table>
				<caption class=""></caption>
				<thead>
					<tr>
						<th scope="col" class="no">번호</th>
						<th scope="col" class="subject">제목</th>
						<th scope="col" class="author">작성자</th>
						<th scope="col" class="date">작성일</th>
						<th scope="col" class="hit">조회</th>
					</tr>
				</thead>
				<tbody>

				<?php
					
					while($row = $result->fetch_array()){
						$datetime = explode(" ",$row["b_date"]);
						$date = $datetime[0]; // 년월일
						$time = $datetime[1]; //시분초

						if($date == Date("Y-m-d"))
							$row["b_date"] = $time;
						else 
							$row["b_date"] = $date;
						
					
				?>
					<!-- db 접속해서 가져올 내용-->
					<tr>
						<td class="no"><?= $row["b_no"]?></td>
						<td class="subject">
							<a href="./view.php?no=<?=$row["b_no"]?>"><?= $row["b_subject"]?></a>
						</td>
						<td class="author"><?= $row["b_id"]?></td>
						<td class="date"><?= $row["b_date"]?></td>
						<td class="hit"><?= $row["b_hit"]?></td>
					</tr>
					<?php
						}
					?>

				</tbody>
				</table>
			
				<div class="btnSet">
					<a href="./write.php" class="btnWrite">글쓰기</a>
				</div>

				<div class="paging">
					<?=$paging?>
				</div>
				<!-- 검색기능 -->
				<!-- <div class="search">
					<form action="./index.php" method="get">
						<select name="" id="">
							<option value="">제목</option>
							<option value="">내용</option>
							<option value="">아이디</option>
						</select>
						<input type="text" name="searchWord" value="">
						<button></button>
					</form>
				</div> -->

			</div>
	</article>
 </body>
</html>