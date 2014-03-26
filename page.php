<?php
/**
 *
 * @package WordPress
 * @subpackage Base_Theme
 */
?>
<?php get_header(); ?>

<div class="visual">
	<img src="<?php echo TDU; ?>/images/img-visual.jpg" alt="image description">
</div>
<div id="main">
	<article id="content">
<?php while ( have_posts() ) : the_post(); ?>
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<div class="entry-content cf">
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'theme' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
		</div>
<?php endwhile; ?>
	</article>
	<div class="footer-area">
		<h2>Available Equipment</h2>
		<div class="equipment-columns cf">
			<ul class="column">
				<li><a href="#">Sub Division Clearing</a></li>
				<li><a href="#">21 Tonne Excavator with Grapples &amp; Hydraulic Shears</a></li>
				<li><a href="#">Track Loaders with Log Grabs</a></li>
				<li><a href="#">Horizontal Grinder (Tri-axle)</a></li>
				<li><a href="#">Large Fleet of Wood Chippers</a></li>
				<li><a href="#">HSEQ Integrated Management Systems</a></li>
			</ul>
			<ul class="column">
				<li><a href="#">Cherry Picker 12m to 24m</a></li>
				<li><a href="#">Greenwaste &amp; Timber Recycling</a></li>
				<li><a href="#">Tree Removal &amp; Pruning to AS 4373-2007</a></li>
				<li><a href="#">Mulch Sales</a></li>
				<li><a href="#">Large Fleet of Trucks and Service Vehicles</a></li>
				<li><a href="#">WorkSafe Working at Heights Certifications</a></li>
			</ul>
		</div>
		<div class="cf">
			<a href="#" class="btn-more">view more</a>
		</div>
	</div>
</div>




















<?php get_footer(); ?>
