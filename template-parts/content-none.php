<?php
/**
 * Template part for displaying a message that posts cannot be found.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package slnm-base
 */

?>

<article class="noResults entry">
	<header class="entry--header">
		<h1 class="entry--title"><?php esc_html_e( 'Niks gevonden', 'slnm-base' ); ?></h1>
	</header><!-- .entry--header -->

	<div class="entry--content">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php printf( wp_kses( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'slnm-base' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php elseif ( is_search() ) : ?>

			<p><?php esc_html_e( 'Er is niets gevonden voor deze zoekterm. Probeer het opnieuw.', 'slnm-base' ); ?></p>
			<?php
				get_search_form();

		else : ?>

			<p><?php esc_html_e( 'Er is niets gevonden.', 'slnm-base' ); ?></p>
			<?php
				get_search_form();

		endif; ?>
	</div><!-- .entry--content -->
</article><!-- .noResults -->
