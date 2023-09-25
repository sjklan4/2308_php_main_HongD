<?php
    require_once("dbconnfig.php");
    session_start();
    // 카테고리 테이블로부터 카테고리 가져오기
    $sql = 'select cat_id, cat_name from categories';
    $db = db_conn();
    $result = $db->query($sql);
    
    if($result){
        $cat_array=array(); 
    
        for($count =0; $row = $result->fetch_array(); $count++){
            $cat_array[$count] = $row;
        }
    }
    
    require_once('header.php');
    
?>
        
    <h3 >쇼핑몰에 오신것을 환영합니다!!!</h3>
        
    <p>원하는 카테고리를 선택하세요 :</p>

        <?php
            if(!is_array($cat_array)){
                echo "<p>카테고리가 존재하지 않습니다!!!</p>";
            }
            echo "<ul>";
            foreach($cat_array as $row){
                $url= "show_categories.php?cat_id=".$row['cat_id'];
                $cat_name = $row['cat_name'];
                echo "<li>";
                ?>
                <a href = "<?php echo $url?>"><?php echo $cat_name; ?></a>
                <?php
                echo "</li>";
            }
            echo "</ul>";
            echo "<hr />";
             // footer    
             require_once('./footer.php');
            
            // if(isset($_SESSION['admin_id'])){
            //     echo "<div align='center'>"
            //     . "<a href='admin.php'>관리자 페이지로</a>"
            //     . "</div>";
            // }
            
           
            ?>


        