<?php
/*
Plugin Name: Setpress Staff
Description: A plugin that adds a staff post-type.
Version: 1.0
License: GPL
Author: Yadiel Arroyo
Author URI: http://yadielar.com
*/

/* Register Custom Post Type: Faculty */
add_action( 'init', 'register_cpt_staff' );

function register_cpt_staff() {

    $labels = array(
        'name' => _x( 'Personal', 'staff' ),
        'singular_name' => _x( 'Personal', 'staff' ),
        'add_new' => _x( 'Añadir nuevo', 'staff' ),
        'add_new_item' => _x( 'Añadir nuevo miembro del personal', 'staff' ),
        'edit_item' => _x( 'Editar miembro del personal', 'staff' ),
        'new_item' => _x( 'Nuevo miembro del personal', 'staff' ),
        'view_item' => _x( 'Ver miembro del personal', 'staff' ),
        'search_items' => _x( 'Buscar en Personal', 'staff' ),
        'not_found' => _x( 'No se ha hallado ningun miembro', 'staff' ),
        'not_found_in_trash' => _x( 'No se ha hallado ningun miembro en la Papelera', 'staff' ),
        'parent_item_colon' => _x( 'Miembro del Personal padre:', 'staff' ),
        'menu_name' => _x( 'Personal', 'staff' ),
    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'description' => 'Miembros del Personal y descripciones',
        'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 20,
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => array( 'slug' => 'personal' ),
        'capability_type' => 'post'
    );

    register_post_type( 'staff', $args );
}


/* Register Taxonomy: Departamento */
add_action( 'init', 'department_init' );

function department_init() {

    register_taxonomy('department', array('staff'), array(

    'hierarchical' => true,
    'labels' => array(
        'name' => _x( 'Departamentos', 'departamentos' ),
        'singular_name' => _x( 'Departamento', 'departamento' ),
        'search_items' =>  __( 'Buscar Departamentos' ),
        'all_items' => __( 'Todos' ),
        'parent_item' => __( 'Departamento Padre' ),
        'parent_item_colon' => __( 'Departamento Padre:' ),
        'edit_item' => __( 'Editar Departamento' ),
        'update_item' => __( 'Actualizar Departamento' ),
        'add_new_item' => __( 'Añadir Nuevo Departamento' ),
        'new_item_name' => __( 'Nombre del Nuevo Departamento' ),
        'menu_name' => __( 'Departamentos' ),
    ),
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'departamento' ),
  ));
}

/* Register Taxonomy: Grado */
add_action( 'init', 'grade_init' );

function grade_init() {

    register_taxonomy('grade', array('staff'), array(

    'hierarchical' => false,
    'labels' => array(
        'name' => _x( 'Grados', 'grados' ),
        'singular_name' => _x( 'Grado', 'grado' ),
        'search_items' =>  __( 'Buscar Grados' ),
        'all_items' => __( 'Todos' ),
        //'parent_item' => __( 'Grado Padre' ),
        //'parent_item_colon' => __( 'Grado Padre:' ),
        'edit_item' => __( 'Editar Grado' ),
        'update_item' => __( 'Actualizar Grado' ),
        'add_new_item' => __( 'Añadir Nuevo Grado' ),
        'new_item_name' => __( 'Nombre del Nuevo Grado' ),
        'menu_name' => __( 'Grados' ),
        'separate_items_with_commas' => __( 'Separa los grados con comas.' ),
        'choose_from_most_used' => __( 'Elige entre los grados más utilizados' ),
        'not_found' => __( 'No se han utilizado grados recientemente.' ),
    ),
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'sort' => false,
    'rewrite' => array( 'slug' => 'grado' ),
  ));
}


/* Add Custom Meta Boxes */
add_action( 'add_meta_boxes', 'add_staff_metaboxes' );

// Add the Staff Meta Boxes
function add_staff_metaboxes() {
    add_meta_box('setpress_staff_info', 'Información del Personal', 'setpress_staff_info', 'staff', 'normal', 'high');
}
// The Staff Info Metabox
function setpress_staff_info() {
    global $post;
    // Noncename needed to verify where the data originated
    echo '<input type="hidden" name="staffmeta_noncename" id="staffmeta_noncename" value="' .
    wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
    // Get the location data if its already been entered
    $courses = get_post_meta($post->ID, '_courses', true);
    $roles = get_post_meta($post->ID, '_roles', true);
    $homeroom = get_post_meta($post->ID, '_homeroom', true);
    // Echo out the fields
    echo '<p><strong>Materias</strong></p>';
    echo '<p><input type="text" name="_courses" value="' . $courses  . '" class="widefat" /></p>';
    echo '<p class="howto">Separa las materias con comas.</p>';
    echo '<hr style="border-bottom: none; border-top: 1px solid #EEE;">';

    echo '<p><strong>Posición / Otros Roles</strong></p>';
    echo '<p><input type="text" name="_roles" value="' . $roles  . '" class="widefat" /></p>';
    echo '<p class="howto">Ejemplo: Directora, Cordinadora, Moderadora, etc.</p>';
    echo '<hr style="border-bottom: none; border-top: 1px solid #EEE;">';

    echo '<p><strong>Salón Hogar</strong></p>';
    echo '<p><input type="text" name="_homeroom" value="' . $homeroom  . '" size="10" /></p>';
}
// Save the Metabox Data
function setpress_save_staffinfo_meta($post_id, $post) {
    // verify this came from the our screen and with proper authorization,
    // because save_post can be triggered at other times
    if ( !wp_verify_nonce( $_POST['staffmeta_noncename'], plugin_basename(__FILE__) )) {
        return $post->ID;
    }
    // Is the user allowed to edit the post or page?
    if ( !current_user_can( 'edit_post', $post->ID ))
        return $post->ID;
    // OK, we're authenticated: we need to find and save the data
    // We'll put it into an array to make it easier to loop though.
    $staffinfo_meta['_courses'] = $_POST['_courses'];
    $staffinfo_meta['_roles'] = $_POST['_roles'];
    $staffinfo_meta['_homeroom'] = $_POST['_homeroom'];
    // Add values of $staffinfo_meta as custom fields
    foreach ($staffinfo_meta as $key => $value) { // Cycle through the $staffinfo_meta array!
        if( $post->post_type == 'revision' ) return; // Don't store custom data twice
        $value = implode(',', (array)$value); // If $value is an array, make it a CSV (unlikely)
        if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
            update_post_meta($post->ID, $key, $value);
        } else { // If the custom field doesn't have a value
            add_post_meta($post->ID, $key, $value);
        }
        if(!$value) delete_post_meta($post->ID, $key); // Delete if blank
    }
}
add_action('save_post', 'setpress_save_staffinfo_meta', 1, 2); // save the custom fields







/* Add Custom Post Type Icon */
add_action( 'admin_head', 'custom_post_type_icon' );

function custom_post_type_icon() {
    ?>
    <style>
        /* Admin Menu - 16px */
        #menu-posts-staff .wp-menu-image {
            background: url(<?php bloginfo( 'wpurl' ); ?>/wp-content/plugins/setpress-staff/images/icon-adminmenu16-sprite.png) no-repeat 6px 6px !important;
        }
		#menu-posts-staff:hover .wp-menu-image, #menu-posts-staff.wp-has-current-submenu .wp-menu-image {
            background-position: 6px -26px !important;
        }
        /* Post Screen - 32px */
        .icon32-posts-staff {
        	background: url(<?php bloginfo( 'wpurl' ); ?>/wp-content/plugins/setpress-staff/images/icon-adminpage32.png) no-repeat left top !important;
        }
        @media
        only screen and (-webkit-min-device-pixel-ratio: 1.5),
        only screen and (   min--moz-device-pixel-ratio: 1.5),
        only screen and (     -o-min-device-pixel-ratio: 3/2),
        only screen and (        min-device-pixel-ratio: 1.5) {

        	/* Admin Menu - 16px @2x */
        	#menu-posts-staff .wp-menu-image {
        		background-image: url('<?php bloginfo( 'wpurl' ); ?>/wp-content/plugins/setpress-staff/images/icon-adminmenu16-sprite@2x.png') !important;
        		-webkit-background-size: 16px 48px;
        		-moz-background-size: 16px 48px;
        		background-size: 16px 48px;
        	}
        	/* Post Screen - 32px @2x */
        	.icon32-posts-staff {
        		background-image: url('<?php bloginfo( 'wpurl' ); ?>/wp-content/plugins/setpress-staff/images/icon-adminpage32@2x.png') !important;
        		-webkit-background-size: 32px 32px;
        		-moz-background-size: 32px 32px;
        		background-size: 32px 32px;
        	}
        }
    </style>
<?php }

function staff_rewrite_flush() {
    // First, we "add" the custom post type via the above written function.
    // Note: "add" is written with quotes, as CPTs don't get added to the DB,
    // They are only referenced in the post_type column with a post entry,
    // when you add a post of this CPT.
    register_cpt_staff();
    department_init();
    grade_init();

    // ATTENTION: This is *only* done during plugin activation hook in this example!
    // You should *NEVER EVER* do this on every page load!!
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'staff_rewrite_flush' );

?>