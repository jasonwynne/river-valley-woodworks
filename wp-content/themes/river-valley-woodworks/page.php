<?php 
 $imageTop = get_field('page_image');		

get_header(); 

?>


<div id="page" class="wrapper">
	<div class="center">
		<div class="top-image">
			<div class="ti-img-holder">
				<img src="<?php echo $imageTop[url]; ?>" alt="<?php echo $imageTop[alt]; ?>" />
			</div>
		</div>
		<div class="page-copy-container clearfix">
			<div class="page-left-container">
			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				<?php the_content(); ?>
			<?php endwhile; wp_reset_query(); ?>	
			</div>
			<div class="page-right-container">
				<?php include(TEMPLATEPATH."/includes/gallery-list-widget.php");?>
				<?php include(TEMPLATEPATH."/includes/random-sale-widget.php");?>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>

<script type="text/javascript">
	$(function () {
		
		window.setTimeout(function() {
			setTallest('.page-copy-container>div');
			}, 250);
		
	}); // end doc ready for page	
</script>