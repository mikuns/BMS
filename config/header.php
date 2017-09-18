<?php include_once("config/functions.php"); 

if (!_loggedin()){
        header("Location: login.php");
}
elseif (_loggedin()){
        $firstname = _getuserfield('firstname');
        $lastname = _getuserfield('lastname');
        $stafflevel = _getuserfield('auth_level');
        $position = _getuserfield('position');
        $useremail = _getuserfield('email');
        $userphone = _getuserfield('phone');
        $avatar = _getuserfield('avatar');
        $alloamt = _getuserfield('allocated_amount');
        $bal = _getuserfield('balance');
        $userdate = _getuserfield('dated');
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>BUDGET MS</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="dist/css/style.css">
 
  <link rel="stylesheet" href="dist/css/skins/skin-purple.min.css">

  <link href="plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
     <!-- JQuery DataTable Css -->
  <link href="plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

  <body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header" style="background-color: #E0F2F1 !important">

    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>FMS</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>BUDGET MS</b></span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
         
                  <!-- User Account Menu -->
          <li class="user user-menu">
            <!-- Menu Toggle Button -->
            <a href="logout.php"" class="text text-danger" style="background-color: #ffffff;" > 
              <i class="fa fa-sign-out text-danger"></i>LOG OUT
            </a>
            
          </li>
          
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar" style="background-color: #000000 !important">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="uploads/profile/<?php echo $avatar; ?>" class="img-circle" alt="User Image" style="width: 50px; height: 50px;">
        </div>
        <div class="pull-left info" style="color: #ffffff">
          <p><?php echo $firstname.' '.$lastname; ?></p>
          <!-- Status -->
          <a href="#" style="color: #ffffff"><i class="fa fa-cogs text-danger"></i>  <?php echo $position; ?></a>
        </div>
      </div>
      
      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <li class="header" style="color: #ffffff">Main Navigation</li>
        <!-- Optionally, you can add icons to the links -->
        <li class="treeview active"><a href="dashboard.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        <li class="treeview">
          <a href="newbudget.php"><i class="fa fa-pencil"></i> <span>New Budget</span>
            </a>
          
        </li>
        <?php 
          $auth = _getuserfield('auth_level');
                if ($auth == 1) {
                  echo '<li class="treeview"><a href="transactions.php"><i class="fa fa-money"></i> <span>Budget Records</span></a></li>';
                } elseif ($auth == 2) {
                  echo '<li class="treeview"><a href="mytransactions.php"><i class="fa fa-money"></i> <span>My Budget Records</span></a></li>';
                }
          ?>
       
    <?php if($stafflevel == 1)
      {echo ' <li class="treeview"> <a href="#"><i class="fa fa-user"></i> <span>Staff</span> <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
              <span class="label label-primary pull-right">2</span></a>
      <ul class="treeview-menu">
        <li><a href="allusers.php"><i class="fa fa-users"></i> <span>All Staff</span></a></li>
        <li><a href="newuser.php"><i class="fa fa-pencil"></i> <span>New Staff</span></a></li>
      </ul>
    </li> ';} ?>

    <li class="treeview"> <a href="myprofile.php"><i class="fa fa-user"></i> <span>My Profile</span> </a></li> 

        
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>
