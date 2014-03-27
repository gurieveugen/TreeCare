<?php
/**
 * @package WordPress
 * @subpackage Base_Theme
 */
?>
	<footer id="footer" class="cf">
		<p class="copy">copyright treecarewa pty ltd</p>
		<?php 
		wp_nav_menu( array(
			'container'      => '',
			'menu_id'        => 'bottom-list',
			'menu_class'     => 'bottom-list',
			'theme_location' => 'bottom_nav'
			)); 
		?>	
		<!-- <ul class="bottom-list">
			<li><a href="#">Terms and ConditionS</a></li>
			<li><a href="#">Privacy Policy</a></li>
		</ul> -->
	</footer>
</div>
<?php wp_footer(); ?>
</body>
</html>
