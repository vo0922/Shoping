<?php 
    session_start();
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
    <h4>내 장바구니</h4>
<div>
    <form name="orderform" id="orderform" method="post" class="orderform" action="/Page" onsubmit="return false;">
    
            <input type="hidden" name="cmd" value="order">
            <div class="basketdiv" id="basket">
                <div class="row head">
                    <div class="subdiv">
                        <div class="img">이미지</div>
                        <div class="pname">상품명</div>
                    </div>
                    <div class="subdiv">
                        <div class="basketprice">가격</div>
                        <div class="num">수량</div>
                        <div class="sum">합계</div>
                    </div>
                    <div class="subdiv">
                        <div class="basketcmd">삭제</div>
                    </div>
                    <div class="split"></div>
                </div>
<?php 
if(isset($_SESSION['cart'])) {
    $sum = 0;
    foreach($_SESSION["cart"] as $keys => $values) { 
?>
                <div class="row data">
                    <div class="subdiv">
                        <div class="img"><img src=<?php echo './storage/'.$values['goods_image'] ?> width="80"></div>
                        <div class="pname">
                            <span><?php echo $values["goods_name"]?></span>
                        </div>
                    </div>
                    <div class="subdiv">
                        <div class="basketprice"><input type="hidden" name="p_price" id="p_price1" class="p_price"><?php echo $values["goods_price"]?></div>
                        <div class="num">
                            <?php echo $values["goods_quantity"]?>
                        </div>
                        <div class="sum"><?php echo number_format($values["goods_quantity"]*$values["goods_price"]);?></div>
                    </div>
                    <div class="subdiv">
                        <div class="basketcmd"><a href="javascript:void(0)" class="abutton" onclick="location.href='cart.php?goods_id=<?php echo $values['goods_id']; ?>&action=delete'">삭제</a></div>
                    </div>
                </div>
                
<?php 
    $sum = $sum + ($values["goods_quantity"] * $values["goods_price"]);
    }
?> 

            </div>
    
            <div class="right-align basketrowcmd">
                <a href="javascript:void(0)" class="abutton" onclick="location.href='cart.php?&action=clear'">장바구니비우기</a>
            </div>

            <div class="bigtext right-align box blue summoney" id="sum_p_price">합계금액 : <?php echo number_format($sum); ?></div>
    
            <div id="goorder" class="">
                <div class="clear"></div>
                <div class="buttongroup center-align cmd">
                    <a href="cart_buy.php">구매하기</a>
                </div>
            </div>
        </form>
        </div>
<?php }?>
</body>
</html>
