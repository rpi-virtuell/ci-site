<?php
/**
* The template for displaying the list of posts titles (archives, categories, )
*/
?>
<header class="archive-header <?php czr_fn_echo( 'element_class' ) ?>" <?php czr_fn_echo('element_attributes') ?>>
  <div class="archive-header-inner">
    <?php if ( czr_fn_get_property('title' ) ) : ?>
    <h1 class="archive-title">
      <?php
        if( (bool) $pre_title = czr_fn_get_property( 'pre_title' ) )
            echo "{$pre_title}&nbsp;";
      // czr_fn_echo( 'title' );
      /* Removed "Archive: " from Archive Title - by lum 16.1.19  */
      $temp = czr_fn_get_property( 'title' ) ;
    $temp = str_replace("Archive: ", "", $temp);
      echo  $temp;

      ?>
    </h1>
    <?php endif;

      global $wp_query;
      if ( $wp_query->found_posts ):
      ?>
     <?php /* Anzahl der gefundenen Elemente entfernt 16.1.19 lum */ ?>
      <?php
      endif
      ?>

  </div>
</header>