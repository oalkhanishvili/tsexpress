<?php

include 'class/tbcpay.lib.php';

use WeAreDe\TbcPay\TbcPayProcessor;


$Payment = new TbcPayProcessor( '/home/tsexpres/domains/tsexpress.ge/public_html/class/tbc.pem', 'dzroxuna90', $_SERVER['REMOTE_ADDR'] );
$amount = str_replace(',','.',$_POST['amount']);
$value = $amount*100;
$Payment->amount      = $value; // 1 = 1 tetri
$Payment->currency    = 981; // 981 = GEL
$Payment->description = $_POST['description'];
$Payment->language    = 'GE'; // Interface language

$start = $Payment->sms_start_transaction();

if ( isset($start['TRANSACTION_ID']) AND !isset($start['error']) ) {
    $trans_id = $start['TRANSACTION_ID'];
    $data = array(
        'user_id' => $_POST['user_id'],
        'debit' => $_POST['amount'],
        'transaction_id' => $trans_id,
        'comment' => $_POST['description'],
        'date' => date('Y-m-d H:i:s', time())
        );
    $this->db->insert('payment', $data);
}

?>


<html>
<head>
    <title>TBCPAY</title>
    <script type="text/javascript" language="javascript">
        function redirect() {
          document.returnform.submit();
        }
    </script>
</head>

<?php if ( isset($start['error']) ) { ?>

<body>
    <h2>Error:</h2>
    <h1><?php echo $start['error']; ?></h1>
</body>

<?php } elseif (isset($start['TRANSACTION_ID'])) { ?>

<body onLoad="javascript:redirect()">
    <form name="returnform" action="https://securepay.ufc.ge/ecomm2/ClientHandler" method="POST">
        <input type="hidden" name="trans_id" value="<?php echo $trans_id; ?>">

        <noscript>
            <center>Please click the submit button below.<br>
            <input type="submit" name="submit" value="Submit"></center>
        </noscript>
    </form>
</body>

<?php } ?>

</html>