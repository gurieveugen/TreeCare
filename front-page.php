<?php
/**
 * @package WordPress
 * @subpackage Base_Theme
 */
?>

<?php get_header(); ?>
<?php $options = $GLOBALS['gcoptions']->getAllOptions(); ?>

<div class="widget-featured cf">
	<div class="box">
		<div class="overlay"></div>
		<img src="<?php echo TDU; ?>/images/img-1.jpg" alt="image description">
		<div class="text">
			<h3><span>Specialists in</span> Commercial Services</h3>
			<a href="#" class="more">View More</a>
		</div>
	</div>
	<div class="box">
		<div class="overlay"></div>
		<img src="<?php echo TDU; ?>/images/img-2.jpg" alt="image description">
		<div class="text">
			<h3><span>Servicing all types of</span> Residential work</h3>
			<a href="#" class="more">View More</a>
		</div>
	</div>
</div>
<div class="main-home">
	<div class="scroll-banner">
		<ul class="slides cf">
			<li>
				<a href="#">
					<img src="<?php echo TDU; ?>/images/img-3.jpg" alt="image description">
					<span class="text"><span class="holder"><span>Tree <br>removal <br>services</span></span></span>
				</a>
			</li>
			<li><a href="#"><img src="<?php echo TDU; ?>/images/img-4.jpg" alt="image description"></a></li>
			<li><a href="#"><img src="<?php echo TDU; ?>/images/img-5.jpg" alt="image description"></a></li>
			<li><a href="#"><img src="<?php echo TDU; ?>/images/img-6.jpg" alt="image description"></a></li>
			<li><a href="#"><img src="<?php echo TDU; ?>/images/img-7.jpg" alt="image description"></a></li>
			<li><a href="#"><img src="<?php echo TDU; ?>/images/img-3.jpg" alt="image description"></a></li>
			<li><a href="#"><img src="<?php echo TDU; ?>/images/img-4.jpg" alt="image description"></a></li>
			<li><a href="#"><img src="<?php echo TDU; ?>/images/img-5.jpg" alt="image description"></a></li>
			<li><a href="#"><img src="<?php echo TDU; ?>/images/img-6.jpg" alt="image description"></a></li>
			<li><a href="#"><img src="<?php echo TDU; ?>/images/img-7.jpg" alt="image description"></a></li>
			<li><a href="#"><img src="<?php echo TDU; ?>/images/img-3.jpg" alt="image description"></a></li>
			<li><a href="#"><img src="<?php echo TDU; ?>/images/img-4.jpg" alt="image description"></a></li>
			<li><a href="#"><img src="<?php echo TDU; ?>/images/img-5.jpg" alt="image description"></a></li>
			<li><a href="#"><img src="<?php echo TDU; ?>/images/img-6.jpg" alt="image description"></a></li>
			<li><a href="#"><img src="<?php echo TDU; ?>/images/img-7.jpg" alt="image description"></a></li>
		</ul>
	</div>
	<div class="posts-block cf">
		<article class="block">
			<h1><a href="#">About Us</a></h1>
			<div class="entry-content">
				<div class="text">
					<p>We are a respected provider of Arboriculture Maintenance services for Government departments, Commercial &amp; Civil companies and the Domestic market.</p>
				</div>
				<img class="alignright" src="<?php echo TDU; ?>/images/img-tree.jpg" alt="image description">
				<p>Our commitment to detail and our high level of customer service, have developed a proven reputation for completing projects to a high standard on time and budget. This, coupled with our <a href="#">commitment to safety &amp; protection</a> of the environment, has secured the loyalty of our clients.</p>
			</div>
		</article>
		<article class="block">
			<h1><a href="#">Recently Completed Work</a></h1>
			<div class="entry-content">
				<h3>City East Alliance - Great Eastern Highway Widening</h3>
				<p>Tree Care were recently  awarded the contract to remove and prune all trees along Great Eastern Hwy between Kooyong Road &amp; Tonkin Hwy in Belmont as part of the Great Eastern Highway Major Widening Contract currently underway. Our methodical approach coupled with commitment to the safety of our employees has lead to these extremely complex works being completed on time and to an.....</p>
				<div class="cf">
					<a href="#" class="btn-more">view more</a>
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
			<!-- <ul class="column">
				<li><a href="#">REMOVAL &amp; PRUNING</a></li>
				<li><a href="#">TREE SURGERY</a></li>
				<li><a href="#">PALM PRUNING AND REMOVAL</a></li>
				<li><a href="#">STUMP GRINDING</a></li>
				<li><a href="#">MULCH SALES</a></li>
				<li><a href="#">CHERRY PICKERS</a></li>
			</ul>
			<ul class="column">
				<li><a href="#">LARGE TREE SPECIALISTS</a></li>
				<li><a href="#">SAFETY FIRST</a></li>
				<li><a href="#">COMPETITIVE PRICES</a></li>
				<li><a href="#">WESTERN POWER CERTIFIED</a></li>
				<li><a href="#">COUNCIL &amp; GOVERNMENT CONTRACTOR</a></li>
				<li><a href="#">METRO &amp; RURAL LOCATIONS</a></li>
			</ul> -->
		</div>
	</div>
</div>
<?php get_footer(); ?>