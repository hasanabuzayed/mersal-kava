<?php
/**
 * The template for displaying related posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Kava
 * @subpackage single-post
 */
?>
<div class="related-post <?php echo esc_attr( $grid_class ); ?>" itemscope itemtype="https://schema.org/BlogPosting"><?php
	if ( $settings['image_visible'] ) :
		kava_post_thumbnail( 'kava-thumb-s' );
	endif; ?>
	<div class="entry-meta" aria-label="<?php esc_attr_e( 'Entry metadata', 'kava' ); ?>"><?php
		if ( $settings['date_visible'] ) :
			kava_posted_on();
		endif;

		if ( $settings['author_visible'] ) :
			kava_posted_by();
		endif; ?>
	</div>
	<header class="entry-header"><?php
		if ( $settings['title_visible'] ) :
			printf(
				'<h6 class="entry-title"><a href="%s" rel="bookmark" aria-label="%s: %s" itemprop="url"><span itemprop="headline">%s</span></a></h6>',
				esc_url( get_permalink() ),
				esc_attr__( 'View post', 'kava' ),
				esc_attr( get_the_title() ),
				get_the_title()
			);
		endif; ?>
	</header>
	<div class="entry-content" itemprop="description"><?php
		if ( $settings['excerpt_visible'] ) :
			the_excerpt();
		endif; ?>
	</div>
</div>
