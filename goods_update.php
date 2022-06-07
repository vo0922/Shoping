<?php
    session_start();
    #관리자만이 사용
    if($_SESSION['user_id'] == "admin"){
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
      <h2>상품 수정</h2>

     <form name="form" id="form" role="form" method="post" action="goods_update_ok.php" enctype="multipart/form-data">

     <div class="mb-3">
            <label for="code">상품 ID</label>
            <input type="text" class="form-control" name="goods_id" id="title" value="<?php echo $goods_id ?>" readonly>
        </div>

        <div class="mb-3">
            <label for="code">상품코드</label>
            <input type="text" class="form-control" name="goods_code" id="title" value="<?php echo $row['goods_code'] ?>">
        </div>

        <div class="mb-3">
            <label for="name">상품명</label>
            <input type="text" class="form-control" name="goods_name" id="goodsname" value="<?php echo $row['goods_name'] ?>">
        </div>

        <div class="mb-3">
            <label for="country">원산지</label>
            <input type="text" class="form-control" name="goods_country" id="contry" value="<?php echo $row['goods_country'] ?>">
        </div>

        <div class="mb-3">
            <label for="price">가격</label>
            <input type="text" class="form-control" name="goods_price" id="price" value="<?php echo $row['goods_price'] ?>">
        </div>

        <div class="mb-3">
            <label for="image">새 이미지</label>
            <input type="file" style="display:inline-block;padding:0px 15px;line-height:35px;cursor:pointer;" class="form-control" name="goods_image" id="image">
        </div>

        <div class="mb-3">
            <label for="content">상세내용</label>
            <textarea class="form-control" rows="5" name="goods_explain"><?php echo $row['goods_explain'] ?></textarea>
        </div>
        
        <div>
        <button type="submit" class="btn btn-sm btn-primary" id="btnSave">등록하기</button>
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
            alert('관리자가 아닙니다.');
            history.back();
        </script>
        ");
        exit;
    }
?>
