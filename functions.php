<?php
/*
 * @package WordPress
 * @subpackage Base_Theme
 */

define('TDU', get_bloginfo('template_url'));

// =========================================================
// REQUIRE
// =========================================================
require_once 'includes/custom_walker.php';
require_once 'includes/page_theme_options.php';
require_once 'includes/widget_featured_posts.php';
require_once 'includes/widget_link_list.php';
require_once 'includes/widget_button.php';
// =========================================================
// HOOKS
// =========================================================
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 604, 270, true );
add_image_size('single-post-thumbnail', 400, 9999, false);
add_image_size('small-post-thumbnail', 150, 100, false);
add_action('wp_enqueue_scripts', 'scripts_method');
add_filter('nav_menu_css_class', 'change_menu_classes');
add_filter('the_content', 'filter_template_url');
add_filter('get_the_content', 'filter_template_url');
add_filter('widget_text', 'filter_template_url');
add_filter( 'use_default_gallery_style', '__return_false' );
add_filter('the_content', 'template_url');
add_filter('get_the_content', 'template_url');
add_filter('widget_text', 'template_url');
add_filter('default_content', 'theme_default_content');
// =========================================================
// REGISTER SIDEBARS
// =========================================================
register_sidebar(array(
	'id'            => 'right-sidebar',
	'name'          => 'Right Sidebar',
	'before_widget' => '<div class="widget %2$s" id="%1$s">',
	'after_widget'  => '</div>',
	'before_title'  => '<h3>',
	'after_title'   => '</h3>'
));

register_sidebar(array(
	'id'            => 'front-page-sidebar',
	'name'          => 'Front page Sidebar',
	'before_widget' => '<div class="%2$s" id="%1$s">',
	'after_widget'  => '</div>'
));

register_sidebar(array(
	'id'            => 'availabl-equipment',
	'name'          => 'Available Equipment Sidebar',
	'before_widget' => '<div class="%2$s" id="%1$s">',
	'after_widget'  => '</div>'
));

// =========================================================
// REGISTER MENUS
// =========================================================
register_nav_menus( array(
	'primary_nav'       => __( 'Primary Navigation', 'theme' ),
	'top_nav'           => __( 'Top Navigation', 'theme' ),
	'bottom_nav'        => __( 'Bottom Navigation', 'theme' ),
	'footer_left_menu'  => __( 'Footer Left column Menu', 'theme' ),
	'footer_right_menu' => __( 'Footer Right column Menu', 'theme' )
) );

function change_menu_classes($css_classes)
{
	$css_classes = str_replace("current-menu-item", "current-menu-item active", $css_classes);
	$css_classes = str_replace("current-menu-parent", "current-menu-parent active", $css_classes);
	return $css_classes;
}


function filter_template_url($text) 
{
	return str_replace('[template-url]',get_bloginfo('template_url'), $text);
}

function theme_paging_nav() 
{
	global $wp_query;

	// Don't print empty markup if there's only one page.
	if ( $wp_query->max_num_pages < 2 )
		return;
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<div class="nav-links cf">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'theme' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'theme' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}

function theme_post_nav() 
{
	global $post;

	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous )
		return;
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'theme' ); ?></h1>
		<div class="nav-links">

			<?php previous_post_link( '%link', _x( '<span class="meta-nav">&larr;</span> %title', 'Previous post link', 'theme' ) ); ?>
			<?php next_post_link( '%link', _x( '%title <span class="meta-nav">&rarr;</span>', 'Next post link', 'theme' ) ); ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}

function theme_entry_date( $echo = true ) 
{
	if(has_post_format(array('chat', 'status'))) $format_prefix = _x('%1$s on %2$s', '1: post format name. 2: date', 'theme');
	else $format_prefix = '%2$s';

	$date = sprintf( '<span class="date"><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a></span>',
		esc_url( get_permalink() ),
		esc_attr( sprintf( __( 'Permalink to %s', 'theme' ), the_title_attribute( 'echo=0' ) ) ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( sprintf( $format_prefix, get_post_format_string( get_post_format() ), get_the_date() ) )
	);

	if($echo) echo $date;

	return $date;
}

function theme_entry_meta() 
{
	if(is_sticky() && is_home() && ! is_paged()) echo '<span class="featured-post">' . __( 'Sticky', 'theme' ) . '</span>';

	if(! has_post_format( 'link' ) && 'post' == get_post_type()) theme_entry_date();

	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __( ', ', 'theme' ) );
	if($categories_list) echo '<span class="categories-links">' . $categories_list . '</span>';
	

	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', __( ', ', 'theme' ) );
	if ( $tag_list ) echo '<span class="tags-links">' . $tag_list . '</span>';

	// Post author
	if ( 'post' == get_post_type() ) 
	{
		printf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( __( 'View all posts by %s', 'theme' ), get_the_author() ) ),
			get_the_author()
		);
	}
}

function scripts_method() {
	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', TDU.'/js/jquery-1.11.0.min.js');
	wp_enqueue_script( 'jquery' );
}


// register tag [template-url]
function template_url($text) {
	return str_replace('[template-url]',get_bloginfo('template_url'), $text);
}


function theme_default_content($content) 
{
	$content = "<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ultrices, magna non porttitor commodo, massa nibh malesuada augue, non viverra odio mi quis nisl. Nullam convallis tincidunt dignissim. Nam vitae purus eget quam adipiscing aliquam. Sed a congue libero. Quisque feugiat tincidunt tortor sed sodales. Etiam mattis, justo in euismod volutpat, ipsum quam aliquet lectus, eu blandit neque libero eu justo. Nunc nibh nulla, accumsan in imperdiet vel, pretium in metus. Aenean in lacus at lacus imperdiet euismod in non nulla. Mauris luctus sodales metus, ac porttitor est lacinia non. Proin diam urna, feugiat at adipiscing in, varius vel mi. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed tincidunt commodo massa interdum iaculis.</p><!--more--><p>Aliquam metus libero, elementum et malesuada fermentum, sagittis et libero. Nullam quis odio vel ipsum facilisis viverra id sit amet nibh. Vestibulum ullamcorper luctus lacinia. Etiam accumsan, orci eu blandit vestibulum, purus ante malesuada purus, non commodo odio ligula quis turpis. Vestibulum scelerisque feugiat diam, eu mollis elit cursus nec. Quisque commodo ultricies scelerisque. In hac habitasse platea dictumst. Nullam hendrerit rhoncus lacus, id lobortis leo condimentum sed. Nulla facilisi. Quisque ut velit a neque feugiat rutrum at sit amet neque. Sed at libero dictum est aliquam porttitor. Morbi tempor nulla ut tellus malesuada cursus condimentum metus luctus. Quisque dui neque, lobortis id vehicula et, tincidunt eget justo. Morbi vulputate velit eget leo fermentum convallis. Nam mauris risus, consectetur a posuere ultricies, elementum non orci.</p><p>Ut viverra elit vel mauris venenatis gravida ut quis mi. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam eleifend urna sit amet nisi scelerisque pretium. Nulla facilisi. Donec et odio vel sem gravida cursus vestibulum dapibus enim. Pellentesque eget aliquet nisl. In malesuada, quam ac interdum placerat, elit metus consequat lorem, non consequat felis ipsum et ligula. Sed varius interdum volutpat. Vestibulum et libero nisi. Maecenas sit amet risus et sapien lobortis ornare vel quis ipsum. Nam aliquet euismod aliquam. Donec velit purus, convallis ac convallis vel, malesuada vitae erat.</p>";
	return $content;
}

/**
 * Get title
 * @return string
 */
function getTitle()
{
	$title = wp_title('|', false, 'right');
	$title = ($title == '') ? get_bloginfo('site') : $title;
	return $title; 
}

/**
 * Get posts to scroll control
 * @param  array   $settings 
 * @param  boolean $print    
 * @return mixed
 */
function getPostsScroll($settings = array(), $print = false)
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
		'post_type'        => 'post',
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
			$link   = get_permalink($value);
			$output.= '<'.$settings['container_item'].'><a href="'.$link.'" title="'.$title.'">';
			$output.= get_the_post_thumbnail($value, 'small-post-thumbnail');
			$output.= $settings['text_before'].$title.$settings['text_after'];
			$output.= '</a></'.$settings['container_item'].'>';
		}
	}
	$output.= '</'.$settings['container'].'>';

	if($print) echo $output;
	else return $output;
}

function getShort($txt)
{
	$str = explode('<!--more-->', $txt);
	return $str[0];
}