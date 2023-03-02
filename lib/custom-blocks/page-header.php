<?php if ( isset( $args ) ) : ?>
	<?php
	if ( ! empty( $args['image'] ) ) {
		$image_url = $args['image'];
	}
	if ( ! empty( $args['title'] ) ) {
		$main_title = $args['title'];
	}
	if ( ! empty( $args['text'] ) ) {
		$text = $args['text'];
	}
	if ( ! empty( $args['date'] ) ) {
		$date = $args['date'];
		$date_machine = get_the_time( 'Y-m-d' );
		$date_human = get_the_time( 'Y-m-d' );
		$date_modified = get_the_modified_time( 'F j, Y' );
		$time_modified = get_the_modified_time( 'g:i a' );
	}
	?>
<div class="compact-header">
	<?php if ( isset( $main_title ) ) : ?>
		<h1 class="compact-header__title"><?= esc_html( $main_title ); ?></h1>
	<?php endif ?>
	<?php if ( isset( $text ) ) : ?>
		<div class="compact-header__text"><?= esc_html( $text ); ?></div>
	<?php endif ?>
	<?php if ( isset( $image_url ) ) : ?>
		<img src="<?= esc_url( $image_url ); ?>"
			 class="compact-header__image" alt="<?= esc_attr( $main_title ); ?>">
	<?php endif ?>
	<?php if ( isset( $date ) || $date ) : ?>
	<div class="compact-header__date">
		<?php if ( isset( $date_output_machine ) && isset( $date_output_human ) ) : ?>
			<span itemprop="datePublished" content="<?= esc_attr( $date_output_machine ); ?>"><?=
				esc_html( $date_output_human ); ?></span>
		<?php endif ?>
		<?php if ( isset( $date_output_time ) ) : ?>
			<?= esc_html( __( 'Last modified on', 'ms' ) ); ?>
			<?= esc_html( $date_output_human ); ?>
			<?= esc_html( __( 'at', 'ms' ) ); ?>
			<?= esc_html( $date_output_time ); ?>
		<?php endif ?>
	</div>
	<?php endif ?>
</div>
<?php endif ?>
