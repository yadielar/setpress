<?php
/**
 * The template for displaying Staff single pages.
 *
 * @package Setpress
 */

get_header(); ?>

<div class="content-padder">

	<?php the_post(); ?>
	<h1><?php the_title(); ?></h1>
	<p><?php echo get_post_meta($post->ID, "_courses", true); ?></p>
	<p><?php the_post_thumbnail( ); ?></p>
	<p><?php echo get_the_term_list( $post->ID, 'department', 'Department: ', ', ', '' ); ?></p>
	<?php the_content(); ?>

	<?php comments_template( '', true ); ?>

</div><!-- .content-padder -->

<?php get_footer(); ?>