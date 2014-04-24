<?php
/**
 * Template Name: Faculty
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


    <div class="staff panel-group" id="accordion">

    <?php
    // Function for setting array to pass to WP_Query
	function set_query_args($term) {
		return array(
			'post_type' => 'staff',
			'tax_query' => array(
				array(
					'taxonomy' => 'department',
					'field' => 'slug',
					'terms' => $term,
				)
			),
			'post_status' => 'publish',
			'posts_per_page' => -1,
			'caller_get_posts'=> 1
		);
    }

    // Query posts for each department
	$departments = array('preescolar', 'elemental', 'superior');
	foreach ($departments as $department) {
	?>

		<div class="staff-dept panel panel-default">

			<?php
			$faculty_query = null;
		    $faculty_query = new WP_Query(set_query_args($department));
			?>

		    <div class="panel-heading">
		    	<h2 class="staff-dept-name panel-title">
		    		<a data-toggle="collapse" data-parent="#accordion" href="#<?php echo $department; ?>">
		    			<?php echo $department; ?>
		    		</a>
		    	</h2>
		    </div>

		    <div id="<?php echo $department; ?>" class="staff-entries panel-collapse collapse">
		    	<div class="panel-body">

				<?php
				if ( $faculty_query->have_posts() ) {
					while ($faculty_query->have_posts()) : $faculty_query->the_post();
				?>
					<div class="staff-single">
						<h3 class="staff-name"><?php the_title(); ?></h3>

						<?php
						$terms = get_the_terms( $post->ID, 'grade' );
						if ( $terms && ! is_wp_error( $terms ) ) :
							$grade_list = array();
							foreach ( $terms as $term ) {
								if ( $term->description == $department ) {
									$grade_list[] = $term->name;
								}
							}
							$grades = join( ", ", $grade_list );
						?>

						<p class="staff-grades"><?php echo $grades; ?></p>

						<?php endif; ?>

						<p class="staff-courses"><?php echo get_post_meta($post->ID, "_courses", true); ?></p>
						<p class="staff-roles"><?php echo get_post_meta($post->ID, "_roles", true); ?></p>
						<p class="staff-homeroom"><?php echo get_post_meta($post->ID, "_homeroom", true); ?></p>
						<p class="staff-desc"><?php the_content(); ?>
					</div>
				<?php
					endwhile;
				}
				wp_reset_postdata();
				?>

				</div> <!-- end .panel-body -->
			</div> <!-- end .staff-entries -->

		</div> <!-- end .staff-dept -->

	<?php
	}
	?>

	</div> <!-- end .staff -->


	<?php
			// If comments are open or we have at least one comment, load up the comment template
			if ( comments_open() || '0' != get_comments_number() )
				comments_template();
	?>

<?php endwhile; // end of the main loop. ?>


<?php get_sidebar(); ?>
<?php get_footer(); ?>
