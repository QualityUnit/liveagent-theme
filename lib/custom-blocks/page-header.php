<?php if ( $args ) : ?>
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
	?>
<div class="eee">
	<?php if ( isset( $main_title ) ) : ?>
		<h1><?= esc_html( $main_title ); ?></h1>
	<?php endif ?>
	<?php if ( isset( $text ) ) : ?>
        <div><?= esc_html( $text ); ?></div>
	<?php endif ?>
	<?php if ( isset( $image_url ) ) : ?>
		<img src="<?= esc_url( $image_url ); ?>" alt="<?= esc_attr( $main_title ); ?>">
	<?php endif ?>
</div>
<?php endif ?>
