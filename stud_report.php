<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
  <?php require_once('api/config.php'); 
  
  if(isset($_GET['student_admission_no']) && isset($_GET['class_id'])){
    $adm_no = $_GET['student_admission_no'];
    $class_id = $_GET['class_id'];
  }
  $total_fee_paid = "SELECT sum(fee_paid) as total_fee_credit FROM `student_fee_record` WHERE student_adm_no= '$adm_no' ";
  $total_credit = mysqli_query($con, $total_fee_paid);

  $fee_rec = "SELECT receipt_no, payment_date, months, amount, concession, fee_paid, mode FROM `student_fee_record` WHERE student_adm_no= '$adm_no' ";
  $res_fee_rec = mysqli_query($con,$fee_rec);

  $query = "SELECT * FROM student as s, class as c WHERE s.student_admission_no = '$adm_no' AND c.class_id = '$class_id' ";
  $res = mysqli_query($con, $query);
  
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
            <h1 class="m-0">Student Report</h1>
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
            <?php
          while ($row = mysqli_fetch_assoc($res)) {
                // print_r($row);
              ?>
          <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <!-- <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle" src="dist/img/user4-128x128.jpg" alt="User profile picture">
                </div> -->

                <h2 class=" text-center"><?php echo $row['student_name']; ?></h2>

                <!-- <p class="text-muted text-center">Teacher 1</p> -->

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Class</b> <a class="float-right"><?php echo $row['class_title']; ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Father Name</b> <a class="float-right"><?php echo $row['student_father_name']; ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Address</b> <a class="float-right"><?php echo $row['student_address']; ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Contact No.</b> <a class="float-right"><?php echo $row['student_mobile']; ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Total Credit Amt</b> <a class="float-right"> <?php
          while ($fee_cr = mysqli_fetch_assoc($total_credit)) {
              echo $fee_cr['total_fee_credit']. ' INR';
          }
                // print_r($row);
              ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Total Balance</b> <a class="float-right">00</a>
                  </li>
                </ul>

                <a href="invoice.php?student_adm_no=<?php echo $row['student_admission_no']. '&class_id=' .$row['class_id'] ?>" class="btn btn-primary btn-block"><b>Pay Fee</b></a>
              </div>
              <!-- /.card-body -->
            </div>

          </div>

          <?php } ?>
          <!-- /.col-md-6 -->
          <div class="col-lg-9">
          <div class="card">
              <div class="card-header">
                <h3 class="card-title">All Transaction</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Receipt No.</th>
                    <th>Date</th>
                    <th>No. of Month</th>
                    <th>Amount</th>
                    <th>Concession</th>
                    <th>Amount Paid</th>
                    <th>Balance</th>
                    <th>Mode</th>
                    <!-- <th>Action</th> -->
                  </tr>
                  </thead>
                  <tbody>
                  <?php
          while ($rec_row = mysqli_fetch_assoc($res_fee_rec)) {
                // print_r($row);
              ?>
                  <tr>
                    <td><?php echo $rec_row['receipt_no']; ?> </td>
                    <td><?php echo $rec_row['payment_date']; ?> </td>
                    <td><?php echo $rec_row['months']; ?></td>
                    <td><?php echo $rec_row['amount']; ?></td>
                    <td><?php echo $rec_row['concession']; ?></td>
                    <td><?php echo $rec_row['fee_paid']; ?></td>
                    <td>avilable soon</td>
                    <td><?php echo $rec_row['mode']; ?></td>
                   <!--  <td ><a href="#" ><i class="fab fa-paypal">Pay</i></a></td> -->
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
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
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
