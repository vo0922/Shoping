<?php
    session_start();

    if(isset($_SESSION['shop_logon'])){
        $conn = mysqli_connect('localhost', 'root', '1234');
        $db = mysqli_select_db($conn, 'shoppingmall');
        if($db){
          mysqli_query($conn, "set session character_set_connection=utf8;");
          mysqli_query($conn, "set session character_set_results=utf8;");
          mysqli_query($conn, "set session character_set_client=utf8;");
        }else {
          echo "디비에러";
        }
        $mem_id = $_SESSION['user_id'];
        $query = "select *from member_tab where mem_id = '$mem_id' ";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);
        if(isset($_POST['password'])){
            if($_POST['password']==$row['mem_password']){
?>

<html>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $("#headers").load("navbar.php");
            });
        </script>
        <script type="text/javascript">
            $(document).ready(function() {
                $("#content").load("product_list.php");
            });
        </script>
    </head>
    <body>
        <div id="headers"></div>
        <article>

    <div class="container" role="main">
            <br/>
      <h2>내 정보수정</h2>

     <form name="form" id="form" role="form" method="post" action="update_member_ok.php" enctype="multipart/form-data">

     <div class="mb-3">
            <label for="code">이메일</label>
            <input type="text" class="form-control" name="mem_email" id="title" value="<?php echo $row['mem_email'] ?>">
        </div>

        <div class="mb-3">
            <label for="code">이름</label>
            <input type="text" class="form-control" name="mem_name" id="title" value="<?php echo $row['mem_name'] ?>">
        </div>

        <div class="mb-3">
            <label for="code">비밀번호 변경</label>
            <input type="password" class="form-control" name="mem_password" id="title" value="<?php echo $row['mem_password'] ?>">
        </div>

        <div class="mb-3">
            <label for="name">주소</label>
            <input type="text" class="form-control" name="mem_address" id="goodsname" value="<?php echo $row['mem_address'] ?>">
        </div>

        <div class="mb-3">
            <label for="country">휴대폰 번호</label>
            <input type="text" class="form-control" name="mem_telephone" id="contry" value="<?php echo $row['mem_telephone'] ?>">
        </div>
        
        <div>
        <button type="submit" class="btn btn-sm btn-primary" id="btnSave">확인</button>
        <button type="reset" class="btn btn-sm btn-primary" id="btnList">다시쓰기</button>
        </div>
    </form>

</div>

</article>

    </body>
</html>
<?php
            }else{
                echo("
                <script>
                    alert('비밀번호가 틀립니다.');
                    history.back();
                </script>
                ");
            }
        }    
    }else{
        echo("
        <script>
            alert('로그인을 하세요.');
            history.back();
        </script>
        ");
    }

?>
