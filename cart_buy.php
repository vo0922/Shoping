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

        foreach($_SESSION["cart"] as $keys => $values) {
            $goods_id = $values['goods_id']; $buy_price = $values['goods_price']*$values['goods_quantity']; $buy_num = $values['goods_quantity']; $goods_name = $values['goods_name']; 
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