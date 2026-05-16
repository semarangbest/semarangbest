<?php
/**
 * The template for displaying the footer.
 *
 * Contains the body & html closing tags.
 *
 * @package Hellomadxartwork
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/*
if ( ! function_exists( 'madxartwork_theme_do_location' ) || ! madxartwork_theme_do_location( 'footer' ) ) {
	if ( did_action( 'madxartwork/loaded' ) && hello_header_footer_experiment_active() ) {
		get_template_part( 'template-parts/dynamic-footer' );
	} else {
		get_template_part( 'template-parts/footer' );
	}
}
*/
?>
<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js'></script>
<?php
echo do_shortcode('[content type=mini name=footer]');
?>
   
<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js'></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/lightslider/1.1.6/js/lightslider.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha512-oBTprMeNEKCnqfuqKd6sbvFzmFQtlXS3e0C/RGFV0hD6QzhHV+ODfaQbAlmY6/q0ubbwlAM/nCJjkrgA3waLzg==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jarallax/2.1.4/jarallax.min.js"></script>
<script>jQuery(document).ready(function(){jQuery('.jarallax').jarallax({ speed: 0.5});})</script>
<!-- <script>
jQuery(document).ready(function() {
jQuery(".content-slider").lightSlider({
loop:true,
keyPress:true,
item:2,
speed:500,
auto:true,
});
});
</script> -->
<?php

wp_footer(); ?>

</body>
</html>
