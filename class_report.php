<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<?php require_once('api/config.php'); 
 require_once('function.php');

if(isset($_GET['class_id']))
{
  $class_id = $_GET['class_id'];
}

?>
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

    <!-- Main Sidebar Container -->


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Class Report</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Starter Page</li>
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
              <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                  <!-- <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle" src="dist/img/user4-128x128.jpg" alt="User profile picture">
                </div> -->

                  <h2 class=" text-center">Class 10th A</h2>

                  <!-- <p class="text-muted text-center">Teacher 1</p> -->

                  <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                      <b>Admission Fee</b> <a class="float-right">20000</a>
                    </li>
                    <li class="list-group-item">
                      <b>Total Students</b> <a class="float-right">543</a>
                    </li>
                    <li class="list-group-item">
                      <b>Total Fee</b> <a class="float-right">13,28700</a>
                    </li>
                    <li class="list-group-item">
                      <b>Total Paid</b> <a class="float-right">13,2870</a>
                    </li>
                    <li class="list-group-item">
                      <b>Total Balance</b> <a class="float-right">13,2087</a>
                    </li>
                  </ul>

                  <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
                </div>
                <!-- /.card-body -->
              </div>

            </div>
            <!-- /.col-md-6 -->
            <div class="col-lg-9">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">All Students</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Adm. No.</th>
                        <th>Name</th>
                        <th>Father Name</th>
                        <th>Mobile No.</th>
                        <th>Monthly Fee</th>
                        <th>Total Fee</th>
                        <th>Paid</th>
                        <th>Balance</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php

                      $sql = "SELECT * FROM student where student_status = 1 and student_class_id = $class_id ";
                      $res = mysqli_query($con, $sql);
                      $i = 1;
                      while ($row = mysqli_fetch_assoc($res)) {
                        //print_r($row);
                      ?>
                        <tr>
                          <td><?php echo $row['student_admission_no']; ?></td>
                          <td><?php echo $row['student_name']; ?></td>
                          <td><?php echo $row['student_father_name']; ?></td>
                          <td><?php echo $row['student_mobile']; ?></td>
                          <td><?php 
                          $query = "SELECT SUM(amount) as amount FROM fee_structure where class = $class_id or class = 'Common' ";
                          $result = mysqli_query($con, $query);
                          $monthly_fee = mysqli_fetch_assoc($result)['amount'];
                          echo $monthly_fee;
                          ?></td>
                          <td><?php echo ($monthly_fee* (cal_month() + 1) ) ?></td>
                          <td><?php echo ("Pending") ?></td>
                          <td><?php echo ("Pending") ?></td>
                          <td><a href="stud_report.php?student_admission_no=<?php echo $row['student_admission_no']. '&stu_name=' . $row['student_name']. '&class_id=' .$class_id ; ?>"><i class="fab fa-paypal">Pay</i></a></td>
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