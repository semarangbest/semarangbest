<?php
/**
 * The template for displaying singular post-types: posts, pages and user-defined custom post types.
 *
 * @package Hellomadxartwork
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<?php
while ( have_posts() ) :
	the_post();
	?>

<!-- <main <?php post_class( 'site-main' ); ?> role="main"> -->
	<?php if ( apply_filters( 'hello_madxartwork_page_title', true ) ) : ?>
	<div class="row">
<div class="col-md-12">
<div class="postback jarallax" style="width:100%;background-color:Black;background: url('<?php echo do_shortcode('[field image-url]');?>'); min-height: 300px; background-size: cover;">
<div style="display:block;position:absolute; bottom:100px;width:100%;background:rgba(0,0,0,0.5)"><h1 style="text-align:center;"><a href="<?php echo do_shortcode('[field url]');?>" style="color:White;text-shadow: 0px 0px 10px #111111;font-size: 0.8em;;"><?php echo do_shortcode('[field title]');?></a></h1></div>

</div><!-- postback -->
</div><!-- col-md-12 -->

</div><!-- row -->


<div class="row">
<div class="col-md-12">

<?php echo do_shortcode('[field _wp_attachment_image_alt]');?>
</div><!-- col-md-12 -->
</div><!-- row -->

<div class="row">
<div class="col-md-12">
<?php echo do_shortcode('[field excerpt]');?>
</div><!-- col-md-12 -->
</div><!-- row -->

		<header class="page-header">
			<?php //the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</header>
	<?php endif; ?>
	<div class="page-content">
		<?php the_content(); ?><br>
		<div class="row"><div class="col-md-8 col-md-push-2"><?php echo do_shortcode('[field image]');?></div></div>
		<?php //echo do_shortcode('[if field="_product_image_gallery"][pass field="_product_image_gallery"][su_custom_gallery source="media:{FIELD}" link="lightbox"][/pass][/if]');?>
		<div class="row"><div class="col-md-8 col-md-push-2"><?php echo do_shortcode('[taxonomy category field=link]');?><?php echo do_shortcode('[taxonomy product_cat field=link]');?><br>
		Kategori: <?php echo do_shortcode('[taxonomy kategori field=link]');?><?php echo do_shortcode('[taxonomy product_cat field=link]');?><br>
Tag:<?php echo do_shortcode('[taxonomy post_tag field=link]');?><?php echo do_shortcode('[taxonomy product_tag field=link]');?>		<?php wp_link_pages(); ?>
	</div>
</div></div>
	<?php //comments_template(); ?>
<!-- </main> -->

	<?php
endwhile;
?>
<div style="box-shadow: 2px 3px 7px 3px rgb(0,0,0);padding: 50px 0 50px 0;margin:50px 0 50px 0;">
<?php  echo do_shortcode('[content type=mini name=related]'); ?>
</div>
<?php