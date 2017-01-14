<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package slnm
 */

get_header(); ?>

	<div id="primary" class="l-primaryContent">
		<main id="main" class="l-main" role="main">

			<article class="error404 entry">
				<header class="entry--header">
					<h1><?php esc_html_e( 'Oeps! De pagina kan niet worden gevonden.', 'slnm' ); ?></h1>
				</header><!-- .entry--header -->

				<div class="entry--content">
					<p><?php esc_html_e( 'Het lijkt erop dat er niets op deze locatie te vinden is. Misschien kan een zoekactie helpen: ', 'slnm' ); ?></p>

					<?php
						get_search_form();
					?>

				</div><!-- .entry--content -->
			</article><!-- .error404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
