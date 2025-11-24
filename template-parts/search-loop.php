<?php
/**
 * Search loop template
 */
?><section class="search-results" aria-label="<?php esc_attr_e( 'Search results', 'kava' ); ?>" itemscope itemtype="https://schema.org/ItemList"><?php
while ( have_posts() ) : the_post();

	/**
	 * Run the loop for the search to output the results.
	 * If you want to overload this in a child theme then include a file
	 * called content-search.php and that will be used instead.
	 */
	get_template_part( 'template-parts/content', 'search' );

endwhile;

?></section><?php

get_template_part( 'template-parts/content', 'navigation' );
