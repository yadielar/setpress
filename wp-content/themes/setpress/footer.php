<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package Setpress
 */
?>

<?php
// Include main content wrappers everywhere except in the Homepage and the Full Page template
if (is_front_page() || is_home() || $curr_temp === "full.php") {
	// Do something
} else {
?>
				</div><!-- close .*-inner (main-content or sidebar, depending if sidebar is used) -->
			</div><!-- close .row -->
		</div><!-- close .container -->
	</div><!-- close .main-content -->
<?php } ?>


<footer class="darkfooter">
	<div class="container">
		<div class="darkfooter-copyright">© Setpress 2013. All rights reserved.</div>
	</div>
</footer>

<?php wp_footer(); ?>

</body>
</html>