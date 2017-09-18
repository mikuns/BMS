  <?php include_once("config/header.php"); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    
    <!-- Main content -->
    <section class="content">

    <div class="row">
        <!-- ./col -->
        <div class="col-lg-6 col-xs-6">
        <div class="info-box" >
            <span class="info-box-icon bg-yellow"><i class="fa fa-money"></i></span>

            <div class="info-box-content">
              <span class="info-box-text" style="font-weight: bold;">Allocated Amount</span>
              <span class="" style="font-size: 35px; font-weight: bold;">&#8358; <?php echo number_format($alloamt); ?> </span>
            </div>
            <!-- /.info-box-content -->
          </div>
        </div>
        
        <div class="col-lg-6 col-xs-6">
        <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-money"></i></span>

            <div class="info-box-content">
              <span class="info-box-text" style="font-weight: bold;">Balance</span>
              <span class="" style="font-size: 35px; font-weight: bold;">&#8358; <?php echo number_format($bal); ?> </span>
            </div>
            <!-- /.info-box-content -->
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->

      <div class="row">
         <!-- PRODUCT LIST -->
         <div class="col-lg-6 col-xs-6">

          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Recent Budgets</h3>

              <div class="box-tools pull-right">

                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <ul class="products-list product-list-in-box">
                 <?php  
                $auth = _getuserfield('auth_level');
                if ($auth == 1) {  
                    $tran =  _getalltranlimited();

                  } elseif ($auth == 2) {
                      $tran =  _getusertranlimited(_getuserfield('id'));                  
                  }
                    foreach ($tran as $p_row) {
                      $uid = $p_row['userid'];
                    $fname = _getuserfieldbyid('firstname', $uid);
                    $lname = _getuserfieldbyid('lastname', $uid);
                    echo '
                <li class="item">
                  <div class="product-img">
                    <img src="dist/img/default-50x50.gif" alt="Product Image">
                  </div>
                  <div class="product-info">
                    <a href="invoice.php?id='.$p_row['invoicenumber'].'" class="product-title">'.$p_row['budgetname'].'
                      <span class="label label-warning pull-right">&#8358 '.number_format($p_row['budgetamount']).'</span></a>
                        <span class="product-description">
                          '.$p_row['budgetdescription'].'
                        </span>
                        
                        <span class="label label-danger pull-right"> By '.strtoupper($fname).' '.strtoupper($lname).' on '.date("F j, Y, g:i a", strtotime($p_row['dated'])).'</span>
                  </div>
                </li>';
              }
                ?>
               
              </ul>
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-center">
             <?php 
          $auth = _getuserfield('auth_level');
                if ($auth == 1) {
                  echo '<a href="transactions.php" class="uppercase">View Staff Budgets</a>';
                } elseif ($auth == 2) {
                  echo '<a href="mytransactions.php" class="uppercase">View My Budgets</a>';
                }
          ?>
              
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
      </div>
<?php 
          $auth = _getuserfield('auth_level');
                if ($auth == 1) {
                  ?>
      <div class="col-lg-6 col-xs-6">
        <!-- USERS LIST -->
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">All Registered Staff</h3>

                  <div class="box-tools pull-right">
                    <span class="label label-danger">Recently Added Staff</span>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                   </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                  <ul class="users-list clearfix">
                    <?php      
                    $users =  _getalluserslimited();
                    foreach ($users as $p_row) {
                    echo '
                    <li><img src="uploads/profile/'.$p_row['avatar'].'" alt="'.$p_row['lastname'].'" style="width: 100px; height: 100px;" >
                    <a class="users-list-name" href="userprofile.php?id='.$p_row['id'].'">'.$p_row['firstname'].' '.$p_row['lastname'].'</a>
                    <span class="users-list-date">'.$p_row['position'].'</span>
                    </li>';
                    }
                    ?>
                  </ul>
                  <!-- /.users-list -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center">

                  <a href="allusers.php" class="uppercase">View All Staff</a>
                </div>
                <!-- /.box-footer -->
              </div>
              <!--/.box -->
      </div>
      <?php } ?>
      </div>
     </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php include_once("config/footer.php"); ?>