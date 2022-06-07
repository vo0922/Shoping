<?php
    session_start();
    $mem_id = $_POST['mem_id'];
    $mem_pass =$_POST['mem_pass'];
    #데이터베이스 연결
    $conn = mysqli_connect('localhost', 'root', '1234');
    $db = mysqli_select_db($conn, 'shoppingmall');
    
    if($db){
        mysqli_query($conn, "set session character_set_connection=utf8;");
        mysqli_query($conn, "set session character_set_results=utf8;");
        mysqli_query($conn, "set session character_set_client=utf8;");
        $query = "select mem_id, mem_name from member_tab where
                (mem_id = '$mem_id') and (mem_password = '$mem_pass');";

        $result = mysqli_query($conn, $query);
   
        $row = mysqli_fetch_row($result);

        if($row[0]==""){
            echo("
            <script>
                alert('아이디와 비밀번호를 확인해 주세요');
                history.back();
            </script>
            ");
            exit;
        }else{
            if(!isset($_SESSION['shop_logon'])){
                $_SESSION['shop_logon']=true;
                $_SESSION['user_id'] = $row[0];
            }
            echo "<script>location.href='index.html'</script>";
        }

    }else {
        
    }

?>