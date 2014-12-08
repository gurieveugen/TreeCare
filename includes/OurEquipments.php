<?php

class OurEquipments{
	//                    __  __              __    
	//    ____ ___  ___  / /_/ /_  ____  ____/ /____
	//   / __ `__ \/ _ \/ __/ __ \/ __ \/ __  / ___/
	//  / / / / / /  __/ /_/ / / / /_/ / /_/ (__  ) 
	// /_/ /_/ /_/\___/\__/_/ /_/\____/\__,_/____/  
	public function __construct()
	{
		add_shortcode( 'our-equipments', array(&$this, 'getEquipmentsHTML') );
	}	       

	public function getEquipmentsHTML()
	{
		$args = array(
		    'orderby'           => 'name', 
		    'order'             => 'ASC',
		    'hide_empty'        => true, 
		    'exclude'           => array(), 
		    'exclude_tree'      => array(), 
		    'include'           => array(),
		    'number'            => '', 
		    'fields'            => 'all', 
		    'slug'              => '', 
		    'parent'            => '',
		    'hierarchical'      => true, 
		    'child_of'          => 0, 
		    'get'               => '', 
		    'name__like'        => '',
		    'description__like' => '',
		    'pad_counts'        => false, 
		    'offset'            => '', 
		    'search'            => '', 
		    'cache_domain'      => 'core'
		); 

		$equipments = get_terms(array('equipment_cat'), $args);

		if(!is_array($equipments) AND count($equipments)) return '';

		$elements = array();

		for ($i=0; $i < count($equipments); $i+=4) 
		{ 
			$elements[] = '<ul class="equipment-list cf">';
			for ($x=0; $x < 4; $x++) 
			{ 
				$elements[] = $this->wrapEquipments($equipments[$i+$x]);
			}
			$elements[] = '</ul>';
		}
		return implode(' ', $elements);
	}

	public function wrapEquipments($equipment)
	{
		$link    = get_term_link( $equipment );
		$img_src = get_option(sprintf('tax_%s_%s', $equipment->term_id, 'equipment_cat_category_image'));
		$img_id  = \__::getAttachmentIDFromSrc($img_src);
		$thumb   = wp_get_attachment_image_src( get_post_thumbnail_id($img_id), 'equipment');
		if(is_array($thumb))
		{
			$img_src = $thumb[0];
		}
		ob_start();
		?>
		<li>
			<h3><a href="<?php echo $link; ?>"><?php echo $equipment->name; ?></a></h3>
			<a href="<?php echo $link; ?>" class="image"><img src="<?php echo $img_src; ?>" alt="<?php echo $equipment->slug; ?>"></a>
		</li>
		<?php
		$var = ob_get_contents();
		ob_end_clean();
		return $var;
	}                                     
}






