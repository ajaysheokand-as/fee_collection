<html>
<?php if (!isset($_GET['orderid'])) die('missing somethin'); ?>

<head>
    <title>Show Payment Page</title>

</head>

<body>
    <center>
        <h1>Please do not refresh this page...</h1>
    </center>
    <form method="post" action="https://securegw-stage.paytm.in/theia/api/v1/initiateTransaction?mid=<?php echo $_GET['mid']; ?>&orderId=<?php echo $_GET['orderid']; ?>" name="paytm">
        <table border="1">
            <tbody>
                <input type="hidden" name="mid" value="<?php echo $_GET['mid']; ?>">
                <input type="hidden" name="orderId" value=" <?php echo $_GET['orderid']; ?>">
                <input type="hidden" name="txnToken" value=" <?php echo $_GET['txnToken']; ?>">
            </tbody>
        </table>
        <script type="text/javascript">
            document.paytm.submit();
        </script>
    </form>
</body>

</html>