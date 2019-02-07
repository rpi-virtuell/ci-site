<?php
/**
 * facetwp injection
 */
  global $fwp_template_name;
?>
	<div class="ddl-full-width-row row">
		<div style="clear: both; width:100%">
			<?php echo facetwp_display( 'facet', 'suche' );?>
			<?php echo facetwp_display( 'counts' );?>
			<?php echo facetwp_display( 'selections');?>
		</div>
		<div class="col-sm-9 results">
			<?php echo facetwp_display( 'pager' ); ?>
			<?php echo facetwp_display( 'template', "$fwp_template_name" );?>
			<?php echo facetwp_display( 'pager' ); ?>
		</div>
		<div class="col-sm-3 filter">
			<div class="sidebarBox">
				<?php echo facetwp_display( 'facet', 'arbeitsbereiche' );?>
			</div>
			<div class="sidebarBox">
				<?php echo facetwp_display( 'facet', 'themen' );?>
			</div>
            <div class="sidebarBox">
				<?php //echo facetwp_display( 'facet', 'categories' );?>
            </div>
			<?php if (is_shop() || 'all-results' == $fwp_tmpl ): ?>
				<div class="sidebarBox">
					<?php echo facetwp_display( 'facet', 'medientypen' );?>
				</div>
                <div class="sidebarBox">
                    <?php echo facetwp_display( 'facet', 'inhaltsbereiche' );?>
                </div>

			<?php endif; ?>
		</div>
	</div>
<?php
