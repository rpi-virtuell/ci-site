<?php
/**
 * Created by PhpStorm.
 * User: Joachim
 * Date: 11.02.2019
 * Time: 00:23
 */

?>
<div class="publikation-details post-details">
	<ul>
        <li>
            <?php echo types_render_field( 'autoren' );?>
        </li>
        <li>
			Erscheinungsjahr: <?php echo types_render_field( 'year' );?>
		</li>
	</ul>
</div>