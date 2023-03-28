<?php
/**
 * facetwp injection
 */
 
  global $fwp_template_name;
?>
	<div class="row">
		<div class="col-sm-12">
			<?php echo facetwp_display( 'facet', 'suche' );?>
			<?php echo facetwp_display( 'counts' );?>
			<?php echo facetwp_display( 'selections');?>
		</div>
    </div>
    <div class="row publicationsWrapper">
		<div class="col-sm-8 results">
		<div class="facetwp-pagerWrapper">	<?php echo facetwp_display( 'pager' ); ?></div>
			<?php echo facetwp_display( 'template', "$fwp_template_name" );?>
        <div class="facetwp-pagerWrapper">	<?php echo facetwp_display( 'pager' ); ?></div>
		</div>
		<div class="col-sm-4 filter sideBarWrapper archive-sidebar archive-sidebar-books">
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
