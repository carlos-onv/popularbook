<?php
/**
 * Create HTML list of nav menu input items.
 *
 * @package WordPress
 * @since 3.0.0
 * @uses Walker_Nav_Menu
 */

add_action( 'wp_nav_menu_item_custom_fields', 'book_junky_add_menu_submenu_type_fields', 10, 4 );

function book_junky_add_menu_submenu_type_fields( $item_id, $item, $depth, $args ) {

    if ( $depth )
        return;

    $title = esc_html__('Submenu Type', 'book-junky'); $key = "menu-item-submenu_type"; $value = $item->submenu_type;

    ?><p class="description description-wide description_width_100">
        <?php echo esc_html( $title ); ?><br />
        <label for="edit-<?php echo ''.$key . '-' . $item_id; ?>">
            <select id="edit-<?php echo ''.$key . '-' . $item_id; ?>" class=" <?php echo ''.$key; ?>" name="<?php echo ''.$key . "[" . $item_id . "]"; ?>">
                <option value="standard" <?php echo ( $value == 'standard' ) ? ' selected="selected" ' : ''; ?>><?php esc_html_e( 'Standard Dropdown', 'book-junky' ); ?></option>
                <option value="columns2" <?php echo ( $value == 'columns2' ) ? ' selected="selected" ' : ''; ?>><?php esc_html_e( '2 columns dropdown', 'book-junky' ); ?></option>
                <option value="columns3" <?php echo ( $value == 'columns3' ) ? ' selected="selected" ' : ''; ?>><?php esc_html_e( '3 columns dropdown', 'book-junky' ); ?>
                </option>
                <option value="columns4" <?php echo ( $value == 'columns4' ) ? ' selected="selected" ' : ''; ?>><?php esc_html_e( '4 columns dropdown', 'book-junky' ); ?></option>
            </select>
        </label>
    </p>
    <?php
    $title = esc_html__('Side of Dropdown Elements', 'book-junky');
    $key = "menu-item-dropdown";
    $value = $item->dropdown;
    ?>
    <p class="description description-wide description_width_100">
        <?php echo esc_html( $title ); ?><br />
        <label for="edit-<?php echo ''.$key . '-' . $item_id; ?>">
            <select id="edit-<?php echo ''.$key . '-' . $item_id; ?>" class=" <?php echo ''.$key; ?>" name="<?php echo ''.$key . "[" . $item_id . "]"; ?>">
                <option value="autodrop_submenu" <?php echo ( $value == 'autodrop_submenu' ) ? ' selected="selected" ' : ''; ?>><?php esc_html_e( 'Auto drop', 'book-junky' ); ?></option>
                <option value="drop_to_left" <?php echo ( $value == 'drop_to_left' ) ? ' selected="selected" ' : ''; ?>><?php esc_html_e( 'Drop To Left Side', 'book-junky' ); ?></option>
                <option value="drop_to_right" <?php echo ( $value == 'drop_to_right' ) ? ' selected="selected" ' : ''; ?>><?php esc_html_e( 'Drop To Right Side', 'book-junky' ); ?></option>
                <option value="drop_to_center" <?php echo ( $value == 'drop_to_center' ) ? ' selected="selected" ' : ''; ?>><?php esc_html_e( 'Drop To Center', 'book-junky' ); ?></option>
                <option value="drop_full_width" <?php echo ( $value == 'drop_full_width' ) ? ' selected="selected" ' : ''; ?>><?php esc_html_e( 'Full width', 'book-junky' ); ?></option>
            </select>
        </label>
    </p>
    <?php

    $title = esc_html__('Has Mega Menu', 'book-junky'); 
    $key = "menu-item-has_mega_menu"; 
    $value = $item->has_mega_menu;

    ?>
    <p class="description description-wide description_width_100">
        <?php echo esc_html( $title ); ?><br />
        <label for="edit-<?php echo $key . '-' . $item_id; ?>">
            <select id="edit-<?php echo $key . '-' . $item_id; ?>" class=" <?php echo $key; ?>" name="<?php echo $key . "[" . $item_id . "]"; ?>">
                <option value="0" <?php echo ( $value == '0' ) ? ' selected="selected" ' : ''; ?>><?php esc_html_e( 'No', 'book-junky' ); ?></option>
                <option value="1" <?php echo ( $value == '1' ) ? ' selected="selected" ' : ''; ?>><?php esc_html_e( 'Yes', 'book-junky' ); ?></option>
            </select>
        </label>
    </p>
    <?php
}

// widget_area.
add_action( 'wp_nav_menu_item_custom_fields', 'book_junky_add_menu_widget_area_fields', 10, 4 );

function book_junky_add_menu_widget_area_fields( $item_id, $item, $depth, $args ) {

    if(!$depth)
        return;

    $title = esc_html__('Widget Area', 'book-junky'); $key = "menu-item-widget_area"; $value = $item->widget_area; $sidebars = $GLOBALS['wp_registered_sidebars'];

    ?><p class="description description-wide description_width_100 el_widget_area">
        <?php echo esc_html( $title ); ?><br />
        <label for="edit-<?php echo ''.$key . '-' . $item_id; ?>">
            <select id="edit-<?php echo ''.$key . '-' . $item_id; ?>" class=" <?php echo ''.$key; ?>" name="<?php echo ''.$key . "[" . $item_id . "]"; ?>">
                <option value="" <?php echo ( $value == '' ) ? ' selected="selected" ' : ''; ?>><?php esc_html_e( 'Select Widget Area', 'book-junky' ); ?></option>
                <?php foreach ( $sidebars as $sidebar ) {
                    echo '<option value="' . $sidebar['id'] . '" ' . ( ( $value == $sidebar['id'] ) ? ' selected="selected" ' : '' ) . '>[' . $sidebar['id'] . '] - ' . $sidebar['name'] . '</option>';
                } ?>
            </select>
        </label>
    </p><?php
}

// item_group.
add_action( 'wp_nav_menu_item_custom_fields', 'book_junky_add_menu_item_group_fields', 10, 4 );

function book_junky_add_menu_item_group_fields( $item_id, $item, $depth, $args ) {
    $title = esc_html__('Group', 'book-junky'); $key = "menu-item-group";

    if(!$item->group)
        $item->group = 'no_group';

    ?>
    <p class="description description-wide description_width_100">
        <span><?php echo esc_html( $title ); ?></span><br />
    <div>
        <label><?php esc_html_e('No', 'book-junky'); ?>
            <input type="radio" class="<?php echo esc_attr($key); ?>" name="<?php echo $key . '['.$item_id.']';?>" value="no_group"<?php if($item->group == 'no_group') { echo ' checked="checked"';} ?>>
        </label>
        <label><?php esc_html_e('Yes', 'book-junky'); ?>
            <input type="radio" class="<?php echo esc_attr($key); ?>" name="<?php echo $key . '['.$item_id.']';?>" value="group"<?php if($item->group == 'group') { echo ' checked="checked"';} ?>>
        </label>
    </div>
    </p>
    <?php
}


// hidden title.
add_action( 'wp_nav_menu_item_custom_fields', 'book_junky_add_menu_none_title', 10, 4 );

function book_junky_add_menu_none_title( $item_id, $item, $depth, $args ) {
    if(!$depth)
        return;

    $title = esc_html__('None title', 'book-junky'); $key = "menu-item-none_title"; $value = $item->none_title;

    ?>
    <p class="description description-wide description_width_100">
        <?php echo esc_html( $title ); ?><br />
        <label for="edit-<?php echo $key . '-' . $item_id; ?>">
            <select id="edit-<?php echo $key . '-' . $item_id; ?>" class=" <?php echo $key; ?>" name="<?php echo $key . "[" . $item_id . "]"; ?>">
                <option value="0" <?php echo ( $value == '0' ) ? ' selected="selected" ' : ''; ?>><?php esc_html_e( 'No', 'book-junky' ); ?></option>
                <option value="1" <?php echo ( $value == '1' ) ? ' selected="selected" ' : ''; ?>><?php esc_html_e( 'Yes', 'book-junky' ); ?></option>
            </select>
        </label>
    </p>
    <?php
}

// hide_link.
add_action( 'wp_nav_menu_item_custom_fields', 'book_junky_add_menu_hide_link_fields', 10, 4 );

function book_junky_add_menu_hide_link_fields( $item_id, $item, $depth, $args ) {
    if(!$depth)
        return;

    $title = esc_html__('No title', 'book-junky'); $key = "menu-item-hide_link"; $value = $item->hide_link;

    ?>
    <p class="description description-wide description_width_100">
        <?php echo esc_html( $title ); ?><br />
        <label for="edit-<?php echo $key . '-' . $item_id; ?>">
            <select id="edit-<?php echo $key . '-' . $item_id; ?>" class=" <?php echo $key; ?>" name="<?php echo $key . "[" . $item_id . "]"; ?>">
                <option value="0" <?php echo ( $value == '0' ) ? ' selected="selected" ' : ''; ?>><?php esc_html_e( 'No', 'book-junky' ); ?></option>
                <option value="1" <?php echo ( $value == '1' ) ? ' selected="selected" ' : ''; ?>><?php esc_html_e( 'Yes', 'book-junky' ); ?></option>
            </select>
        </label>
    </p>
    <?php
}

// extra class
add_action( 'wp_nav_menu_item_custom_fields', 'book_junky_add_menu_el_class_fields', 10, 4 );

function book_junky_add_menu_el_class_fields( $item_id, $item, $depth, $args ) {

    $title = esc_html__('Extra Class', 'book-junky'); $key = "menu-item-el_class"; 
    $value = $item->el_class;

    ?><p class="description description-wide description_width_100">
        <label for="edit-<?php echo $key . '-' . $item_id; ?>">
            <span class='obtheme_long_desc'><?php echo esc_html( $title ); ?></span><br />
            <input type="text" value="<?php echo $value; ?>" id="edit-<?php echo $key . '-' . $item_id; ?>" class=" <?php echo $key; ?>" name="<?php echo $key . "[" . $item_id . "]"; ?>" />
        </label>
    </p><?php
}


class Walker_Nav_Menu_Edit_Custom extends Walker_Nav_Menu  {
    /**
     * @see Walker_Nav_Menu::start_lvl()
     * @since 3.0.0
     *
     * @param string $output Passed by reference.
     */
    function start_lvl( &$output, $depth = 0, $args = array() ) {}

    /**
     * @see Walker_Nav_Menu::end_lvl()
     * @since 3.0.0
     *
     * @param string $output Passed by reference.
     */
    function end_lvl( &$output, $depth = 0, $args = array() ) {}

    /**
     * @see Walker::start_el()
     * @since 3.0.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $item Menu item data object.
     * @param int $depth Depth of menu item. Used for padding.
     * @param object $args
     */
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        global $_wp_nav_menu_max_depth, $wp_registered_sidebars;
        $_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;

        ob_start();
        $item_id = esc_attr( $item->ID );
        $removed_args = array(
            'action',
            'customlink-tab',
            'edit-menu-item',
            'menu-item',
            'page-tab',
            '_wpnonce',
        );

        $original_title = '';
        if ( 'taxonomy' == $item->type ) {
            $original_title = get_term_field( 'name', $item->object_id, $item->object, 'raw' );
            if ( is_wp_error( $original_title ) )
                $original_title = false;
        } elseif ( 'post_type' == $item->type ) {
            $original_object = get_post( $item->object_id );
            $original_title = get_the_title( $original_object->ID );
        }

        $classes = array(
            'menu-item menu-item-depth-' . $depth,
            'menu-item-' . esc_attr( $item->object ),
            'menu-item-edit-' . ( ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? 'active' : 'inactive'),
        );

        $title = $item->title;

        if ( ! empty( $item->_invalid ) ) {
            $classes[] = 'menu-item-invalid';
            /* translators: %s: title of menu item which is invalid */
            $title = sprintf( esc_html__( '%s (Invalid)', 'book-junky'), $item->title );
        } elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
            $classes[] = 'pending';
            /* translators: %s: title of menu item in draft status */
            $title = sprintf( esc_html__('%s (Pending)', 'book-junky'), $item->title );
        }

        $title = ( ! isset( $item->label ) || '' == $item->label ) ? $title : $item->label;

        $submenu_text = '';
        if ( 0 == $depth )
            $submenu_text = 'style="display: none;"';

        ?>
    <li id="menu-item-<?php echo esc_attr($item_id); ?>" class="<?php echo implode(' ', $classes ); ?>">
        <dl class="menu-item-bar">
            <dt class="menu-item-handle">
                <span class="item-title"><span class="menu-item-title"><?php echo esc_html( $title ); ?></span> <span class="is-submenu" <?php echo $submenu_text; ?>><?php esc_html_e( 'sub item' , 'book-junky'); ?></span></span>
                <span class="item-controls">
                    <span class="item-type"><?php echo esc_html( $item->type_label ); ?></span>
                    <span class="item-order hide-if-js">
                        <a href="<?php
                        echo esc_url( wp_nonce_url(
                            add_query_arg(
                                array(
                                    'action' => 'move-up-menu-item',
                                    'menu-item' => $item_id,
                                ),
                                remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
                            ),
                            'move-menu_item'
                        ) );
                        ?>" class="item-move-up"><abbr title="<?php esc_attr_e('Move up', 'book-junky'); ?>">&#8593;</abbr></a>
                        |
                        <a href="<?php
                        echo esc_url( wp_nonce_url(
                            add_query_arg(
                                array(
                                    'action' => 'move-down-menu-item',
                                    'menu-item' => $item_id,
                                ),
                                remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
                            ),
                            'move-menu_item'
                        ) );
                        ?>" class="item-move-down"><abbr title="<?php esc_attr_e('Move down', 'book-junky'); ?>">&#8595;</abbr></a>
                    </span>
                    <a class="item-edit" id="edit-<?php echo esc_attr($item_id); ?>" title="<?php esc_attr_e('Edit Menu Item', 'book-junky'); ?>" href="<?php
                    echo esc_url( ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? admin_url( 'nav-menus.php' ) : add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) ) );
                    ?>"><?php esc_html_e( 'Edit Menu Item', 'book-junky' ); ?></a>
                </span>
            </dt>
        </dl>

        <div class="menu-item-settings" id="menu-item-settings-<?php echo esc_attr($item_id); ?>">
            <?php if( 'custom' == $item->type ) : ?>
                <p class="field-url description description-wide">
                    <label for="edit-menu-item-url-<?php echo esc_attr($item_id); ?>">
                        <?php esc_html_e( 'URL', 'book-junky' ); ?><br />
                        <input type="text" id="edit-menu-item-url-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->url ); ?>" />
                    </label>
                </p>
            <?php endif; ?>
            <p class="description description-thin">
                <label for="edit-menu-item-title-<?php echo esc_attr($item_id); ?>">
                    <?php esc_html_e( 'Navigation Label', 'book-junky' ); ?><br />
                    <input type="text" id="edit-menu-item-title-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->title ); ?>" />
                </label>
            </p>
            <p class="description description-thin">
                <label for="edit-menu-item-attr-title-<?php echo esc_attr($item_id); ?>">
                    <?php esc_html_e( 'Title Attribute', 'book-junky' ); ?><br />
                    <input type="text" id="edit-menu-item-attr-title-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
                </label>
            </p>
            <p class="field-link-target description">
                <label for="edit-menu-item-target-<?php echo esc_attr($item_id); ?>">
                    <input type="checkbox" id="edit-menu-item-target-<?php echo esc_attr($item_id); ?>" value="_blank" name="menu-item-target[<?php echo esc_attr($item_id); ?>]"<?php checked( $item->target, '_blank' ); ?> />
                    <?php esc_html_e( 'Open link in a new window/tab', 'book-junky' ); ?>
                </label>
            </p>

            <?php do_action( 'wp_nav_menu_item_custom_fields', $item_id, $item, $depth, $args ); ?>

            <p class="field-move hide-if-no-js description description-wide">
                <label>
                    <span><?php esc_html_e( 'Move', 'book-junky' ); ?></span>
                    <a href="#" class="menus-move menus-move-up" data-dir="up"><?php esc_html_e( 'Up one', 'book-junky' ); ?></a>
                    <a href="#" class="menus-move menus-move-down" data-dir="down"><?php esc_html_e( 'Down one', 'book-junky' ); ?></a>
                    <a href="#" class="menus-move menus-move-left" data-dir="left"></a>
                    <a href="#" class="menus-move menus-move-right" data-dir="right"></a>
                    <a href="#" class="menus-move menus-move-top" data-dir="top"><?php esc_html_e( 'To the top', 'book-junky' ); ?></a>
                </label>
            </p>

            <div class="menu-item-actions description-wide submitbox">
                <?php if( 'custom' != $item->type && $original_title !== false ) : ?>
                    <p class="link-to-original">
                        <?php printf( esc_html__('Original: %s', 'book-junky' ), '<a href="' . esc_attr( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>
                    </p>
                <?php endif; ?>
                <a class="item-delete submitdelete deletion" id="delete-<?php echo esc_attr($item_id); ?>" href="<?php
                echo esc_url( wp_nonce_url(
                    add_query_arg(
                        array(
                            'action' => 'delete-menu-item',
                            'menu-item' => $item_id,
                        ),
                        admin_url( 'nav-menus.php' )
                    ),
                    'delete-menu_item_' . $item_id
                ) ); ?>"><?php esc_html_e( 'Remove', 'book-junky' ); ?></a> <span class="meta-sep hide-if-no-js"> | </span> <a class="item-cancel submitcancel hide-if-no-js" id="cancel-<?php echo esc_attr($item_id); ?>" href="<?php echo esc_url( add_query_arg( array( 'edit-menu-item' => $item_id, 'cancel' => time() ), admin_url( 'nav-menus.php' ) ) );
                ?>#menu-item-settings-<?php echo esc_attr($item_id); ?>"><?php esc_html_e('Cancel', 'book-junky' ); ?></a>
            </div>

            <input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr($item_id); ?>" />
            <input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->object_id ); ?>" />
            <input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->object ); ?>" />
            <input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->menu_item_parent ); ?>" />
            <input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->menu_order ); ?>" />
            <input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->type ); ?>" />
        </div><!-- .menu-item-settings-->
        <ul class="menu-item-transport"></ul>
        <?php
        $output .= ob_get_clean();
    }
}

class HeroMenuWalker extends Walker_Nav_Menu {
    function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
        if ( ! $element ) {
            return;
        }
        $id_field = $this->db_fields['id'];
        //display this element
        if ( isset( $args[0] ) && is_array( $args[0] ) ) {
            $args[0]['has_children'] = ! empty( $children_elements[$element->$id_field] );
        }
        $cb_args = array_merge( array( &$output, $element, $depth ), $args );
        call_user_func_array( array( $this, 'start_el' ), $cb_args );

        $id = $element->$id_field;

        // descend only when the depth is right and there are childrens for this element
        if ( ( $max_depth == 0 || $max_depth > $depth + 1 ) && isset( $children_elements[$id] ) ) {
            $b          = $args[0];
            $b->element = $element;
            $b->count_child = count($children_elements[$id]);
            //$b->mega_child = $element->mega;
            $args[0]    = $b;
            foreach ( $children_elements[$id] as $child ) {
                if ( ! isset( $newlevel ) ) {
                    $newlevel = true;
                    //start the child delimiter
                    $cb_args = array_merge( array( &$output, $depth ), $args );
                    $cb_args = array_merge( array( &$output, $depth ), $args );
                    call_user_func_array( array( $this, 'start_lvl' ), $cb_args );
                }
                $this->display_element( $child, $children_elements, $max_depth, $depth + 1, $args, $output );
            }
            unset( $children_elements[$id] );
        }

        if ( isset( $newlevel ) && $newlevel ) {
            //end the child delimiter
            $cb_args = array_merge( array( &$output, $depth ), $args );
            call_user_func_array( array( $this, 'end_lvl' ), $cb_args );
        }

        //end this element
        $cb_args = array_merge( array( &$output, $element, $depth ), $args );
        call_user_func_array( array( $this, 'end_el' ), $cb_args );
    }

    function start_lvl( &$output, $depth = 0, $args = array() )  {
        $bg_image        = isset($args->element->bg_image)?$args->element->bg_image:'';
        $column_width        = isset($args->element->column_width)?(!empty($args->element->column_width)?$args->element->column_width:200):200;
        $submenu_type        = isset($args->element->submenu_type)?$args->element->submenu_type:'columns4';
        $has_mega_menu = isset($item->has_mega_menu)?$item->has_mega_menu:'';
        $dropdown        = isset($args->element->dropdown)?$args->element->dropdown:'drop_to_left';
        $class = null;
        $style = 'style="';
        $columns = array('columns2'=>2,'columns3'=>3,'columns4'=>4);
        if($submenu_type != 'standard' && $depth == 0){
            if(isset($columns[$submenu_type])){
                $style = 'style="width:'.($column_width*$columns[$submenu_type]).'px;';
                $class = 'multicolumn mega-columns-'.$columns[$submenu_type];
            }
            $class = 'multicolumn';
        }else if($depth == 0){
            $style = 'style="width:'.($column_width).'px;';
            $class = 'standar-dropdown';
        }

        if($has_mega_menu == "1"){
            $classes .= ' has-mega-menu';
        }

        $class .= ' '.$submenu_type;
        $class .= ' '.$dropdown;
        $class = $bg_image?$class .= ' sub-menu mega-bg-image':$class .= ' sub-menu';
        
        $style .='"';
        $indent = str_repeat( "\t", $depth );

        $output .= "\n$indent<ul class='$class' $style>\n";
    }

    public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
        $class_names = '';
        $dropdown = isset($item->dropdown)?$item->dropdown:'';
        $none_title = isset($item->none_title)?$item->none_title:'';
        $hide_link = isset($item->hide_link)?$item->hide_link:0;
        $group = isset($item->group)?$item->group:'';
        $has_mega_menu = isset($item->has_mega_menu)?$item->has_mega_menu:'';
        $el_class = isset($item ->el_class) ? $item ->el_class : '';
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        if($dropdown == "drop_full_width"){
            $classes[]= 'has_full_width';
        }

        if($none_title == "1"){
            $classes[] = 'no-title';
        }

        if($has_mega_menu == "1"){
            $classes[] = 'has-mega-menu';
        }

        $classes[]= $group;
        $classes[]= $el_class;
        $classes[] = 'menu-item-' . $item->ID;
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
        $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
        $output .= $indent . '<li' . $id . $class_names .' data-depth="'.$depth.'">';
        $atts = array();
        $atts['target'] = ! empty( $item->target )     ? $item->target     : '';
        $atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
        $atts['href']   = ! empty( $item->url )        ? $item->url        : '';
        $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );
        $attributes = '';
        foreach ( $atts as $attr => $value ) {
            if ( ! empty( $value ) ) {
                $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }
        $attr_title  = ! empty( $item->attr_title ) ? $item->attr_title : '';
        $item_output = isset($args->before)?$args->before:'';
        $link_before = isset($args->link_before)?$args->link_before:'';
        $link_after = isset($args->link_after)?$args->link_after:'';
        $after = isset($args->after)?$args->after:'';
        $one_page = isset($item->is_onepage) && $item->is_onepage ? 'is-one-page' : '';
        if(!$hide_link || $hide_link=="0"){
            $item_output .= '<a'. $attributes .' class="'.$one_page.'">';
            
            $item_output.='<span class="menu-title">';
            $item_output .= $link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $link_after;
            if ( $attr_title ) {
                $item_output .= '<span class="title-attribute">'.$attr_title.'</span> ';
            }
            $item_output .= '</span></a>';
        }

        $widget_area = $item->widget_area;

        if ($widget_area && $depth != 0) {
            ob_start();
            dynamic_sidebar($widget_area);
            $content         = ob_get_clean();
            if ( $content ) {
                $item_output .= $content;
            }
        }
        $item_output .= $after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }

}