<article>
<div class="reisebi">
<div class="list-group">
	<div class="reisebi-title">რეისები</div>
	<?php 
	$hashmap = array(
		'm' => 'მიღებულია',
		'g' => 'გამოგზავნილია',
		'c' => 'ჩამოსულია',
		'a' => 'არქივი'
	); 
	$freight = array();
	foreach ( $schelude as $key => $items ):
		if ($key == 4){break;}
		if ( in_array($items['freight'],$freight) ){
			continue;
		}
		$freight[] = $items['freight']; ?>
		<?php  ?>
		<a class="list-group-item">
			<h4 class="list-group-item-heading">
			<?php echo $items['freight'];?></h4>
			<p class="list-group-item-text">
			<span class="glyphicon glyphicon-calendar" aria-hidden="true">&nbsp;</span><?php echo $items['send_date'];?><br>
			<span class="glyphicon glyphicon-plane" aria-hidden="true">&nbsp;</span><?php echo $hashmap[$items['status']]; ?>
			 </p>
		</a>

	<?php endforeach; ?>
</div>
</div>
</article>
<div class="banner">
<a href="http://taobao.com" target="_blanck"><img src="<?php echo base_url('images/taobao.jpg'); ?>"></a>
	<div class="target">
	<p>მსოფლიოში ყველაზე დიდი ონლაინ მაღაზია</p>
	</div>
</div>
<div class="banner">
<a href="http://www.clothing-dropship.com/" target="_blanck"><img src="<?php echo base_url('images/dropship.jpg'); ?>"></a>
	<div class="target">
	<p>ყველაზე იაფად ტანსაცმელი</p>
	</div>
</div>

	</aside>