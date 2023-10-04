<?php
require_once("./dbconnect.php");

//no값이 post방식으로 넘어옴 
// 값이 있으면 $no 생성
if(isset($_POST["no"])){
	$no = $_POST["no"];
}

// $no 값이 없으면 수정이 아니라 글쓰기
if(empty($no)){
	$id = $_POST["ID"]; 
	$date = date("Y-m-d H:i:s");
}


$pw = $_POST["password"];
$subject = $_POST["subject"];
$content = $_POST["content"];

//get , post 방식과 상관 없이 값을 전달 받을 수 있는 변수 : $_REQUEST[""]
//$content = $_REQUEST["content"];

//---------------- 글 수정------------------------------
if(isset($no)){
	//입력할 비밀번호와 db에 있는 비밀번호가 일치 하는지 체크
	$sql = "SELECT COUNT(b_pw) AS cnt FROM boards WHERE b_pw = '$pw' AND b_no = $no";
	$result = $db->query($sql);
	$row = $result->fetch_array();


	// 비밀번호가 일치하면 수정 쿼리 작성을 통해 수정함
	if($row["cnt"]){
		$sql = " UPDATE boards SET b_subject ='".$subject."', b_content ='".$content."' WHERE b_no = '".$no."'";
		$msgState = "수정";

	}else {
		// 불일치 하면 cnt값이 0이됨
		$msg ="비밀번호가 일치하지 않습니다";
		?>
		<script>
			alert("<?=$msg?>");
			history.back();
		</script>
<?php
		exit; //나머지 부분을 실행하게 되므로 종료 해줘야함

	}
	//---------------글등록---------------------------------------
}else {

	$sql = "INSERT INTO boards (b_no, b_subject, b_content, b_date, b_hit, b_id, b_pw) VALUES (null, '{$subject}', '{$content}', '{$date}', 0, '{$id}', '{$pw}')";

$msgState = "등록";

}
//메세지가 없을 경우(비밀번호가 일치하는 경우)
if(empty($msg)){
	$result = $db->query($sql);

	//정상 실행
	if($result){
		$msg = "정상적으로 글이".$msgState."되었습니다";
		if(empty($no)){
			$no = $db->insert_id;
		}
		$replaceURL = "./view.php?no=".$no;
	}else {
		$msg = "글".$msgState."실패";
?>
	<script>
		alert("<?=$msg?>");
		history.back();
	</script>	
<?php	
	exit;
	}
}

?>

<script>
	alert("<?php echo $msg?>");
	location.replace("<?php echo $replaceURL ?>");
</script>

