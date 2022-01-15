<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<?php require_once('api/config.php'); 

$query = "SELECT SUM(fee_paid) as all_time_collection FROM `student_fee_record`";
$res = mysqli_query($con,$query);
?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Fee Collection </title>

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

    <!-- Main Sidebar Container -->


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">ST. MARRY'S CONVENT SCHOOL NARWANA</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Starter Page</li>
              </ol>
            </div>
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->
      <div class="row text-center" style="margin-bottom: 30px;">
        <div class="col-lg-3">
        <a href="#">
          <div class="btn-group btn-group-toggle" data-toggle="buttons">
            <label class="btn btn-success text-center">
              <input type="radio" name="color_option" id="color_option_b1" autocomplete="off">
              <span class="text-lg">Today Collection</span>
              <br>
              00
            </label>
          </div>
        </a>
        </div>
        <div class="col-lg-3">
        <a href="#">
          <div class="btn-group btn-group-toggle" data-toggle="buttons">
            <label class="btn btn-primary text-center">
              <input type="radio" name="color_option" id="color_option_b3" autocomplete="off">
              <span class="text-lg">This Week Collection</span>
              <br>
              00
            </label>
          </div>
        </a>
        </div>
        <div class="col-lg-3">
        <a href="#">
          <div class="btn-group btn-group-toggle" data-toggle="buttons">
            <label class="btn btn-warning text-center">
              <input type="radio" name="color_option" id="color_option_b2" autocomplete="off">
              <span class="text-lg">This Month Collection</span>
              <br>
              00
            </label>
          </div>
        </a>
        </div>
        <div class="col-lg-3">
        <a href="#">
          <div class="btn-group btn-group-toggle" data-toggle="buttons">
            <label class="btn btn-danger text-center">
              <input type="radio" name="color_option" id="color_option_b3" autocomplete="off">
              <span class="text-lg">All Time Collection</span>
              <br>
              <?php
          while ($result = mysqli_fetch_assoc($res)) {
              echo $result['all_time_collection']. ' INR';
          }
                // print_r($row);
              ?>
            </label>
          </div>
        </a>
        </div>
      </div>

      <!-- Main content -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12">
            <?php
                        
                        $sql = "SELECT * FROM class where class_status = 1";
                        $res = mysqli_query($con, $sql);
                        $i=1;
                        while ($row = mysqli_fetch_assoc($res)) {
                           //print_r($row);
                        ?>
                <a class="btn btn-app" href="class_report.php?class_id=<?php echo $row['class_id']. '&class_title=' .$row['class_title']; ?>">
                  <span class="badge bg-success">Pending Amt</span>
                  <h5><?php echo $row['class_title']; echo " "; echo $row['class_section'];  ?></h5>
                  
                </a>
              <?php } ?>
            </div>
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
</body>

</html>