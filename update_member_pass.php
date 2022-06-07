<!DOCTYPE html>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $("#headers").load("navbar.php");
            });
        </script>
         <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
         <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
         <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    </head>
    <body>
    <div id="headers"></div>
    <form class="form-horizontal" role="form" method="post" action="update_member.php">
         </div>
            <form>
                <div class="form-group" id="divPassword" style="margin:10%">
                    <label for="inputPassword" class="col-lg-2 control-label"><h5>패스워드를 입력하세요.</h5></label>
                    <div class="col-lg-10">
                        <input type="password" class="form-control" id="password" name="password" data-rule-required="true" placeholder="패스워드" maxlength="30">
                    </div>
                </div>
                <div class="form-group" style="text-align:center;">
                    <div class="col-lg-offset-2 col-lg-10">
                        <button type="submit" class="btn btn-primary">Sign in</button>
                    </div>
                </div>
    </form>

    </body>
</html>

