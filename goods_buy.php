<?php
    session_start();

    if(isset($_SESSION['shop_logon'])) {
        $conn = mysqli_connect('localhost', 'root', '1234');
        $db = mysqli_select_db($conn, 'shoppingmall');
        if(!$db){
            echo "DB 에러";
            exit;
        }

        $mem_date = date("Y-m-d", time());
        $mem_id = $_SESSION['user_id'];
        $buy_state = '구매요청';
        $goods_id = $_GET['goods_id'];

        $query = "select *from goods_tab where goods_id = '$goods_id' ";
        $result = mysqli_query($conn, $query);
        $rows = mysqli_fetch_array($result);

        if($result){
            $buy_price = $rows['goods_price']; $buy_num = 1; $goods_name = $rows['goods_name'];
            $query = "insert into buy_tab (goods_id, mem_id, buy_price, buy_state, buy_date, buy_num, goods_name)
             values ('$goods_id', '$mem_id', '$buy_price', '$buy_state', '$mem_date', '$buy_num', '$goods_name');";
            $result = mysqli_query($conn, $query);
            if(!$result) {
                echo "<script> 
                    alert('쿼리가 잘못되었습니다.');
                    history.back();
                </script>";
                exit;
            }
        }
        echo "<script>
            alert('구매를 완료했습니다.')
            history.back();
            </script>";
        unset($_SESSION['cart']);
    }else {
        echo "<script>
            alert('먼저 로그인을 해 주십시오.')
            history.back();
            </script>";
    }
?>