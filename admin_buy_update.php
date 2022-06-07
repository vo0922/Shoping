<?php 
    session_start();

    if($_SESSION['user_id']=='admin'){
        $conn = mysqli_connect('localhost', 'root', '1234');
        $db = mysqli_select_db($conn, 'shoppingmall');
        if(!$db){
            echo "DB 에러";
            exit;
        }
        $buy_id = $_POST['buy_id'];
        $buy_state = $_POST['buy_state'];
        $query = "update buy_tab set buy_state='$buy_state' where buy_id='$buy_id';";
        $result = mysqli_query($conn, $query);
        if(!$result){
            echo "<script>
                alert('수정할수 없습니다.');
                history.back();
            </script>";
        } else {
            echo "<script>
                alert('수정했습니다.');
                history.back();
                </script>";
        }
    }
?>