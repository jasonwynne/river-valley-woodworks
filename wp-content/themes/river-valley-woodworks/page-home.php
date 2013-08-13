<?php 
/* Template Name:Home*/ 
?>

<?php get_header(); ?>

<div id="bg">
	<?php while(the_repeater_field('background_images')): ?>
		<img src="<?php the_sub_field('hero_image'); ?>" alt="<?php the_sub_field('image_title'); ?>">		
	<?php endwhile; ?>	
</div>

<div id="home-page" class="wrapper">
	<div class="center">
			<div class="page-container">
				<ul class="home-hero-dots"></ul>
				<div class="clear"></div>
				<div class="caption-container">
				<?php while(the_repeater_field('background_images')): ?>
					<div class="caption-holder">				
						<h1 class="caption"><?php the_sub_field('image_caption'); ?></h1>	
						<?php if (get_sub_field('link_text')){ ?>
						<a class="rvw-btn" href="<?php the_sub_field('link'); ?>"><?php the_sub_field('link_text'); ?></a>
						<?php } ?>
					</div>	
				<?php endwhile; ?>
				</div>
				
			</div>
	</div>
</div>

<?php get_footer(); ?>

<script type="text/javascript">
	$(function () {
		// this sets up the dots and counts the hero images
		
		var heroCount = $('#bg img').length;
		var heroActual = heroCount-1;
		var currSlide = 0;
		var nextSlide;
		var isAnimating = 0;
		var slideintervalTime = 7000;
		var fadeTime = 750;
		
		$('#bg img').each(function(i){
			$(this).addClass('hero'+i);
			$(this).css('display','none');
		});
		
		$('.caption-holder').each(function(i){
			$(this).addClass('hero-cap'+i);
			$(this).css('display','none');
			$('.home-hero-dots').append('<li class="dot'+i+'" data-dot-num="'+i+'">Dot</li>');
		});
		
		$('.hero0, .hero-cap0').show();	
		$('.dot0').addClass('active');	
		
		var slideTimer = $.timer(function() {
			slideFade();
		});

    slideTimer.set({ time : slideintervalTime, autostart : true });	
	
		
		$('.home-hero-dots li').click(function(){
			var num = $(this).attr('data-dot-num');
			if(isAnimating==0 && num != currSlide){
				slideTimer.stop();
				isAnimating = 1;
				$('.hero'+currSlide).fadeOut(fadeTime);
				$('.hero-cap'+currSlide).fadeOut(fadeTime);
				$('.hero-cap'+num).fadeIn(fadeTime);
				$('.hero'+num).fadeIn(fadeTime, function() {
					fadeComplete(num);
				});
				$('.home-hero-dots li').removeClass('active');
				$('.dot'+num).addClass('active');
  		}
		});
		
		
		function slideFade(){
			isAnimating = 1;
			if(currSlide != heroActual){
				nextSlide = currSlide+1;
			}else{
				nextSlide = 0;
			}
			$('.hero'+currSlide).fadeOut(fadeTime);
			$('.hero-cap'+currSlide).fadeOut(fadeTime);
			$('.hero-cap'+nextSlide).fadeIn(fadeTime);
			$('.hero'+nextSlide).fadeIn(fadeTime, function() {
				fadeComplete(nextSlide);
			});
			$('.home-hero-dots li').removeClass('active');
			$('.dot'+nextSlide).addClass('active');
		}
		
		function fadeComplete(x){
				currSlide = x;
				isAnimating = 0;
		}

	$(window).focus(function() {		
		slideTimer.play();
	});

	$(window).blur(function() {		
		slideTimer.stop();
	});		
		
	}); // end doc ready for home page	
</script>