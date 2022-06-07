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
    $goods_id = $_GET['goods_id'];
    $query = "select *from goods_tab where goods_id = '$goods_id' ";
    $result = mysqli_query($conn, $query);
    $rows = mysqli_fetch_array($result);
?>
<!DOCTYPE html>
    <head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $("#headers").load("navbar.php");
            });
        </script>
       <link rel="stylesheet" href="detail.css">

    </head>
    <body>
        <div id="headers"></div>

        <div class="content">
            <img class="img" src="<?php echo './storage/'.$rows['goods_image'] ?>" width="350" height="400"></img>
            <h2><?php echo $rows['goods_name']; ?></h2>
            <div class="explain">
              제품코드 : <?php echo $rows['goods_code']; ?> <br/>
              제품명 : <?php echo $rows['goods_name']; ?> <br/>
              원산지 : <?php echo $rows['goods_country']; ?> <br/>
              제품가격 : <?php echo $rows['goods_price']; ?> <br/> <br />
              상세설명 : <?php echo $rows['goods_explain'] ?> <br/>
          </div>
            <div class="foot">

              <button type="button" class="btn btn-outline-danger" onclick="location.href='goods_buy.php?goods_id=<?php echo $goods_id; ?>'">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag" viewBox="0 0 16 16">
                  <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"></path>
                </svg>
                구매하기
              </button>
              <button type="button" class="btn btn-outline-danger" onclick="location.href='cart.php?goods_id=<?php echo $goods_id; ?>&quantity=1&action=add'">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-basket" viewBox="0 0 16 16">
                <path d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1v4.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 13.5V9a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h1.217L5.07 1.243a.5.5 0 0 1 .686-.172zM2 9v4.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V9H2zM1 7v1h14V7H1zm3 3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 4 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 6 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 8 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5z"></path>
                </svg>
                담기
              </button>
            </div>
        </div>
    </body>
</html>
