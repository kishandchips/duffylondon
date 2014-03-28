<?php

define('THEME_NAME', 'duffy');

require( get_template_directory() . '/inc/default/functions.php' );

require( get_template_directory() . '/inc/default/hooks.php' );

require( get_template_directory() . '/inc/default/shortcodes.php' );

// Custom Actions
add_image_size( 'main-nav-thumb', 155, 110, true );
add_image_size( 'misc-thumb', 500, 500, true );
add_image_size('full-width', 1200, 9999, false);
add_image_size('cat-thumb', 1200, 300, true);

//Breadcrumbs and Wrappers
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );

//Archive Single Product
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

//CONTENT_PRODUCT
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price');
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash',10);
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart');
remove_action( 'woocommerce_before_shop_loop','woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop','woocommerce_catalog_ordering', 30);
add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 11);
add_action('woocommerce_archive_options', 'woocommerce_result_count', 20);
add_action('woocommerce_archive_options', 'woocommerce_pagination', 20);

//CONTENT PRODUCT CAT
remove_action( 'woocommerce_before_subcategory_title', 'woocommerce_subcategory_thumbnail',10);
add_action( 'woocommerce_before_subcategory_title', 'custom_woocommerce_subcategory_thumbnail',10 );

//SINGLE PRODUCT
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 25 );
add_action('woocommerce_single_product_summary', 'custom_woocommerce_add_tagline', 15);
add_action('woocommerce_after_single_product','custom_woocommerce_after_single_product',30 );
add_action('custom_woocommerce_before_main_content', 'single_product_wrapper_start', 10);
add_action('custom_woocommerce_after_main_content', 'single_product_wrapper_end', 10);


//CART
remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );


//SHORTCODES
add_shortcode( 'button', 'add_button' );

function add_button( $atts, $content = null ) {
	$url = site_url('/contact' );  
    return '<p class="test-contact"><strong>Get in touch for more information:</strong></p><p><a href=" ' . $url . ' " class="button alt">'.$content.'</a></p>';  
}  

add_action( 'after_setup_theme', 'custom_setup_theme' );
add_action( 'init', 'custom_init');
add_action( 'wp', 'custom_wp');
add_action( 'admin_menu', 'custom_remove_menus');
add_action( 'widgets_init', 'custom_widgets_init' );
add_action( 'wp_enqueue_scripts', 'custom_scripts', 30);
add_action( 'wp_print_styles', 'custom_styles', 30);

// Custom Filters

add_filter( 'woocommerce_subcategory_count_html', 'custom_woocommerce_subcategory_count_html');

function custom_woocommerce_subcategory_count_html(){
	return false;
}

add_filter('woocommerce_product_thumbnails_columns', 'custom_woocommerce_thumbnails_columns');

function custom_woocommerce_thumbnails_columns(){
	return 2;
}

add_filter( 'loop_shop_columns', 'custom_woocommerce_shop_columns');

function custom_woocommerce_shop_columns(){
	return 6;
}

add_filter( 'woocommerce_enqueue_styles', 'custom_remove_your_shit');

function custom_remove_your_shit(){
	return false;
}

add_filter( 'loop_shop_per_page', 'custom_shop_per_page', 20 );

function custom_shop_per_page(){
	if(isset($_GET['view_all'])) {
		return -1;
	} else {
		return get_option( 'posts_per_page' );
	}
}

add_filter('parse_query', 'custom_parse_query');

function custom_parse_query($query) {
	if (!$query->is_main_query())
		return;

	//if(!is_admin() && isset($query->query_vars['post_type']) && $query->query_vars['post_type'] != 'product' ){
	if(!is_admin() && (is_post_type_archive('product') || is_tax('product_cat'))){
		$query->query_vars['tax_query'][] = array(
			'taxonomy' => 'language',
			'field'    => 'term_taxonomy_id',
			'terms'    => 74,
			'operator' => 'IN'
		);
	}
}

add_filter( 'upload_mimes', 'cc_mime_types' );

function cc_mime_types( $mimes ){
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}

add_filter( 'template_include', 'custom_template_include', 99 );
add_filter( 'query_vars', 'custom_query_vars');
add_filter( 'nmi_menu_item_content', 'md_nmi_custom_content', 10, 3 );


function custom_setup_theme() {
	
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support('woocommerce');
	add_theme_support('editor_style');
	add_editor_style('/editor-styles.css');

	register_nav_menus( array(
		'primary' => __( 'Footer Main', THEME_NAME ),
		'footer' => __( 'Footer Secondary', THEME_NAME ),
		'subnavigation-test' => __( 'Testimonial', THEME_NAME ),
		'subnavigation-press' => __( 'Press', THEME_NAME ),
	) );
}

function custom_init(){
	require( get_template_directory() . '/inc/classes/custom-post-type.php' );
	if(function_exists('get_field')) {
		$testimonials_page = get_field('testimonials_page', 'options');
		$testimonial = new Custom_Post_Type( 'testimonial', 
	 		array(
	 			'rewrite' => array( 'with_front' => false, 'slug' => get_page_uri($testimonials_page->ID) ),
	 			'capability_type' => 'post',
	 		 	'publicly_queryable' => true,
	   			'has_archive' => true, 
	    		'hierarchical' => false,
	    		'exclude_from_search' => true,
	    		'menu_position' => null,
	    		'supports' => array('title', 'editor', 'page-attributes','thumbnail'),
	    		'plural' => 'Testimonials'
	   		)
	   	);
	   	$press_page = get_field('press_page', 'options');
		$press = new Custom_Post_Type( 'press', 
	 		array(
	 			'rewrite' => array( 'with_front' => false, 'slug' => get_page_uri($press_page->ID) ),
	 			'capability_type' => 'post',
	 		 	'publicly_queryable' => true,
	   			'has_archive' => true, 
	    		'hierarchical' => false,
	    		'exclude_from_search' => true,
	    		'menu_position' => null,
	    		'supports' => array('title', 'editor', 'page-attributes','thumbnail'),
	    		'plural' => 'Press'
	   		)
	   	);
	   	$exhibitions = new Custom_Post_Type( 'exhibition', 
	 		array(
	 			'capability_type' => 'post',
	 		 	'publicly_queryable' => true,
	   			'has_archive' => true, 
	    		'exclude_from_search' => true,
	    		'menu_position' => null,
	    		'supports' => array('title', 'editor', 'page-attributes','thumbnail'),
	    		'plural' => 'Exhibitions',
	    		'taxonomies'          => array('year' ),
	   		)
	   	);

	   	//taxonomy for exhibitions

		$labels = array(
			'name'                       => _x( 'Years', 'Taxonomy General Name', 'text_domain' ),
			'singular_name'              => _x( 'Year', 'Taxonomy Singular Name', 'text_domain' )
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => false,
			'public'                     => true,
		);
		register_taxonomy( 'year', array( 'exhibition' ), $args );
	}
}

function custom_remove_menus () {
	global $menu;
	$restricted = array(__('Links'), __('Comments'), __('Posts'));
	end ($menu);
	while (prev($menu)){
		$value = explode(' ',$menu[key($menu)][0]);
		if(in_array($value[0] != NULL?$value[0]:"" , $restricted)) unset($menu[key($menu)]);
	}
}

function custom_scripts() {
	wp_deregister_script('jquery');

	wp_enqueue_script('modernizr', get_template_directory_uri().'/js/libs/modernizr.min.js');
	wp_enqueue_script('jquery',  get_template_directory_uri().'/js/libs/jquery.min.js');
	wp_enqueue_script('easing', get_template_directory_uri().'/js/plugins/jquery.easing.js', array('jquery'), '', true);
	wp_enqueue_script('prettyphoto',  get_template_directory_uri().'/js/plugins/jquery.prettyphoto.js', array( 'jquery' ), '3.1.5', true );
	wp_enqueue_script('main', get_template_directory_uri().'/js/main.js', array('jquery'), '', true);
}


function custom_styles() {
	global $wp_styles;
	// wp_deregister_style( 'woocommerce_prettyPhoto_css' );

	wp_register_style( 'jquery-ui', get_template_directory_uri() . '/css/jquery-ui.css' );
	wp_enqueue_style('jquery-ui');
	wp_enqueue_style( 'style', get_template_directory_uri() . '/css/style.css' );
	wp_enqueue_style( 'ie7', get_template_directory_uri() . '/css/ie7.css' );
	// wp_enqueue_style( 'prettyphoto', get_template_directory_uri() . '/css/prettyphoto.css' );

	$wp_styles->add_data('ie7', 'conditional', 'lt IE 8');
}

function custom_woocommerce_before_main_content(){

}

function custom_woocommerce_add_to_cart_text($text){
	return __("Add to Cart", THEME_NAME);
}


function custom_woocommerce_checkout_fields($fields){
	return $fields;
}



function custom_woocommerce_form_field_date($field, $key, $args, $value ){
	$checked = '';
	
	$field  = '<div class="form-row ' . esc_attr( implode( ' ', $args['class'] ) ) .'" id="field-' . esc_attr( $key ) . '">';
	$field .= '<input type="hidden" class="datepicker-input" name="'. esc_attr($key).'" value="" id="input-' . esc_attr( $key ) . '"/>';
	$field .= '</div>';

	return $field;
}

function custom_woocommerce_form_field_radio($field, $key, $args, $value ){

	if ( $args['required'] ) {
		$required = ' <abbr class="required" title="' . esc_attr__( 'required', 'woocommerce'  ) . '">*</abbr>';
	} else {
		$required = '';
	}

	$checked = '';
	
	$field  = '<div class="form-row ' . esc_attr( implode( ' ', $args['class'] ) ) .'" id="' . esc_attr( $key ) . '_field">';
	$field .= '<label class="field-label large-label" >' . $args['label'] . '</label>';
	$field .= '<div class="options clearfix" >';
	foreach($args['options'] as $option_key => $label){
		$field .= '<div class="radio-field">';
		$field .= '<input type="' . $args['type'] . '" class="input-radio" name="' . esc_attr( $key ) . '" id="' . esc_attr( $key.'-'.$option_key ) . '" value="'.$option_key.'" '.$checked .' />';
		$field .= '<label for="' . esc_attr( $key.'-'.$option_key ) . '" class="radio">' . $label . '</label>';
		$field .= '</div>';

	}
	$field .= '</div>';
	$field .= '</div>';

	return $field;
}


function custom_template_include( $template ) {
	//die(get_query_var('upgrade'));
	if ( is_single() && get_post_type() == 'product' && get_query_var('upgrade')) {
		$template = locate_template(array('woocommerce/upgrade-single-product.php'));
	}

	return $template;

}

function custom_query_vars( $query_vars ){
	$query_vars[] = 'upgrade';
	return $query_vars;
}

function custom_woocommerce_add_to_cart_validation($valid){
	global $woocommerce;
	$woocommerce->cart->empty_cart();
	return $valid;
}

function custom_woocommerce_add_tagline(){
	$tag = get_field('tagline');
	echo '<p class="uppercase">' . $tag . '</p>';
}

function custom_woocommerce_after_single_product(){
	$args = array(
			'posts_per_page' => 6,
			'columns' => 3,
			'orderby' => 'rand'
		);

		woocommerce_related_products( apply_filters( 'woocommerce_output_related_products_args', $args ) );
}

function single_product_wrapper_start(){
	echo '<div id="single-product">';
}

function single_product_wrapper_end(){
	echo '</div>';
}

function md_nmi_custom_content( $content, $item_id, $label ) {
	$image = get_the_post_thumbnail( $item_id, 'main-nav-thumb', array( 'alt' => $label, 'title' => $label ) );
	$content = '<p class="nav-title">' . $label . '</p>'.$image;
  	return $content;
}

function custom_woocommerce_subcategory_thumbnail( $category ) {
	$small_thumbnail_size  	= apply_filters( 'single_product_small_thumbnail_size', 'cat-thumb' );
	$dimensions    			= wc_get_image_size( $small_thumbnail_size );
	$thumbnail_id  			= get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true  );

	if ( $thumbnail_id ) {
		$image = wp_get_attachment_image_src( $thumbnail_id, $small_thumbnail_size  );
		$image = $image[0];
	} else {
		$image = wc_placeholder_img_src();
	}

	if ( $image ) {
		// Prevent esc_url from breaking spaces in urls for image embeds
		// Ref: http://core.trac.wordpress.org/ticket/23605
		$image = str_replace( ' ', '%20', $image );

		echo '<img src="' . esc_url( $image ) . '" alt="' . esc_attr( $category->name ) . '" width="' . esc_attr( $dimensions['width'] ) . '" height="' . esc_attr( $dimensions['height'] ) . '" />';
	}
}


