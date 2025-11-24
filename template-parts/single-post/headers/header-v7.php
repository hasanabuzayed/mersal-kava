<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Kava
 */

$has_post_thumbnail = has_post_thumbnail();
$has_post_thumbnail_class = $has_post_thumbnail ? 'invert' : '';
?>

<div class="single-header-7 <?php echo esc_attr( $has_post_thumbnail_class ); ?>">
	<?php if ( $has_post_thumbnail ) : ?>
		<div class="overlay-thumbnail" <?php kava_post_overlay_thumbnail( 'kava-thumb-xl' ); ?>></div>
	<?php endif; ?>
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-lg-8 col-lg-push-2">
				<div class="entry-header-top"><?php
					kava_posted_in( [
						'delimiter' => '',
						'before'    => '<div class="cat-links btn-style">',
						'after'     => '</div>'
					]);
					kava_posted_on( [
						'prefix'  => '<i class="fa-regular fa-clock" aria-hidden="true"></i> ' . __( 'Posted', 'kava' ),
						'before'  => '<div class="posted-on">',
						'after'   => '</div>',
					]);
				?></div>
				<header class="entry-header">
					<?php get_template_part( 'template-parts/single-post/author-bio' ); ?>
					<?php the_title( '<h1 class="entry-title h3-style">', '</h1>' ); ?>
				</header><!-- .entry-header -->
				<div class="entry-header-bottom">
					<div class="entry-meta" aria-label="<?php esc_attr_e( 'Entry metadata', 'kava' ); ?>"><?php
						kava_post_tags ( [
							'prefix'    => '<i class="fa-solid fa-tag" aria-hidden="true"></i>',
						]);
						kava_post_comments( [
							'prefix'    => '<i class="fa-regular fa-comment" aria-hidden="true"></i>',
							'postfix' => __( 'Comment(s)', 'kava' )
						]);
					?></div><!-- .entry-meta -->
				</div>
			</div>
		</div>
	</div>
</div>