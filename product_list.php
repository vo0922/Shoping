<?php 
  session_start();
  #데이터베이스 연결
  $conn = mysqli_connect('localhost', 'root', '1234');
  $db = mysqli_select_db($conn, 'shoppingmall');
  if($db){
    mysqli_query($conn, "set session character_set_connection=utf8;");
    mysqli_query($conn, "set session character_set_results=utf8;");
    mysqli_query($conn, "set session character_set_client=utf8;");
  }else {
    echo "디비에러";
  }
  $query = "select goods_id, goods_name, goods_country, goods_price, goods_image
            , goods_explain from goods_tab order by goods_date desc, goods_name asc;";
  $result = mysqli_query($conn, $query);
  $total = mysqli_num_rows($result);
?>
<html>
    <head>
    <meta charset="utf-8">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/album/">
    <!-- Bootstrap core CSS -->
    <link href="/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/docs/5.0/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="/docs/5.0/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="/docs/5.0/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
    <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon.ico">
    <meta name="theme-color" content="#7952b3">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
  </head>
  <body>
<main>
<header class="p-3 bg-dark text-white">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" action="search.php" method="POST">
          <input type="search" name="search_text" class="form-control form-control-dark" placeholder="Search..." aria-label="Search">
        </form>
      </div>
    </div>
  </header>
      <br>
  <div class="container">
      <div class="row">
      <?php 
  while($rows = mysqli_fetch_assoc($result)){
?>
        <div class="col-6">
          <div class="card" style="margin:10px;">
            <img src=<?php echo './storage/'.$rows['goods_image'] ?> style="width:300px; height:300px;"/>
            <div class="card-body">
              <h5 class="card-title"><?php echo $rows['goods_name']; ?></h5>
              <p class="card-text"><?php echo $rows['goods_explain']; ?></p>
              <a href="detail.php?goods_id=<?php echo $rows['goods_id']; ?>" class="btn btn-primary">구매</a>
              <a href="cart.php?goods_id=<?php echo $rows['goods_id']; ?>&quantity=1&action=add" class="btn btn-primary">담기</a>
<?php  if(isset($_SESSION['user_id'])){
       if($_SESSION['user_id'] == "admin") {?>
                <div class="btn-group">
                  <button onclick="location.href='goods_update.php?goods_id=<?php echo $rows['goods_id']?>'" type="button" class="btn btn-sm btn-outline-secondary">수정</button>
                  <button onclick="location.href='goods_delete.php?goods_id=<?php echo $rows['goods_id']?>'" type="button" class="btn btn-sm btn-outline-secondary">삭제</button>
                </div>
<?php }}?>
            </div>
          </div>
        </div>
<?php } ?>
       
      </div>
    </div>
</main>
</body>
</html>