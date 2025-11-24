<?php
/**
 * Template part for displaying default posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Kava
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('posts-list__item default-item'); ?>>

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="default-item__thumbnail" <?php kava_post_overlay_thumbnail( 'kava-thumb-m-2' ); ?>></div>
	<?php endif; ?>

	<div class="default-item__content">

		<?php
			kava_post_comments( [
				'prefix' => '<i class="fa-solid fa-comment" aria-hidden="true"></i>'
			]);
		?>

		<header class="entry-header">
			<div class="entry-meta" aria-label="<?php esc_attr_e( 'Entry metadata', 'kava' ); ?>"><?php
				kava_posted_by();
				kava_posted_in( [
					'prefix' => __( 'In', 'kava' ),
				]);
				kava_posted_on( [
					'prefix' => __( 'Posted', 'kava' )
				]);
			?></div><!-- .entry-meta -->
			<h4 class="entry-title" aria-label="<?php esc_attr_e( 'Entry title', 'kava' ); ?>"><?php 
				kava_sticky_label();
				the_title( '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a>' );
			?></h4>
		</header><!-- .entry-header -->

		<?php kava_post_excerpt(); ?>

		<footer class="entry-footer">
			<div class="entry-meta" aria-label="<?php esc_attr_e( 'Entry footer metadata', 'kava' ); ?>">
				<?php
					kava_post_tags( [
						'prefix' => __( 'Tags:', 'kava' )
					]);
				?>
				<div><?php
					kava_post_link();
				?></div>
			</div>
			<?php kava_edit_link(); ?>
		</footer><!-- .entry-footer -->
	
	</div>

</article><!-- #post-<?php the_ID(); ?> -->
