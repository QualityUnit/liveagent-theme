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
		<img src="<?= esc_url( $image_url ); ?>" class="compact-header__image" alt="<?= esc_attr(
                $main_title ); ?>">
	<?php endif ?>
	<?php if ( isset( $date ) || $date ) : ?>
	<div class="compact-header__date">
        <span itemprop="datePublished" content="<?= esc_html( get_the_time( 'Y-m-d' ) ); ?>"><?php echo get_the_time( 'F j, Y' ) . '</span><br />' .// @codingStandardsIgnoreStart
                __( 'Last modified on', 'ms' ) . ' ' .
                get_the_modified_time( 'F j, Y' ) . ' ' .
                __( 'at', 'ms' ) . ' ' .
                get_the_modified_time( 'g:i a' ); // @codingStandardsIgnoreEnd
        ?>
	</div>
	<?php endif ?>
</div>
<?php endif ?>
