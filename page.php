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
		<?php if(is_active_sidebar('availabl-equipment')) dynamic_sidebar('availabl-equipment'); ?>		
	</div>
</div>
<?php get_footer(); ?>