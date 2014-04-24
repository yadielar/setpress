<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package Setpress
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body <?php body_class(); ?>>
<?php do_action( 'before' ); ?>

<nav class="navbar-wrapper">

	<div class="navbar navbar-inverse navbar-static-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
			    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
			    	<span class="sr-only">Toggle navigation</span>
			    	<span class="icon-bar"></span>
			    	<span class="icon-bar"></span>
			    	<span class="icon-bar"></span>
			    </button>

			    <!-- Your site title as branding in the menu -->
			    <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
			    	<!--img src="<?php echo get_template_directory_uri(); ?>/images/logo-symbol.png" alt="Logo"-->
			    	<span><?php bloginfo( 'name' ); ?></span>
			    </a>
			</div>

		    <!-- The WordPress Menu goes here -->
	        <?php wp_nav_menu(
                array(
                    'theme_location' => 'primary',
                    'container_class' => 'collapse navbar-collapse navbar-responsive-collapse',
                    'menu_class' => 'nav navbar-nav',
                    'fallback_cb' => '',
                    'menu_id' => 'main-menu',
                    'walker' => new wp_bootstrap_navwalker()
                )
            ); ?>
        </div><!-- .container -->

	</div><!-- .navbar -->

</nav><!-- .navbar-wrapper -->


<?php /*
// Get the current template name
global $template;
$curr_temp = substr( $template, strrpos( $template, '/' )+1 );

// Include masthead everywhere except in the Home Page
if (!is_front_page() || is_home()) {
	global $post;
	$parents = get_post_ancestors( $post->ID );
	$parent_id = ($parents) ? $parents[count($parents)-1]: $post->ID;
	$title = get_the_title( $parent_id );
	$description = get_post_meta( $parent_id, 'description', true );
	$mastimg_attrs = array(
		'class'	=> 'masthead-img',
		'title'	=> $title,
	);
	$mastimg = get_the_post_thumbnail( $parent_id, "full", $mastimg_attrs );
?>
	<div class="masthead">
		<div class="container">
			<h1 class="masthead-title"><?php echo $title; ?></h1>
			<p class="masthead-desc"><?php echo $description; ?></p>
			<?php echo $mastimg; ?>
		</div>
	</div>
<?php } */?>


<?php
// Include main content wrappers everywhere except in the Homepage and the Full Page template
if (is_front_page() || is_home() || $curr_temp === "full.php") {
	// Do something
} else {
?>
	<div class="main-content">
		<div class="container">
			<div class="row">
				<div class="main-content-inner col-sm-12 col-md-8">
<?php } ?>