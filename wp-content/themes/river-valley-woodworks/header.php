<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="HandheldFriendly" content="True">
<meta name="MobileOptimized" content="320">  
<meta name="viewport" content="width=device-width, initial-scale=1.0, target-densitydpi=160">

<meta charset="<?php bloginfo( 'charset' ); ?>" />

<title><?php wp_title(''); ?></title>

<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>" />
<!-- <link href='http://fonts.googleapis.com/css?family=Abel' rel='stylesheet' type='text/css'> -->
<link href='http://fonts.googleapis.com/css?family=Magra:400,700' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic' rel='stylesheet' type='text/css'>

<!--[if IE 9]>
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/ie9.css" />
<![endif]-->
<!--[if lt IE 9]>
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/ie8.css" />
<![endif]-->

<?php wp_head(); ?>

<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.timer.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/global.js"></script>


</head>

<body <?php body_class(); ?>>


<div id="header" class="wrapper">
	<div class="center">
			<div class="header-container">
					<div class="logo">
						<a href="<?php echo home_url( '/' ); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/logo-rvw.png" alt="River Valley Woodworks Logo" /></a>
					</div>
					<div class="main-menu"><?php  wp_nav_menu( array( 'menu' => 'main_menu' ) );?></div>
					<div class="clear"></div>
			</div>
	</div>
</div>

