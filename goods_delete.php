<?php
    session_start();
    $goods_id = $_GET['goods_id'];
    #관리자만이 사용
    if($_SESSION['user_id'] == "admin"){
        $conn = mysqli_connect('localhost', 'root', '1234');
        $db = mysqli_select_db($conn, 'shoppingmall');
        if($db){
         mysqli_query($conn, "set session character_set_connection=utf8;");
         mysqli_query($conn, "set session character_set_results=utf8;");
         mysqli_query($conn, "set session character_set_client=utf8;");
        }else {
         echo "디비에러";
        }
        $query = "select *from goods_tab where goods_id = '$goods_id' ";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);
        if(file_exists("./storage/".$row['goods_image'])){
            if(!unlink("./storage/".$row['goods_image'])){
                echo "사진 삭제 실패";
            }
        }
        $query = "delete from goods_tab where goods_id='$goods_id'";
        $result = mysqli_query($conn, $query);
        if(!$result) {
            echo("
            <script>
                alert('상품삭제에 실패했습니다.');
                history.back();
            </script>
            ");
        }else{
            echo("
            <script>
                alert('상품을 삭제했습니다.');
                history.back();
            </script>
            ");
        }
    }
?>