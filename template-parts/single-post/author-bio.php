<?php
/**
 * The template for displaying author bio.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Kava
 * @subpackage widgets
 */

$is_enabled = kava_theme()->customizer->get_value( 'single_author_block' );

if ( ! $is_enabled ) {
	return;
}

?>
<aside class="post-author-bio" aria-label="<?php esc_attr_e( 'Author information', 'kava' ); ?>" role="complementary" itemscope itemtype="https://schema.org/Person">
	<div class="post-author__avatar" itemprop="image"><?php
		kava_get_post_author_avatar();
	?></div>
	<div class="post-author__content">
		<h4 class="post-author__title"><?php
			kava_get_post_author();
		?></h4>
		<div class="post-author__content" itemprop="description"><?php
			kava_get_author_meta();
		?></div>
	</div>
</aside>
