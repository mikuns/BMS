  <?php include_once("config/header.php"); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-book"></i> BUDGET
        <small>NEW BUDGET</small>
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Your Page Content Here -->
   <div class="row">
   <div class="col-xs-9">
   <div class="box">
            <div class="box-header">
              <h3 class="box-title">NEW BUDGET</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <div id="alert_text">** Error, Please Try Again **</div>
                  <div id="alert_text1">** Budget Amount Exceed Your Balance **</div>
                </div>
                <div class="form-group">
                  <label for="InputName">Budget Name</label>
                  <input type="text" class="form-control" required="" name="bname" placeholder="Enter Budget Name">
                </div>
                <div class="form-group">
                  <label for="InputName">Budget Description</label>
                  <input type="text" class="form-control" required="" name="binfo" placeholder="Budget Description">
                </div>
                <div class="form-group">
                  <label for="InputName">Budget Amount 
                  <span class="text text-danger">| Old Balance: &#8358</span>
                  <span class="text text-danger"><?php echo number_format(_getuserfield('balance')); ?></span>
                  <span class="text text-success"> | New Balance: &#8358</span>
                  <span class="text text-success" id="liveb"><?php echo number_format(_getuserfield('balance')); ?></span>
                  </label>
                  <input type="number" class="form-control" placeholder="Enter Budget Amount" name="bamount" id="bamt" pattern="[0-9]*" oninput="checkamt();" min="1" step="any" >
                  <input type="hidden" name="oldamount" value="<?php echo _getuserfield('balance'); ?>" id="oldamt" >
                  <span class="help-inline" id="amterror"></span>
                </div>
                 <div class="form-group">
                  <label for="InputName">Recipient Name (Individual|Company)</label>
                  <input type="text" class="form-control" required="" name="rname" placeholder="Enter Recipient Name (Individual|Company)">
                </div>
                <div class="form-group">
                  <label for="InputEmail">Recipient Address</label>
                  <input type="text" class="form-control" name="raddress" placeholder="Enter Recipient Address">
                </div>
                <div class="form-group">
                  <label for="InputEmail">Recipient Email address</label>
                  <input type="email" class="form-control" name="remail" placeholder="Enter Recipient Email address">
                </div>
                <div class="form-group">
                  <label for="InputName">Recipient Phone Number</label>
                  <input type="text" class="form-control" name="rphone" placeholder="Enter Recipient Phone Number">
                </div>
               
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-primary" id="sbtn" name="submit"><i class="fa fa-ok"></i> Submit</button>
              </div>
            </form>
           
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
          function checkamt(){
              var b=document.getElementById('bamt').value;
              var ob=document.getElementById('oldamt').value;
              var c = ob-b;
              document.getElementById('liveb').innerHTML=c;
                if(b > ob){
                  document.getElementById('amterror').innerHTML="<p class=\"text text-danger\">Budget Amount exceeds Balance <i class=\"fa fa-remove\"></i></p>";
                            document.getElementById("sbtn").disabled = true;
                } 
                if(c < 0){
                  document.getElementById('amterror').innerHTML="<p class=\"text text-danger\">Budget Amount exceeds Balance <i class=\"fa fa-remove\"></i></p>";
                            document.getElementById("sbtn").disabled = true;
                } 
                else if(b = ""){
                  document.getElementById('amterror').innerHTML="<p class=\"text text-danger\">Budget Amount is Empty <i class=\"fa fa-remove\"></i></p>";
                            document.getElementById("sbtn").disabled = true;
                } 
                  else if(b <= ob){
                  undisableBtn();
                  document.getElementById('amterror').innerHTML="<p class=\"text text-success\">Budget Amount is within Available Balance <i class=\"fa fa-ok\"></i></p>";
                           
                  }
              }
      /*  document.getElementById("bamt").onblur =function (){    

    //number-format the user input
    this.value = parseFloat(this.value.replace(/,/g, ""))
                    .toFixed(2)
                    .toString()
                    .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}*/
</script>

  <?php include_once("config/footer.php"); 

if(isset($_POST['submit']))
{
  if(isset($_POST['bname']) && isset($_POST['binfo']) && isset($_POST['rname']) && isset($_POST['bamount']) ) {
    // Escape user inputs for security

        $bname = mysqli_real_escape_string($link, $_POST['bname']);
        $rname = mysqli_real_escape_string($link, $_POST['rname']);
        $binfo = mysqli_real_escape_string($link, $_POST['binfo']);
        $bamount = mysqli_real_escape_string($link, $_POST['bamount']);
        $oldbalance = _getuserfield('balance');
        $raddress = mysqli_real_escape_string($link, $_POST['raddress']);
        $rphone = mysqli_real_escape_string($link, $_POST['rphone']);
        $remail = mysqli_real_escape_string($link, $_POST['remail']);
        $date = date("Y-m-d H:i:s");
        $userid0 = _getuserfield('id');

    if(!empty($bname) && !empty($rname) && !empty($binfo) && !empty($bamount) ){
      if ($bamount > $oldbalance ) {
        echo '<script type="text/javascript">function hideMsg(){
            document.getElementById("alert_text1").style.visibility = "hidden"; }         document.getElementById("alert_text1").style.visibility = "visible";
           window.setTimeout("hideMsg()", 60000);
            </script>';
      } else {
                do{
                    $invoiceid = _invoiceid();
                    $query = "SELECT invoicenumber FROM budget_tbl WHERE invoicenumber='$invoiceid' ";
                    $query_run = mysqli_query($link, $query);
                    $numRowsCheck = mysqli_num_rows($query_run);
                 } while ( $numRowsCheck > 0);

                $newbalance = $oldbalance - $bamount;
                $result = _newBudget($userid0, $bname, $binfo, $bamount, $rname, $raddress, $remail, $rphone, $invoiceid, $date);
                $updatebalance = _updatebalance(_getuserfield('id'), $newbalance); 
                if ($result) {
                header("Location: invoice.php?id=$invoiceid");
                } else {
                echo '<script type="text/javascript">function hideMsg(){
            document.getElementById("alert_text").style.visibility = "hidden"; }         document.getElementById("alert_text").style.visibility = "visible";
           window.setTimeout("hideMsg()", 40000);
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
