  <?php include_once("config/header.php"); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-book"></i> ADMINISTRATORS
        <small>ADD ADMINISTRATORS</small>
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content">

<div id="popup"> Staff Added Successfully <i class="fa fa-check"></i> </div>
<div id="popup_f"> Staff Already Exit <i class="fa fa-times"></i> </div>
<div id="popup_err"> Error Adding admin <i class="fa fa-times"></i> </div>


      <!-- Your Page Content Here -->
   <div class="row">
   <div class="col-xs-6">
   <div class="box">
            <div class="box-header">
              <h3 class="box-title">ADD ADMINISTRATORS</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label for="InputName">First name</label>
                  <input type="text" class="form-control" required="" name="fname" id="InputFName" placeholder="Enter Username">
                </div>
                 <div class="form-group">
                  <label for="InputName">Last name</label>
                  <input type="text" class="form-control" required="" name="lname" id="InputLName" placeholder="Enter Username">
                </div>
                <div class="form-group">
                  <label for="InputEmail">Email address</label>
                  <input type="email" class="form-control" required="" name="email" id="InputEmail" placeholder="Enter email">
                </div>
                <div class="form-group">
                  <label for="InputPassword1">Password</label>
                  <input type="password" class="form-control" id="pw" placeholder="Password" name="password" required="">
                </div>
                <div class="form-group">
                  <label for="InputPassword2">Confirm Password</label>
                  <input type="password" class="form-control" name="confirm_password" id="confirm_password" required="" oninput="confirmpw()" placeholder="Confirm Password">
                  <span class="help-inline" id="confirmpw"></span>
                </div>
                <div class="form-group">
                  <label for="InputName">Phone Number</label>
                  <input type="text" class="form-control" required="" name="phone" id="InputLName" placeholder="Enter Phone Number">
                </div>
                <div class="form-group">
                <label>STAFF Office Position</label>
                <select name="position" class="form-control select2" style="width: 100%;" required="" >
                <option selected="selected" disabled="">Select Office Position</option>
                <?php
                $pos =  _getallpositions();
                    foreach ($pos as $posrow) {
                    echo '<option value="'.$posrow['position'].'" >'.$posrow['position'].'</option>';
                }
                  ?>
                </select>
                
              </div>
              <div class="form-group">
                <label>Allocate Amount</label>
                <select name="allocatedamount" class="form-control select2" style="width: 100%;" required="" >
                <option selected="selected" disabled="">Select Amount to allocate</option>
                <?php
                $amt =  _getallamounts();
                    foreach ($amt as $amtrow) {
                    echo '<option value="'.$amtrow['amount'].'" > &#8358 '.number_format($amtrow['amount']).'</option>';
                }
                  ?>
                </select>
                
              </div>
                <div class="form-group">
                  <label for="InputFile">Profile Picture (Optional)</label>
                  <input type="file" id="InputFile" name="file">
                  <p class="text-danger">* File must be JPG or PNG, and less than 200kb.</p>
                  <p id="alert_pic1">** Image size is 0kb **</p>
                  <p id="alert_pic2">** Image is not PNG or JPG **</p>
                </div>
                
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary" id="sbtn" name="submit"><i class="fa fa-check"></i> Submit</button>
              </div>
            </form>
           
          </div>

   </div>
   <div class="col-xs-6">
    <div class="callout callout-info">
                <h4>Administrative Level: Super VS Sub</h4>

                <p>Follow the steps to continue to payment.</p>
              </div>
              
              <div class="callout callout-success">
                <h4>I am a success callout!</h4>

                <p>This is a green callout.</p>
              </div>
  
   </div>
   </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<script type="text/javascript">
     function undisableBtn() {
       document.getElementById("sbtn").disabled = false;
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

if(isset($_POST['submit']))
{
  if(isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['password']) && isset($_POST['position']) && isset($_POST['email']) ) {
    // Escape user inputs for security

        $fname = mysqli_real_escape_string($link, $_POST['fname']);
        $lname = mysqli_real_escape_string($link, $_POST['lname']);
        $password = mysqli_real_escape_string($link, md5($_POST['password']));
        $position = mysqli_real_escape_string($link, $_POST['position']);
        $email = mysqli_real_escape_string($link, $_POST['email']);
        $phone = mysqli_real_escape_string($link, $_POST['phone']);
        $allocatedamount = mysqli_real_escape_string($link, $_POST['allocatedamount']);
        $date = date("Y-m-d H:i:s");
        $balance = $allocatedamount;

    if(!empty($fname) && !empty($lname) && !empty($password) && !empty($email) && !empty($position) ){
        
        $query = "SELECT email FROM users_tbl WHERE email = '$email'  ";
        $query_run = mysqli_query($link, $query);
        $numRowsCheck = mysqli_num_rows($query_run);
     
        if ($numRowsCheck > 0) {
            echo '<script type="text/javascript">function hideMsg(){
            document.getElementById("popup_f").style.visibility = "hidden"; }         document.getElementById("popup_f").style.visibility = "visible";
           window.setTimeout("hideMsg()", 4000);
            </script>';
        } else {
if (!file_exists($_FILES['file']['tmp_name']) || !is_uploaded_file($_FILES['file']['tmp_name'])) 
{
    $NewImageName = "avatar.png";
} else {
            $filename = $_FILES['file']['name'];
            $extension = pathinfo($filename, PATHINFO_EXTENSION);
            if ($extension == 'png' || $extension == 'jpg' ) {

              if($_FILES['file']["size"] <= 0){ 
                  echo '<script type="text/javascript">function hideMsg(){
                        document.getElementById("alert_pic1").style.visibility = "hidden"; }         document.getElementById("alert_pic1").style.visibility = "visible";
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
                            $NewImageName = $lname.$RandomNum.'.'.$ImageExt;

                            move_uploaded_file($_FILES['file']['tmp_name'], "$Destination/$NewImageName");
                       
                    }

            } else {
            echo '<script type="text/javascript">function hideMsg(){
                  document.getElementById("alert_pic2").style.visibility = "hidden"; }         document.getElementById("alert_pic2").style.visibility = "visible";
                 window.setTimeout("hideMsg()", 5000);
                  </script>';
            }
                  
                
              } 

         
                            $result = _newStaff($fname, $lname, $email, $password, $phone, $NewImageName, $position, $allocatedamount, $balance, 2, $date); 
                            if ($result) {
                            echo '<script type="text/javascript">function hideMsg(){
                            document.getElementById("popup").style.visibility = "hidden"; }         document.getElementById("popup").style.visibility = "visible";
                            window.setTimeout("hideMsg()", 4000);
                            </script>';
                            } else {
                            echo '<script type="text/javascript">function hideMsg(){
                            document.getElementById("popup_err").style.visibility = "hidden"; }         document.getElementById("popup_err").style.visibility = "visible";
                            window.setTimeout("hideMsg()", 4000);
                            </script>';
                            }
          }
        }

// close connection
            mysqli_close($link);
    }
     else {

}
}
  ?>
