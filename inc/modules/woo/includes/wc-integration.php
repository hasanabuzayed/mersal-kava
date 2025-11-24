<?php
declare(strict_types=1);

/**
 * Extends basic functionality for better WooCommerce compatibility
 *
 * @package Kava
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)-in-3.0.0
 *
 * @return void
 */
function kava_wc_setup(): void {
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}

add_action( 'after_setup_theme', 'kava_wc_setup' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 *
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function kava_wc_active_body_class( array $classes ): array {
	$classes[] = 'woocommerce-active';

	return $classes;
}

add_filter( 'body_class', 'kava_wc_active_body_class' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 *
 * @return array $args related products args.
 */
function kava_wc_related_products_args( array $args ): array {
	$defaults = [
		'posts_per_page' => 4,
		'columns'        => 4,
	];

	$args = wp_parse_args( $defaults, $args );

	return $args;
}

add_filter( 'woocommerce_output_related_products_args', 'kava_wc_related_products_args' );

/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'kava_wc_wrapper_before' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function kava_wc_wrapper_before(): void {
		?>
			<div <?php kava_content_class() ?>>
			<div class="row">
			<div id="primary" <?php kava_primary_content_class(); ?>>
			<main id="main" class="site-main">
		<?php
	}
}

add_action( 'woocommerce_before_main_content', 'kava_wc_wrapper_before' );

if ( ! function_exists( 'kava_wc_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
function kava_wc_wrapper_after(): void {
	?>
	</main><!-- #main -->
	</div><!-- #primary -->
	<?php
}
}
add_action( 'woocommerce_after_main_content', 'kava_wc_wrapper_after' );


if ( ! function_exists( 'kava_wc_sidebar_after' ) ) {
	/**
	 * Close tags after sidebar
	 */
	function kava_wc_sidebar_after(): void {
		?>
			</div>
			</div>
		<?php
	}
}
add_action( 'woocommerce_sidebar', 'kava_wc_sidebar_after', 99 );

/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
 * <?php
 * if ( function_exists( 'kava_wc_header_cart' ) ) {
 * kava_wc_header_cart();
 * }
 * ?>
 */

if ( ! function_exists( 'kava_wc_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 *
	 * @return array Fragments to refresh via AJAX.
	 */
	function kava_wc_cart_link_fragment( array $fragments ): array {
		ob_start();
		kava_wc_cart_link();
		$fragments['a.header-cart__link'] = ob_get_clean();

		return $fragments;
	}
}

if ( defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '3.0.0', '>=' ) ) {
	add_filter( 'woocommerce_add_to_cart_fragments', 'kava_wc_cart_link_fragment' );
} else {
	add_filter( 'add_to_cart_fragments', 'kava_wc_cart_link_fragment' );
}

if ( ! function_exists( 'kava_wc_cart_link' ) ) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function kava_wc_cart_link(): void {
		$item_count = WC()->cart->get_cart_contents_count();
		$item_count_text = sprintf(
			/* translators: number of items in the mini cart. */
			esc_html__( '%d', 'kava' ),
			$item_count
		);
		$aria_label = sprintf(
			/* translators: %d: number of items in cart */
			esc_attr__( 'View your shopping cart (%d items)', 'kava' ),
			$item_count
		);
		?>
			<a class="header-cart__link" href="<?php echo esc_url( wc_get_cart_url() ); ?>" aria-label="<?php echo $aria_label; ?>" title="<?php esc_attr_e( 'View your shopping cart', 'kava' ); ?>">
				<i class="header-cart__link-icon" aria-hidden="true"></i>
				<span class="header-cart__link-count" aria-hidden="true"><?php echo esc_html( $item_count_text ); ?></span>
			</a>
		<?php
	}
}

if ( ! function_exists( 'kava_wc_header_cart' ) ) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function kava_wc_header_cart(): void {
		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		?>
			<div class="header-cart" aria-label="<?php esc_attr_e( 'Shopping cart', 'kava' ); ?>">
				<div class="header-cart__link-wrap <?php echo esc_attr( $class ); ?>">
			<?php kava_wc_cart_link(); ?>
				</div>
				<div class="header-cart__content" aria-label="<?php esc_attr_e( 'Cart contents', 'kava' ); ?>">
			<?php
			$instance = [ 'title' => esc_html__( 'My cart', 'kava' ) ];
			the_widget( 'WC_Widget_Cart', $instance );
			?>
				</div>
			</div>
		<?php
	}
}

add_action( 'kava-theme/top-panel/elements-right', 'kava_wc_header_cart' );

if ( ! function_exists( 'kava_wc_pagination' ) ) {

	/**
	 * WooCommerce pagination
	 *
	 * @param $args
	 *
	 * @return mixed
	 */
	function kava_wc_pagination( array $args ): array {
		$prev_text = esc_html__( 'Prev', 'kava' );
		$next_text = esc_html__( 'Next', 'kava' );
		
		$args['prev_text'] = sprintf(
			'<span class="nav-icon icon-prev" aria-hidden="true"></span><span>%1$s</span>',
			$prev_text
		);

		$args['next_text'] = sprintf(
			'<span>%1$s</span><span class="nav-icon icon-next" aria-hidden="true"></span>',
			$next_text
		);

		return $args;
	}

}
add_filter( 'woocommerce_pagination_args', 'kava_wc_pagination' );

if ( ! function_exists( 'kava_init_wc_properties' ) ) {

	/**
	 * Init shop properties
	 */
	function kava_init_wc_properties(): void {

		// Sidebar properties for archive product
		if ( ( is_shop() || is_product_taxonomy() ) && ! is_singular( 'product' ) ) {
			if ( is_active_sidebar( 'sidebar-shop' ) ) {
				kava_theme()->sidebar_position = 'one-left-sidebar';
			} else {
				kava_theme()->sidebar_position = 'none';
			}
		}

	}

}
add_action( 'wp_head', 'kava_init_wc_properties', 2 );