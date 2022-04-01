<?php
// Referenced from content-single-ms_checklists.php
?>
<div class="Post__header__small">
		<div class="wrapper__wide">
			<strong class="Post__header__small__navLabel"><?php _e( 'Navigation', 'ms' ); ?></strong>
			<div class="Post__header__small__navigation flex" data-target="ChecklistTOC">
				<h3 class="h3 Post__header__small__title">
						<?php
						$pagetitle = explode( '^', get_the_title() );
						if ( isset( $pagetitle[1] ) ) {
							?>
							<?php echo esc_html( $pagetitle[0] ) . ' '; ?>
							<span class="highlight-gradient"><?php echo esc_html( $pagetitle[1] ); ?></span>
							<?php echo esc_html( ' ' . $pagetitle[2] ); ?>
							<?php
						} else {
							the_title();
						}
						?>
				</h3>
				<?php if ( checklists_toc() !== false ) { ?>
				<div class="Checklists__toc__block">
					<span class="Checklists__toc__activator"></span>
					<div class="Checklists__toc__wrapper hidden" data-targetId="ChecklistTOC">
						<div class="Checklists__toc__inn">
							<strong class="Checklists__toc__title"><?php _e( 'Contents:', 'ms' ); ?> </strong>
							<ol class="Checklists__toc">
								<?= wp_kses_post( checklists_toc()->toc ); ?>
							</ol>
						</div>
					</div>
				</div>
			</div>
			<div class="Post__header__progress CircleProgressBar">
				<div class="CircleProgressBar__middle" id="circleProgressMiddle"></div>
				<div class="CircleProgressBar__spinner" id="circleProgressSpinner"></div>
			</div>
			<div class="Post__header__counter" id="checklistsCounter" data-checked="0" data-total="<?= esc_attr( checklists_toc()->count ); ?>">
					<?= esc_html( checklists_toc()->count ); ?>
			</div>
			<div class="Post__header__collapse">
				<span class="qu-Checklist__expander qu-Checklist__expander--collapse" data-action="closeAll">
					<svg width="24" height="24" xmlns="http://www.w3.org/2000/svg"><path d="M7.41 18.59 8.83 20 12 16.83 15.17 20l1.41-1.41L12 14l-4.59 4.59Zm9.18-13.18L15.17 4 12 7.17 8.83 4 7.41 5.41 12 10l4.59-4.59Z" fill="#050505"/></svg>
					<span class="desktop--only"><?php _e( 'Collapse All', 'ms' ); ?></span>
				</span>
				<span class="qu-Checklist__expander qu-Checklist__expander--expand inactive" data-action="openAll">
					<svg viewBox="0 0 24 24" width="24" height="24" xmlns="http://www.w3.org/2000/svg"><path d="M7.41 18.59 8.83 20 12 16.83 15.17 20l1.41-1.41L12 14l-4.59 4.59Z" style="fill:#050505" transform="translate(0 -10)"/><path d="M16.59 5.41 15.17 4 12 7.17 8.83 4 7.41 5.41 12 10l4.59-4.59Z" style="fill:#050505" transform="translate(0 10)"/></svg>
					<span class="desktop--only"><?php _e( 'Expand All', 'ms' ); ?></span>
				</span>
			</div>
		<?php } ?>
		</div>
	</div>
