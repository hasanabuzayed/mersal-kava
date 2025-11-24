<?php
/**
 * Posts loop template
 */

do_action( 'kava-theme/blog/before' );

?><section <?php kava_posts_list_class(); ?> aria-label="<?php esc_attr_e( 'Posts list', 'kava' ); ?>" itemscope itemtype="https://schema.org/Blog"><?php

	while ( have_posts() ) : the_post();

		/*
		* Include the Post-Format-specific template for the content.
		* If you want to override this in a child theme, then include a file
		* called content-___.php (where ___ is the Post Format name) and that will be used instead.
		*/
		get_template_part( kava_get_post_template_part_slug(), kava_get_post_style() );

	endwhile;

?></section><?php

do_action( 'kava-theme/blog/after' );

get_template_part( 'template-parts/content', 'navigation' );
