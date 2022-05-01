<?php
/*
Plugin Name: Estatik Bookings
Description: This is my Estatik Bookings plugin! It makes a new admin menu link!
Author: Michael Yang
*/


/**
 * Register meta boxes.
 */

function bcf_register_meta_boxes() {
    add_meta_box( 'bcf-1', __( 'booking-custom-field', 'bcf' ), 'bcf_display_callback', 'post' );
}
add_action( 'add_meta_boxes', 'bcf_register_meta_boxes' );

/**
 * Meta box display callback.
 *
 * @param WP_Post $post Current post object.
 */

function bcf_display_callback( $post ) {
    include plugin_dir_path( __FILE__ ) . './form.php';
}

/**
 * Save meta box content.
 *
 * @param int $post_id Post ID
 */
function bcf_save_meta_box( $post_id ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( $parent_id = wp_is_post_revision( $post_id ) ) {
        $post_id = $parent_id;
    }
    $fields = [
        'bcf_start_date',
        'bcf_end_date',
        'bcf_address',
    ];
    foreach ( $fields as $field ) {
        if ( array_key_exists( $field, $_POST ) ) {
            update_post_meta( $post_id, $field, sanitize_text_field( $_POST[$field] ) );
        }
     }
}
add_action( 'save_post', 'bcf_save_meta_box' );


add_action( 'single_booking_page', 'custom_address_map', 30 );
function custom_address_map() {

    if( function_exists( 'get_field' ) && $location = get_field( 'bcf_address' ) ) { ?>
        <div class="bcf-map">
            <div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>
        </div>
    <?php }
}

function booking_register_post_type() {
 
    // booking
 
    $labels = array( 
 
        'name' => __( 'Booking' , 'booking' ),
 
        'singular_name' => __( 'Booking' , 'booking' ),
 
        'add_new' => __( 'New Booking' , 'booking' ),
 
        'add_new_item' => __( 'Add New Booking' , 'booking' ),
 
        'edit_item' => __( 'Edit Booking' , 'booking' ),
 
        'new_item' => __( 'New Booking' , 'booking' ),
 
        'view_item' => __( 'View Booking' , 'booking' ),
 
        'search_items' => __( 'Search Booking' , 'booking' ),
 
        'not_found' =>  __( 'No Booking Found' , 'booking' ),
 
        'not_found_in_trash' => __( 'No Booking found in Trash' , 'booking' ),
 
    );
 
    $args = array(
 
        'labels' => $labels,
 
        'has_archive' => true,
 
        'public' => true,
 
        'hierarchical' => false,
 
        'supports' => array(
 
            'title', 
 
            'editor', 
 
            'excerpt', 
 
            'custom-fields', 
 
            'thumbnail',
 
            'page-attributes'
 
        ),
 
        'rewrite'   => array( 'slug' => 'booking' ),
 
        'show_in_rest' => true
 
    );
 
}

add_action( 'init', 'booking_register_post_type' );

function booking_register_taxonomy() {    
      
    // books
    $labels = array(
        'name' => __( 'Genres' , 'booking' ),
        'singular_name' => __( 'Genre', 'booking' ),
        'search_items' => __( 'Search Genres' , 'booking' ),
        'all_items' => __( 'All Genres' , 'booking' ),
        'edit_item' => __( 'Edit Genre' , 'booking' ),
        'update_item' => __( 'Update Genres' , 'booking' ),
        'add_new_item' => __( 'Add New Genre' , 'booking' ),
        'new_item_name' => __( 'New Genre Name' , 'booking' ),
        'menu_name' => __( 'Genres' , 'booking' ),
    );
      
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'sort' => true,
        'args' => array( 'orderby' => 'term_order' ),
        'rewrite' => array( 'slug' => 'genres' ),
        'show_admin_column' => true,
        'show_in_rest' => true
  
    );
      
    register_taxonomy( 'booking_genre', array( 'booking_booking' ), $args);
      
}
add_action( 'init', 'booking_register_taxonomy' );


function booking_styles() {
    wp_enqueue_style( 'booking',  plugin_dir_url( __FILE__ ) . '/css/booking-style.css' );                      
}
add_action( 'wp_enqueue_scripts', 'booking_styles' );


