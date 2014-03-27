<?php
/**
 * @package WordPress
 * @subpackage Base_Theme
 */
?>
<?php $options = $GLOBALS['gcoptions']->getAllOptions(); ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<title><?php echo getTitle(); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link href='http://fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,600,700,800,900' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); 
		wp_head(); ?>
	<script type="text/javascript" src="<?php echo TDU; ?>/js/jquery.flexslider.js" ></script>
	<script type="text/javascript" src="<?php echo TDU; ?>/js/jquery_002.js" ></script>
	<script type="text/javascript" src="<?php echo TDU; ?>/js/jquery_003.js" ></script>
	<script type="text/javascript" src="<?php echo TDU; ?>/js/jcarousel.js" ></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
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
					<a href="<?php bloginfo('url'); ?>"><strong>Servicing</strong> <br>metro and rural <br>locations</a>
				</div>
			</div>
			<?php if(is_front_page()): ?>
				<h1 class="logo"><a href="<?php echo home_url('/'); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
			<?php else: ?>
				<strong class="logo"><a href="<?php echo home_url('/'); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home"><?php bloginfo('name'); ?></a></strong>
			<?php endif; ?>
			<div class="contact-block">
				<h3>Contact Us</h3>
				<span><?php echo $options['phone']; ?></span>
				<span><?php echo $options['afterhours']; ?></span>
				<a href="mailto:<?php echo $options['email']; ?>"><?php echo $options['email']; ?></a>
			</div>
		</header>
		<h2 class="main-title">LARGE TREE SPECIALISTS</h2>
		<nav id="nav">
			<?php 
			wp_nav_menu( array(
				'container'      => '',
				'menu_id'        => 'hover',
				'theme_location' => 'primary_nav',
				'walker'		 => new CustomWalker
				)); 
			?>	
		</nav>
	