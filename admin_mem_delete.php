<?php 
        session_start();

        if($_SESSION['user_id']=='admin'){
            $conn = mysqli_connect('localhost', 'root', '1234');
            $db = mysqli_select_db($conn, 'shoppingmall');
            if(!$db){
                echo "DB 에러";
                exit;
            }
            $mem_id = $_GET['mem_id'];
            $query = "delete from member_tab where mem_id='$mem_id';";
            $result = mysqli_query($conn, $query);
            if(!$result){
                echo "<script>
                    alert('삭제할수 없습니다.');
                    history.back();
                </script>";
            } else {
                echo "<script>
                    alert('삭제했습니다.');
                    history.back();
                    </script>";
            }
        }
?>