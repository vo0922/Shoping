<?php 
    session_start();

    $conn = mysqli_connect('localhost', 'root', '1234');
    $db = mysqli_select_db($conn, 'shoppingmall');

    if($db){
        mysqli_query($conn, "set session character_set_connection=utf8;");
        mysqli_query($conn, "set session character_set_results=utf8;");
        mysqli_query($conn, "set session character_set_client=utf8;");
      }else {
        echo "디비에러";
      }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	<link rel="stylesheet" href="cart_ui.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript">
            $(document).ready(function() {
                $("#headers").load("navbar.php");
            });
    </script>

</head>
<body>
<div id="headers"></div>
    <br />
    <h4>현재 구매중인 상품</h4>
<div>
    <form name="orderform" id="orderform" method="post" class="orderform" action="/Page" onsubmit="return false;">
    
            <input type="hidden" name="cmd" value="order">
            <div class="basketdiv" id="basket">
                <div class="row head">
                    <div class="subdiv">
                        <div class="img">날짜</div>
                        <div class="pname">상품명</div>
                    </div>
                    <div class="subdiv">
                        <div class="basketprice">가격</div>
                        <div class="num">수량</div>
                        <div class="sum">합계</div>
                    </div>
                    <div class="subdiv">
                        <div class="basketcmd">진행사항</div>
                    </div>
                    <div class="split"></div>
                </div>
<?php 
if(isset($_SESSION['shop_logon'])) {
    $mem_id=$_SESSION['user_id'];
    $query = "select *from buy_tab where (mem_id='$mem_id') and (buy_state <> '배송완료') order by buy_date desc, goods_name asc";
    $result = mysqli_query($conn, $query);
    while($rows = mysqli_fetch_assoc($result)){
?>
                <div class="row data">
                    <div class="subdiv">
                        <div class="img"><?php echo $rows['buy_date'] ?></div>
                        <div class="pname">
                            <span><?php echo $rows["goods_name"]?></span>
                        </div>
                    </div>
                    <div class="subdiv">
                        <div class="basketprice"><input type="hidden" name="p_price" id="p_price1" class="p_price"><?php echo $rows["buy_price"]?></div>
                        <div class="num">
                            <?php echo $rows["buy_num"]?>
                        </div>
                        <div class="sum"><?php echo number_format($rows["buy_price"]); ?></div>
                    </div>
                    <div class="subdiv">
                        <div class="basketcmd"><?php echo $rows["buy_state"] ?></div>
                    </div>
                </div>
                <?php } ?>
            </div>
    
        </form>
        </div>
<?php }?>
        <br />

        <h4>지난 구매 내역</h4>
<div>
    <form name="orderform" id="orderform" method="post" class="orderform" action="/Page" onsubmit="return false;">
    
            <input type="hidden" name="cmd" value="order">
            <div class="basketdiv" id="basket">
                <div class="row head">
                    <div class="subdiv">
                        <div class="img">날짜</div>
                        <div class="pname">상품명</div>
                    </div>
                    <div class="subdiv">
                        <div class="basketprice">가격</div>
                        <div class="num">수량</div>
                        <div class="sum">합계</div>
                    </div>
                    <div class="subdiv">
                        <div class="basketcmd">진행사항</div>
                    </div>
                    <div class="split"></div>
                </div>
<?php 
if(isset($_SESSION['shop_logon'])) {
    $mem_id=$_SESSION['user_id'];
    $query = "select *from buy_tab where (mem_id='$mem_id') and (buy_state = '배송완료') order by buy_date desc, goods_name asc";
    $result = mysqli_query($conn, $query);
    while($rows = mysqli_fetch_assoc($result)){
?>
                <div class="row data">
                    <div class="subdiv">
                        <div class="img"><?php echo $rows['buy_date'] ?></div>
                        <div class="pname">
                            <span><?php echo $rows["goods_name"]?></span>
                        </div>
                    </div>
                    <div class="subdiv">
                        <div class="basketprice"><input type="hidden" name="p_price" id="p_price1" class="p_price"><?php echo $rows["buy_price"]?></div>
                        <div class="num">
                            <?php echo $rows["buy_num"]?>
                        </div>
                        <div class="sum"><?php echo number_format($rows["buy_price"]*$rows["buy_num"]); ?></div>
                    </div>
                    <div class="subdiv">
                        <div class="basketcmd"><?php echo $rows["buy_state"] ?></div>
                    </div>
                </div>
                <?php } ?>
            </div>
    
        </form>
        </div>
<?php }?>
</body>
</html>
