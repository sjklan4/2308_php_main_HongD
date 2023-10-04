<?php
require_once("dbconnect.php");

if(isset($_POST["no"])){
	$no = $_POST["no"];

}
$pw = $_POST["pw"];

if(isset($no)){
	$sql = "SELECT COUNT(b_pw) AS cnt FROM boards WHERE b_pw = '$pw' AND b_no = $no";
	$result = $db->query($sql);
	$row =  $result->fetch_array();

	if($row["cnt"]){
		$sql = " DELETE FROM boards WHERE b_no =".$no;
	} else {
		$msg = "비밀번호가 일치하지 않습니다";
?>		
	<script>
		alert("<?=$msg?>");
		history.back();
	</script>
		<?php
		exit;
		}
	}

	$result = $db->query($sql);

	//정상 실행되면 
	if($result){
		$msg = "삭제 성공";
		$replaceURL="index.php"; //삭제 후 목록으로 이동
	} else {
		$msg = "삭제 오류 발생";
		?>
		<script>
			alert("<?=$msg?>");
			history.back();
		</script>
	<?php
	exit;
	}
	?>
		<script>
			alert("<?=$msg?>"); //삭제성공 메세지 
			location.replace("<?=$replaceURL?>"); 
		</script>