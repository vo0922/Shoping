<?php 
    session_start();

    if($_SESSION['user_id'] != 'admin') {
        echo "<script> 
                    alert('관리자가 아닙니다.');
                    history.back();
            </script>";
        exit;
    } else {
        $conn = mysqli_connect('localhost', 'root', '1234');
        $db = mysqli_select_db($conn, 'shoppingmall');
        if(!$db){
            echo "DB 에러";
            exit;
        }
?> 
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript">
            $(document).ready(function() {
                $("#headers").load("navbar.php");
            });
    </script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body>
<div id="headers"></div>
    <br />
    <h2>구매관리</h2>
    <br />
    <form name="search_form" action="admin_buy.php" method="POST">
    <div class="col-lg-6">
    <div class="input-group">
    <select class="selectpicker" name="search_item">
    <option value="buy_date">날짜</option>
    <option value="mem_id">아이디</option>
    <option value="goods_name">상품명</option>
    <option value="buy_state">진행사항</option>
    </select>
      <input type="text" class="form-control" name="search_text" placeholder="Search for...">
      <span class="input-group-btn">
        <button class="btn btn-default" type="submit" style="background-color:gray;">찾기</button>
      </span>
    </div>
    </div>
    </form>

    <br />
<?php 
    if(isset($_POST['search_text'])){
        $search_item = $_POST['search_item'];
        $search_text = $_POST['search_text'];
        $query = "select *from buy_tab where $search_item like '%$search_text%' order by buy_date desc, mem_id asc";
    } else {
        $query = "select *from buy_tab order by buy_date desc, mem_id asc";
    }
?>
<table class="table">
   <th></th> <th>날짜</th> <th>아이디</th> <th>상품명</th> <th>수량</th> <th>가격</th> <th>진행사항</th> <th>처리</th>

<?php  
    $result = mysqli_query($conn, $query);
    while($rows = mysqli_fetch_assoc($result)){
?>
<form action="admin_buy_update.php" method="POST">
    <tr>
        <td><input type="hidden" name="buy_id" value="<?php echo $rows['buy_id'];?>"></td>
        <td><?php echo $rows['buy_date'];?></td>
        <td><?php echo $rows['mem_id'];?></td>
        <td><?php echo $rows['goods_name'];?></td>
        <td><?php echo $rows['buy_num'];?></td>
        <td><?php echo number_format($rows["buy_num"]*$rows["buy_price"]);?></td>
        <td><select class="select" name="buy_state"><?php if($rows['buy_state']=='배송완료'){?>
            <option selected value="배송완료"><?php echo $rows['buy_state']?></option>
            <option value="구매요청">구매요청</option>
            <?php }else {?>
            <option selected value="구매요청"><?php echo $rows['buy_state']?></option>
            <option value="배송완료">배송완료</option>
            <?php }?>
        </select></td>
        <td><button type="submit" class="btn btn-primary">수정</button>
        <button type="button" class="btn btn-primary"  onclick="location.href='admin_buy_delete.php?buy_id=<?php echo $rows['buy_id']?>'">삭제</button></td>
    </tr>
</form>
<?php }?>
</table>
</body>
</html>
<?php }?>