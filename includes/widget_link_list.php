<?php
/**
 * Register new widget
 */
add_action('widgets_init', create_function('', 'register_widget( "LinkList" );'));


class LinkList extends WP_Widget {
	//                    __  __              __    
	//    ____ ___  ___  / /_/ /_  ____  ____/ /____
	//   / __ `__ \/ _ \/ __/ __ \/ __ \/ __  / ___/
	//  / / / / / /  __/ /_/ / / / /_/ / /_/ (__  ) 
	// /_/ /_/ /_/\___/\__/_/ /_/\____/\__,_/____/  
	public function __construct() 
	{
		$widget_ops     = array('classname' => 'equipment-columns cf', 'description' => 'Links list widget' );		
		parent::__construct('linklist', 'Links list widget', $widget_ops);

		// =========================================================
		// Add styles
		// =========================================================
		wp_enqueue_style('linklist',  get_bloginfo('template_url').'/css/linklist.css');	
		wp_enqueue_script('linklist', get_bloginfo('template_url').'/js/linklist.js', array('jquery'));
	}

	function widget($args, $instance) 
	{
		extract($args);
		$links_per_column = isset($instance['links_per_column']) ? $instance['links_per_column'] : 0;	
		$links_per_column = max(1, $links_per_column);	
		$items            = isset($instance['items']) ? $instance['items'] : null;

		echo $before_widget;		
		// =========================================================
		// Print featured widget
		// =========================================================
		for ($i=0; $i < 2; $i++) 
		{ 		
			echo '<ul class="column">';
			$x = $i * $links_per_column;				
			for ($j=0; $j < $links_per_column; $j++) 
			{ 
				if(isset($items[$x + $j])) echo '<li><a href="'.$items[$x + $j]['url'].'">'.$items[$x + $j]['title'].'</a></li>';
			}
			echo '</ul>';
		}
		echo $after_widget;
	}

	function form($instance) 
	{	
		$links_per_column = $instance['links_per_column'];		
		$items            = $instance['items'];
		
		?>		
		<p>
			<label for="<?php echo $this->get_field_id('links_per_column'); ?>"><?php _e('Links per column'); ?>: 
				<input class="widefat" id="<?php echo $this->get_field_id('links_per_column'); ?>" name="<?php echo $this->get_field_name('links_per_column'); ?>" type="text" value="<?php echo esc_attr($links_per_column); ?>" />
			</label>
		</p>		
		<div class="linkslist-table" id="linklist">
			<table id="links-table" data-defaultname="<?php echo $this->get_field_name('items'); ?>">
				<thead>
					<tr>						
						<th>Title</th>						
						<th>URL</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if($items)
					{						
						foreach ($items as $key => $value) 
						{							
							?>
							<tr>								
								<td><input class="widefat" id="<?php echo $this->get_field_id('items'); ?>" name="<?php echo $this->get_field_name('items'); ?>[title][]" type="text" value="<?php echo $value['title']; ?>" /></td>
								<td><input class="widefat" id="<?php echo $this->get_field_id('items'); ?>" name="<?php echo $this->get_field_name('items'); ?>[url][]" type="text" value="<?php echo $value['url']; ?>" /></td>
							</tr>
							<?php
						}	
					}
					?>
				</tbody>
			</table>
			<button class="button" id="add-controls" type="button" onclick="addControls(this)"><?php _e('Add'); ?></button>
		</div>
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
		$instance                     = $old_instance;		
		$instance['links_per_column'] = intval($new_instance['links_per_column']);		
		if($new_instance['items'])
		{

			for ($i=0; $i < count($new_instance['items']['title']); $i++) 
			{ 
				if($new_instance['items']['title'][$i] != '')
				{
					$new_arr[$i]['title'] = $new_instance['items']['title'][$i];
					$new_arr[$i]['url']   = isset($new_instance['items']['url'][$i]) ? $new_instance['items']['url'][$i] : '';	
				}
			}

			$instance['items'] = $new_arr;
		}
		
		return $instance;
	}
}