<?php
    #데이터베이스 연결
    $conn = mysqli_connect('localhost', 'root', '1234');
    $mem_id = $_POST['mem_id'];
    $mem_email =$_POST['mem_email'];
    $mem_pass = $_POST['mem_pass'];
    $mem_name = $_POST['mem_name'];
    $mem_address = $_POST['mem_address'];
    $mem_telephone = $_POST['mem_telephone'];
    $mem_jumin = $_POST['mem_jumin'];
    $db = mysqli_select_db($conn, 'shoppingmall');
    
    if($db){
        mysqli_query($conn, "set session character_set_connection=utf8;");
        mysqli_query($conn, "set session character_set_results=utf8;");
        mysqli_query($conn, "set session character_set_client=utf8;");
        $mem_date = date("Y-m-d", time());
        $query = "insert into member_tab values('$mem_id', '$mem_email', '$mem_pass', '$mem_name', '$mem_address', '$mem_telephone',
                '$mem_jumin', '$mem_date');";

        $result = mysqli_query($conn, $query);

        if(!$result){
            echo "(
            <script>
            alert('회원가입실패');
            history.back();
            </script>
            )";
        }else {
            echo "<script>location.href='login.php'</script>";
        }
    }else {
        echo "등록실패";
    }

?>