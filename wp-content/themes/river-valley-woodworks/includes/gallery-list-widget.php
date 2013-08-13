<?php 

$pageID = $post->ID;
$slug = $post->post_name; 
$page = get_page_by_title( 'Wares' );
?>


<div id="gallery-sale-widget" class="widget-holder">
	<h3>Our Wares</h3>
	<ul>
 	<?php wp_list_pages('title_li=&child_of=19' ); ?>

	</ul>
</div>

<script type="text/javascript">
	$(function () {
		
	}); // end doc ready for page	
</script>