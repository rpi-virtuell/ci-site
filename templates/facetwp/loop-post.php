<?php
/**
 * Created by PhpStorm.
 * User: Joachim
 * Date: 03.02.2019
 * Time: 13:02
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="ddl-full-width-row row ">
        <div class="col-sm-3">
            <div  class="posttumbnail">
                <?php print_post_image();?>
            </div>
        </div>
        <div class="col-sm-9">
            <div class="datum" ><?php print_entry_date(); ?></div>
            <header class="entry-header">
                <div>
                    <span class="content-type"><?php echo get_content_type(); ?></span>
                    <span>
                        <?php echo get_the_term_list( $post->ID, 'thema', '<span class="thema-taxonomy entry-taxonomy"> &bull; Themenbereich: ', ', ', '</span>' ); ?>
                    </span>
                </div>

                <?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
                    <span class="sticky-post">
                <?php endif; ?>
                <?php
                
                    the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
                ?>
            </header><!-- .entry-header -->

            <div class="entry-content">

                <?php load_details_template() ?>
                <p>
                    <?php echo get_the_term_list( $post->ID, 'section', '<span class="section-taxonomy entry-taxonomy">Arbeitsbereich: ', ', ', '</span><br>' ); ?>
                    <?php echo get_the_term_list( $post->ID, 'category', '<span class="thema-taxonomy entry-taxonomy">Kategorien: ', ', ', '</span><br>' ); ?>
                    <?php echo get_the_term_list( $post->ID, 'medientyp', '<span class="medientyp-taxonomy entry-taxonomy">Medientyp: ', ', ', '</span><br>' ); ?>
                </p>

            </div><!-- .entry-content -->


        </div>
    </div>
</article><!-- #post-## -->