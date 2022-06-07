<?php
    session_start();
    #관리자만이 사용
    if($_SESSION['user_id'] == "admin"){
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
      <h2>상품 입력</h2>

     <form name="form" id="form" role="form" method="post" action="goods_confirm.php" enctype="multipart/form-data">

        <div class="mb-3">
            <label for="code">상품코드</label>
            <input type="text" class="form-control" name="goods_code" id="title" placeholder="상품코드를 입력해주세요.">
        </div>

        <div class="mb-3">
            <label for="name">상품명</label>
            <input type="text" class="form-control" name="goods_name" id="goodsname" placeholder="상품명을 입력해주세요.">
        </div>

        <div class="mb-3">
            <label for="country">원산지</label>
            <input type="text" class="form-control" name="goods_country" id="contry" placeholder="원산지를 입력해주세요.">
        </div>

        <div class="mb-3">
            <label for="price">가격</label>
            <input type="text" class="form-control" name="goods_price" id="price" placeholder="가격을 입력해주세요.">
        </div>

        <div class="mb-3">
            <label for="image">이미지</label>
            <input type="file" style="display:inline-block;padding:0px 15px;line-height:35px;cursor:pointer;" class="form-control" name="goods_image" id="image">
        </div>

        <div class="mb-3">
            <label for="content">상세내용</label>
            <textarea class="form-control" rows="5" name="goods_explain" id="content" placeholder="상세내용을 입력해 주세요" ></textarea>
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
