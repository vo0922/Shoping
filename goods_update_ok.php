<?php 
    session_start();

    $goods_id = $_POST['goods_id'];
    #관리자만이 사용
    if($_SESSION['user_id'] == "admin"){
    $goods_code = $_POST['goods_code'];
    $goods_name = $_POST['goods_name'];
    $goods_country = $_POST['goods_country'];
    $goods_price = $_POST['goods_price'];
    $goods_explain = $_POST['goods_explain'];
    $img = $_FILES['goods_image']['name'];

    $conn = mysqli_connect('localhost', 'root', '1234');
    $db = mysqli_select_db($conn, 'shoppingmall');

    if($db){
        mysqli_query($conn, "set session character_set_connection=utf8;");
        mysqli_query($conn, "set session character_set_results=utf8;");
        mysqli_query($conn, "set session character_set_client=utf8;");
      }else {
        echo "디비에러";
      }

      if(trim($img != "")){
        $uploaddir = './storage/'; 
        $uploadfile = $uploaddir.basename($_FILES['goods_image']['name']); 
        $query = "select *from goods_tab where goods_id = '$goods_id' ";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);
        if($row['goods_image']!=''){
            if(file_exists("./storage/".$row['goods_image'])){
                if(!unlink("./storage/".$row['goods_image'])){
                echo "사진 삭제 실패";
                }
            }
        }
        if($img){
            if(file_exists("./storage/".$img)){
                echo("이미 존재하는 파일입니다.");
            }else if(($_FILES['goods_image']['error'] > 0) || ($_FILES['goods_image']['size'] <= 0)){ 
                echo "파일 업로드에 실패하였습니다."; 
             } else { 
                // HTTP post로 전송된 것인지 체크합니다. 
                if(!is_uploaded_file($_FILES['goods_image']['tmp_name'])) { 
                      echo "HTTP로 전송된 파일이 아닙니다."; 
                } else { 
                      // move_uploaded_file은 임시 저장되어 있는 파일을 ./uploads 디렉토리로 이동합니다. 
                      if (move_uploaded_file($_FILES['goods_image']['tmp_name'], $uploadfile)) { 
                           echo "성공적으로 업로드 되었습니다.\n";
                           $query = "update goods_tab set goods_image='$img' where goods_id='$goods_id';";
                           $result = mysqli_query($conn, $query);
                        } else { 
                           echo "파일 업로드 실패입니다.\n"; 
                      } 
                } 
           } 
        }
    }
      
    $mem_date = date("Y-m-d", time());

    $query = "update goods_tab set goods_code='$goods_code',
            goods_name='$goods_name', goods_country='$goods_country',
            goods_price='$goods_price', goods_explain='$goods_explain',
            goods_date='$mem_date' where goods_id='$goods_id';";
    $result = mysqli_query($conn, $query);
 
    
    }
    
    if(!$result) {
        echo("
        <script>
            alert('상품등록에 실패했습니다.');
            history.back();
        </script>
        ");
    }else{
        echo("
        <script>
            alert('상품을 수정했습니다.');
            location.href='index.html';       
        </script>
        ");
    }
?>