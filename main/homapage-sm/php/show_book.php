<?php
require_once("./dbconnfig.php");
require_once("./header.php");

$isbn = $_GET['isbn'];
if((!$isbn) || ($isbn == '')){
?>
	<script>
		alert("정상적인 경로를 이용하세요");
		history.back();
	</script>
<?php
	exit;
	}
	//
	$sql = "select * from books where isbn = '".$isbn."'";
	$result= $db->query($sql);
	

	if($result){
		$row = $result->fetch_array();
		
	}
	// 책 제목 출력
	echo "<h3>".$row['title']."</h3>";

	//책의 상세 정보 

require_once("./footer.php");




?>