<?php
require_once("./dbconnfig.php");

session_start();
$cat_id = $_GET['cat_id'];

$sql = " SELECT cat_name FROM categories WHERE cat_id"."="."$cat_id";
$result = $db->query($sql);
if($result){
	$num_cats = $result->num_rows;
	if($num_cats == 0){
		echo "카테고리가 존재하지 않네요";
	}
	$row = $result->fetch_object(); //객체로 가져옴
	
	$cat_name = $row->cat_name;

	require_once("./header.php");

	echo "<h3>".$cat_name."</h3>";


	$sql =" SELECT * FROM books WHERE 'cat_id ='".$cat_id."'";
	$result = $db->query($sql);
	if($result){
		$num_books = $result->num_rows;
        if($num_books == 0){
			echo "카테고리에 해당하는 상품이 존재하지 않습니다.";
		}
		$books_array=array(); 
    
        for($count =0; $row = $result->fetch_array(); $count++){
            $books_array[$count] = $row;
        }

		if(!is_array($books_array)){
			echo "<p>카테고리에 해당하는 책이 존재하지 않습니다.</p>";
		}else {
			echo "<table width='100%' border='0'>";
			
			foreach($books_array as $row){
				$url='show_book.php?isbn='.$row['isbn'];
				echo "<tr><td>";
				if(file_exists("img/".$row['isbn'].".jpg'")){
					$book_img= "<img src='img/".$row['isbn'].".jpg' style='border: 1px solid black'
					width=100px height=120px />";
					?>
					<a href="<?php echo $url; ?>"><?php echo $book_img; ?></a>
				<?php	
				}else {
					echo "&nbsp;";
				}
				echo "</td></tr>";
				$title = $row['title'].",저자 : ".$row['author'];
				?>
				<a href="<?php echo $url; ?>"><?php echo $title; ?></a>
				<?php
				echo "</td></tr>";
			} //echo of foreach
			echo "</table>";
		}
		echo "<hr />";
   	 }
}
	echo "<div align='center'><a href='index.php'><img src='img/continue_shopping.jpg' 
	border='0'></a></div>";
	// footer    
	require_once('./footer.php');
	
  ?>