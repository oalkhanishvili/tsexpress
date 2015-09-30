
<aside>
<article>
		<div class="left-list-title">ნავიგაცია</div>
		<div class="list-group">
		<?php
		$navigation = $this->page_model->show_navigation();
		if ( $navigation ):
		foreach ( $navigation as $nav_list ):
		?>
		<a href="<?php echo site_url('navigation/'.$nav_list['id']);?>" class="list-group-item">
		<?php echo $nav_list['nav_name'];?></a>
		<?php endforeach; endif;?>
		</div>
	</article>
	<div class="user-login">
	<div class="login-title">მომხმარებელი</div>
	<div class="balance"><p><span>ბალანსზე:</span> <?php echo $user['balance']; ?> ლარი</p>
				<form action="<?php echo site_url('payment/start'); ?>" method="post">
					<input type="text" name="amount" placeholder="0.00"/>
					<input type="hidden" name="description" value="tanxis gadaxda TSG<?php echo str_pad($user['id'],5,'0',STR_PAD_LEFT);?>"/>
					<input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'] ?>"/>
					<button type="submit">შევსება</button>
				</form>
				</div>
			<form action="<?php echo site_url('user/logout'); ?>" method="post">
			<ul class="nav nav-pills nav-stacked">

				
				<li <?php if (stripos($_SERVER['REQUEST_URI'],'parcels') !== false) {echo 'class="active"';} ?>>
				<a href="<?php echo site_url('user/parcels/'); ?>">
				<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
				 ოთახი <span class="badge"><?php echo $number; ?></span></a></li>
				
				<li <?php if (stripos($_SERVER['REQUEST_URI'],'useredit') !== false) {echo 'class="active"';} ?>>
				<a href="<?php echo site_url('user/useredit/'); ?>">
				<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
				 რედაქტირება</a></li>
			</ul>
			<p><button type="submit">Logout</button></p>
			</form>

		
	</div>