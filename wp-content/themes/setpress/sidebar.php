<?php
/**
 * The sidebar containing the main widget area
 *
 * @package Setpress
 */
?>

	</div><!-- close .main-content-inner -->

	<div class="sidebar col-sm-12 col-md-4">


	<?php if ( is_page( ) && $post->post_parent > 0 || is_active_sidebar( 'primary' ) ) : ?>

		<div class="sidebar-padder panel">

			<aside id="search" class="widget widget_search">
				<?php get_search_form(); ?>
			</aside>

			<?php /* Sidebar navigation that only shows sibling pages and their children
			<?php if ( $post->post_parent > 0 ) : ?>
				<aside class="sidebar-nav">
					<ul class="nav nav-pills nav-stacked">
						<?php
						$output = wp_list_pages('echo=0&depth=1&title_li=' );
						if (is_page( )) {
							$page = $post->ID;
							if ($post->post_parent) {
								$page = $post->post_parent;
							}
							$children = wp_list_pages( 'echo=0&child_of=' . $page . '&title_li=' );
							if ($children) {
								$output = wp_list_pages ('echo=0&child_of=' . $page . '&title_li=');
							}
						}
						echo $output;
						?>
					</ul>
				</aside>
			<?php endif; ?>
			*/ ?>

			<?php do_action( 'before_sidebar' ); ?>
			<?php if ( ! dynamic_sidebar( 'primary' ) ) : ?>

				<!-- Delete these asides if you don't want to always show them on the sidebar -->
				<aside id="search" class="widget widget_search">
					<?php get_search_form(); ?>
				</aside>

				<aside id="archives" class="widget widget_archive">
					<h3 class="widget-title"><?php _e( 'Archives', 'setpress' ); ?></h3>
					<ul>
						<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
					</ul>
				</aside>

				<aside id="meta" class="widget widget_meta">
					<h3 class="widget-title"><?php _e( 'Meta', 'setpress' ); ?></h3>
					<ul>
						<?php wp_register(); ?>
						<li><?php wp_loginout(); ?></li>
						<?php wp_meta(); ?>
					</ul>
				</aside>

			<?php endif; ?>

		</div><!-- close .sidebar-padder -->

	<?php endif; ?>
