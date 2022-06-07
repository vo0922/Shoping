<!DOCTYPE html>
<?php session_start(); ?>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
  <?php 
    if(isset($_SESSION['shop_logon'])){
  ?>
  <body>
    <nav class="navbar navbar-dark bg-dark">
        <a class="navbar-brand" href="index.html">가방사가세요~</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample01" aria-controls="navbarsExample01" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarsExample01">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="index.html"> 상점보기</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="cart_ui.php"> 장바구니보기 </a>
            </li>
    <?php 
        if($_SESSION['user_id'] == "admin") {
    ?>
            <li class="nav-item">
              <a class="nav-link" href="my_buy.php"> 내 구매관리 </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="add_goods.php"> 상품입력 </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="admin_buy.php"> 구매관리 </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="admin_mem_list.php"> 회원관리 </a>
            </li>
    <?php 
        } else {
    ?>
            <li class="nav-item">
              <a class="nav-link" href="my_buy.php"> 내 구매관리 </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="update_member_pass.php"> 내 정보수정 </a>
            </li>
    <?php
        }
    ?>
            <li class="nav-item">
              <a class="nav-link" href="logout.php"> 로그아웃 </a>
            </li>
        </ul>
      </div>
    </nav>   
  </body>
</html>
    <?php 
      }else {
    ?>
    <body>
    <nav class="navbar navbar-dark bg-dark">
        <a class="navbar-brand" href="index.html">가방사가세요~</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample01" aria-controls="navbarsExample01" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarsExample01">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="index.html"> 상점보기 </a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="login.php"> 로그인 </a>
            </li>
          </ul>
        </div>
    </nav>   
  </body>
</html>
    <?php
      }
      ?>

