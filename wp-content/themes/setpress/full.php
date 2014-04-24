<?php
/**
 * Template Name: Fullwidth
 *
 * @package Setpress
 */

get_header(); ?>

<div class="main-content">
	<div class="container">
		<div class="row">
			<div class="main-content-inner col-md-12">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

				<?php
						// If comments are open or we have at least one comment, load up the comment template
						if ( comments_open() || '0' != get_comments_number() )
							comments_template();
				?>

			<?php endwhile; // end of the loop. ?>

			</div><!-- close .main-content-inner -->
		</div><!-- close .row -->
	</div><!-- close .container -->
</div><!-- close .main-content -->


<?php get_footer(); ?>
