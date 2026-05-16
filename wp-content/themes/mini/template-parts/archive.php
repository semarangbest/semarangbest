<?php
/**
 * The template for displaying archive pages.
 *
 * @package Hellomadxartwork
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<main class="site-main" role="main">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flexboxgrid/6.3.1/flexboxgrid.min.css" integrity="sha512-YHuwZabI2zi0k7c9vtg8dK/63QB0hLvD4thw44dFo/TfBFVVQOqEG9WpviaEpbyvgOIYLXF1n7xDUfU3GDs0sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<?php if ( apply_filters( 'hello_madxartwork_page_title', true ) ) : ?>
		<header class="page-header">
			<?php
			the_archive_title( '<h1 class="entry-title">', '</h1>' );
			the_archive_description( '<p class="archive-description">', '</p>' );
			?>
		</header>
	<?php endif; ?>
	<div class="page-content"><div class="row">
		<?php
		while ( have_posts() ) {
		?><?php
			the_post();?><div class="col-md-6"><?php
			$post_link = get_permalink();
			?>
			<article class="post">
			<div class="row">
				<?php
				printf( '<h2 class="%s"><a href="%s">%s</a></h2>', 'entry-title', esc_url( $post_link ), esc_html( get_the_title() ) );?>
				<div class="col-md-4 col-xs-3">
				<?php printf( '<a href="%s">%s</a>', esc_url( $post_link ), get_the_post_thumbnail( $post, 'medium' ) ); ?></div>
				<div class="col-md-8 col-xs-9"><?php the_excerpt(); ?></div>
				</div>
			</article></div>
		<?php } ?>
	</div></div>

	<?php wp_link_pages(); ?>

	<?php
	global $wp_query;
	if ( $wp_query->max_num_pages > 1 ) :
		?>
		<nav class="pagination" role="navigation">
			<?php /* Translators: HTML arrow */ ?>
			<div class="nav-previous"><?php next_posts_link( sprintf( __( '%s older', 'hello-madxartwork' ), '<span class="meta-nav">&larr;</span>' ) ); ?></div>
			<?php /* Translators: HTML arrow */ ?>
			<div class="nav-next"><?php previous_posts_link( sprintf( __( 'newer %s', 'hello-madxartwork' ), '<span class="meta-nav">&rarr;</span>' ) ); ?></div>
		</nav>
	<?php endif; ?>
</main>
<div class="row">
<div class="col-md-8 col-md-push-2"><?php wp_pagenavi(); ?></div></div>