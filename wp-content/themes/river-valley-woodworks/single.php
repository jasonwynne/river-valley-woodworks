<?php 

$post_type = get_post_type( $post );
$postid = get_the_ID(); 
$url = site_url();
$post_categories = wp_get_post_categories( $postid );	
$excludedCatList = array();
$cats = array();
foreach($post_categories as $c){
	if($c->cat_name != 'uncategorized')	{
		$cat = get_category( $c );
		$cats[] = array( 'name' => $cat->name, 'slug' => $cat->slug );
		array_push($excludedCatList, $cat->cat_ID);
	}
}

get_header(); 
?>
<div id="single" class="wrapper">
	<div class="center">
	<?php if ($post_type == 'sales'){ ?>
		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>		
		<?php $image = get_field('image'); ?>
		<div class="top-image">
			<img src="<?php echo $image[url]; ?>" alt="<?php echo $image[alt]; ?>" />
		</div>
		<div class="page-copy-container clearfix">
			<div class="page-left-container">
				<h1 class="single-item-title"><?php the_title(); ?></h1>
				<?php 
						$on_sale = get_field( 'on_sale' );
						$org_price = get_field('price');
						$sale_price = get_field('sale_price');
						$org_price = number_format($org_price, 2, '.', '');
						$sale_price = number_format($sale_price, 2, '.', '');
						if($on_sale == 'true') {?>
						<div class="sale-priced">	
							<div class="org-price">Was $<?php echo $org_price ?></div>
							<div class="sale-price">Sale Price $<?php echo $sale_price ?></div>
							<div class="clear"></div>
						</div>
					<?php }else{ ?>
						<div class="item-price">$<?php echo $org_price ?></div>
					<?php } ?>
				<?php the_content(); ?>
				<p class="cat-tags">Categories: <span> 
				<?php
					$i = 0;
					while ($i < count($cats)) {
					 $a = $cats[$i]["name"];
					 $slug = $cats[$i]["slug"];
						if($i <(count($cats)-1)){
							echo '<a href="'.$url.'/offers/for-sale/?item-cat='.$slug.'">'.$a.'</a>, ';
							}else{
							echo '<a href="'.$url.'/offers/for-sale/?item-cat='.$slug.'">'.$a.'</a>' ;
							
							}
					 $i++;
					 }
					?>
						</span></p>
				<div class="order-form-container">
					<h1>Order Inquiry</h1>
					<div id="sales-singles-form">
						<?php echo do_shortcode( '[contact-form-7 id="104" title="Sales Inquiry"]' ) ?>	
					</div>	
				</div>
				<div class="sales-single-response">
					<?php the_field('single_reponse','options') ?>
				</div>
			</div>
			<div class="page-right-container">
				<div class="sim-cat-list widget-holder">
					<h3>View Similar Items</h3>
					<ul>
					<?php
						$i = 0;
						while ($i < count($cats)) {
						 $a = $cats[$i]["name"];
						 $slug = $cats[$i]["slug"];
						echo '<li><a href="'.$url.'/offers/for-sale/?item-cat='.$slug.'">'.$a.'</a>';
						
						 $i++;
						 }
					?>
					</ul>
				</div>
				<div class="all-cats-list widget-holder">

				<h3>More Categories</h3>
				<ul>
				<?php
					$exculeCats = implode(",", $excludedCatList);
					$args = array(
						'orderby' => 'name',
						'exclude' => '1,'.$exculeCats,
						'parent' => 0
						);
					$categories = get_categories( $args );
					
					foreach ( $categories as $category ) {
						echo '<li><a href="'.$url.'/offers/for-sale/?item-cat='.$category->slug.'">'.$category->name.'</a></li>';
					}
					?>
						<li><a href="<?php echo $url ?>/offers/for-sale">View All</a></li>
					</ul>
				</div>
			</div>
		
		
		</div>
	

	<?php endwhile; wp_reset_query(); ?>

	<?php }else{ ?>

	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<h1><?php the_title(); ?></h1>
		<?php the_content(); ?>
	<?php endwhile; wp_reset_query(); ?>

	<?php } ?>
	</div>
</div>

<?php get_footer(); ?>

<script type="text/javascript">
	$(function () {	
				
		var price = '<?php echo $org_price ?>';
		var onSalePrice = '<?php echo $sale_price ?>';
		var itemName = $('.single-item-title').html();
		var itemCost;
		
		if(onSalePrice!='0.00'){
			itemCost = onSalePrice;
		}else{
			itemCost = price;
		}
		
		$('input.item-name').val(itemName);
		$('input.item-cost').val(itemCost);
		
 		
 		window.setTimeout(function() {
			setTallest('.page-copy-container>div');
			}, 250);
		
	}); // end doc ready for page	
</script>
