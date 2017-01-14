<?php
    /**
     * Template Name: Homepage
     *
     * @package slnm-base
     */

   get_header(); ?>

   <div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php
			$args = array(
				'posts_per_page'	=> -1,
				'post_type'			=> 'page',
				'post_parent'		=> '3',
				'orderby'			=> 'menu_order',
				'order'				=> 'ASC'
			);
			$posts = get_posts($args);

			if ($posts) {
				// Loop through the posts
				foreach ( $posts as $post ) : setup_postdata( $post );

				endforeach;
			}
            ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
