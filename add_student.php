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
              <h1 class="m-0">Students</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Students</li>
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
              <div class="card card-success">
                <div class="card-header">
                  <h3 class="card-title"><i class="fas fa-plus"> Add Student</i></h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form>
                  <div class="card-body">
                    <div class="form-group">
                      <label for="adm_no">Adm. No.</label>
                      <input type="number" class="form-control" id="adm_no" placeholder="Enter Admission No.">
                    </div>
                    <div class="form-group">
                      <label for="name">Name</label>
                      <input type="text" class="form-control" id="name" placeholder="Enter Name">
                    </div>
                    <div class="form-group">
                      <label for="father_name">Father Name</label>
                      <input type="text" class="form-control" id="father_name" placeholder="Enter Father Name">
                    </div>
                    <div class="form-group">
                      <label>Select Gender</label>
                      <select class="custom-select" id="gender">
                        <option>Male</option>
                        <option>Female</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Select Class</label>
                      <select class="custom-select" id="class">
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
                    <!-- <div class="form-group">
                        <label>Select Section</label>
                        <select class="custom-select">
                          <option>A</option>
                          <option>B</option>
                          <option>C</option>
                          <option>D</option>
                          <option>E</option>
                        </select>
                  </div> -->
                    <div class="form-group">
                      <label for="address">Address</label>
                      <input type="text" class="form-control" id="address" placeholder="Enter Address">
                    </div>
                    <div class="form-group">
                      <label for="mob_no">Mobile No.</label>
                      <input type="text" class="form-control" id="mob_no" placeholder="Enter Mobile No.">
                    </div>

                  </div>
                  <!-- /.card-body -->

                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary" id="btn_add_student">Add Student</button>
                  </div>
                </form>
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
                        <th>Gender</th>
                        <th>Class</th>
                        <th>Section</th>
                        <th>Mob. No.</th>
                        <th>Address</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php

                      $sql = "SELECT * FROM student as s, class as c where student_status = 1 AND s.student_class_id = c.class_id";
                      $res = mysqli_query($con, $sql);
                      $i = 1;
                      while ($row = mysqli_fetch_assoc($res)) {
                        //print_r($row);
                      ?>

                        <tr>
                          <td><?php echo $row['student_admission_no'] ?> </td>
                          <td><?php echo $row['student_name'] ?></td>
                          <td><?php echo $row['student_father_name'] ?></td>
                          <td><?php echo $row['student_gender'] ?></td>
                          <td><?php echo $row['class_title'] ?></td>
                          <td><?php echo $row['class_section'] ?></td>
                          <td><?php echo $row['student_mobile'] ?></td>
                          <td><?php echo $row['student_address'] ?></td>
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

    <!-- Control Sidebar -->

    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <?php include('footer.php') ?>
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
  <script>
    $("#btn_add_student").on("click", (e) => {
      e.preventDefault();
      // const class_title = $("#class").val();
      // const class_section = $("#section").val();
      const data = {
        student_name: $("#name").val(),
        student_father_name: $("#father_name").val(),
        student_admission_no: $("#adm_no").val(),
        student_gender: $("#gender").val(),
        student_class_id: $("#class").val(),
        student_address: $("#address").val(),
        student_mobile: $("#mob_no").val()
      }
      $.ajax({
        url: "api/students/add.php",
        method: "POST",
        data: JSON.stringify(data),
        contentType: "application/json",
        dataType: "json",
        success: function(result) {
          console.log(result.success);
          const json = result;
          if (json.success) {
            swal("Good Job", "Student Added", "success");
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