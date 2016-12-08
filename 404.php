<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package _s
 */

get_header(); ?>

	<div id="primary" class="l-primaryContent">
		<main id="main" class="l-main" role="main">

			<article class="error404 entry">
				<header class="entry--header">
					<h1><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', '_s' ); ?></h1>
				</header><!-- .entry--header -->

				<div class="entry--content">
					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', '_s' ); ?></p>

					<?php
						get_search_form();
					?>

				</div><!-- .entry--content -->
			</article><!-- .error404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
