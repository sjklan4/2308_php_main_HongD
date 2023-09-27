<?php
define("ROOT",$_SERVER["DOCUMENT_ROOT"]."/mini_board2/src/");
define("FILE_HEADER",ROOT."header2.php");
require_once(ROOT."db.php"); 



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
				<td><?php echo $item["title"]?></td>
				<td><?php echo $item["create_at"]?></td>
			</tr>

			<?php  } ?>
			<!-- <tr>
				<td>2</td>
				<td>22222222222</td>
				<td>2023-09-25</td>
			</tr>
			<tr>
				<td>3</td>
				<td>3333333333</td>
				<td>2023-09-25</td>
			</tr>
			<tr>
				<td>4</td>
				<td>4444444444</td>
				<td>2023-09-25</td>
			</tr>
			<tr>
				<td>5</td>
				<td>5555555555</td>
				<td>2023-09-25</td>
			</tr>
			<tr>
				<td>6</td>
				<td>6666666666</td>
				<td>2023-09-25</td>
			</tr> -->

		</table>
		<button type="button"  id="form_btn" ><a href="/mini_board/src/insert2.php">Write</a></button>
	</form>
	<section>
		<a href="/mini_board2/src/list.php/?page=">이전</a>
		<a href="/mini_board2/src/list.php/?page="></a>
		<a href="/mini_board2/src/list.php/?page=">다음</a>
	</section>
</body>
</html>