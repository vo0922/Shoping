<?php 
    session_start();

    $mem_email = $_POST['mem_email'];
    $mem_name = $_POST['mem_name'];
    $mem_password = $_POST['mem_password'];
    $mem_address = $_POST['mem_address'];
    $mem_telephone = $_POST['mem_telephone'];
    $mem_id = $_POST['mem_id'];
    $conn = mysqli_connect('localhost', 'root', '1234');
    $db = mysqli_select_db($conn, 'shoppingmall');

    if($db){
        mysqli_query($conn, "set session character_set_connection=utf8;");
        mysqli_query($conn, "set session character_set_results=utf8;");
        mysqli_query($conn, "set session character_set_client=utf8;");
      }else {
        echo "디비에러";
      }

    $query = "update member_tab set mem_email='$mem_email', mem_name='$mem_name', mem_password='$mem_password',
            mem_address='$mem_address', mem_telephone='$mem_telephone' where mem_id='$mem_id'; ";

    $result = mysqli_query($conn, $query);
 
    if(!$result) {
        echo("
        <script>
            alert('정보수정에 실패했습니다.');
            history.back();
        </script>
        ");
    }else{
        echo("
        <script>
            alert('정보를 수정했습니다.');
            location.href='admin_mem_list.php';       
        </script>
        ");
    }
?>