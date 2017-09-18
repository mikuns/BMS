<?php include_once("config/header.php");
if (isset($_GET['id'])) {
   $userid = mysqli_real_escape_string($link, $_GET['id']);
  $userrow = _getuserinfo($userid);
  foreach ($userrow as $u_row) {
        $u_firstname = $u_row['firstname'];
        $u_lastname = $u_row['lastname'];
        $u_stafflevel = $u_row['auth_level'];
        $u_position = $u_row['position'];
        $u_useremail = $u_row['email'];
        $u_userphone = $u_row['phone'];
        $u_avatar = $u_row['avatar'];
        $u_alloamt = $u_row['allocated_amount'];
        $u_bal = $u_row['balance'];
        $u_userdate = $u_row['dated'];
  }

  }
 ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        User Profile
      </h1>
      
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-4">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="uploads/profile/<?php echo $u_avatar; ?>" style="width: 150px; height: 150px;"  alt="User profile picture">

              <h3 class="profile-username text-center"><?php echo $u_firstname.' '.$u_lastname; ?></h3>

              <p class="text-muted text-center"><?php echo $u_position; ?></p>
              <p class="text-muted text-center"><?php echo $u_useremail; ?> | <?php echo $u_userphone; ?> </p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Registration Date: </b> <a class="pull-right"><?php echo date("F j, Y, g:i a", strtotime($u_userdate)); ?></a>
                </li>
                <li class="list-group-item">
                  <b>Allocated Amount: </b> <a class="pull-right">&#8358 <?php echo number_format($u_alloamt); ?></a>
                </li>
                
              </ul>

              <p class="btn btn-primary btn-block"><b>Balance: &#8358 <?php echo number_format($u_bal); ?></b></p>
            </div>

            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        <a href="allusers.php" class="btn btn-warning btn-block"><i class="fa fa-backward"></i> BACK TO USERS</a>

        </div>
        <!-- /.col -->
        <div class="col-md-8">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Activity</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                <ul class="timeline timeline-inverse" >
                  <!-- timeline time label -->
                  <?php
                
                $budget = _getmytransactions($userid);
                $affectedrows = _getmytrannumrows($userid);
                if ($affectedrows == 0) {
                  echo '<span class="text text-info " style="margin-left:35%;" >No Budget has been made</span>';
                  
                } else {
                  
                foreach ($budget as $b_row) {

                echo '
              
                  <li class="time-label">
                        <span class="bg-red">
                        '.date("F j, Y, g:i a", strtotime($b_row['dated'])).'
                        </span>
                  </li>
                  <!-- /.timeline-label -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-clock-o" aria-hidden="true"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-bookmark"></i> Invoice #'.$b_row['invoicenumber'].'</span>

                      <h3 class="timeline-header"><a href="#">'.strtoupper($b_row['budgetname']).'</a> | <span class="text-danger">&#8358 '.number_format($b_row['budgetamount']).'</span> </h3>

                      <div class="timeline-body">
                        <p>Description: '.$b_row['budgetdescription'].'</p>
                        <p>Recipient Name: '.$b_row['recipientname'].'</p>
                      </div>
                      <div class="timeline-footer">
                        <a href="invoice.php?id='.$b_row['invoicenumber'].'" class="btn btn-success btn-flat btn-xs">View Invoice</a>
                      </div>
                    </div>
                  </li>'; }
                }
              ?>

                  <!-- END timeline item -->
                  <!-- timeline time label -->
                  
                  <!-- END timeline item -->
                  <li>
                    <i class="fa fa-clock-o bg-gray"></i>
                  </li>
                </ul>
              </div>
             
                         </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include_once("config/footer.php"); ?>  