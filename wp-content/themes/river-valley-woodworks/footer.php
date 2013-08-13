

<?php if(is_front_page()) { ?>
<div id="home-footer" class="wrapper">
	<div class="center">
		<div class="footer-container">
			<div class="footer-copyright">Copyright &copy;<?php echo date("Y"); ?> River Valley Woodworks, Inc. All rights reserved.</div>
			<div class="footer-menu"><?php  wp_nav_menu( array( 'menu' => 'footer_menu' ) );?></div>
			<div class="clear"></div>
		</div>
	</div>
</div>
<?php }else{ ?> 
<div  id="footer" class="wrapper">
	<div class="center">
		<div class="footer-container">
			<div class="footer-copyright">Copyright &copy;<?php echo date("Y"); ?> River Valley Woodworks, Inc. All rights reserved.</div>
			<div class="footer-menu"><?php  wp_nav_menu( array( 'menu' => 'footer_menu' ) );?></div>
			<div class="clear"></div>
		</div>
	</div>
</div>
<?php } ?>



<?php wp_footer(); ?>
</body>
</html>