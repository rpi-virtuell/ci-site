<?php
/**
* Template Name: Suche
* Template Post Type: page
*
*/
?>
<?php get_header();

$imgsrc = get_the_post_thumbnail_url();
if (is_page() && $imgsrc):

	?>
    <div class="page-header-image header-image">
        <div class="header-image-cover" style="background-image: url(<?php echo $imgsrc; ?>);">
        </div>
    </div>
<?php

endif;
// This hook is used to render the following elements(ordered by priorities) :
// slider
// singular thumbnail
do_action('__before_main_wrapper')
?>
<div id="main-wrapper" class="section">

	<?php
	//this was the previous implementation of the big heading.
	//The next one will be implemented with the slider module
	?>
	<?php  if ( apply_filters( 'big_heading_enabled', false && ! czr_fn_is_real_home() && ! is_404() ) ): ?>
        <div class="container-fluid">
			<?php

			if ( czr_fn_is_registered_or_possible( 'archive_heading' ) )
				$_heading_template = 'content/post-lists/headings/archive_heading';
            elseif ( czr_fn_is_registered_or_possible( 'search_heading' ) )
				$_heading_template = 'content/post-lists/headings/search_heading';
            elseif ( czr_fn_is_registered_or_possible('post_heading') )
				$_heading_template = 'content/singular/headings/post_heading';
			else //pages and fallback
				$_heading_template = 'content/singular/headings/page_heading';

			czr_fn_render_template( $_heading_template );
			?>
        </div>
	<?php endif ?>


	<?php
	/*
	* Featured Pages | 10
	* Breadcrumbs | 20
	*/
	do_action('__before_main_container')
	?>

    <div class="<?php czr_fn_main_container_class() ?>" role="main">

		<?php do_action('__before_content_wrapper'); ?>

        <div class="<?php czr_fn_column_content_wrapper_class() ?>">

			<?php do_action('__before_content'); ?>

            <div id="content" class="<?php czr_fn_article_container_class() ?>">

				<?php




				/* Archive regular headings */
				if ( apply_filters( 'regular_heading_enabled', ! czr_fn_is_real_home() && ! is_404() ) ): ?>
                    <header class="woocommerce-products-header header-content">
                        <h1 class="page-title">
                            <?php
                            the_title();
                            ?>
                        </h1>
                    </header>
                <?php
				endif;

				do_action( '__before_loop' );
				$slug = get_queried_object()->post_name;

				if ( ! czr_fn_is_home_empty() ) {
					if ( have_posts() && ! is_404() ) {

						/**
						 * facetwp injection
						 */
						if( function_exists('facetwp_display') && is_page() && $slug =='publikationen' ){

							the_archive_loop('all-publications');
							
						}elseif( function_exists('facetwp_display') && is_page() ){
							the_archive_loop('all-results');
						} else {
							czr_fn_render_template('loop');
						}


					} else {//no results

						if ( is_search() )
							czr_fn_render_template( 'content/no-results/search_no_results' );
                        elseif ( is_404() )
							czr_fn_render_template( 'content/no-results/404' );
					}
				}//not home empty

				/*
				 * Optionally attached to this hook :
				 * - In single posts:
				 *   - Author bio | 10
				 *   - Related posts | 20
				 * - In posts and pages
				 *   - Comments | 30
				 */
				do_action( '__after_loop' );
				?>
            </div>

			<?php
			/*
			 * Optionally attached to this hook :
			 * - In single posts:
			 *   - Author bio | 10
			 *   - Related posts | 20
			 * - In posts and pages
			 *   - Comments | 30
			 */
			do_action( '__after_content' );

			/*
			* SIDEBARS
			*/
			/* By design do not display sidebars in 404 or home empty */
			if ( ! ( czr_fn_is_home_empty() || is_404() ) ) {
				if ( czr_fn_is_registered_or_possible('left_sidebar') )
					get_sidebar( 'left' );

				if ( czr_fn_is_registered_or_possible('right_sidebar') )
					get_sidebar( 'right' );

			}
			?>

        </div><!-- .column-content-wrapper -->

		<?php do_action('__after_content_wrapper'); ?>


    </div><!-- .container -->

	<?php do_action('__after_main_container'); ?>

</div><!-- #main-wrapper -->

<?php do_action('__after_main_wrapper'); ?>

<?php
if ( czr_fn_is_registered_or_possible('posts_navigation') ) :
	?>
    <div class="container-fluid">
		<?php
		if ( !is_singular() )
			czr_fn_render_template( "content/post-lists/navigation/post_list_posts_navigation" );
		else
			czr_fn_render_template( "content/singular/navigation/singular_posts_navigation" );
		?>
    </div>
<?php endif ?>

<?php get_footer() ?>
