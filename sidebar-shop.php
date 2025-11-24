<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Kava
 */
?>

<?php if ( is_active_sidebar( 'sidebar-shop' ) && 'none' !== kava_theme()->sidebar_position ) : ?>
	<aside id="secondary" <?php kava_secondary_content_class( ['widget-area'] ); ?> aria-label="<?php esc_attr_e( 'Shop sidebar', 'kava' ); ?>" role="complementary" itemscope itemtype="https://schema.org/WPSideBar">
	  <?php dynamic_sidebar( 'sidebar-shop' ); ?>
	</aside><!-- #secondary -->
<?php endif;