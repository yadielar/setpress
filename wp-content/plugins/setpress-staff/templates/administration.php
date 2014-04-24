<?php
/**
 * Template Name: Administration
 *
 * @package Setpress
 */

get_header(); ?>


<?php while ( have_posts() ) : the_post(); ?>
	<header class="page-header">
		<h1 class="page-title"><?php the_title(); ?></h1>
	</header>

	<div class="entry-content">
    	<?php the_content(); ?>
	</div><!-- .entry-content -->


	<div class="staff">

		<?php
		$args=array(
			'post_type' => 'staff',
			'tax_query' => array(
				array(
					'taxonomy' => 'department',
					'field' => 'slug',
					'terms' => 'administracion'
				)
			),
			'post_status' => 'publish',
			'posts_per_page' => -1,
			'caller_get_posts'=> 1
	      );
	    $admin_query = null;
	    $admin_query = new WP_Query($args);
	    ?>

	    <div class="staff-entries">

	    <?php
		if ( $admin_query->have_posts() ) {
			while ($admin_query->have_posts()) : $admin_query->the_post();
		?>
			<div class="staff-single">
				<h3 class="staff-name"><?php the_title(); ?></h3>
				<p class="staff-courses"><?php echo get_post_meta($post->ID, "_courses", true); ?></p>
				<p class="staff-desc"><?php the_content(); ?>
			</div>
		<?php
			endwhile;
		}
		wp_reset_postdata();
		?>

		</div>

	</div> <!-- end .staff -->


	<?php
			// If comments are open or we have at least one comment, load up the comment template
			if ( comments_open() || '0' != get_comments_number() )
				comments_template();
	?>

<?php endwhile; // end of the main loop. ?>


<?php get_sidebar(); ?>
<?php get_footer(); ?>
