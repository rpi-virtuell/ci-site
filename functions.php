<?php
/* Editor selected Text Style ändern */
//add_editor_style('editor-style.css');
// no functionality by this action hook
function cd_add_editor_styles()
{
    add_editor_style('editor-style.css');
}

add_action('init', 'cd_add_editor_styles');
/**
 * Apply theme's stylesheet to the visual editor.
 *
 * @uses add_editor_style() Links a stylesheet to visual editor
 */


/* Hookings ;-)  for Woocommerce */
/* deactivate theme support for woocommerce image zoom */
function remove_image_zoom_support()
{
    remove_theme_support('wc-product-gallery-zoom');
}

add_action('wp', 'remove_image_zoom_support', 100);
// no functionality by this action hook

remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
remove_action('woocommerce_before_subcategory_title', woocommerce_subcategory_thumbnail, 10);

/*function mytheme_add_woocommerce_support()
{
    add_theme_support('woocommerce', array(
        'thumbnail_image_width' => 150,
        'single_image_width' => 300,
        'product_grid' => array(
            'default_rows' => 3,
            'min_rows' => 2,
            'max_rows' => 8,
            'default_columns' => 2,
            'min_columns' => 2,
            'max_columns' => 5,
        ),
    ));
}

add_action('after_setup_theme', 'mytheme_add_woocommerce_support');*/

/* Single Product price output wrapper formatting */
function my_start_wrapper_func($output)
{
    return '<span class="price">';
}
add_filter('wc_views_price_start_wrapper', 'my_start_wrapper_func');
function my_end_wrapper_func($output)
{
    return '</span>';
}
add_filter('wc_views_price_end_wrapper', 'my_end_wrapper_func');

/* Woocommerce Shop Startpage template */
function testhook()
{
    echo "TEst";
}
// add_action('woocommerce_shop_loop', 'testhook', 100);


/* Woocommerce Hooks End #############################################*/

/**
 * Display a custom taxonomy dropdown in admin
 * @author Mike Hemberger
 * @link http://thestizmedia.com/custom-post-type-filter-admin-custom-taxonomy/
 *
 * add_action('restrict_manage_posts', 'tsm_filter_post_type_by_taxonomy');
 * function tsm_filter_post_type_by_taxonomy() {
 * global $typenow;
 * $post_type = 'post'; // change to your post type
 * $taxonomy  = 'section'; // change to your taxonomy
 * if ($typenow == $post_type) {
 * $selected      = isset($_GET[$taxonomy]) ? $_GET[$taxonomy] : '';
 * $info_taxonomy = get_taxonomy($taxonomy);
 * wp_dropdown_categories(array(
 * 'show_option_all' => __("All")." ".$info_taxonomy->label,
 * 'taxonomy'        => $taxonomy,
 * 'name'            => $taxonomy,
 * 'orderby'         => 'name',
 * 'selected'        => $selected,
 * 'show_count'      => 1,
 * 'hierarchical'    => true,
 * 'hide_if_empty'   => true,
 * 'value_field'      => 'slug'
 *
 * ));
 * };
 * }
 *
 */

/**
 * Displays dropdown filterboxes for each Term an each posttype in admin post columns
 * @author Joachim Happel
 * @link https://developer.wordpress.org/reference/functions/wp_dropdown_categories/
 */
add_action('restrict_manage_posts', 'ci_admin_add_taxonomy_dropdown_filters');

function ci_admin_add_taxonomy_dropdown_filters()
{

    global $typenow;


    //set manuell array with custom post types and related taxonomy slugs
    //may be there ist a way to get this array from db => nice to have

    $post_types = array(

        'person' => array('section', 'topic', 'funktionsbereich'),
        'product' => array('section', 'topic', 'medientyp'),
        'publikation' => array('section', 'topic', 'medientyp'),
        'network' => array('section', 'topic'),
        'event' => array('section', 'topic'),
        'project' => array('section', 'topic'),
        'post' => array('section', 'topic'),
        'page' => array('section', 'topic')
    );


    foreach ($post_types as $post_type => $terms) {


        foreach ($terms as $taxonomy) {

            //build a dropdown filter for each taxonomy at the current post_type

            if ($typenow == $post_type) {

                $selected = isset($_GET[$taxonomy]) ? $_GET[$taxonomy] : '';
                $info_taxonomy = get_taxonomy($taxonomy);
                wp_dropdown_categories(array(
                    'show_option_all' => __("All") . " " . $info_taxonomy->label,
                    'taxonomy' => $taxonomy,
                    'name' => $taxonomy,
                    'orderby' => 'name',
                    'selected' => $selected,
                    'show_count' => 0,
                    'hierarchical' => true,
                    'hide_if_empty' => true,
                    'value_field' => 'slug'

                ));
            }

        }
    }
}


/**
	* Template Hooks
	* @see woocomerce plugin: includes/wc_template_hooks.php
*/

function woocommerce_template_loop_product_title() {
		echo '<h2 class="woocommerce-loop-product__title">' . $content . '</h2>';
		echo wp_trim_words( get_the_content(), $num_words = 15, $more = '<br>Mehr ..' );
}

/**
   Customizr prevents, to load the woocommerce/archive-product.php  template from childtheme
   this Hack do the job
*/
add_filter( 'template_include', 'template_load_archive_page', 200 );
function template_load_archive_page($template){
	if(strpos( $template ,'/archive-product.php')>0){

	  $template = get_stylesheet_directory( ). '/woocommerce/archive-product.php' ;

	}
	return $template;
}

/**
 * Erweitert Toolset um nach posttypes zu filtern
 */
add_action( 'pre_get_posts', 'post_type_filter_func', 1 );
function post_type_filter_func( $query) {


	if ( 	$query->is_main_query()
			&& isset($_GET['wpv_filter_submit'])
			&& isset($_GET['wpv-post-type'][0])
			&& !empty($_GET['wpv-post-type'][0])
		) {

		$query->query_vars['post_type'] = $_GET['wpv-post-type'] ;
    }


}

/**
 * Füge "Einträge" an die Anzahl der Suchtreffer
*/
add_filter( 'facetwp_result_count', function( $output, $params ) {
	return $output . ' Einträge';
}, 10, 2 );

/* template helper */

function print_excerpt( $class = 'entry-summary' ) {

    $class = esc_attr( $class );

	?>
		<div class="<?php echo $class; ?>">
			<?php the_excerpt(); ?>
		</div><!-- .<?php echo $class; ?> -->
	<?php

}
function print_post_image( $dummy = "https://dummyimage.com/140x140/eeeeee/ffffff.png&amp;text=CI" ){

	$imgsrc = get_the_post_thumbnail_url(get_the_ID(),'post-thumbnail');
	if(!$imgsrc){
	    $imgsrc = $dummy;
	}
	?><img   class="attachment-thumbnail size-thumbnail wp-post-image" src="<?php echo $imgsrc;?>" sizes="(max-width: 150px) 100vw, 150px" width="150"><?php

}

function print_entry_date() {

    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf(
		$time_string,
		esc_attr( ( 'm.Y' ) ),
		get_the_date(),
		esc_attr( get_the_modified_date( 'c' ) ),
		get_the_modified_date()
	);

	printf(
		'<span class="posted-on"><span class="screen-reader-text">%1$s </span><a href="%2$s" rel="bookmark">%3$s</a></span>',
		esc_url( get_permalink() ),
		$time_string
	);
}

function get_content_type(){
	$postType = get_post_type( get_the_ID() );
	switch( strtolower($postType)){
		case 'product':
			$postType = get_the_term_list( get_the_ID(), 'medientyp','', ' · ','' );
			break;
		case 'network':
			$postType = 'Netzwerk';
			break;
		case 'page':
			$postType = '';
			break;
		case 'post':
			$postType = 'Blog';
			break;
		case 'publikation':
			$postType = 'Publikation';
			break;
		case 'event':
			$postType = 'Veranstaltung';
			break;
		case 'project':
			$postType = 'Projekt';
			break;
		case 'person':
			$postType = 'Mitarbeiter_in / Autor_in';
			break;
	}
	return $postType;
}

function get_facetwp_pots_type_template_slug(){

    $type = get_queried_object();
	$slug = str_replace('/','',$type->rewrite['slug'] );
	
	if(is_shop()){
		$slug =   'product';  
    }
	switch( strtolower($slug)){
		case 'product':
		case 'network':
		case 'page':
		case 'post':
		case 'publikation':
		case 'event':
		case 'project':
		case 'person':
		    return $slug;
			break;
        default:
	        return 'all-results';

	}
}

function load_templatepart($file){
	if ( $template = locate_template( 'templates/'. $file  ) ) {
	    load_template( $template );
	}else{
	    echo "file error: Template not found!";
    }
}


function include_facetwp_article(){
	include get_stylesheet_directory( ) . "/templates/facetwp/loop-post.php";
}


add_shortcode( 'ci_article_teaser' , 'print_loop_post' );
function print_loop_post($atts){

	load_templatepart('facetwp/archive-loop.php');

}

function fwp_add_facet_labels() {
	?>
    <script>
        (function($) {
            $(document).on('facetwp-loaded', function() {
                $('.facetwp-facet').each(function() {
                    var $facet = $(this);
                    var facet_name = $facet.attr('data-name');
                    var facet_label = FWP.settings.labels[facet_name];

                    if ($facet.closest('.facet-wrap').length < 1) {
                        $facet.wrap('<div class="facet-wrap"></div>');
                        $facet.before('<h3 class="facet-label">' + facet_label + '</h3>');
                    }
                });
            });
        })(jQuery);
    </script>
	<?php
}
add_action( 'wp_head', 'fwp_add_facet_labels', 100 );

/**
 * replaces post_type dynamicaly
 * but there is an unsolved issue with ajax
 * so we do not use ist at this time

    add_filter( 'facetwp_query_args', function( $query_args, $class ) {

        global $query;

        if(get_query_var("post_type")){
            $type = get_queried_object();
            $post_type = str_replace('/','',$type->rewrite['slug'] );

            if(post_type_exists($post_type) &&  'all-results' == $class->ajax_params['template'] ){
                $query_args['post_type'] = $post_type;
            }

        }
        return $query_args;
    }, 10, 2 );

 */

