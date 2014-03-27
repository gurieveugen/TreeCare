<?php
class CustomWalker extends Walker_Nav_Menu {

    var $tree_type = array('post_type', 'taxonomy', 'custom');
    var $db_fields = array('parent' => 'menu_item_parent', 'id' => 'db_id');

    /**
     * Starts the list before the elements are added.
     *
     * @see Walker::start_lvl()
     *
     * @since 3.0.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param int    $depth  Depth of menu item. Used for padding.
     * @param array  $args   An array of arguments. @see wp_nav_menu()
     */
    function start_lvl( &$output, $depth = 0, $args = array() ) 
    {
        $indent = str_repeat("\t", $depth);
        $x = ($depth > 0) ? $depth + 1 : ''; 
        $output .= "\n$indent<div class=\"children$x\">\n";
    }

    /**
     * Ends the list of after the elements are added.
     *
     * @see Walker::end_lvl()
     *
     * @since 3.0.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param int    $depth  Depth of menu item. Used for padding.
     * @param array  $args   An array of arguments. @see wp_nav_menu()
     */
    function end_lvl( &$output, $depth = 0, $args = array() ) 
    {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</div>\n";
    }

    /**
     * Start the element output.
     *
     * @see Walker::start_el()
     *
     * @since 3.0.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $item   Menu item data object.
     * @param int    $depth  Depth of menu item. Used for padding.
     * @param array  $args   An array of arguments. @see wp_nav_menu()
     * @param int    $id     Current item ID.
     */
    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) 
    {
        $item_container = ($depth) ? 'div' : 'li';
        $indent         = ($depth) ? str_repeat("\t", $depth) : '';
        $class_names    = $value = '';
        $classes        = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[]      = ($depth) ? 'li menu-item-'.$item->ID : 'menu-item-' . $item->ID;
        $class_names    = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_names    = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
        $id             = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
        $id             = $id ? ' id="' . esc_attr( $id ) . '"' : '';
        $output        .= $indent . '<'.$item_container.$id . $value . $class_names .'>';
        $atts           = array();
        $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
        $atts['target'] = ! empty( $item->target )     ? $item->target     : '';
        $atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
        $atts['href']   = ! empty( $item->url )        ? $item->url        : '';       
        $atts           = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );
        $attributes     = '';

        foreach ( $atts as $attr => $value ) 
        {
            if(!empty($value)) 
            {
                $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $item_output  = $args->before;
        $item_output .= '<a'. $attributes .'>';        
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;
        $output      .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }

    /**
     * Ends the element output, if needed.
     *
     * @see Walker::end_el()
     *
     * @since 3.0.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $item   Page data object. Not used.
     * @param int    $depth  Depth of page. Not Used.
     * @param array  $args   An array of arguments. @see wp_nav_menu()
     */
    function end_el( &$output, $item, $depth = 0, $args = array() ) 
    {
        $item_container = ($depth) ? 'div' : 'li';
        $output .= "</$item_container>\n";
    }

}