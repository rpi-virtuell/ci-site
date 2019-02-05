<?php
/**
 * Created by PhpStorm.
 * User: Joachim
 * Date: 05.02.2019
 * Time: 23:20
 */
?>
<?php get_header() ?>


<?php
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
				if ( apply_filters( 'regular_heading_enabled', ! czr_fn_is_real_home() && ! is_404() ) ):

					if ( czr_fn_is_registered_or_possible( 'archive_heading' ) )
						czr_fn_render_template( 'content/post-lists/headings/regular_archive_heading',
							array(
								'model_class' => 'content/post-lists/headings/archive_heading'
							)
						);
					elseif ( czr_fn_is_registered_or_possible( 'search_heading' ) )
						czr_fn_render_template( 'content/post-lists/headings/regular_search_heading' );

				endif;

				if( function_exists('facetwp_display') ){

					load_templatepart('facetwp/archive-loop.php');

				}

				?>
			</div>



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
