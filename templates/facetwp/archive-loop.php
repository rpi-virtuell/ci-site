<?php
/**
 * facetwp injection
 */

	$fwp_tmpl = get_facetwp_pots_type_template_slug();

?>
	<div class="ddl-full-width-row row">
		<div style="clear: both; width:100%">
			<?php echo facetwp_display( 'facet', 'suche' );?>
			<?php echo facetwp_display( 'counts' );?>
			<?php echo facetwp_display( 'selections');?>
		</div>
		<div class="col-sm-9 results">
			<?php echo facetwp_display( 'pager' ); ?>
			<?php echo facetwp_display( 'template', "$fwp_tmpl" );?>
			<?php echo facetwp_display( 'pager' ); ?>
		</div>
		<div class="col-sm-3 filter">
			<div class="sidebarBox">
				<h3>Arbeitsbereiche</h3>
				<?php echo facetwp_display( 'facet', 'arbeitsbereiche' );?>
			</div>
			<div class="sidebarBox">
				<h3>Themen</h3>
				<?php echo facetwp_display( 'facet', 'themen' );?>
			</div>
			<?php if ('product' == $fwp_tmpl): ?>
				<div class="sidebarBox">
					<h3>Medium</h3>
					<?php echo facetwp_display( 'facet', 'medientyp' );?>
				</div>
			<?php endif; ?>
		</div>
	</div>
<?php
