<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/reset.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('css/bootstrap.css'); ?>">

<!-- Optional theme -->
<link rel="stylesheet" href="<?php echo base_url('css/bootstrap-theme.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/style.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('fonts/font-awesome.min.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('fonts/fonts.css');?>">


	<title>tsexpress ამანათები და ტვირთები ჩინეთიდან</title>
	<meta name="description" content="ამანათები ჩინეთიდან,ტვირთები ჩინეთიდან,საზღვაო და საჰაერო ტვირთები,საავტომობილო ტვირთები" />
	<meta name="keywords" content="ამანათები,ტვირთები,საჰაერო გადაზიდვა,ექსპრესი" />
	<meta property="og:title" content="&quot;tsexpress&quot; - ამანათები ჩინეთიდან" /> 
	<meta property="og:image" content="http://tsexpress.ge/uploads/banner11.png" />
	<meta property="og:description" content="ტვირთების ჩამოტანა ჩინეთიდან ყველაზე სწრაფად საზღვაო,საჰაერო და სახმელეთო გადაზიდვები" />

</head>
<body>
<div class="se-pre-con"></div>
<header>
	<div class="header-top">
	<!-- <div class="logo">
		<img src="<?php echo base_url('images/logo.png'); ?>" height="100"/>
	</div> -->
	</div>
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
  <div class="navbar-header">
      <a class="navbar-brand" href="<?php echo site_url(); ?>">
      	<?php echo file_get_contents(base_url('images/logo.svg')); ?>

      </a>
		<div>TSEXPRESS</div>

  </div>
   <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
      	</li>
        <li><a href="<?php echo site_url(); ?>">მთავარი</a></li>
        <?php
			$number = $this->page_model->show_pages();
			foreach ( $number as $page ): ?>
        <li <?php if (stripos($_SERVER['REQUEST_URI'],'page/'.$page['id']) !== false) {echo 'class="active"';} ?>><a href="<?php echo site_url('page/'.$page['id']);?>" ><?php echo $page['menu_name'] ?></a></li>
       <?php endforeach; ?>
      </ul>
      </div>

		</div>
	</nav>
	
	</header>
	<div class="container">

