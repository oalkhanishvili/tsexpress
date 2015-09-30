	<header>
	<div class="header-top">
	<div class="logo">
		<img src="<?php echo base_url('images/logo.jpg'); ?>"/>
	</div>
	<nav>
		<ul>
			<?php
			$number = $this->page_model->show_pages();
			foreach ( $number as $page ): ?>
			<li><a href="<?php echo site_url('page/'.$page['id']);?>">
			<?php echo $page['menu_name'] ?></a></li>
			<?php endforeach; ?>
		</ul>
	</nav>
	</div>
	</header>