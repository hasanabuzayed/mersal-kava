<?php
/**
 * The template for displaying search form.
 *
 * @package Kava
 */
$search_field_id = 'search-field-' . uniqid();
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php esc_attr_e( 'Site search', 'kava' ); ?>" itemscope itemtype="https://schema.org/SearchAction">
	<label for="<?php echo esc_attr( $search_field_id ); ?>">
		<span class="screen-reader-text"><?php echo _x( 'Search for:', 'label', 'kava' ) ?></span>
		<input type="search" id="<?php echo esc_attr( $search_field_id ); ?>" class="search-form__field" placeholder="<?php echo esc_attr_x( 'Enter keyword search', 'placeholder', 'kava' ) ?>" value="<?php echo get_search_query() ?>" name="s" aria-label="<?php esc_attr_e( 'Search input', 'kava' ); ?>" itemprop="query-input">
	</label>
	<button type="submit" class="search-form__submit btn btn-primary" aria-label="<?php esc_attr_e( 'Submit search', 'kava' ); ?>" itemprop="target"><i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i></button>
</form>
