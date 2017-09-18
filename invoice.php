 <?php include_once("config/header.php"); 
if (isset($_GET['id'])) {
   $invoiceno = mysqli_real_escape_string($link, $_GET['id']);

   $query = "SELECT * FROM budget_tbl WHERE invoicenumber='$invoiceno' ";
   $query_run = mysqli_query($link, $query);
   if ($brow = mysqli_fetch_assoc($query_run)) {
             
      $budgetname = $brow['budgetname'];
      $budgetdescription = $brow['budgetdescription'];
      $budgetamount = $brow['budgetamount'];
      $recipientname = $brow['recipientname'];
      $recipientaddress = $brow['recipientaddress'];
      $recipientemail = $brow['recipientemail'];
      $recipientphone = $brow['recipientphone'];
      $invoicenumber = $brow['invoicenumber'];
      $dated = $brow['dated'];
    }
  }
 ?>
 
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Invoice
        <small>#<?php echo $invoicenumber; ?></small>
      </h1>
    </section>

    <div class="pad margin no-print">
      <div class="callout callout-info" style="margin-bottom: 0!important;">
        <h4><i class="fa fa-info"></i> Note:</h4>
        This is the Invoice for the Budget: <strong> <?php echo strtoupper($budgetname); ?> </strong>
      </div>
    </div>

    <!-- Main content -->
    <section class="invoice" >
      <!-- title row -->
      <div id="printsection">
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> BUDGET NAME: <?php echo strtoupper($budgetname); ?>
            <small class="pull-right">Date: <?php echo $dated; ?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-6 invoice-col">
          From:
          <address>
            <strong><?php echo _getuserfield('firstname')." "._getuserfield('lastname'); ?></strong><br>
            <?php echo _getuserfield('position'); ?><br>
            Phone: <?php echo _getuserfield('phone'); ?><br>
            Email: <?php echo _getuserfield('email'); ?>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-6 invoice-col">
          To (Recipient):
          <address>
            <strong><?php echo ucfirst($recipientname); ?></strong><br>
            Recipient Address: <?php echo $recipientaddress; ?><br>
            Recipient Phone: <?php echo $recipientphone; ?><br>
            Recipient Email: <?php echo $recipientemail; ?>
          </address>
        </div>
      
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">
          <p class="lead">Budget Desciption:</p>
          
          <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
            <?php echo $budgetdescription; ?>
          </p>
        </div>
        <!-- /.col -->
        <div class="col-xs-6">
          <p class="lead">Budget Amount</p>

          <div class="table-responsive">
            <table class="table">
              <tr>
                <th style="width:50%">Total:</th>
                <td style="font-weight: bold;">&#8358 <?php echo number_format($budgetamount); ?></td>
              </tr>
            </table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      </div>
      <!-- /.row -->

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <button type="button" class="btn btn-primary pull-right" id="print1" " onclick="printpage()" style="margin-right: 5px;">
            <i class="fa fa-print"></i> Print
          </button>
        </div>
      </div>
    </section>
    <!-- /.content -->
    <div class="clearfix" ></div>
  </div>
  <!-- /.content-wrapper -->
 <script type="text/javascript">     
 //Print Page 
    function printpage(){
        var prtContent = document.getElementById("printsection");
        var WinPrint = window.open('', '', 'left=0,top=10,width=900,height=1000,toolbar=0,scrollbars=0,status=0');
        WinPrint.document.write('<html><head>');
        WinPrint.document.write('<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">');
        WinPrint.document.write('<link rel="stylesheet" href="dist/css/AdminLTE.min.css">');
        WinPrint.document.write(' <link rel="stylesheet" href="dist/css/style.css">');
        WinPrint.document.write(' <link rel="stylesheet" href="dist/css/skins/skin-purple.min.css">');
        WinPrint.document.write(' <link href="plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">');
        WinPrint.document.write('</head><body style="margin: 10px;" onload="print();close();">');
        WinPrint.document.write(prtContent.innerHTML);
        WinPrint.document.write('</body></html>');
        WinPrint.document.close();
        WinPrint.focus();
    };
 </script> 

<?php include_once("config/footer.php"); ?>