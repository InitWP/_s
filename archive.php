<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package slnm-base
 */

get_header(); ?>

	<main id="main" class="l-main l-container">

	<?php
	if ( have_posts() ) : ?>

		<header class="pageHeader">
			<?php
				the_archive_title( '<h1 class="pageHeader--title">', '</h1>' );
				the_archive_description( '<div class="pageHeader--description">', '</div>' );
			?>
		</header><!-- .page-header -->

		<?php
		/* Start the Loop */
		while ( have_posts() ) : the_post();

			/*
			 * Include the Post-Type-specific template for the content.
			 * If you want to override this in a child theme, then include a file
			 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
			 */
			get_template_part( 'template-parts/content', get_post_type() );

		endwhile;

		the_posts_navigation();

	else :

		get_template_part( 'template-parts/content', 'none' );

	endif; ?>

	</main><!-- #main -->

<?php
//get_sidebar();
get_footer();
