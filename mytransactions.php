<?php include_once("config/header.php"); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-book"></i> TRANSACTIONS
        <small>TRANSACTIONS</small>
      </h1>
     
    </section>
    <div id="popup"> Transaction Deleted Successfully <i class="fa fa-check"></i> </div>

    <?php
    $userid0 = _getuserfield('id');
      if (isset($_GET['ID'])) {
      $theid = mysqli_real_escape_string($link, $_GET['ID']);
      $qry = "DELETE FROM budget_tbl WHERE invoicenumber = '$theid' AND userid = '$userid0' ";
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
              <h3 class="box-title">ALL TRANSACTIONS</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                <thead>
                <tr>
                <th>#</th>
                
                <th>Budget Name</th>
                <th>Budget Description</th>
                <th>Budget Amount</th>
                <th>Recipient Name</th>
                <th>Date</th>
                <th></th>
                <th></th>
                </tr>
                </thead>
                <tbody>
                <?php
                $count = 1;
                $userid1 = _getuserfield('id');
                $budget = _getmytransactions($userid1);
                
                foreach ($budget as $b_row) {

                echo '<tr class="gradeX">
                <td>'.$count.'</td>
                <td>'.$b_row['budgetname'].'</td>
                <td>'.$b_row['budgetdescription'].'</td>
                <td>&#8358 '.number_format($b_row['budgetamount']).'</td>
                <td>'.$b_row['recipientname'].'</td>
                <td>'.date("F j, Y, g:i a", strtotime($b_row['dated'])).'</td>
                <td><a href="invoice.php?id='.$b_row['invoicenumber'].'" class="btn btn-success btn-mini"><i class="fa fa-file"></i> View invoice</button></a></td>
                <td><a onClick="javascript: return confirm(\'ARE YOU SURE YOU WANT TO DELETE THIS TRANSACTION\');" href="mytransactions.php?ID='.$b_row['invoicenumber'].'"><button type="submit" class="btn btn-danger btn-mini"><i class="fa fa-remove"></i> Delete</button></a></td></tr>';
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