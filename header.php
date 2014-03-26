<?php
/**
 * @package WordPress
 * @subpackage Base_Theme
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link href='http://fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,600,700,800,900' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); 
		wp_head(); ?>
	<script type="text/javascript" src="<?php echo TDU; ?>/js/jquery.flexslider.js" ></script>
	<script type="text/javascript" src="<?php echo TDU; ?>/js/jquery_002.js" ></script>
	<script type="text/javascript" src="<?php echo TDU; ?>/js/jquery_003.js" ></script>
	<script type="text/javascript" src="<?php echo TDU; ?>/js/jquery.main.js" ></script>
	<!--[if lt IE 9]>
		<script type="text/javascript" src="<?php echo TDU; ?>/js/html5.js"></script>
		<script type="text/javascript" src="<?php echo TDU; ?>/js/pie.js"></script>
		<script type="text/javascript" src="<?php echo TDU; ?>/js/init-pie.js"></script>
	<![endif]-->
	<!--[if lte IE 9]>
		<script type="text/javascript" src="<?php echo TDU; ?>/js/jquery.placeholder.min.js"></script>
		<script type="text/javascript">
			jQuery(function(){
				jQuery('input, textarea').placeholder();
			});
		</script>
	<![endif]-->
</head>
<body <?php body_class(); ?>>
	<div id="wrapper">
		<header id="header" class="cf">
			<div class="left">
				<img src="<?php echo TDU; ?>/images/img-member-isa.png" alt="image description">
				<div class="text">
					<a href="#"><strong>Servicing</strong> <br>metro and rural <br>locations</a>
				</div>
			</div>
			<?php if(is_front_page()): ?>
				<h1 class="logo"><a href="<?php echo home_url('/'); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
			<?php else: ?>
				<strong class="logo"><a href="<?php echo home_url('/'); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home"><?php bloginfo('name'); ?></a></strong>
			<?php endif; ?>
			<div class="contact-block">
				<h3>Contact Us</h3>
				<span>9317 3213</span>
				<span>0412 441 811</span>
				<a href="mailto:admin@treecarewa.com.au">admin@treecarewa.com.au</a>
			</div>
		</header>
		<h2 class="main-title">LARGE TREE SPECIALISTS</h2>
		<nav id="nav">
			<ul id="hover">
				<li><a href="#">Homepage</a></li>
				<li>
					<a href="#"><span>Our</span> Company</a>
					<div class="children">
						<div class="li"><a href="#">About Us</a></div>
						<div class="li"><a href="#">Our Vision</a></div>
						<div class="li">
							<a href="#">Organisational Structure</a>
							<div class="children2">
								<div class="li"><a href="#">About Us</a></div>
								<div class="li"><a href="#">Our Vision</a></div>
							</div>
						</div>
						<div class="li"><a href="#">Insurance</a></div>
					</div>
				</li>
				<li><a href="#"><span>Our</span> Equipment</a></li>
				<li><a href="#"><span>Our</span> Experience</a></li>
				<li><a href="#">Contact Us</a></li>
			</ul>
		</nav>