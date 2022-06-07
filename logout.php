<?php
    session_start();
    #--세션 해제--#
    unset($_SESSION['user_id']);
    unset($_SESSION['shop_logon']);
    unset($_SESSION['cart']);
    echo "<script>location.href='login.php'</script>";
?>