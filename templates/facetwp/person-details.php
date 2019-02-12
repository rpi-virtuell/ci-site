<?php
/**
 * Created by PhpStorm.
 * User: Joachim
 * Date: 11.02.2019
 * Time: 00:23
 */

?>
<?php //print_excerpt(15 ); ?>
<div class="person-details post-details">
    <?php if(!types_render_field( 'aufgaben' )=='Externer Mitarbeiter'):?>
    <ul>
        <li>
            <strong>Aufgaben:</strong> <?php echo types_render_field( 'aufgaben' );?>
        </li>
        <li>
            <strong>Telefon:</strong> <?php echo types_render_field( 'telefon' );?>
        </li>
        <li>
            <strong>E-Mail:</strong> <?php echo types_render_field( 'email' );?>
        </li>
        <li>
	        <strong>
		        Funktionsbereich: <?php echo get_the_term_list( $post->ID, 'funktionsbereich', '<span class="funktionsbereich-taxonomy entry-taxonomy">', ', ', '</span><br>' ); ?>
            </strong>
        </li>
    </ul>
    <?php endif;?>
</div>