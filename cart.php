<?php
    session_start();

    if(!isset($_SESSION['user_id'])){
        echo "<script>alert('먼저 로그인을 해주십시오'); history.back();</script>";
        exit;
    }

    $conn = mysqli_connect('localhost', 'root', '1234');
    $db = mysqli_select_db($conn, 'shoppingmall');
    if($db){
      mysqli_query($conn, "set session character_set_connection=utf8;");
      mysqli_query($conn, "set session character_set_results=utf8;");
      mysqli_query($conn, "set session character_set_client=utf8;");
    }else {
      echo "디비에러";
    }

    $goods_id = $_GET['goods_id'];
    $query = "select *from goods_tab where goods_id = '$goods_id' ";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);
    if(isset($_GET['action'])){
            if($_GET['action']=='add'){
                if(isset($_SESSION['cart'])){
                $item_array_id = array_column($_SESSION['cart'], 'goods_id');

                if(!in_array($goods_id, $item_array_id)){
                    $count = count($_SESSION['cart']);

                    $item_array = array(
                        'goods_id' => $goods_id,
                        'goods_name' => $row["goods_name"],
                        'goods_price' => $row["goods_price"],
                        'goods_quantity' => $_GET['quantity'],
                        'goods_image' => $row["goods_image"]
                        );

                        $_SESSION['cart'][$count] = $item_array;
                        echo '<script>alert("장바구니에 상품을 담았습니다.")</script>';
                }else{
                    foreach($_SESSION["cart"] as $keys => $values){
                        if($values["goods_id"] == $goods_id){
                            $_SESSION["cart"][$keys]['goods_quantity'] += 1; 
                            echo '<script>alert("장바구니에 상품을 담았습니다.")</script>';
                        }
                    }
                }
            }else{
                $item_array = array(
                'goods_id' => $goods_id,
                'goods_name' => $row["goods_name"],
                'goods_price' => $row["goods_price"],
                'goods_quantity' => $_GET["quantity"],
                'goods_image' => $row["goods_image"]
                );
                $_SESSION['cart'][0] = $item_array;
                echo '<script>alert("장바구니에 상품을 담았습니다.")</script>';
            }
        }else if($_GET['action']=='delete'){
            foreach($_SESSION["cart"] as $keys => $values){ 
                if($values["goods_id"] == $goods_id)
                {
                    unset($_SESSION["cart"][$keys]);
                    echo '<script>alert("삭제 되었습니다")</script>';
                }
            }

        }else if($_GET['action']=='clear'){
            unset($_SESSION['cart']);
            echo '<script>alert("장바구니를 비웠습니다.")</script>';
        }
    }
    echo "<script>history.back();</script>"

?>