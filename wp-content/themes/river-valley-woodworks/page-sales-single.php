<?php 
/* Template Name: Sale Single */ 

get_header(); 

?>

<div id="sales" class="wrapper">
	<div class="center">
		<div class="sales-container clearfix">
			<div class="sales-left-container">
			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				<?php the_content(); ?>
			<?php endwhile; wp_reset_query(); ?>	
			</div>
			<div class="sales-right-container">
				<h1>Sale Categories</h1>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>

<script type="text/javascript">
	$(function () {
		
	}); // end doc ready for page	
</script>