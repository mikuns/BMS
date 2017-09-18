<?php 
require_once("config/functions.php");
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>BMS | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="dist/css/style.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">


<div class="login-box">
  <div class="login-logo">
    <a href="login.php"><b>Staff</b> - Budget MS</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <form action="" method="post">
    <div id="alert_text">** Incorrect Login Details, Please Try Again **</div>
      <div class="form-group has-feedback">
        <input type="email" name="email" class="form-control" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" name="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>

</body>
</html>

<?php

if(isset($_POST['email']) && isset($_POST['password']) ) {

    // Escape user inputs for security
    $login_email = mysqli_real_escape_string($link, $_POST['email']);
    $login_password = mysqli_real_escape_string($link, md5($_POST['password']));
   

    if(!empty($login_email) && !empty($login_password)) {
        
        $query = "SELECT id FROM users_tbl WHERE email= '$login_email' AND password = '$login_password'  ";
        $query_run = mysqli_query($link, $query);
        $numRowsCheck = mysqli_num_rows($query_run);

        if ($numRowsCheck == 0) {
            echo '<script type="text/javascript">function hideMsg(){
            document.getElementById("alert_text").style.visibility = "hidden"; }         document.getElementById("alert_text").style.visibility = "visible";
           window.setTimeout("hideMsg()", 40000);
            </script>';
    
        } elseif ($numRowsCheck == 1) {


            $useridrow = mysqli_fetch_assoc($query_run);
            $userid = $useridrow['id'];
            ob_start();
            session_start();
            $_SESSION['user_id'] = $userid;
            $_SESSION['activiteit'] = time();
            header("Location: dashboard.php");

        }
    }

} 

?>
