<?php
/**
 * @package WordPress
 * @subpackage Base_Theme
 */
?>

<?php get_header(); ?>
<?php 
	$options       = $GLOBALS['gcoptions']->getAllOptions(); 
	$about_us      = get_post(142); 
	$recently_work = get_term_by('id', 6, 'category');
	
	// =========================================================
	// WIDGETS
	// Print featured posts
	// =========================================================
	if(is_active_sidebar('front-page-sidebar')) dynamic_sidebar( 'front-page-sidebar' );
?>
<div class="main-home">
	<div class="scroll-banner">
		<?php echo getPostsScroll(); ?>		
	</div>
	<div class="posts-block cf">
		<article class="block">
			<h1><a href="<?php echo get_permalink($about_us->ID); ?>"><?php echo $about_us->post_title; ?></a></h1>
			<div class="entry-content">
				<?php echo getShort($about_us->post_content); ?>				
			</div>
		</article>
		<article class="block">
			<h1><a href="<?php echo get_category_link($recently_work->term_id); ?>"><?php echo $recently_work->name; ?></a></h1>
			<div class="entry-content">
				<h3>City East Alliance - Great Eastern Highway Widening</h3>
				<p><?php echo $recently_work->description; ?></p>
				<!-- <p>Tree Care were recently  awarded the contract to remove and prune all trees along Great Eastern Hwy between Kooyong Road &amp; Tonkin Hwy in Belmont as part of the Great Eastern Highway Major Widening Contract currently underway. Our methodical approach coupled with commitment to the safety of our employees has lead to these extremely complex works being completed on time and to an.....</p> -->
				<div class="cf">
					<a href="<?php echo get_category_link($recently_work->term_id); ?>" class="btn-more">view more</a>
				</div>
			</div>
		</article>
	</div>
	<div class="info-area cf">
		<div class="contact-box">
			<h2>Contact Us</h2>
			<div class="info">
				<span>Phone:</span>
				<strong><?php echo $options['phone']; ?></strong>
				<span>Email:</span>
				<strong><a href="mailto:<?php echo $options['email']; ?>"><?php echo $options['email']; ?></a></strong>
				<span>Afterhours:</span>
				<strong><?php echo $options['afterhours']; ?></strong>
			</div>
		</div>
		<div class="two-columns cf">
			<?php 
			wp_nav_menu( array(
				'container'      => '',
				'menu_id'        => 'column',
				'menu_class'     => 'column',
				'theme_location' => 'footer_left_menu'
				)); 
			wp_nav_menu( array(
				'container'      => '',
				'menu_id'        => 'column',
				'menu_class'     => 'column',
				'theme_location' => 'footer_right_menu'
				)); 
			?>				
		</div>
	</div>
</div>
<?php get_footer(); ?>