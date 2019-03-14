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
        'dienstleistung' => array('section'),
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
/*
function woocommerce_template_loop_product_title() {
		echo '<h2 class="woocommerce-loop-product__title">' . $content . '</h2>';
		echo wp_trim_words( get_the_content(), $num_words = 15, $more = '<br>Mehr ..' );
}
*/
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
/*
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
*/

/**
 * Füge "Einträge" an die Anzahl der Suchtreffer
*/
add_filter( 'facetwp_result_count', function( $output, $params ) {
	return $output . ' Einträge';
}, 10, 2 );

/* template helper */

function print_excerpt($wordscount=20, $class = 'entry-summary' ) {

    $class = esc_attr( $class );
    ?>
		<div class="<?php echo $class; ?>">
			<?php
                if(has_excerpt()){
                    echo get_the_excerpt();
                }else{
	                echo wp_trim_words( get_the_content(), $wordscount );
                }
            ?>
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
/*
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}
*/
	$time_string = sprintf(
		$time_string,
		esc_attr( ( 'c' ) ),
		get_the_date( 'M Y'),
		esc_attr( get_the_modified_date( 'c') ),
		get_the_modified_date('M Y' )
	);


	printf(
		'<span class="posted-on"><span class="screen-reader-text">%1$s</span><a href="%2$s" rel="bookmark">%3$s</a></span>',
		__( 'Posted on' ),
        esc_url( get_permalink() ),
		$time_string

	);
}
function print_parent_themenbereich($header= "h3") {
	if ( is_tax( 'thema' ) ) {
		echo '<div class="sidebarBox">';
		// Get the current section term id.
		$query_obj = get_queried_object();
		$term_id   = $query_obj->term_id;
		$term = get_term($term_id);
		echo '<'.$header.'>Themenbereich</'.$header.'>';
		echo '<p>'.$term->name.'</p>';
		echo '</div>';
	}
}
function print_parent_arbeitsbereich($header= "h3"){
	if ( is_tax('section') ) {
		echo '<div class="sidebarBox">';
		// Get the current section term id.
		$query_obj = get_queried_object();
		$term_id   = $query_obj->term_id;
		if($p=get_ancestors($term_id, 'section', 'taxonomy')){

		    $parent_term_id= $p[0];

			$term = get_term($term_id);

			echo '<'.$header.'>Arbeitsbereich<br>';
			echo get_term_parents_list( $term_id, 'section',array('inclusive'=>false,'separator'=>'<br>' ) );
			echo '</'.$header.'>';
/*			echo '<p><strong>Aufgabenbereich:</strong><br>'.
			     $term->name;
                 '</p>';
*/
			$term_children = get_term_children( $parent_term_id, 'section' ) ;
            if($term_children){
	            echo '<h3>Aufgaben</h3>';
                echo '<ul>';

	            foreach ( $term_children as $child ) {
		            $term_child = get_term_by( 'id', $child, 'section' );
		            if($term_child == $term){
			            echo '<li><strong>' . $term_child->name . '</strong></li>';
		            }else{
			            echo '<li><a href="' . get_term_link( $child, 'section' ) . '">' . $term_child->name . '</a></li>';
		            }

	            }
	            echo '</ul>';
            }



        }else{
			echo '<'.$header.'>Aufgaben</'.$header.'>';
			echo '<ul>';
			$term_children = get_term_children( $term_id, 'section' ) ;
			rsort($term_children);
            foreach ( $term_children as $child ) {
                $term = get_term_by( 'id', $child, 'section' );
                echo '<li><a href="' . get_term_link( $child, 'section' ) . '">' . $term->name . '</a></li>';
            }
            echo '</ul>';
        }
		echo '</div>';
	}
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
		case 'dienstleistung':
			$postType = 'Service';
			break;
		case 'person':
			$postType = 'Mitarbeiter_in / Autor_in';
			break;
	}
	return $postType;
}

function get_facetwp_pots_type_template_slug($archive = 'archive'){

    $type = get_queried_object();
	$slug = str_replace('/','',$type->rewrite['slug'] );
	
	if(is_shop()){
		return 'product';
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
		case 'dienstleistung':
		    return $slug;
			break;
        default:
	        return $archive;

	}
}

function load_templatepart($file, $template_name = false){

    global $fwp_template_name;
	if ( $template_file = locate_template( 'templates/'. $file  ) ) {
		$fwp_template_name = $template_name;
		require_once( $template_file );

	}else{
	    echo "file error: Template not found!";
    }
}

function the_archive_loop( $default = 'archive'){

	$template_name = get_facetwp_pots_type_template_slug($default);

	load_templatepart('facetwp/archive-loop.php', $template_name);

}
add_shortcode( 'ci_article_teaser' , 'the_archive_loop' );


function include_facetwp_article(){
	include get_stylesheet_directory( ) . "/templates/facetwp/loop-post.php";
}

function load_details_template(){



    $file =  get_stylesheet_directory( ) .
             "/templates/facetwp/" . get_post_type( get_the_ID() ).'-details.php';


    if(file_exists($file)){
	    include ($file) ;
    }else{
	    print_excerpt(15 );
    }
}



function get_query_all_tax_in_tax($resulttax = 'thema', $filtertax='section'){

	$terms = get_terms( array(
		'taxonomy' => $resulttax,
		'hide_empty' => false,
	) );

    $slugs = array();
	foreach ($terms as  $term){
		$slugs[]=$term->slug;
    }

	$args = array(
	    'posts_per_page' => 100000,
        'post_type' =>'any',
		'tax_query' => array(
			array(
				'relation' => 'AND',
				array(
					'taxonomy' => $filtertax,
					'field'    => 'slug',
					'terms'    => array( get_query_var( $filtertax ) ),
				),
				array(
					'taxonomy' => $resulttax,
					'field'    => 'slug',
					'terms'    => $slugs

				),
			),
		),
	);
	$pp = new WP_Query( $args );
	$tax_ids = array();
	if ( $pp->have_posts() ) {
		while ( $pp->have_posts() ) {
			$pp->the_post();
			$tax_ids =  array_merge(wp_get_object_terms(get_the_ID(), $resulttax,  array('fields' => 'slugs')),$tax_ids);
		}
		/* Restore original Post Data */
		wp_reset_postdata();
	}
	$tax_ids = array_unique($tax_ids);
	sort($tax_ids);

    $list_elements = '';
	foreach ($terms as  $term){
		if (in_array($term->slug, $tax_ids)){

            $list_elements .= '<li><a href="/'.$resulttax.'/'.$term->slug.'">' . $term->name . '</a></li>';

		}
	}
	return '<ul>' .$list_elements. '</ul>';

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
 * Modifiziert den WP Query loop in der product-archive.php entsprechend facetwp archive
 * keine personen und seiten anzeigen
 */

function modify_poduct_archive_query( $query ) {
	if ( $query->is_tax() && $query->is_main_query() ) {

		$query->set('post_type',array(
		        'post',
		        'product',
		        'publikation'
        ));
	}

}
add_action( 'pre_get_posts', 'modify_poduct_archive_query' );

/*
* Removes loading of facetwp-stylesheet
 * Styles coppied to theme-styles
 *
 * Todo: make it work
 **/

/*add_filter( 'facetwp_assets', 20 , function( $styles_array ){
  $styles_array = [];

    return $styles_array;
});*/


/***************************************************************************
 * Anpassung für Internetexplorer
 * eigenes style hinzufügen
 */
function ci_script_scripts_add_style() {
    
	global $is_IE;
	if($is_IE ){
		wp_enqueue_style('ie-main-style', czr_fn_get_theme_file_url( "ie-main-style.css") );	
	}
}
add_action( 'wp_enqueue_scripts', 'ci_script_scripts_add_style', 9 );

/**
 * Anpassung für Internetexplorer
 * orginal style.css von customizer deaktivieren
 */

function ci_remove_scripts_style() {
    
	global $is_IE;
	if($is_IE ){
		wp_deregister_style('customizr-main');
		wp_add_inline_style( 'ie-main-style'      , apply_filters( 'czr_user_options_style' , '' ) );
	}
   
}
add_action( 'wp_enqueue_scripts', 'ci_remove_scripts_style', 11 );

/***************************************************************************/
