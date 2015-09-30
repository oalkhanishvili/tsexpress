<div class="corousel">
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">

<?php foreach ( $slider as $key => $item ): ?>
  <?php if ( $key == 0 ): ?>
<div class="item active">
<a href="<?php echo $item->link; ?>">
<img src="<?php echo base_url('uploads/'.$item->image); ?>" alt="...">
  
      <div class="carousel-caption">
        <h3><?php echo $item->title; ?></h3>
        <p><?php echo $item->description; ?></p>
      </div>
  </a>
</div>
  <?php else: ?>
<div class="item">
 <a href="<?php echo $item->link; ?>">
<img src="<?php echo base_url('uploads/'.$item->image); ?>" alt="...">
 
      <div class="carousel-caption">
        <h3><?php echo $item->title; ?></h3>
        <p><?php echo $item->description; ?></p>
      </div>
  </a>
</div>
<?php endif; ?>
<?php endforeach; ?>
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
</div>

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
		<form action="<?php echo site_url('user/login'); ?>" method="post">
			<input type="text" name="username" placeholder="username"/>
			<input type="password" name="password" placeholder="password"/>
			<p><button type="submit">შესვლა</button></p>
      <a href="<?php echo site_url('user/registration') ?>">რეგისტრაცია</a><br>
			<a href="<?php echo site_url('user/forgot_password') ?>">დაგავიწყდა პაროლი?</a>
		</form>
		
	</div>