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
    <h2>회원 관리</h2>
    <br />
    <form name="search_form" action="admin_mem_list.php" method="POST">
    <div class="col-lg-6">
    <div class="input-group">
    <select class="selectpicker" name="search_item">
    <option value="mem_id">회원 아이디</option>
    <option value="mem_name">회원 이름</option>
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
    $query = "select *from member_tab where $search_item like '%$search_text%' order by mem_id desc, mem_name asc";
} else {
    $query = "select *from member_tab order by mem_id desc";
}
?>
<table class="table">
   <th>아이디</th> <th>이름</th> <th>메일</th> <th>주민등록번호</th> <th>전화번호</th> <th>주소</th> <th>가입일</th> <th>처리</th>
<?php  
    $result = mysqli_query($conn, $query);
    while($rows = mysqli_fetch_assoc($result)){
?>
<form action="admin_mem_update.php" method="POST">
    <tr>
        <td><?php echo $rows['mem_id'];?></td>
        <td><?php echo $rows['mem_name'];?></td>
        <td><?php echo $rows['mem_email'];?></td>
        <td><?php echo $rows['mem_jumin'];?></td>
        <td><?php echo $rows['mem_telephone'];?></td>
        <td><?php echo $rows['mem_address'];?></td>
        <td><?php echo $rows['mem_date'];?></td>
        <td><button type="button" class="btn btn-primary" onclick="location.href='admin_mem_update.php?mem_id=<?php echo $rows['mem_id'];?>'">수정</button>
        <button type="button" class="btn btn-primary"  onclick="location.href='admin_mem_delete.php?mem_id=<?php echo $rows['mem_id'];?>'">삭제</button></td>
    </tr>
</form>
<?php }?>
</table>
</body>
</html>
<?php }?>