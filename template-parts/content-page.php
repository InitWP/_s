<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package slnm-base
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('entry'); ?>>
	<header class="entry--header">
		<?php
		if ( is_front_page() ) :
			the_title( '<h2 class="entry--title">', '</h2>' );
		else :
			the_title( '<h1 class="entry--title">', '</h1>' );
		endif;
		?>
	</header><!-- .entry--header -->

	<div class="entry--content">
		<?php the_content(); ?>
	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry--footer">
			<?php
				edit_post_link(
					sprintf(
						/* translators: %s: Name of current post */
						esc_html__( 'Edit %s', 'slnm-base' ),
						the_title( '<span class="screenReaderText">"', '"</span>', false )
					),
					'<span class="editLink">',
					'</span>'
				);
			?>
		</footer><!-- .entry--footer -->
	<?php endif; ?>
</article><!-- #post-## -->
