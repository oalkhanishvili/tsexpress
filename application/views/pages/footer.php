	</div>
	<footer>

		<ul class="footer">
			<li><img src="<?php echo base_url('images/facebook56.svg'); ?>" height="13"> <a href="http://facebook.com/tsexpress.ge" target="_blank">facebook.com/tsexpress.ge</a></li>
			<li><img src="<?php echo base_url('images/facebook56.svg'); ?>" height="13"> <a href="https://www.facebook.com/pages/Tranport-Service-group-%E1%83%A2%E1%83%A0%E1%83%90%E1%83%9C%E1%83%A1%E1%83%9E%E1%83%9D%E1%83%A0%E1%83%A2-%E1%83%A1%E1%83%94%E1%83%A0%E1%83%95%E1%83%98%E1%83%A1-%E1%83%AF%E1%83%92%E1%83%A3%E1%83%A4%E1%83%98/456012241240248?fref=ts" target="_blank">facebook.com/tsgeoline</a></li>
			<li><span class="glyphicon glyphicon-earphone"  aria-hidden="true"></span> +995(322) 19 22 42</li>
			<li><span class="glyphicon glyphicon-envelope"></span> info@tsexpress.ge</li>
			<li><span class="glyphicon glyphicon-copyright-mark"></span> შ.პ.ს ტრანსპორტ სერვის ჯგუფი</li>
			<li> skype:tsexpress1</li>
		</ul>
	</footer>
<script src="<?php echo base_url('/js/geo.js');?>" mce_src="<?php echo base_url('/js/geo.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('/js/jquery-2.1.4.min.js');?>"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>
<script src="<?php echo base_url('/js/bootstrap.js');?>" mce_src="<?php echo base_url('/js/bootstrap.js');?>" type="text/javascript"></script>
<?php 
// ვალუტის ავტომატური API
// $json = file_get_contents("http://currency.any.ge/api.php?info=yvela");
// $result = json_decode($json,true); 
// $cur =  round($result['currency'][9]['cur_value'],4);

$query = $this->db->select('*')
	->get('curency');
$cur = $query->row_array();

?>
<script>
   var param = "<?php echo $cur['cur']; ?>";
</script>
<script type="text/javascript" src="<?php echo base_url('/js/my_script.js');?>"></script>
</body>
</html>