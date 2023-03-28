<?php
/**
 * Created by PhpStorm.
 * User: Joachim
 * Date: 03.02.2019
 * Time: 13:02
 */
 ?>
<div class="themenTeaser">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
    <div class="ddl-full-width-row row ">
		<?php if (has_post_image()): ?>
        <div class="col-sm-3">
            <div  class="posttumbnail">
               <?php
                echo '<a href="' . esc_url( get_permalink() ) . '">';?>
                <?php print_post_image();?>
          <?php echo '</a>'  ?>
            </div>
        </div>
        <div class="col-sm-9 productArchive">
		<?php else: ?>
		<div class="col-sm-12 productArchive">
		<?php endif; ?>
            <p class="datum" ><?php print_entry_date(); ?></p>
            <header class="entry-header">
                <div>
                  <?php /*  <span class="content-type"><?php echo get_content_type(); ?></span> */ ?>
                    <p class="metaData">
                        <?php echo get_the_term_list( $post->ID, 'thema', '<span class="thema-taxonomy entry-taxonomy ">  <span class="label"></span> ', ', ', '</span>' ); ?>
                    </p>
                </div>

                <?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
                    <span class="sticky-post">
                <?php endif; ?>
                <?php
                    the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );
                ?>
            </header><!-- .entry-header -->

            <div class="entry-content">

                <?php load_details_template() ?>
                <p class="metaData metaDataBottom">
                    <?php echo get_the_term_list( $post->ID, 'section', '<span class="section-taxonomy entry-taxonomy "><span class="label">Arbeitsbereich:</span> ', ', ', '</span><br>' ); ?>
                    <?php echo get_the_term_list( $post->ID, 'category', '<span class="thema-taxonomy entry-taxonomy"><span class="label">Kategorien:</span> ', ', ', '</span><br>' ); ?>
                    <?php echo get_the_term_list( $post->ID, 'medientyp', '<span class="medientyp-taxonomy entry-taxonomy"><span class="label">Medientyp:</span> ', ', ', '</span><br>' ); ?>
                </p>

            </div><!-- .entry-content -->


        </div>
    </div>
</article>
</div><!-- #post-## -->