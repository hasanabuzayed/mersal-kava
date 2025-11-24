<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Kava
 */

?>

<?php 

do_action( 'kava-theme/sidebar/before' );

if ( is_active_sidebar( 'sidebar' ) && 'none' !== kava_theme()->sidebar_position ) : ?>
	<aside id="secondary" <?php kava_secondary_content_class( ['widget-area'] ); ?> aria-label="<?php esc_attr_e( 'Main sidebar', 'kava' ); ?>" role="complementary" itemscope itemtype="https://schema.org/WPSideBar">
		<?php dynamic_sidebar( 'sidebar' ); ?>
	</aside><!-- #secondary -->
<?php endif; 

do_action( 'kava-theme/sidebar/after' );
