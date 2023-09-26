<?php
define("ROOT",$_SERVER["DOCUMENT_ROOT"]."/mini_board2/src/");
define("FILE_HEADER",ROOT."header2.php");
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
			<tr>
				<td>1</td>
				<td>1111111111</td>
				<td>2023-09-25</td>
			</tr>
			<tr>
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
			</tr>
		</table>
		<button type="button"  id="form_btn" >Write</button>
	</form>
</body>
</html>