-- --------------------------------------------------------
-- 호스트:                          127.0.0.1
-- 서버 버전:                        8.0.34 - MySQL Community Server - GPL
-- 서버 OS:                        Win64
-- HeidiSQL 버전:                  12.3.0.6589
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- boards 데이터베이스 구조 내보내기
CREATE DATABASE IF NOT EXISTS `boards` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `boards`;

-- 테이블 boards.boards 구조 내보내기
CREATE TABLE IF NOT EXISTS `boards` (
  `b_no` int unsigned NOT NULL AUTO_INCREMENT,
  `b_subject` varchar(100) NOT NULL,
  `b_content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `b_date` datetime NOT NULL,
  `b_hit` int unsigned NOT NULL DEFAULT '0',
  `b_id` varchar(20) NOT NULL,
  `b_pw` varchar(50) NOT NULL,
  PRIMARY KEY (`b_no`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- 테이블 데이터 boards.boards:~22 rows (대략적) 내보내기
INSERT INTO `boards` (`b_no`, `b_subject`, `b_content`, `b_date`, `b_hit`, `b_id`, `b_pw`) VALUES
	(1, '테스트1', '테스트1테스트1테스트1테스트1', '2023-10-01 22:37:40', 1, '테', '1234'),
	(2, '테스트2', '수정합니다', '2023-10-01 22:37:50', 1, '스', '1234'),
	(3, '테스트3', '테스트3테스트3테스트3테스트3', '2023-10-01 22:39:06', 1, '트', '1234'),
	(4, '테스트4', '테스트4테스트4테스트4테스트4', '2023-10-01 23:04:38', 1, 't', '1234'),
	(5, '테스트5', '테스트5테스트5테스트5ㅍ', '2023-10-01 23:08:17', 1, 'e', '1234'),
	(6, '테스트6', '테스트6테스트6테스트6테스트6', '2023-10-01 23:10:10', 1, 's', '1234'),
	(7, '테스트7', '테스트7테스트7테스트7테스트7', '2023-10-01 23:13:09', 1, 't', '1234'),
	(8, '테스트8', '테스트8테스트8테스트8', '2023-10-01 23:55:19', 1, '테스트', '1234'),
	(9, '테스트9', '테스트9', '2023-10-02 00:33:43', 1, '테스트', '1234'),
	(10, '테스트0000', '테스트', '2023-10-02 13:20:28', 1, '테스트', '1234'),
	(11, '글 작성 테스트 ', '작성 완료 - ok', '2023-10-02 13:47:00', 1, 'test', '1234'),
	(12, '글 수정 테스트 입니다.', '비밀번호는 1234 / 글 작성 테스트 완료 \r\n글 수정 완료 ', '2023-10-02 13:47:56', 1, 'write test', '1234'),
	(13, '등록 확인', '테스트 내용 \r\n수정 완료 \r\n수정하기 눌러서 수정하기로 오면 수정하기로 버튼 변경 됨 - 확인', '2023-10-02 13:49:12', 1, 'wtest', '1234'),
	(14, 'hit test', '한 사람이 여러 번 조회 해도 한 번만 적용하는지 확인', '2023-10-02 19:13:00', 1, 'hit test', '1234'),
	(15, '조회수 설정 오류와 해결 방안 <오류해결완료>', '결과 : 조회수 표시 / 완료\r\n문제점 : 클릭할 때마다 조회수가 늘어남 \r\n문제점 설명 : 동일한 유저일 경우 늘어나지 않아야함\r\n해결방안 : 쿠키생성 부분에 오류가 있어 쿠키 생성이 실행오류가 있어서\r\n로드 될 때마다 증가했던 것으로 확인됨 오류 수정 후 해결됨\r\n\r\n조회 수는 작성 하는 순간 1로 설정됨', '2023-10-02 19:14:06', 2, 'test', '1234'),
	(16, '글 작성 테스트 입니다', '내용내용', '2023-10-02 19:20:16', 2, 'dddd', '1234'),
	(17, '---------현재까지 구현 되는 기능 리스트Ver_1------', '1. index.php \r\n- 작성된 글 리스트 \r\n- 글쓰기 누르면 write.php 페이지로 이동\r\n2. write.php \r\n- 글 작성 폼 생성됨\r\n- write.php에서는 작성 후 등록하기 버튼 생성\r\n- 작성완료 후 등록하기 누르면 작성 완료 되었다는 스트립트 뜨고\r\n작성된 페이지 표시 됨 (ex.view.php?no=25)\r\n- 수정 삭제 목록으로 버튼\r\n3. 수정 화면 \r\n- 밑에 버튼은 수정하기로 변경됨\r\n- 비밀번호 = 일치 해야지 수정완료되고 일치 하지 않으면\r\n스트립트 뜸\r\n', '2023-10-02 19:22:37', 2, 'result', '1234'),
	(18, '페이징 처리를 위한 게시글 ', '페이징 처리를 위한 게시글 ', '2023-10-02 20:28:57', 1, 'zz', '1234'),
	(19, '페이징 처리를 위한 게시글 ', '페이징 처리를 위한 게시글 ', '2023-10-02 20:29:10', 1, '1', '1234'),
	(20, '페이징 처리 확인 / 완료 ⭕ ⭕ ⭕', '페이징 구현 \r\n1. 디폴트 화면에서는 처음 버튼이 생성x \r\n2. 2부터 처음 생성 - ok\r\n3. 다음 버튼을 누르면 이전버튼 생성 - ok\r\n4.처음 누르면 첫 페이지로 이동 -ok\r\n5. 끝 누르면 마지막 페이지로 이동  -ok', '2023-10-02 22:31:03', 1, 'pagingtest', '12345'),
	(21, '글 작성 오류 / 미해결  ❌❌❌', '글 작성시 큰 따옴표 작은 따옴표 사용하면 오류 발생함 / 미해결\r\n<<<<< 원인 >>>>>>\r\n작성 sql문이 stmt를 사용하지 않고 직접쿼리 방식으로 작성되어 \r\n변수 값을 그대로 쿼리에 넣어주기 때문에 오류가 발생한 것으로 예상됨\r\n<<<<<< <처리 방안 >>>>>>\r\n전체적으로 쿼리 재작성 후 prepare stmt 혹은 라이브러리 파라미터 기능으로 수정 할 예정임', '2023-10-02 22:33:26', 1, 'Error', '1234'),
	(23, '	---------현재까지 구현 되는 기능 리스트Ver_2------ ', '1. 리스트 \r\n2. 글쓰기\r\n3. 수정\r\n4. 삭제\r\n5. 페이징\r\n6. 검색 ((((예정)))\r\n7. 댓글((((예정)))', '2023-10-02 22:54:19', 1, 'boards-result', '1234');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
