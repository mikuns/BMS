  <?php include_once("config/header.php"); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-book"></i> Records
        <small>All Records</small>
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Your Page Content Here -->
   <div class="row">
   <div class="col-xs-12">
   <div class="box">
            <div class="box-header">
              <h3 class="box-title">Records</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Book Name</th>
                  <th>Author(s)</th>
                  <th>Category</th>
                  <th>Quantity</th>
                  <th>CD (Yes|No)</th>
                  <th></th>
                </tr>
                </thead>
                <tbody>

                 <?php
                    $count = 1;
                    $allbooks =  _getallrecords();
                    foreach ($allbooks as $bookrow) {

                    echo '<tr class="gradeX">
                    <td>'.$count.'</td>
                    <td>'.$bookrow['BOOK_NAME'].'</td>
                    <td>'.$bookrow['BOOK_AUTHORS'].'</td>
                    <td>'.$bookrow['BOOK_CATEGORY'].'</td>
                    <td>'.$bookrow['BOOK_QUANTITY'].'</td>
                    <td>'.$bookrow['BOOK_CD'].'</td>
                    <td><a href="bookpreview.php?ID='.$bookrow['ID'].'" class="btn btn-primary btn-mini"><i class="icon icon-edit"></i> View </a></td>

                    </tr>';
                    $count++;
                    }

                    ?> 
                </tbody>
                <tfoot>
                <tr>
                  <th>#</th>
                  <th>Book Name</th>
                  <th>Author(s)</th>
                  <th>Category</th>
                  <th>Quantity</th>
                  <th>CD (Yes|No)</th>
                  <th></th>
                </tr>
                </tfoot>
              </table>
            </div>
          </div>

   </div>
   </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php include_once("config/footer.php"); ?>