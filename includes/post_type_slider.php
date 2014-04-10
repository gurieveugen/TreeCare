<?php

class Slider{
	//                    __  __              __    
	//    ____ ___  ___  / /_/ /_  ____  ____/ /____
	//   / __ `__ \/ _ \/ __/ __ \/ __ \/ __  / ___/
	//  / / / / / /  __/ /_/ / / / /_/ / /_/ (__  ) 
	// /_/ /_/ /_/\___/\__/_/ /_/\____/\__,_/____/  
	public function __construct()
	{		
		// =========================================================
		// HOOKS
		// =========================================================
		add_action('init', array($this, 'createPostTypeSlider'));		
		add_action('save_post', array($this, 'saveSlider'), 0);	
		add_action('add_meta_boxes', array($this, 'metaBoxSlider'));
		add_filter('manage_edit-slide_columns', array($this, 'columnThumb'));	
		add_action('manage_posts_custom_column', array($this, 'columnthumbShow'), 10, 2);
		add_shortcode('slider', array($this, 'displaySlider'));
		add_image_size('slide-image', 150, 100, true);
		add_image_size('slide-thumb-image', 100, 100, true);				
	}

	/**
	 * Create GCEvents post type and his taxonomies
	 */
	public function createPostTypeSlider()
	{

		$post_labels = array(
			'name'               => __('Slides'),
			'singular_name'      => __('Slide'),
			'add_new'            => __('Add new'),
			'add_new_item'       => __('Add new slide'),
			'edit_item'          => __('Edit slide'),
			'new_item'           => __('New slide'),
			'all_items'          => __('Slides'),
			'view_item'          => __('View slide'),
			'search_items'       => __('Search slide'),
			'not_found'          => __('Slide not found'),
			'not_found_in_trash' => __('Slide not found in trash'),
			'parent_item_colon'  => '',
			'menu_name'          => __('Slides'));

		$post_args = array(
			'labels'             => $post_labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'slide' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'thumbnail'));

		register_post_type('slide', $post_args);
	}

	/**
	 * Register new column
	 * @param  array $columns 
	 * @return array
	 */
	public function columnThumb($columns)
	{
		return array_merge($columns, array('thumb' => __('Image'), 'url' => __('External URL')));
	}

	/**
	 * Display new column
	 * @param  string  $column  
	 * @param  integer $post_id           
	 */
	public function columnThumbShow($column, $post_id)
	{		
		switch ($column) 
		{
			case 'thumb':
				if(has_post_thumbnail($post_id)) echo get_the_post_thumbnail($post_id, 'slide-thumb-image');
				break;
			case 'url':
				$meat       = $this->getMeta($post_id);
				$url = isset($meat['url']) ? $meat['url'] : '';
				echo $url;
				break;
		}			
	}

	/**
	 * Add GCEvents meata box
	 */
	public function metaBoxSlider($post_type)
	{
		$post_types = array('slide');
		if(in_array($post_type, $post_types))
		{
			add_meta_box('metaBoxSlider', __('Slider settings'), array($this, 'metaBoxSliderRender'), $post_type, 'side', 'high');	
		}
		
	}

	/**
	 * render Slider Meta box
	 */
	public function metaBoxSliderRender($post)
	{
		$meta = $this->getMeta($post->ID);
		wp_nonce_field( 'slider_box', 'slider_box_nonce' );
		?>	
		<div class="gcslider">
			<p>
				<label for="slider_url"><?php _e('External URL'); ?>:</label>
				<input type="text" name="meta[url]" id="slider_url" value="<?php echo $meta['url']; ?>" class="w100">
			</p>			
		</div>	
		<?php
	}

	/**
	 * Get meta array
	 * @param  integer $id
	 * @return array
	 */
	public function getMeta($id)
	{
		return get_post_meta($id, 'meta', true);
	}
	
	/**
	 * Save post
	 * @param  integer $post_id 
	 * @return integer
	 */
	public function saveSlider($post_id)
	{
		// =========================================================
		// Check nonce
		// =========================================================
		if(!isset( $_POST['slider_box_nonce'])) return $post_id;
		if(!wp_verify_nonce($_POST['slider_box_nonce'], 'slider_box')) return $post_id;
		if(defined( 'DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;

		// =========================================================
		// Check the user's permissions.
		// =========================================================
		if ( 'page' == $_POST['post_type'] ) 
		{			
			if (!current_user_can( 'edit_page', $post_id)) return $post_id;
		} 
		else 
		{
			if(!current_user_can( 'edit_post', $post_id)) return $post_id;
		}

		// =========================================================
		// Save
		// =========================================================		
		if(isset($_POST['meta']))
		{
			update_post_meta($post_id, 'meta', $_POST['meta']);
		}

		return $post_id;
	}

	/**
	 * Get post type imtes
	 * @param  integer $count
	 * @return array        
	 */
	public function getItems($count = -1)
	{
		$all = array(
			'posts_per_page'   => $count,
			'offset'           => 0,			
			'orderby'          => 'post_date',
			'order'            => 'DESC',
			'post_type'        => 'slide',
			'post_status'      => 'publish');
		$arr = get_posts($all);
		foreach ($arr as $key => &$value) 
		{
			$images = null;
			if(has_post_thumbnail($value->ID))
			{
				$post_thumbnail_id = get_post_thumbnail_id($value->ID);
				$slide_image       = wp_get_attachment_image_src($post_thumbnail_id ,'slide-image', false);
				$slide_thumb_image = wp_get_attachment_image_src($post_thumbnail_id ,'slide-thumb-image', false);
				$images['full']    = $slide_image[0];
				$images['small']   = $slide_thumb_image[0];
			}
			$value->images = $images;
			$value->meta   = $this->getMeta($value->ID);
		}
		return $arr;
	}

	/**
	 * Get posts to scroll control
	 * @param  array   $settings 
	 * @param  boolean $print    
	 * @return mixed
	 */
	public function getSlider($settings = array(), $print = false)
	{
		$default_settings = array(
			'container'       => 'ul',
			'container_class' => array('slides', 'cf'),
			'container_item'  => 'li',
			'text_before'     => '<span class="text"><span class="holder"><span>',
			'text_after'      => '</span></span></span>');
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
			'post_type'        => 'slide',
			'post_status'      => 'publish',
			'suppress_filters' => true,
			'fields'		   => 'ids' );

		$settings = array_merge($default_settings, $settings);
		$posts    = get_posts($args);

		$output = '<'.$settings['container'].' class="'.implode(' ', $settings['container_class']).'">';
		foreach ($posts as &$value) 
		{
			if(has_post_thumbnail($value))
			{
				$title  = get_the_title($value);				
				$meta   = $this->getMeta($value);
				$link   = (isset($meta['url']) && $meta['url'] != '') ? $meta['url'] : '#';
				$output.= '<'.$settings['container_item'].'><a href="'.$link.'" title="'.$title.'">';
				$output.= get_the_post_thumbnail($value, 'slide-image');
				$output.= $settings['text_before'].$title.$settings['text_after'];
				$output.= '</a></'.$settings['container_item'].'>';
			}
		}
		$output.= '</'.$settings['container'].'>';

		if($print) echo $output;
		else return $output;
	}
}
// =========================================================
// LAUNCH
// =========================================================
$GLOBALS['slider'] = new Slider();