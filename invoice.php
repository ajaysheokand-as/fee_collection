<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<?php
require_once('api/config.php');
require_once('function.php');
if (isset($_GET['student_adm_no']) && isset($_GET['class_id'])) {
  $adm_no = $_GET['student_adm_no'];
  $class_id = $_GET['class_id'];
}
$recepit_no = "SELECT receipt_no FROM student_fee_record ORDER BY receipt_no DESC LIMIT 1";
$res_rec_no = mysqli_query($con, $recepit_no);
// print_r($res_rec_no);
$query = "SELECT * FROM student s, class c WHERE s.student_admission_no = '$adm_no' AND c.class_id = '$class_id' ";
$res = mysqli_query($con, $query);
// print_r($res);
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
              <h1 class="m-0">Invoice</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Invoice</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->
      <!-- Main content -->
      <?php
      while ($row = mysqli_fetch_assoc($res)) {
        //print_r($row);
        $orderid =  $adm_no . date('ymdHis');
        $student_id =  $row['student_id'];
      ?>
        <div class="content">
          <div class="container">
            <div class="row">
              <div class="col-12">
                <!-- Main content -->
                <div class="invoice p-3 mb-3">
                  <!-- title row -->
                  <div class="row">
                    <div class="col-6">
                      <h4>
                        <i class="fas fa-file-invoice"></i> Receipt No. <span id="receipt_no"> <?php
                                                                                                if (mysqli_num_rows($res_rec_no) < 1) echo $r_no = 1;
                                                                                                else
                                                                                                  echo $r_no = mysqli_fetch_assoc($res_rec_no)['receipt_no'] + 1; ?> </span>
                        <small class="float-right"> Date: <?php $date = date('d-m-Y');
                                                          echo $date; ?></small>
                      </h4>
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- info row -->
                  <div class="row invoice-info">
                    <div class="col-sm-5 invoice-col">
                      From
                      <address>
                        <strong>St. Mary's Convent School</strong><br>
                        Narwana (Jind)<br>
                        Phone: (804) 123-5432<br>
                        Email: school@gmail.com
                      </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                      To
                      <address>
                        <strong><?php echo $row['student_name']; ?></strong><br>
                        F.Name: <?php echo $row['student_father_name']; ?><br>
                        Class : <?php echo $row['class_title']; ?><br>
                        Adm. No.: <?php echo $row['student_admission_no']; ?><br>
                      </address>
                    </div>
                    <!-- /.col -->
                    <!-- <div class="col-sm-4 invoice-col">
                  <b>Invoice #007612</b><br>
                  <br>
                  <b>Payment Due:</b> 2/22/2014<br>
                  <b>Account:</b> 968-34567
                </div> -->
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->

                  <!-- Table row -->
                  <div class="row">
                    <div class="col-12 table-responsive">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th>S.No.</th>
                            <th>Particulars</th>
                            <th>Amount</th>
                            <!-- <th>Concession</th> -->
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $i = 1;
                          $total_amount = 0;
                          $total_month = cal_month('2021-06-05') + 1;
                          $sql = "SELECT title, amount FROM fee_structure where class = '$class_id' or class = 'common' ";
                          $result = mysqli_query($con, $sql);
                          while ($row_fs = mysqli_fetch_assoc($result)) {
                            //print_r($row);
                            $total_amount += $row_fs['amount'];
                          ?>
                            <tr>
                              <td><?php echo $i++ ?></td>
                              <td><?php echo $row_fs['title']; ?></td>
                              <td id="fee_amount"><?php echo $row_fs['amount']; ?></td>
                              <!-- <td>00</td> -->
                            </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->

                  <div class="row">
                    <!-- accepted payments column -->
                    <!-- <div class="col-6">
                 
                </div> -->
                    <!-- /.col -->
                    <div class="col-6">

                      <div class="table-responsive">
                        <table class="table">
                          <tbody>
                            <tr>
                              <th style="width:50%">Monthly Fee:</th>
                              <td id="monthly_fee"><?php echo $total_amount;  ?></td>
                            </tr>
                            <tr>
                              <th style="width:50%">Subtotal:</th>
                              <td id="subtotal"><?php echo $total_amount = $total_amount * (cal_month() + 1);  ?></td>
                            </tr>
                            <tr>
                              <th>Change Duration</th>
                              <td><input type="date" id="end_date"></td>
                            </tr>
                            <tr>
                              <th>Concession</th>
                              <td><input type="number" id="concession" value="0" ?></td>
                            </tr>
                            <tr>
                              <th>Fee Paid</th>
                              <td id="fee_paid"><?php echo $total_amount; ?></td>
                            </tr>
                            <tr>
                              <th>Fee Month</th>
                              <td id="month"> <?php echo month_name(); ?> - <span id="end_month_name"> <?php echo month_name($today) ?> </span> (Month - <span id="month_no"><?php echo cal_month() + 1; ?></span>) </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->

                  <!-- this row will not appear when printing -->
                  <div class="row no-print">
                    <div class="col-12">
                      <a href="#" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                      <button type="button" class="btn btn-success float-right" id="cash_payment"><i class="far fa-credit-card"></i> Pay Cash </button>
                      <!-- <a href="./PayU/PayU.php?adm_no=<?php echo $adm_no; ?>&recepit_no=<?php echo $r_no; ?>"> -->
                      <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;" id="online_payment">
                        <i class="fas fa-credit-card"></i> Pay Online
                      </button>

                      <!-- </a> -->
                    </div>
                  </div>
                </div>
                <!-- /.invoice -->
              </div><!-- /.col -->
            </div>
          </div><!-- /.container-fluid -->
        </div>
      <?php } ?>
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

  <script>
    function get_date(start_date, end_date) {
      $.ajax({
        url: "api/date/get_month_diff.php",
        method: "POST",
        data: JSON.stringify({
          start_date: start_date,
          end_date: end_date
        }),
        contentType: "application/json",
        dataType: "json",
        success: function(result) {
          console.log(result);
          const json = result;
          if (json.success) {
            // swal("Good Job", " Class Added", "success");
            $('#end_month_name').html(json.data.end_month);
            $('#month_no').html(json.data.month_diff);
            const month_no = json.data.month_diff;
            const total_fee = $('#monthly_fee').html();
            cal_fee(total_fee, month_no);
          } else swal({
            title: "Error Occured",
            text: json.error,
            icon: "error"
          });
          // console.info(json.success);
          // $(e).html(text);
        },
      })
    }

    function cal_fee(fee, months) {
      const total_fee = fee * months;
      $('#subtotal, #fee_paid').html(total_fee);
    }

    $('#concession').on('input', () => {
      let concession = $('#concession').val();
      let sub_total = $('#subtotal').html();
      let fee_paid = sub_total - concession;
      $('#fee_paid').html(fee_paid);

    })

    $('#end_date').on('change', () => {

      get_date('2021-03-01', $('#end_date').val());

    })
  </script>

  <script>
    $("#cash_payment").on("click", (e) => {
      e.preventDefault();
      const student_adm_no = <?php echo $adm_no; ?>;
      const receipt_no = $("#receipt_no").html();
      const subtotal = $("#subtotal").html();
      const concession = $("#concession").val();
      const fee_paid = $("#fee_paid").html();
      const month = $("#month_no").html();
      const mode = "Cash";
      const data = {
        student_adm_no: student_adm_no,
        receipt_no: receipt_no,
        subtotal: subtotal,
        concession: concession,
        fee_paid: fee_paid,
        month: month,
        mode: mode,
      }
      $.ajax({
        url: "api/fee_record/add.php",
        method: "POST",
        data: JSON.stringify(data),
        contentType: "application/json",
        dataType: "json",
        success: function(result) {
          console.log(result.success);
          const json = result;
          if (json.success) {
            swal("Good Job", " Fee Submitted Successfully", "success");
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
      // location.reload();
    })
  </script>

  <script>
    $("#online_payment").on("click", (e) => {
      e.preventDefault();
      const mid = "OgdBig44888892307561";
      const order_id = "";
      const amount = 10;
      $.ajax({
        method: "POST",
        url: "api/paytm/initiate.php",
        dataType: "json",
        contentType: "application/json",
        data: JSON.stringify({
          student_id: <?php echo $student_id; ?>,
          MID: mid,
          order_id: order_id,
          amount: amount,
        }),
        success: function(response) {
          if (response.success) {
            res_array = ({
              student_id: <?php echo $student_id; ?>,
              adm_no: <?php echo $adm_no; ?>,
              orderid: <?php echo $orderid; ?>,
              amt: 10,
              ...response
            });
            console.log(res_array);

            savePaymentRequest(res_array);
            // alert(window.location.href = `./paymentInitiate.php?mid=${mid}&orderid=${order_id}&txnToken=${response.txnToken}`);
          } else alert(response.error)
        }
      });
    });

    function savePaymentRequest(data) {
      if (data == null) return;
      $.ajax({
        url: './api/paytm/savePaymentRequest.php',
        method: 'POST',
        data: JSON.stringify(data),
        contentType: 'application/json',
        dataType: 'json',
        success: (res) => {
          console.log(res);
        }

      })
    }
  </script>

</body>

</html>