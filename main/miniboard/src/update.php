<?php
define("ROOT", $_SERVER["DOCUMENT_ROOT"] . "/miniboard/src/");
define("ERROR_MSG_PARAM", "파라미터 오류: %s");
require_once(ROOT . "db.php");

$conn = null;
$http_method = $_SERVER["REQUEST_METHOD"];
$arr_err_msg = [];

try {
    if (!my_db_conn($conn)) {
        throw new Exception("DB 오류: PDO 인스턴스");
    }

    $id = isset($_REQUEST["id"]) ? $_REQUEST["id"] : "";
    $page = isset($_REQUEST["page"]) ? $_REQUEST["page"] : "";
    $bid = isset($_REQUEST["b_id"]) ? $_REQUEST["b_id"] : "";

    if ($id === "") {
        $arr_err_msg[] = sprintf(ERROR_MSG_PARAM, "id");
    }
    if ($page === "") {
        $arr_err_msg[] = sprintf(ERROR_MSG_PARAM, "page");
    }
    if ($bid === "") {
        $arr_err_msg[] = sprintf(ERROR_MSG_PARAM, "b_id");
    }

    if (count($arr_err_msg) >= 1) {
        throw new Exception(implode("<br>", $arr_err_msg));
    }

    $arr_param = [
        "id" => $id,
        "b_title" => $_POST["b_title"],
        "b_content" => $_POST["b_content"],
        "b_id" => $_POST["b_id"]
    ];

    $conn->beginTransaction();

    if (!db_update_boards_id($conn, $arr_param)) {
        throw new Exception("DB 오류: Update_boards_id");
    }

    $conn->commit();

    header("Location: update.php?id={$id}&page={$page}");
    exit;

} catch (Exception $e) {
    if ($conn) {
        $conn->rollBack(); // 에러 발생 시 롤백
    }
    echo $e->getMessage();
    exit;
} finally {
    db_destroy_conn($conn);
}
?>

?>
<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="style.css">
	<title>수정페이지</title>
</head>
<body>
	<main>
	<form action="update.php" method="post">
			<table>
			<input type="hidden" name="id" value="<?php echo $id;?>">
			<input type="hidden" name="page" value="<?php echo $page;?>">
			
				<tr>
					<th>번호</th>
					<td><?php echo $item["id"]?></td>
				</tr>
				<tr>
					<th>작성자</th>
					<td><?php echo $item["b_id"]?></td>
				</tr>
				<tr>
					<th>제목</th>
					<td>
					
						<input type="text" name="b_title"value="<?php echo $item["b_title"];?>">
					</td>
				</tr>
				<tr>
					<th>내용</th>
					<td><textarea name="b_content" id="b_content" cols="30" rows="10"><?php echo $item["b_content"];?></textarea></td>
				</tr>
			</table>
			<section>
				<button>완료</button>
				<a href="detail.php?id=<?php echo $item["id"];?>&page=<?php echo $page;?>">수정취소</a>
				
			</section>
		</form>
	</main>
</body>
</html>