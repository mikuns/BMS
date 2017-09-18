<?php include_once("config/header.php");
 ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        User Profile
      </h1>
      
    </section>

        <div id="popup"> Changes Made Successfully <i class="fa fa-check"></i> </div>
        <div id="popup1"> Password Changed Successfully <i class="fa fa-check"></i> </div>
        <div id="popup3"> Picture Changed Successfully <i class="fa fa-check"></i> </div>
        <div id="popup1_err"> Password Don't Match <i class="fa fa-check"></i> </div>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-4">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="uploads/profile/<?php echo $avatar; ?>" style="width: 150px; height: 150px;"  alt="User profile picture">

              <h3 class="profile-username text-center"><?php echo $firstname.' '.$lastname; ?></h3>

              <p class="text-muted text-center"><?php echo $position; ?></p>
              <p class="text-muted text-center"><?php echo $useremail; ?> | <?php echo $userphone; ?> </p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Registration Date: </b> <a class="pull-right"><?php echo date("F j, Y, g:i a", strtotime($userdate)); ?></p></a>
                </li>
                <li class="list-group-item">
                  <b>Allocated Amount: </b> <a class="pull-right">&#8358 <?php echo number_format($alloamt); ?></p></a>
                </li>
                
              </ul>

              <p class="btn btn-primary btn-block"><b>Balance: &#8358 <?php echo number_format($bal); ?></p></b></p>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          
        </div>
        <!-- /.col -->
        <div class="col-md-8">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Activity</a></li>
              <li><a href="#editprofile" data-toggle="tab">Edit Profile</a></li>
              <li><a href="#changepassword" data-toggle="tab">Change Password</a></li>
              <li><a href="#changeavatar" data-toggle="tab">Change Picture</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                <ul class="timeline timeline-inverse">
                  <!-- timeline time label -->
                  <?php
                $userid1 = _getuserfield('id');
                $budget = _getmytransactions($userid1);
                
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
              ?>

                  <!-- END timeline item -->
                  <!-- timeline time label -->
                  
                  <!-- END timeline item -->
                  <li>
                    <i class="fa fa-clock-o bg-gray"></i>
                  </li>
                </ul>
              </div>
             
              <div class="tab-pane" id="editprofile">
                <form role="form" method="post" action="">
                <div class="box-body">
                  <div class="form-group">
                  <label for="InputName" class="col-sm-2 control-label" >First name</label>
                  <div class="col-sm-10">
                  <input type="text" class="form-control" required="" name="fname" id="InputFName" value="<?php echo $firstname; ?>" >
                  </div>
                </div>
                 <div class="form-group">
                  <label for="InputName" class="col-sm-2 control-label">Last name</label>
                  <div class="col-sm-10">
                  <input type="text" class="form-control" required="" name="lname" id="InputLName" value="<?php echo $lastname; ?>" >
                  </div>
                </div>
                <div class="form-group">
                  <label for="InputName" class="col-sm-2 control-label">Phone Number</label>
                  <div class="col-sm-10">
                  <input type="text" class="form-control" required="" name="phone" id="InputLName" value="<?php echo $userphone; ?>" >
                  </div>
                </div>
                
                </div>
                <div class="box-footer">
                <button type="submit" class="btn btn-primary" name="submit1"><i class="fa fa-check"></i> Make Changes</button>
              </div>
                
                
              <!-- /.box-body -->
                </form>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="changepassword">
                <form role="form" method="post" action="">
                <div class="box-body">
                  <div class="form-group">
                  <label for="InputPassword1">Old Password</label>
                  <input type="password" class="form-control" id="pw0" placeholder="Old Password" name="password0" required="">
                </div>
                <div class="form-group">
                  <label for="InputPassword1">New Password</label>
                  <input type="password" class="form-control" id="pw" placeholder="New Password" name="password" required="">
                </div>
                <div class="form-group">
                  <label for="InputPassword2">Confirm Password</label>
                  <input type="password" class="form-control" name="confirm_password" id="confirm_password" required="" oninput="confirmpw()" placeholder="Confirm Password">
                  <span class="help-inline" id="confirmpw"></span>
                </div>
                </div>
                <div class="box-footer">
                <button type="submit" class="btn btn-primary" name="submit2" id="passbtn"><i class="fa fa-check"></i> Make Changes</button>
              </div>
                </form>
              </div>

              <div class="tab-pane" id="changeavatar">
                <form role="form" method="post" action="" enctype="multipart/form-data">
              <div class="box-body">
                  <div class="form-group">
                  <label for="InputFile" class="col-sm-6 control-label">Profile Picture (Optional)</label>
                  <div class="col-sm-10">
                  <input type="file" id="InputFile" name="file">

                  <p class="text-danger">* File must be less than 200kb.</p>
                  </div>
                </div>
                </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary" name="submit3"><i class="fa fa-check"></i> Make Changes</button>
              </div>
                </form>
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
  <script type="text/javascript">
     function undisableBtn() {
       document.getElementById("passbtn").disabled = false;
        }
          function confirmpw(){
              var p=document.getElementById('pw').value;
              var cp=document.getElementById('confirm_password').value;
                if(p =="" && cp == ""){
                  document.getElementById('confirmpw').innerHTML="<p class=\"text text-warning\">Password is empty <i class=\"fa fa-remove\"></i></p>";
                            document.getElementById("sbtn").disabled = true;
                } 
                  else if(p==cp){
                  undisableBtn();
                  document.getElementById('confirmpw').innerHTML="<p class=\"text text-success\">Password match <i class=\"fa fa-check\"></i></p>";
                           
                  }else{
                  document.getElementById('confirmpw').innerHTML="<p class=\"text text-warning\">Password must match <i class=\"fa fa-remove\"></i></p>";
                            document.getElementById("sbtn").disabled = true;
                            
                        }
                    }
</script>
<?php include_once("config/footer.php"); 

if(isset($_POST['submit1']))
{
  if(isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['phone'])){

        $fname = mysqli_real_escape_string($link, $_POST['fname']);
        $lname = mysqli_real_escape_string($link, $_POST['lname']);
        $phone = mysqli_real_escape_string($link, $_POST['phone']);

    if(!empty($fname) && !empty($lname) && !empty($phone) ){
      $query = "UPDATE users_tbl SET firstname = '$fname', lastname = '$lname', phone = '$phone' WHERE id = '$userid1' AND email = '$useremail' " ;
      $query_run = mysqli_query($link, $query);
      if(mysqli_affected_rows($link) > 0 ){
     echo '<script type="text/javascript">function hideMsg(){
                     document.getElementById("popup").style.visibility = "hidden"; }         document.getElementById("popup").style.visibility = "visible";
                       document.getElementById("popup").style.visibility = "visible";
                       window.setTimeout("hideMsg()", 4000);
                        </script>';
      } else {}   
    }
  }
}

else if(isset($_POST['submit2']))
{
  if(isset($_POST['password0']) && isset($_POST['password'])) {

        $pw0 = mysqli_real_escape_string($link, md5($_POST['password0']));
        $pw = mysqli_real_escape_string($link, md5($_POST['password']));

    if(!empty($pw0) && !empty($pw)){
      $query = "UPDATE users_tbl SET password = '$pw' WHERE id = '$userid1' AND email = '$useremail' AND password = '$pw0' " ;
      $query_run = mysqli_query($link, $query);
      if(mysqli_affected_rows($link) > 0 ){
     echo '<script type="text/javascript">function hideMsg(){
                     document.getElementById("popup1").style.visibility = "hidden"; }         document.getElementById("popup1").style.visibility = "visible";
                       document.getElementById("popup1").style.visibility = "visible";
                       window.setTimeout("hideMsg()", 4000);
                        </script>';
      } else {
        echo '<script type="text/javascript">function hideMsg(){
                     document.getElementById("popup1_err").style.visibility = "hidden"; }         document.getElementById("popup1_err").style.visibility = "visible";
                       document.getElementById("popup1_err").style.visibility = "visible";
                       window.setTimeout("hideMsg()", 4000);
                        </script>';
      }   
    }
  }
}
else if(isset($_POST['submit3']))
{
  if (!file_exists($_FILES['file']['tmp_name']) || !is_uploaded_file($_FILES['file']['tmp_name'])) 
{
    $NewImageName = "avatar.png";
} else {
            $filename = $_FILES['file']['name'];
            $extension = pathinfo($filename, PATHINFO_EXTENSION);
            if ($extension == 'png' || $extension == 'jpg' ) {

              if($_FILES['file']["size"] <= 0){ 
                  echo '<script type="text/javascript">function hideMsg(){
                        document.getElementById("popup_empty").style.visibility = "hidden"; }         document.getElementById("popup_empty").style.visibility = "visible";
                       window.setTimeout("hideMsg()", 5000);
                        </script>';
                  } else {

                            if (file_exists($_FILES["file"]["name"])) {
                            unlink($_FILES["file"]["name"]);
                            }

                            $Destination = 'uploads/profile';
                            $RandomNum = rand(0, 99);
                            $ImageName = str_replace(' ','-',strtolower($_FILES['file']['name']));
                            $ImageType = $_FILES['file']['type'];
                            $ImageExt = substr($ImageName, strrpos($ImageName, '.'));
                            $ImageExt = str_replace('.','',$ImageExt);
                            $ImageName = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
                            $NewImageName = $lastname.$RandomNum.'.'.$ImageExt;

                            move_uploaded_file($_FILES['file']['tmp_name'], "$Destination/$NewImageName");  
                    }
            } else {
            echo '<script type="text/javascript">function hideMsg(){
                  document.getElementById("popup_ext").style.visibility = "hidden"; }         document.getElementById("popup_ext").style.visibility = "visible";
                 window.setTimeout("hideMsg()", 5000);
                  </script>';
            }   
          } 
            $query = "UPDATE users_tbl SET avatar = '$NewImageName' WHERE id = '$userid1' AND email = '$useremail' " ;
            $query_run = mysqli_query($link, $query);

            if(mysqli_affected_rows($link) > 0 ){
            echo '<script type="text/javascript">function hideMsg(){
             document.getElementById("popup3").style.visibility = "hidden"; }         document.getElementById("popup3").style.visibility = "visible";
               document.getElementById("popup3").style.visibility = "visible";
               window.setTimeout("hideMsg()", 4000);
                </script>';
            } else {
            echo '<script type="text/javascript">function hideMsg(){
                    document.getElementById("popup_err").style.visibility = "hidden"; }         document.getElementById("popup_err").style.visibility = "visible";
                    window.setTimeout("hideMsg()", 4000);
                    </script>';
                    }
}


      ?>  