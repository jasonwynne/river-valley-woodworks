<?php 
/*
Template Name: Gallery
*/
?>

<?php 

	$pageParent = $post->post_parent;
	
	get_header(); 

?>


<div id="gallery" class="wrapper">
	<div class="center">
		<div class="gallery-container">
		<div class="arrow-holder arrow-holder-right" data-dir="r">
			<div class="arrow-right"></div>
		</div>
		<div class="arrow-holder arrow-holder-left" data-dir="l">	
			<div class="arrow-left"></div>
		</div>
			<?php while(the_repeater_field('gallery_all')): 
				$image = get_sub_field('image');
				$isForSale = get_sub_field('for_sale');
			?>		
			<div class="gallery-image">
				<img src="<?php echo $image[url]; ?>" alt="<?php echo $image[alt]; ?>" />
				<?php if (!empty($image[caption])) { ?>
				<div class="gallery-caption">
					<div class="caption-choose up">Learn More</div>	
					<div class="clear"></div>
					<?php if ($isForSale == 1){?>
						<div class="ios-container caption-copy">
							<p><?php echo $image[caption]; ?></p>
							<a class="rvw-btn" href="<?php the_sub_field('page_link') ?>">On Sale Now</a>
							<div class="clear"></div>
						</div>
					<?php }else{ ?>
						<p class="caption-copy"><?php echo $image[caption]; ?></p>
					<?php } ?>
					<div class="clear"></div>
				</div>
				<?php } ?>
			</div>
			<?php endwhile; ?>	
		</div>
		<div class="gallery-dots-holder clearfix"></div>
		<div class="page-copy-container clearfix">
			<div class="page-left-container">
			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				<h1><?php the_title(); ?></h1>
				<?php the_content(); ?>
			<?php endwhile; wp_reset_query(); ?>	
			</div>
			<div class="page-right-container">
				<div class="widget-holder">
				<h3>More Galleries</h3>
					<ul>
					<?php wp_list_pages('exclude='.$post->ID.'&sort_column=menu_order&title_li=&child_of='.$pageParent); ?>
					</ul>
  			</div>
  			<?php include(TEMPLATEPATH."/includes/gallery-sale-widget.php");?>
  			<?php include(TEMPLATEPATH."/includes/on-sale-widget.php");?>
			</div>
		</div>
		<div class="fma-container"></div>	
	</div>
</div>

<?php get_footer(); ?>

<script type="text/javascript">
	$(function () {

		var imageCount = $('.gallery-image').length;
		var imageActual = imageCount-1;
		var currSlide = 0;
		var nextSlide = 1;
		var isAnimating = 0;
		var slideintervalTime = 7000;
		var fadeTime = 750;
		
		$('.gallery-image').each(function(i){
			$(this).addClass('gip'+i);
			$(this).attr('data-image-num',i);
			$(this).css('display','none');
			var myPic = $(this).children('img').attr('src');
			var myAlt = $(this).children('img').attr('alt');
			$('.gallery-dots-holder').append('<div class="g-dot-selector g-dot'+i+'" data-dot-num="'+i+'"><div class="dot-actual">galleryNum'+i+'</div><div class="image-hint"><img src="'+myPic+'" alt="'+myAlt+'" height="70px" width="125px" /></div></div>');
		});
		
		$('.gip0').show();
		$('.g-dot-selector:first-child .dot-actual').addClass('active');
	
		// gallery dot click to change slide
		$('.g-dot-selector').click(function(){
			var myNum = $(this).attr('data-dot-num');
			if(myNum != currSlide){
				nextSlide = myNum;
				changeSlide(myNum);
			}
		});
		
		// arrow click to change slide
		$('.arrow-holder').click(function(){
			var myDir = $(this).attr('data-dir');
			if(myDir=='r' && currSlide!=imageActual){
				nextSlide = parseInt(currSlide)+1;
				changeSlide(nextSlide);
			}	else if(myDir=='r' && currSlide==imageActual){
				nextSlide = 0;
				changeSlide(nextSlide);
			} else if(myDir=='l' && currSlide!=0){
				nextSlide = parseInt(currSlide)-1;
				changeSlide(nextSlide);	
			} else if(myDir=='l' && currSlide==0){
				nextSlide = imageActual;
				changeSlide(nextSlide);	
			}	
		});
		
		// change slide on keypress
		$(document).keydown(function(e) {
	
			if(e.which==39){
				if(currSlide!=imageActual){
					nextSlide = parseInt(currSlide)+1;
					changeSlide(nextSlide);
				}	else if(currSlide==imageActual){
					nextSlide = 0;
					changeSlide(nextSlide);
				} 
			}
			
			if(e.which==37){
				if(currSlide!=0){
					nextSlide =  parseInt(currSlide)-1;
					changeSlide(nextSlide);	
				} else if(currSlide==0){
					nextSlide = imageActual;
					changeSlide(nextSlide);	
				}	
			}
		});		
				
		//caption up and down
		$('.caption-choose').click(function(){
			var capSize = $(this).parent().children('.caption-copy').outerHeight();
			$(this).toggleClass('up');
			if($(this).hasClass('up')){
				$(this).parent().animate({'bottom': 0}, 250);
			}else{
				$(this).parent().animate({'bottom': '-'+capSize+'px'}, 250);
			}	
		});
		
		// fade change slides
		function changeSlide(x){
			if(isAnimating==0){
				isAnimating = 1;
				$('.dot-actual').removeClass('active');
				$('.g-dot'+x+' .dot-actual').addClass('active');
				$('.gip'+currSlide).fadeOut(fadeTime);
				$('.gip'+x).fadeIn(fadeTime, function() {
					changeSlideComplete(x);
				});
			}
		}		
		
		function changeSlideComplete(x){
			isAnimating = 0;
			currSlide = x;
			console.debug(currSlide+' '+nextSlide);
		}

		window.setTimeout(function() {
			setTallest('.page-copy-container>div');
			}, 250);
		
		}); // end doc ready for home page	
</script>