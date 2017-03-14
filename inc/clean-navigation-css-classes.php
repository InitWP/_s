<?php
/**
 * Create HTML list of nav menu items.
 *
 * @since 1.0
 * @uses Walker_Nav_Menu
 */
class slnm_base_Walker_Nav_Menu extends Walker_Nav_Menu {

	/**
	 * @see Walker_Page::start_lvl()
	 * @since 1.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int $depth Depth of page. Used for padding.
	 * @param array $args
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<button class='mainNavigation--subMenuToggle' aria-expanded='false'><span class='screenReaderText'>" . __('Toon submenu', 'TEXTDOMAIN') . "</span></button>\n";
		$output .= "\n$indent<ul class='mainNavigation--subMenu'>\n";
	}

	/**
	 * Start the element output.
	 *
	 * @see Walker_Nav_Menu::start_el()
	 *
	 * @since 1.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item  			Menu item data object.
	 * @param int    $depth  			Depth of menu item. Used for padding.
	 * @param array  $args   			An array of arguments. @see wp_nav_menu()
	 * @param int    $current_object_id	Current object ID.
	 */
	public function start_el( &$output, $item, $depth = 0, $args = array(), $current_object_id = 0 ) {

		// Cleaner class array to replace default
		$new_classes = array();

		// Get the menu id for which this walker is used
		$theme_location = $args->theme_location;
		$locations = get_nav_menu_locations();
		$menu_id = $locations[$theme_location];
		$item_id = $item->ID;

		// Prepare an indent variable for later use
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		// Get the classes on this menu-item
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		$classes[] = 'menu-item-' . $item_id;

		// Set the new classes based on depth
		if ($depth > 0) {
			$new_classes[] = 'mainNavigation--subMenu--menuItem';
		} else {
			$new_classes[] = 'mainNavigation--menuItem';
		}

		// Set the new classes based on the WordPress default classes
		//if ( in_array( 'menu-item-has-children', $classes ) )
			//$new_classes[] = 'parent';
		if ( in_array( 'current-menu-item', $classes ) )
			$new_classes[] = 'is-active';
		if ( in_array( 'current-menu-ancestor', $classes ) )
			$new_classes[] = 'is-active-ancestor';
		//if ( in_array( 'current-menu-parent', $classes ) )
			//$new_classes[] = 'is-active-parent';

		// Get custom set classes on menu items in WP admin > Menus
		foreach($classes as $class) {
			if ($class === 'menu-item') {
				break;
			} else {
				$new_classes[] = $class;
			}
		}

		// Set active class for custom post type menu items, parents and ancestors
		$new_classes[] = $this->cpt_active_menu_css_class($menu_id, $item);

		// Overwrite the old classes with the new ones
		$classes = $new_classes;

		/**
		 * Filter the CSS class(es) applied to a menu item's list item element.
		 *
		 * @since 1.0
		 *
		 * @param array  $classes The CSS classes that are applied to the menu item's `<li>` element.
		 * @param object $item    The current menu item.
		 * @param array  $args    An array of {@see wp_nav_menu()} arguments.
		 * @param int    $depth   Depth of menu item. Used for padding.
		 */
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		// removed the ID
		$output .= $indent . '<li' . $class_names .'>';

		// prepare the HTML link attributes
		$atts = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
		$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
		$atts['href']   = ! empty( $item->url )        ? $item->url        : '';

		/**
		 * Filter the HTML attributes applied to a menu item's anchor element.
		 *
		 * @since 1.0
		 *
		 * @param array $atts {
		 *     The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
		 *
		 *     @type string $title  Title attribute.
		 *     @type string $target Target attribute.
		 *     @type string $rel    The rel attribute.
		 *     @type string $href   The href attribute.
		 * }
		 * @param object $item  The current menu item.
		 * @param array  $args  An array of {@see wp_nav_menu()} arguments.
		 * @param int    $depth Depth of menu item. Used for padding.
		 */
		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		/** This filter is documented in wp-includes/post-template.php */
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item_id ) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		/**
		 * Filter a menu item's starting output.
		 *
		 * The menu item's starting output only includes `$args->before`, the opening `<a>`,
		 * the menu item's title, the closing `</a>`, and `$args->after`. Currently, there is
		 * no filter for modifying the opening and closing `<li>` for a menu item.
		 *
		 * @since 1.0
		 *
		 * @param string $item_output The menu item's starting HTML output.
		 * @param object $item        Menu item data object.
		 * @param int    $depth       Depth of menu item. Used for padding.
		 * @param array  $args        An array of {@see wp_nav_menu()} arguments.
		 */
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}


	/**
	 * Return 'is-active(-ancestor)' css class for CPT (parent) menu items when on CPT pages
	 *
	 * @param string $menu_id	Menu name, ID, or slug
 	 * @param object $menu_item	Menu item data object
 	 * @return string returns css class is-active or is-active-ancestor
	 */
	function cpt_active_menu_css_class($menu_id, $menu_item) {
		global $wp;
		$class = '';

		// Get the url of the current page we're on
		$current_url = trailingSlashIt(home_url( $wp->request ));
		// Get the post type of the current page
		$post_type = get_post_type();
		// Find out if this menu-item has any active child menu items
		$has_active_child_menu_item = $this->has_active_child_menu_item($menu_id, $menu_item->ID, $current_url);

		// If we are on a custom post type page
		// And if we are not on a search results page
		if ($post_type && !is_search()) {

			// Find out if this menu-item has an active child menu item
			if ($has_active_child_menu_item ) {
				// if it has, add the ancestor css class
				$class = 'is-active-ancestor';

			// Check if the current page's url contains the menu item's url
			// But not for the homepage menu item url as this url will always by part uf the current page's url
			} elseif (strpos($current_url, $menu_item->url) === 0 && $menu_item->url !== home_url('/')) {
				// if it does, add the active css class
				$class = 'is-active';
			}
		}

		return $class;
	}


	/**
	 * Find out if a menu-item has an active child menu item
	 *
	 * @param string $menu_id				Menu name, ID, or slug
 	 * @param int 	 $parent_menu_item_id	the parent nav_menu_item ID
 	 * @param string $current_url			the url of the current page
 	 * @return boolreturns true if menu item has an active child menu item
	 */
	function has_active_child_menu_item($menu_id, $parent_menu_item_id, $current_url) {
		// Get all the menu items
		$nav_menu_items = wp_get_nav_menu_items($menu_id);

		if ( $nav_menu_item_children = $this->get_nav_menu_item_children( $parent_menu_item_id, $nav_menu_items, false ) ) {
			foreach ($nav_menu_item_children as $nav_menu_item_child) {
				//error_log('$current_url: ' . $current_url . ' - $nav_menu_item_child->url ' . $nav_menu_item_child->url . ' strpos: ' . strpos($current_url, $nav_menu_item_child->url));
				if ( strpos($current_url, $nav_menu_item_child->url) === 0 && $nav_menu_item_child->url !== home_url('/')) {
					return true;
				}
			}
		}

		return false;
	}


	/**
	* Returns all children menu items of a parent nav_menu_item
	*
	* @param int 	$parent_id		the parent nav_menu_item ID
	* @param array 	$nav_menu_items nav_menu_items (get by using wp_get_nav_menu_items(...))
	* @param bool 	$depth			all children or direct children only
	* @return array returns filtered array of nav_menu_items
	*/
	function get_nav_menu_item_children($parent_id, $nav_menu_items, $depth = true) {
		$nav_menu_item_list = array();
		foreach ($nav_menu_items as $nav_menu_item) {
			if ($nav_menu_item->menu_item_parent == $parent_id) {
				$nav_menu_item_list[] = $nav_menu_item;
				if ($depth) {
					if ($children = $this->get_nav_menu_item_children($nav_menu_item->ID, $nav_menu_items)) {
						$nav_menu_item_list = array_merge($nav_menu_item_list, $children);
					}
				}
			}
		}
		return $nav_menu_item_list;
	}
}
