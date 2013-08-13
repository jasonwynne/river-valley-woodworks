<?php 

$currPageID = $post->ID;
 
?>


<div id="on-sale-widget" class="widget-holder">
		<h3>Now Offering</h3>
<?php
	$wp_query = new wp_query( array('post_type' => 'sales', 'orderby' => 'rand', 'showposts' => 1) );
	while($wp_query->have_posts()) : $wp_query->the_post();
			$myID = $post->ID;
			$image = get_field('image');
			$on_sale = get_field( 'on_sale' );
			$org_price = get_field('price');
			$sale_price = get_field('sale_price');
			$org_price = number_format($org_price, 2, '.', '');
			$sale_price = number_format($sale_price, 2, '.', '');
?>
	<div class="on-sale-item-container">
		<img class="osw-image" src="<?php echo $image[url]; ?>" alt="<?php echo $image[alt]; ?>" />
		<h4><?php the_title(); ?></h4>
		<div class="sale-priced">	
			<?php if($on_sale=='true'){ ?>
			<div class="org-price">Was $<?php echo $org_price ?></div>
			<div class="sale-price">On Sale For $<?php echo $sale_price ?></div>
			<?php }else{ ?>
			<div class="org-price">Only $<?php echo $org_price ?></div>
			<?php } ?>
			<div class="clear"></div>
		</div>
		<a class="rvw-btn" href="<?php the_permalink(); ?>">Check It Out</a>
	</div>	

<?php endwhile; wp_reset_query(); ?>	
</div>

<script type="text/javascript">
	$(function () {
		
	}); // end doc ready for page	
</script>