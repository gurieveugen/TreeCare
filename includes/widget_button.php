<?php
/**
 * Register new widget
 */
add_action('widgets_init', create_function('', 'register_widget( "WidgetButton" );'));


class WidgetButton extends WP_Widget {
	//                    __  __              __    
	//    ____ ___  ___  / /_/ /_  ____  ____/ /____
	//   / __ `__ \/ _ \/ __/ __ \/ __ \/ __  / ___/
	//  / / / / / /  __/ /_/ / / / /_/ / /_/ (__  ) 
	// /_/ /_/ /_/\___/\__/_/ /_/\____/\__,_/____/  
	public function __construct() 
	{
		$widget_ops     = array('classname' => 'cf', 'description' => 'Button widget' );		
		parent::__construct('widgetbutton', 'Button widget', $widget_ops);
	}

	function widget($args, $instance) 
	{
		extract($args);
		$title     = isset($instance['title']) ? $instance['title'] : '';	
		$css_class = isset($instance['css_class']) ? $instance['css_class'] : '';
		$url       = isset($instance['url']) ? $instance['url'] : '';

		echo $before_widget;		
		echo '<a href="'.$url.'" class="'.$css_class.'">'.$title.'</a>';
		echo $after_widget;
	}

	function form($instance) 
	{	
		$title     = $instance['title'];
		$css_class = $instance['css_class'];
		$url       = $instance['url'];
		
		?>		
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title'); ?>: 
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
			</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('css_class'); ?>"><?php _e('CSS Class'); ?>: 
				<input class="widefat" id="<?php echo $this->get_field_id('css_class'); ?>" name="<?php echo $this->get_field_name('css_class'); ?>" type="text" value="<?php echo esc_attr($css_class); ?>" />
			</label>
		</p>		
		<p>
			<label for="<?php echo $this->get_field_id('url'); ?>"><?php _e('URL'); ?>: 
				<input class="widefat" id="<?php echo $this->get_field_id('url'); ?>" name="<?php echo $this->get_field_name('url'); ?>" type="text" value="<?php echo esc_attr($url); ?>" />
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
		$instance              = $old_instance;		
		$instance['title']     = strip_tags($new_instance['title']);		
		$instance['css_class'] = strip_tags($new_instance['css_class']);		
		$instance['url']       = strip_tags($new_instance['url']);		
		
		return $instance;
	}
}