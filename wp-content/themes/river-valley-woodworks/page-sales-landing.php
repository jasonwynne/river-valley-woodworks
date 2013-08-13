<?php 
/* Template Name: Sales Landing */ 

$sales_catagory =  $_GET['item-cat'];
$currCat = get_category_by_slug($sales_catagory); 
$currCatName = $currCat->name;
$currCatDisc = $currCat->description;

if ($sales_catagory == ''){
	$sales_catagory='all';
	}

get_header(); 
?>

<div id="sales" class="wrapper">
	<div class="center">
		<div class="sales-container clearfix">
			<div class="sales-left-container">
			<?php if ($sales_catagory == 'all') { ?>
			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				<h1>Current Pieces For Sale</h1>
				<?php the_content(); ?>			
			<?php endwhile; wp_reset_query(); ?>
			<?php }else{ ?>
				<h1><?php echo $currCatName; ?> Pieces For Sale</h1>
				<p><?php echo $currCatDisc; ?></p>
			<?php } ?>	
				<div class="sales-item-container">
				<?php	
					if ($sales_catagory == 'all'){
						$wp_query = new wp_query( array('post_type' => 'sales', 'showposts' => 4, 'paged' => $paged) );
					}else{
						$wp_query = new wp_query( array('post_type' => 'sales', 'category_name' => $sales_catagory, 'showposts' => 4, 'paged' => $paged) );
					}
		
					while($wp_query->have_posts()) : $wp_query->the_post();
					$myID = $post->ID;
					$image = get_field('image');	 
					$post_categories = wp_get_post_categories( $myID );	
					$cats = array();
					foreach($post_categories as $c){
						if($c->cat_name != 'uncategorized')	{
							$cat = get_category( $c );
							$cats[] = array( 'name' => $cat->name, 'slug' => $cat->slug );
						}
					}	
					  	
				?>
			<div class="sales-single-holder clearfix">
				<div class="item-image-container">
					<img class="item-image" src="<?php echo $image[url]; ?>" alt="<?php echo $image[alt]; ?>" />
					<a class="rvw-btn sales-btn" href="<?php the_permalink(); ?>">More Information</a>
				</div>	
				<div class="item-copy">
					<h3><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h3>
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
					
					<?php the_excerpt(); ?>	
					<p class="cat-tags">Categories: <span> <?php
							$i = 0;
						 	while ($i < count($cats)) {
						   $a = $cats[$i]["name"];
						   	if($i <(count($cats)-1)){
						   		echo $a .", ";
						   		}else{
						   		echo $a ;
						   		}
						   $i++;
						   }
							?>
						</span></p>
				</div>
			</div>	
			
	
									
			<?php endwhile; ?>
			<div class="pag-holder clearfix">
				<?php 
				$current_page = max( 1, get_query_var('paged') );
				$total_pages = $wp_query->max_num_pages;
			
				if ( $wp_query->max_num_pages > 1 ) : 
			
				?>
			
					<p class="page-of"><?php echo 'Page '.$current_page.' of '.$total_pages; ?></p>
					<p class="next">
					<?php next_posts_link( __( 'More Items &rarr;' ) ); ?>
					</p>
					<p class="prev">
					<?php previous_posts_link( __( '&larr; Back' ) ); ?>
					</p>
				<?php endif; ?>	
			</div>		
			
			<?php wp_reset_query(); ?>	
			
				</div>
			</div>
			<div class="sales-right-container">
				<div class="widget-holder">
				<h3>Search By Category</h3>
				<ul class="sales-cat-list">
					<li><a href="<?php echo home_url('/'); ?>offers/for-sale?item-cat=all" data-cat="all">All</a></li>
					<?php
					$args=array(
						'orderby' => 'name',
						'order' => 'ASC',
						'exclude' => '1'
						);
					$categories=get_categories($args);
						foreach($categories as $category) { 
							echo '<li><a href="'.home_url( '/' ).'offers/for-sale/?item-cat='.$category->slug.'" data-cat="'.$category->slug.'">'.$category->name.'</a></li>';
						} 
					?>
					</ul>	
				 </div>
				<?php include(TEMPLATEPATH."/includes/gallery-list-widget.php");?>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>

<script type="text/javascript">
	$(function () {
	
		var isActive = '<?php echo $sales_catagory ?>';
	
		$('.sales-cat-list li a').each(function(){
			if($(this).attr('data-cat') == isActive){
				$(this).parent().hide();
			}
		});
	
		
		
		window.setTimeout(function() {
			setTallest('.sales-container > div');	
			}, 250);
		
	}); // end doc ready for page	
</script>