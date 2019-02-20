<?php
/**
 * facetwp injection
 */
  global $fwp_template_name;
?>
	<div class="row">
		<div col-12>
			<?php echo facetwp_display( 'facet', 'suche' );?>
			<?php echo facetwp_display( 'counts' );?>
			<?php echo facetwp_display( 'selections');?>
		</div>
    </div>
    <div class="row">
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
            <?php if (is_shop() || 'all-results' == $fwp_template_name ): ?>
				<div class="sidebarBox">
					<?php echo facetwp_display( 'facet', 'medientypen' );?>
				</div>
			<?php endif; ?>
			<?php if ('all-results' == $fwp_template_name ): ?>
                <div class="sidebarBox">
					<?php echo facetwp_display( 'facet', 'inhaltsbereiche' );?>
                </div>

                <div class="sidebarBox">
					<?php echo facetwp_display( 'facet', 'categories' );?>
                </div>

			<?php endif; ?>

		</div>
	</div>
<?php
