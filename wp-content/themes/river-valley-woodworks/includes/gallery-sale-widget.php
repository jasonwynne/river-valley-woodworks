<?php 

$pageID = $post->ID;
$slug = $post->post_name; 

?>


<div id="gallery-sale-widget" class="widget-holder">
	<h3><?php echo $slug; ?> Items for Sale</h3>
	<ul>
	<?php
		$wp_query = new wp_query( array('post_type' => 'sales', 'category_name' => $slug, 'showposts' => -1) );
		$totalPosts = $wp_query->found_posts;
		while($wp_query->have_posts()) : $wp_query->the_post();
				$myID = $post->ID;
				$on_sale = get_field( 'on_sale' );
				$myTitle = get_the_title($myID);
				$myTitle = strtolower($myTitle);
				$myTitle = str_replace( $slug.' ','', $myTitle);
	?>
	<?php if($on_sale!='true'){ ?>
		<li><a href="<?php the_permalink(); ?>"><?php echo $myTitle; ?></a></li>
	<?php } ?>
	
<?php endwhile; wp_reset_query(); ?>	
	</ul>
</div>

<script type="text/javascript">
	$(function () {
		
	}); // end doc ready for page	
</script>