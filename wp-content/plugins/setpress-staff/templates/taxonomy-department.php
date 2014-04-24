<?php
/*
This is the template for the "Departments" taxonomy.

*/
?>

<?php get_header(); ?>

<div class="content-padder">

	<h1 class="archive-title h2"><?php single_cat_title(); ?></h1>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?> role="article">

		<?php
			/* Include the Post-Format-specific template for the content.
			 * If you want to overload this in a child theme then include a file
			 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
			 */
			get_template_part( 'content', get_post_format() );
		?>

	</article>

	<?php endwhile; ?>

	<?php else : ?>

		<?php get_template_part( 'no-results', 'archive' ); ?>

	<?php endif; ?>

</div>

<?php get_sidebar(); ?>


<?php get_footer(); ?>
