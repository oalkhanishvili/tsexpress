<?php

include 'class/tbcpay.lib.php';

use WeAreDe\TbcPay\TbcPayProcessor;


$Payment = new TbcPayProcessor( '/home/tsexpres/domains/tsexpress.ge/public_html/class/tbc.pem', 'dzroxuna90', $_SERVER['REMOTE_ADDR'] );

if ( isset($_REQUEST['trans_id']) ) {
	$trans_id = $_REQUEST['trans_id'];
	$result   = $Payment->get_transaction_result( $trans_id );
}

?>


<html>
<head>
    <title>TBCPAY</title>
</head>

<body>
   <!--  <h2>Response:</h2>
    <?php echo date('m/d/Y h:i:s a', time()); ?>
    <?php print_r($trans_id); ?>
    <p><?php print_r( $result ); ?></p> -->
    <?php
    if ( $result['RESULT'] == 'OK' ){
    	$data = implode(':', $result);
    	$this->db->where('transaction_id', $trans_id);
    	$this->db->set('result',$data);
    	$this->db->set('ok', 1);
    	$this->db->update('payment');
    	// 
    	$query = $this->db->select('user_id,debit')
    		->where('transaction_id', $trans_id)
    		->get('payment');
		$row = $query->row_array();
		echo $row['user_id'];
		$query = $this->db->select('balance')
			->where('id', $row['user_id'])
			->get('users');
		if ( $query->num_rows() > 0 ){
			$result = $query->row();
			$update_amount = $result->balance + $row['debit'];
			$this->db->set('balance',$update_amount);
			$this->db->where('id', $row['user_id']);
			$this->db->update('users');
			return true;
		}
	 }elseif ( $result['RESULT'] == 'FAILED' || $result['RESULT'] == 'DECLINED'){
	 	$data = implode(':', $result);
    	$this->db->where('transaction_id', $trans_id);
    	$this->db->set('result',$data);
    	$this->db->set('ok', 1);
    	$this->db->update('payment');
	 }
	header("Location: http://tsexpress.ge/user/parcels");
	die();
     ?>
   
</body>
</html>