<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<?php require_once('api/config.php'); ?>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Fee Collection</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<body class="layout-top-nav control-sidebar-slide-open" style="height: auto;">
  <div class="wrapper">

    <!-- Navbar -->
    <?php include('navbar.php'); ?>
    <!-- /.navbar -->

    <!-- Content Wrapper. Contains page content -->
    <div class="wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Fee Structure</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Fee Structure</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-3">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Fee Structure</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form>
                  <div class="card-body">
                    <div class="form-group">
                      <label>Select Class</label>
                      <select class="custom-select" id="class">
                        <option value="Common">All Classes</option>
                        <?php
                        
                        $sql = "SELECT * FROM class where class_status = 1";
                        $res = mysqli_query($con, $sql);
                        while ($row = mysqli_fetch_assoc($res)) {
                           //print_r($row);
                        ?>
                          <option value="<?php echo $row['class_id']; ?>"><?php echo $row['class_title']; ?></option>
                        <?php } ?>
                        <!-- <option>2</option> -->
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="title">Title</label>
                      <input type="text" class="form-control" id="title">
                    </div>
                    <div class="form-group">
                      <label for="amount">Amount</label>
                      <input type="number" class="form-control" id="amount" value=0>
                    </div>
                    <div class="form-group">
                      <label>Type </label>
                      <select class="custom-select" id="fund_type">
                        <option value="Monthly">Monthly</option>
                        <option value="Annual">Annual</option>
                      </select>
                    </div>
                  </div>
                  <!-- /.card-body -->

                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary" id="btn_fee_structure">Submit</button>
                  </div>
                </form>
              </div>

            </div>
            <!-- /.col-md-6 -->
            <div class="col-lg-9">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Details</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>S.No.</th>
                        <th>Title</th>
                        <th>Amount</th>
                        <th>Type</th>
                        <th>Classes</th>
                        <!-- <th>Action</th> -->

                      </tr>
                    </thead>
                    <tbody>
                    <?php
                        $i=1;
                        $sql = "SELECT * FROM fee_structure where fs_status = 1";
                        $res = mysqli_query($con, $sql);
                        while ($row = mysqli_fetch_assoc($res)) {
                           //print_r($row);
                        ?>
                        <tr>
                          <td><?php echo ($i++); ?></td>
                          <td><?php echo $row['title']; ?></td>
                          <td><?php echo $row['amount']; ?></td>
                          <td><?php echo $row['fund_type']; ?></td>
                          <td><?php echo $row['class']; ?></td>
                          <!-- <td>100</td> -->

                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
            </div>
            <!-- /.col-md-6 -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <?php include('footer.php'); ?>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->


  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- DataTables  & Plugins -->
  <script src="plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="plugins/jszip/jszip.min.js"></script>
  <script src="plugins/pdfmake/pdfmake.min.js"></script>
  <script src="plugins/pdfmake/vfs_fonts.js"></script>
  <script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="dist/js/demo.js"></script>
  <!-- Page specific script -->
  <script>
    // $(document).ready(function() {
    //   $ajax
    //   $("#fee_class").
    // })
  </script>
  <script>
    $(function() {
      $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>

<script>
  $("#btn_fee_structure").on("click",(e)=>{
  e.preventDefault();
  // const class_title = $("#class").val();
  // const class_section = $("#section").val();
  const data = {
    class : $("#class").val(),
    title: $("#title").val(),
    amount: $("#amount").val(),
    fund_type: $('#fund_type').val(),
}
$.ajax({
url:"api/fee_structure/add.php",
method: "POST",
data:JSON.stringify(data),
contentType: "application/json",
dataType: "json",
success: function(result) {
          console.log(result.success);
          const json = result;
          if (json.success) {
            swal("Good Job", "Added Successfully ", "success");
          } else swal({
            title: "Error Occured",
            text: json.error,
            icon: "error"
          });
          // console.info(json.success);
          // $(e).html(text);
        },
})
// alert();
})

</script>

</body>

</html>