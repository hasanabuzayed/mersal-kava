<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Kava
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('search-item'); ?> itemscope itemtype="https://schema.org/BlogPosting">
	<header class="entry-header">
		<div class="entry-meta" aria-label="<?php esc_attr_e( 'Entry metadata', 'kava' ); ?>"><?php
			kava_posted_by();
			kava_posted_in( [
				'prefix' => __( 'In', 'kava' ),
			] );
			kava_posted_on( [
				'prefix' => __( 'Posted', 'kava' )
			] );
		?></div><!-- .entry-meta -->
		<?php the_title( '<h4 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark" itemprop="url"><span itemprop="headline">', '</span></a></h4>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content" itemprop="description">
		<?php the_excerpt(); ?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php kava_post_link(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
