<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined('ABSPATH') || exit;

get_header('shop');
/**
 * Headerbild: kommt aus dem entsprechenden Begriffsfeld der Taxonomie
 */
$headerbild = get_term_meta(get_queried_object_id(), 'wpcf-headerbild', true);
if ($headerbild):
    ?>
    <div class="tax-header-image header-image">
        <div class="header-image-cover" style="background-image: url(<?php echo $headerbild ?>);">
        </div>
    </div>
<?php
endif;
/**
 *
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action('woocommerce_before_main_content');
?>
    <header class="woocommerce-products-header">
        <?php if (apply_filters('woocommerce_show_page_title', true)) : ?>
            <h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
        <?php endif;
        ?>

    </header>
<?php

if (woocommerce_product_loop() || true) {

    /**
     * Hook: woocommerce_before_shop_loop.
     *
     * @hooked woocommerce_output_all_notices - 10
     * @hooked woocommerce_result_count - 20
     * @hooked woocommerce_catalog_ordering - 30
     */


    if (!is_tax() && !is_page() && function_exists('facetwp_display')) {

        /**
         *  facet_wp injection
         */
        the_archive_loop();
    } else {


        //woocommerce_product_loop_start();

        ?>
        <div class="ddl-full-width-row row">
            <div class="col-md-8 results">

                <?php
                /**
                 * Hook: woocommerce_archive_description.
                 *
                 * @hooked woocommerce_taxonomy_archive_description - 10
                 * @hooked woocommerce_product_archive_description - 10
                 */
                do_action('woocommerce_archive_description');

                // woocommerce_results count
                //do_action( 'woocommerce_before_shop_loop' );

                //Dienstleistungen in den Arbeitsbereichen anzeigen
                if (is_tax('section')) {
                    echo render_view(array(
                        'name' => 'dienstleistungen-grid'
                    ));
                }

                if (woocommerce_product_loop()):
                    ?>
                    <h2 class="loop-title">
                        Aktuelle
                        Veröffentlichungen <?php echo (is_tax('section')) ? 'aus dem Bereich' : 'zum Thema'; ?> <?php woocommerce_page_title(); ?>
                    </h2>
                    <?php

                    if (wc_get_loop_prop('total')) {


                        while (have_posts()) {
                            the_post();

                            /**
                             * Hook: woocommerce_shop_loop.
                             *
                             * @hooked WC_Structured_Data::generate_product_data() - 10
                             */
                            do_action('woocommerce_shop_loop');

                            //wc_get_template_part( 'content', 'product' );
                            include get_stylesheet_directory() . "/templates/facetwp/loop-post.php";
                        }
                    }
                    /**
                     * Hook: woocommerce_after_shop_loop.
                     *
                     * @hooked woocommerce_pagination - 10
                     */
                    do_action('woocommerce_after_shop_loop');
                endif;
                ?>
            </div>
            <div class="col-md-4 archive-sidebar">
                <div class="sideBarWrapper">
                    <?php

                    if (is_tax('section')) {
                        print_parent_arbeitsbereich('h2');
                        /**
                         * Ausgabe des Feldes Dienstleistungen in der Taxonomie Arbeitsbereiche
                         * echo '<div class="sidebarBox">';
                         * echo    '<h2>Dienstleistungen</h2>';
                         * echo    '<div class="personen-sidebar">';
                         * echo         get_term_meta(get_queried_object_id(),'wpcf-dienstleistungen', true);
                         * echo    '</div>';
                         * echo '</div>';
                         */


                        echo '<div class="sidebarBox">';
                        echo '<h2>Mitwirkende</h2>';
                        echo '<div class="personen-sidebar">';
                        echo render_view(array('name' => 'personen-in-arbeitsbereichen'));
                        echo '</div>';
                        echo '</div>';

                        echo '<div class="sidebarBox">';
                        echo '<h2>Verbundene Themenbereiche</h2>';
                        echo get_query_all_tax_in_tax('thema', 'section');
                        echo '</div>';

                        echo '<div class="sidebarBox networks">';
                        echo render_view(array('name' => 'websites-in-arbeitsbereichen'));
                        echo '</div>';

                    }

                    if (is_tax('thema')) {

                        print_parent_themenbereich('h2');
                        echo '<div class="sidebarBox">';
                        echo '<h2>Mitwirkende</h2>';
                        echo '<div class="personen-sidebar">';
                        echo render_view(array('name' => 'personen-in-themenbereichen'));
                        echo '</div>';
                        echo '</div>';


                        echo '<div class="sidebarBox">';
                        echo '<h2>Verbundene Bereiche und Aufgaben</h2>';
                        echo get_query_all_tax_in_tax('section', 'thema');
                        echo '</div>';

                        echo '<div class="sidebarBox networks">';
                        echo render_view(array('name' => 'websites-in-themenbereichen'));
                        echo '</div>';
                    }


                    ?>
                </div>
            </div>
        </div>
        <?php

    }


} else {
    /**
     * Hook: woocommerce_no_products_found.
     *
     * @hooked wc_no_products_found - 10
     */
    do_action('woocommerce_no_products_found');
}

/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action('woocommerce_after_main_content');

/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
do_action('woocommerce_sidebar');

get_footer('shop');
