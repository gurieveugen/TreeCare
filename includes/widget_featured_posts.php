<?php
/**
 * Register new widget
 */
add_action('widgets_init', create_function('', 'register_widget( "FeaturedPosts" );'));


class FeaturedPosts extends WP_Widget {
	//                    __  __              __    
	//    ____ ___  ___  / /_/ /_  ____  ____/ /____
	//   / __ `__ \/ _ \/ __/ __ \/ __ \/ __  / ___/
	//  / / / / / /  __/ /_/ / / / /_/ / /_/ (__  ) 
	// /_/ /_/ /_/\___/\__/_/ /_/\____/\__,_/____/  
	public function __construct() 
	{
		$widget_ops     = array('classname' => 'widget-featured cf', 'description' => 'Feature Boxes widget' );		
		parent::__construct('promo', 'Feature Boxes widget', $widget_ops);
		add_image_size('featured-post-thumbnail', 510, 243, true);
	}

	function widget($args, $instance) 
	{
		extract($args);
		$title_left     = isset($instance['title_left']) ? $instance['title_left'] : '';		
		$subtitle_left  = isset($instance['subtitle_left']) ? $instance['subtitle_left'] : '';
		$id_left        = isset($instance['id_left']) ? intval($instance['id_left']) : '';		
		$img_left       = has_post_thumbnail($id_left) ? get_the_post_thumbnail($id_left, 'featured-post-thumbnail') : '<img src="http://placehold.it/512x243/000/fff" alt="'.$title_left.'">';
		$title_right    = isset($instance['title_right']) ? $instance['title_right'] : '';		
		$subtitle_right = isset($instance['subtitle_right']) ? $instance['subtitle_right'] : '';
		$id_right       = isset($instance['id_right']) ? intval($instance['id_right']) : '';
		$img_right      = has_post_thumbnail($id_right) ? get_the_post_thumbnail($id_right, 'featured-post-thumbnail') : '<img src="http://placehold.it/512x243/000/fff" alt="'.$title_right.'">';

		echo $before_widget;		
		// =========================================================
		// Print featured widget
		// =========================================================
		?>
		<div class="box">
			<div class="overlay"></div>
			<?php echo $img_left; ?>
			<div class="text">
				<h3><span><?php echo $title_left; ?></span> <?php echo $subtitle_left; ?></h3>
				<a href="<?php echo get_permalink($id_left); ?>" class="more">View More</a>
			</div>
		</div>
		<div class="box">
			<div class="overlay"></div>
			<?php echo $img_right; ?>
			<div class="text">
				<h3><span><?php echo $title_right; ?></span> <?php echo $subtitle_right; ?></h3>
				<a href="<?php echo get_permalink($id_left); ?>" class="more">View More</a>
			</div>
		</div>
		<?php
		echo $after_widget;
	}

	function form($instance) 
	{		
		$title_left     = $instance['title_left'];		
		$subtitle_left  = $instance['subtitle_left'];
		$id_left        = $instance['id_left'];
		
		$title_right    = $instance['title_right'];		
		$subtitle_right = $instance['subtitle_right'];
		$id_right       = $instance['id_right'];
		
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title_left'); ?>"><?php _e('Title left'); ?>: 
				<input class="widefat" id="<?php echo $this->get_field_id('title_left'); ?>" name="<?php echo $this->get_field_name('title_left'); ?>" type="text" value="<?php echo esc_attr($title_left); ?>" />
			</label>
		</p>		
		<p>
			<label for="<?php echo $this->get_field_id('subtitle_left'); ?>"><?php _e('Subtitle left'); ?>: 
				<input class="widefat" id="<?php echo $this->get_field_id('subtitle_left'); ?>" name="<?php echo $this->get_field_name('subtitle_left'); ?>" type="text" value="<?php echo esc_attr($subtitle_left); ?>" />
			</label>
		</p>		
		<p>
			<label for="<?php echo $this->get_field_id('id_left'); ?>"><?php _e('Page left'); ?>: 
				<?php echo $this->getSelect($id_left, $this->get_field_name('id_left')); ?>
			</label>
		</p>		

		<p>
			<label for="<?php echo $this->get_field_id('title_right'); ?>"><?php _e('Title right'); ?>: 
				<input class="widefat" id="<?php echo $this->get_field_id('title_right'); ?>" name="<?php echo $this->get_field_name('title_right'); ?>" type="text" value="<?php echo esc_attr($title_right); ?>" />
			</label>
		</p>		
		<p>
			<label for="<?php echo $this->get_field_id('subtitle_right'); ?>"><?php _e('Subtitle right'); ?>: 
				<input class="widefat" id="<?php echo $this->get_field_id('subtitle_right'); ?>" name="<?php echo $this->get_field_name('subtitle_right'); ?>" type="text" value="<?php echo esc_attr($subtitle_right); ?>" />
			</label>
		</p>		
		<p>
			<label for="<?php echo $this->get_field_id('id_right'); ?>"><?php _e('Page right'); ?>: 
				<?php echo $this->getSelect($id_right, $this->get_field_name('id_right')); ?>
			</label>
		</p>	
		
		<?php
	}

	/**
	 * Update all edits
	 * @param  array $new_instance 
	 * @param  array $old_instance 
	 * @return array               
	 */
	function update($new_instance, $old_instance) 
	{
		$instance                  = $old_instance;		
		$instance['title_left']     = strip_tags($new_instance['title_left']);		
		$instance['subtitle_left']  = strip_tags($new_instance['subtitle_left']);		
		$instance['id_left']        = intval($new_instance['id_left']);		
		$instance['title_right']    = strip_tags($new_instance['title_right']);		
		$instance['subtitle_right'] = strip_tags($new_instance['subtitle_right']);		
		$instance['id_right']       = intval($new_instance['id_right']);	
		return $instance;
	}

	/**
	 * Get select control
	 * @param  integer $id   
	 * @param  string  $name 
	 * @return string
	 */
	private function getSelect($id = 0, $name = 'somename')
	{
		$args 			 = array(
			'posts_per_page'   => 500,
			'offset'           => 0,
			'category'         => '',
			'orderby'          => 'post_date',
			'order'            => 'DESC',
			'include'          => '',
			'exclude'          => '',
			'meta_key'         => '',
			'meta_value'       => '',
			'post_type'        => 'page',
			'post_status'      => 'publish',
			'suppress_filters' => true,
			'fields'		   => 'ids');
		$pages = get_posts($args);

		$output = '<select name="'.$name.'">';
		foreach ($pages as &$value) 
		{
			$output.= '<option value="'.$value.'" '.$this->selected($value == $id).'>'.get_the_title($value).'</option>';
		}
		$output.= '</select>';

		return $output;
	}

	/**
	 * Selected helper for HTML
	 * @param  boolean $bool 
	 * @return string        
	 */
	private function selected($bool = false)
	{
		return ($bool) ? 'selected' : '';
	}

}