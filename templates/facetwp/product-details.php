<?php
/**
 * Created by PhpStorm.
 * User: Joachim
 * Date: 11.02.2019
 * Time: 00:23
 */

$_product = wc_get_product( get_the_ID() );
?>
<div class="product-details post-details">
	<ul>
        <li>
            <?php echo types_render_field( 'autoren' );?>
        </li>
		<li>
			Preis: <?php echo $_product->get_price();?> Euro
		</li>
		<li>
			Erscheinungsjahr: <?php echo types_render_field( 'year' );?>
		</li>
	</ul>
</div>