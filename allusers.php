<?php include_once("config/header.php"); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-book"></i> STAFF
        <small>STAFF LIST</small>
      </h1>
     
    </section>
    <div id="popup"> Staff Deleted Successfully <i class="fa fa-check"></i> </div>

    <?php
    $authl = _getuserfield('auth_level');
      if (isset($_GET['ID'])) {
      $theid = mysqli_real_escape_string($link, $_GET['ID']);
      $qry = "DELETE FROM users_tbl WHERE id = '$theid' AND auth_level = 1 ";
      $qry_run = mysqli_query($link, $qry) or die(mysqli_error($link));
      if(mysqli_affected_rows($link) > 0 ){
        echo '<script type="text/javascript">function hideMsg(){
                     document.getElementById("popup").style.visibility = "hidden"; }         document.getElementById("popup").style.visibility = "visible";
                       document.getElementById("popup").style.visibility = "visible";
                       window.setTimeout("hideMsg()", 4000);
                        </script>';
      } else {}
   }
   ?>

    <!-- Main content -->
    <section class="content">

      <!-- Your Page Content Here -->
   <div class="row">
   <div class="col-xs-12">
   <div class="box">
            <div class="box-header">
              <h3 class="box-title">STAFF LIST</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                <thead>
                <tr>
                <th>#</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Job Title</th>
                <th>Allocated Amount</th>
                <th>Balance</th>
                <th></th>
                <th></th>
                </tr>
                </thead>
                <tbody>
                <?php
                $count = 1;
                $users =  _getallusers();
                foreach ($users as $p_row) {

                echo '<tr class="gradeX">
                <td>'.$count.'</td>
                <td>'.$p_row['firstname'].'</td>
                <td>'.$p_row['lastname'].'</td>
                <td>'.$p_row['email'].'</td>
                <td>'.$p_row['phone'].'</td>
                <td>'.$p_row['position'].'</td>
                <td> &#8358 '.number_format($p_row['allocated_amount']).'</td>
                <td> &#8358 '.number_format($p_row['balance']).'</td>
                <td><a href="userprofile.php?id='.$p_row['id'].'" class="btn btn-success btn-mini"><i class="fa fa-user"></i> View Profile</button></a></td>
                <td><a onClick="javascript: return confirm(\'ARE YOU SURE YOU WANT TO DELETE THIS STAFF\');" href="allusers.php?ID='.$p_row['id'].'"><button type="submit" class="btn btn-danger btn-mini"><i class="fa fa-remove"></i> Delete</button></a></td></tr>';
                $count++;
                }

                ?>    
                </tbody>
              </table>
            </div>
          </div>
        </div>
        </div>
      </section>

</div>


<?php include_once("config/footer.php"); ?>   