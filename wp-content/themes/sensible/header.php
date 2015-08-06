<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>

		<link href="//www.google-analytics.com" rel="dns-prefetch">
        <link href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon.ico" rel="shortcut icon">
        <link href="<?php echo get_template_directory_uri(); ?>/img/icons/touch.png" rel="apple-touch-icon-precomposed">

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?php bloginfo('description'); ?>">

		<?php wp_head(); ?>
		<script>
        // conditionizr.com
        // configure environment tests
        conditionizr.config({
            assets: '<?php echo get_template_directory_uri(); ?>',
            tests: {}
        });
        </script>
		<style>
		.green-dots
		{
			background-image: url(<?php echo get_template_directory_uri(); ?>/img/sf-dashed-line-green.png);
			background-repeat:repeat-x;
		}
		.green-dots-bottom
		{
			background-image: url(<?php echo get_template_directory_uri(); ?>/img/sf-dashed-line-green.png);
			background-repeat:repeat-x;
			background-position: bottom;
		}
		.green-dots-vertical
		{
			background-image: url(<?php echo get_template_directory_uri(); ?>/img/sf-dashed-vertical-line-green.png);
			background-repeat:repeat-y;
		}
		.green-dots-vertical-right
		{
			background-image: url(<?php echo get_template_directory_uri(); ?>/img/sf-dashed-vertical-line-green.png);
			background-repeat:repeat-y;
			background-position: right;
		}
		.modal-backdrop 
		{
			background-color: #006f43;
		}
		.modal-backdrop.in {
			opacity: .75;
			filter: alpha(opacity=75);
		}
		.modal-footer { border: none; !important; text-align: center; padding-bottom:40px; }
		.modal-footer button { width: 100px; text-transform: uppercase;}
		.bootbox-body
		{
			margin-top:30px;
			font-size: 24px;
			text-align:center;
			color: #006f43;
			font-family:flyerfontsregular;
			text-transform: uppercase;
		}
		
		.modal-title
		{
			background-image: url(<?php echo get_template_directory_uri(); ?>/img/sf-dashed-line-green.png);
			background-repeat:repeat-x;
			background-position: bottom;
			border-bottom: none;
			padding-left: 30px;
			padding-right: 30px;
		}
		</style>

	</head>
	<body <?php body_class(); ?> style="font-family:'Trebuchet MS', Helvetica, sans-serif;">
	<!-- <?PHP  echo basename( get_page_template());  ?>-->

		<!-- wrapper -->
		<div class="wrapper">
			<header class="header clear <?PHP if(is_front_page() || (get_post_type() == 'product_description' && is_single()) || ( basename( get_page_template()) == 'template-large-header.php')) echo'front-page product-description'; else echo 'page';?>" role="banner">
			
				<nav class="navbar navbar-default navbar-static-top" style="background-image:url(<?php echo get_template_directory_uri(); ?>/img/sf-header-gradient.png); background-repeat:repeat-x; border-color:transparent;position:absolute; width:100%; max-width:1500px;">
					<div class="container">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							<?php if ( get_theme_mod( 'sensible_logo' )): ?>
								<div class='site-logo hidden-sm'>
									<a href='<?php echo esc_url( home_url( '/' ) ); ?>' title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='home'><img src='<?php echo esc_url( get_theme_mod( 'sensible_logo' ) ); ?>' alt='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' ></a>
								</div>
							<?php endif; ?>
						</div>
							
						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<?php sensible_bootstrap_nav(); ?>
						</div>
					</div>
				</nav>		
				<div style="position:absolute; z-index:1001; right:0; margin-right:20px;margin-top:10px"><?php sensible_secondary_nav(); ?></div>
				<div class="social-icons" style="">
					<a href="http://twitter.com/Sensible_Foods" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/social-icons/sf-icon-twitter.png" alt ="Twitter" style="width:32px;" /></a>
					<a href="http://www.facebook.com/pages/Blend-LLC-dba-Sensible-Foods/1536550946619716?fref=ts" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/social-icons/sf-icon-facebook.png" alt ="Facebook" style="width:32px;" /></a>
					<a href="http://instagram.com/sensiblefoods/" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/social-icons/sf-icon-instagram.png" alt ="Instagram" style="width:32px;"/></a>
				</div>
				
				<?PHP if(is_front_page()):?>
				
					<div class="catapult-slideshow">
					
					
						<div style="z-index:10; position:absolute; width:100%;height:100%;" class="container">
							<div class="row table-row" style="height:100%;">
								<div class="col-md-1" style="min-height:70px;">&nbsp;</div>
								<div class="col-md-3" style="text-align:center; height:100%;vertical-align:middle; ">	
									<?php

										// check if the repeater field has rows of data
										$slideCounter = 0;
										if( have_rows('slideshowrepeater','option') ):
											while ( have_rows('slideshowrepeater','option') ) : the_row(); ?>	

									<div class="catapult-slideshow-text" <?PHP if ($slideCounter != 0) echo 'style="display:none;"'; ?> data-index="<?PHP echo $slideCounter; ?>">
										<h1 style="color:#FFFFFF;"><?PHP the_sub_field('slideshowtext'); ?></h1>
										<?PHP if(get_sub_field('slideshowbuttontext')!="" && get_sub_field('slideshowbuttonurl')): ?>
										<a href="<?PHP the_sub_field('slideshowbuttonurl'); ?>" <?PHP if (get_sub_field('slideshowbuttontarget') == 'New Page') echo "target='_blank'";?> ><?PHP the_sub_field('slideshowbuttontext'); ?></a>
										<?PHP endif; ?>
									</div>		
												<?php
											$slideCounter++;
											endwhile;
										endif;

									?>
								
								</div>
								<div class="col-md-8">&nbsp;
								</div>
							</div>
							
						</div>
						<div class="catapult-slideshow-wrapper">						
								<?php

								// check if the repeater field has rows of data
								$slideCounter = 0;
								if( have_rows('slideshowrepeater','option') ):
									while ( have_rows('slideshowrepeater','option') ) : the_row(); $slideCounter++;?>										
							<div class="catapult-slide">
								<img src="<?php echo get_sub_field('slideshowimage')['url']; //echo get_sub_field('slideshowimage')['sizes']['bootstrap-xl']; ?>" alt="" style="display:none;" >
							</div>
										<?php
									endwhile;
								endif;

								?>
						</div>	
						
						<div style="z-index:20; position:absolute; width:100%;margin-top:-40px;" class="container">
							<div class="row" style="">
								<div class="col-md-1">&nbsp;</div>
								<div class="col-md-3" style="text-align:center;">
									<div style="">
										<ol class="catapult-slideshow-indicators" style="padding:0">
											<?PHP $isFirst = true; for($i =0; $i<$slideCounter;$i++): ?><li class="<?PHP if ($isFirst) echo "active"; ?>" data-index="<?PHP echo $i; ?>"></li>
											<?PHP $isFirst = false; endfor; ?>
										
										</ol>
									</div>
								</div>
								<div class="col-md-8">&nbsp;</div>
							</div>
						</div>
								
									
					</div>	
					
					<script type="text/javascript">					
					
					jQuery(document).ready(function($) {
					
						
						$('.catapult-slide').first().clone().appendTo('.catapult-slideshow-wrapper');										
						var slides = $('.catapult-slide');		
						var orginalImageSize = 1500;
						var numberOfSlides = slides.length-1;
						/*var slideWidth = 1200;*/
						var slideWidth = $('.catapult-slideshow').width();
						if (slideWidth > orginalImageSize)
						{
							slideWidth = orginalImageSize;
							$('.catapult-slideshow-wrapper').width(slideWidth);
						}
						$('.catapult-slide').width(slideWidth);
						var currentPos = 0;
						var inTransition = false;
						var slideShowInterval;
						var speed = 5000;
						
						slideShowInterval = setInterval(NextSlide, speed);
										
						
						slides.wrapAll('<div id="catapultSlidesHolder"></div>');
						slides.css({ 'float' : 'left' });
						$('#catapultSlidesHolder').css('width', slideWidth * (numberOfSlides+1));
						$('.catapult-slide img').css('display', 'block');
						$('#catapultSlidesHolder').click(function(){ NextSlide(); });	
						
						$(window).resize(function(){	
							ResizeSlides();
						});
						
						$(window).bind('orientationchange', function (e) { 
							setTimeout(function () {
								ResizeSlides();
							}, 500);
						});
						
						function ResizeSlides()
						{
							slideWidth = $('.catapult-slideshow').width();
							if (slideWidth > orginalImageSize)
								slideWidth = orginalImageSize;
							$('.catapult-slideshow-wrapper').width(slideWidth);
							$.each(slides,function(index,value){  $(value).width(slideWidth); });
							
							$('#catapultSlidesHolder').css('width', slideWidth * (numberOfSlides+1));
							$('#catapultSlidesHolder').css('marginLeft', slideWidth*-currentPos);

						}
					
						function NextSlide()
						{						
							if (inTransition == false)
							{
								inTransition = true;
								$('.catapult-slideshow-indicators li.active').removeClass('active');
								$(".catapult-slideshow-text").fadeOut();
								//console.log(currentPos);
								$('#catapultSlidesHolder').animate({'marginLeft' : slideWidth*-(currentPos+1)},1000,function(){
									currentPos++;
									if (currentPos == numberOfSlides)
									{
										$('#catapultSlidesHolder').css({'marginLeft':0});
										currentPos = 0;
									}
									$(".catapult-slideshow-indicators li[data-index='"+currentPos+"']").addClass('active');
									$(".catapult-slideshow-text[data-index='"+currentPos+"']").fadeIn();
									inTransition = false;
								});
							}
						}
					
						function GotToSlide(index)
						{						
							if (inTransition == false)
							{
								if (index != currentPos)
								{
									inTransition = true;
									$('.catapult-slideshow-indicators li.active').removeClass('active');
									$(".catapult-slideshow-text").fadeOut();
									$('#catapultSlidesHolder').animate({'marginLeft' : slideWidth*-(index)},1000,function(){		
										currentPos=parseInt(index);						
										$(".catapult-slideshow-indicators li[data-index='"+index+"']").addClass('active');
										$(".catapult-slideshow-text[data-index='"+index+"']").fadeIn();
										inTransition = false;
									});
								}
							}
						}
						
						$('.catapult-slideshow-indicators li').click(function(){
							GotToSlide($(this).attr('data-index'));
						});
						
						
					});
					</script>
					
				<?PHP elseif (get_post_type() == 'product_description' && is_single()): ?>
				<div class="product-background">	
					<img src="<?php echo get_field('productbackgroundimage')['sizes']['bootstrap-xl']; ?>" alt="" >
				</div>
				<div class="centered-pills">
					<?PHP   $menu = get_field('productdescriptionsubmenu');
							if( !empty($menu) )						
							{
								wp_nav_menu(
								array(
									'menu'            => $menu->ID,
									'container'       => 'div',
									'container_class' => 'menu-{menu slug}-container', 
									'menu_class'      => 'menu', 
									'echo'            => true,
									'fallback_cb'     => 'wp_page_menu', 
									'items_wrap'      => '<ul class="nav nav-pills">%3$s</ul>',
									'depth'           => 0,
									)
								);
							}
							
					$image = get_field('productdescriptionimage');
					if( !empty($image) ): ?>		
							<div class="container-fluid hidden-sm hidden-xs" style="">
								<div class="row">
									<div class="col-md-6" style="text-align:right;">
										<div  style="text-align:center;">
											<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" style="margin-top:60px;" />
											<!--<br><br><br><br><a href="#" class="" style="background-color:<?php the_field('productdescriptionfontcolor'); ?>; border-radius: 2px; padding:15px 20px; color:#ffffff; font-size:22px;">BUY NOW</a>-->
										</div>
									</div>
								</div>
							</div>
					<?php endif; ?>			
				</div>
				<?PHP elseif(basename( get_page_template()) == 'template-large-header.php'): ?>
				<div class="product-background">	
					<img src="<?PHP echo get_field('pagebackgroundheader')['sizes']['bootstrap-xl']; ?>" alt="" >
				</div>				
				<?PHP else: ?>
				<div class="page-background">	
					<img src="<?PHP echo get_field('pagebackgroundheader')['sizes']['bootstrap-xl-header']; ?>" alt="" >
				</div>					
				<?PHP endif; ?>				
			</header>
			
				
			<?PHP if (is_front_page()):?>
			<div class="secondary-menu">
				<div class="container">
					<div class="row">
						<div class="col-md-4" style="text-align:center;margin: 5px 0;">
							<a href="http://sensiblefoods.danielvalenzuela.com.mx/shop/" target="_blank" class="icon-link" style="line-height: 60px;">
								<div class="icon-sprite" style="background-image:url(<?php echo get_template_directory_uri(); ?>/img/sf-icon-shop.png); vertical-align:middle; margin-right:15px;"></div>
								SHOP ONLINE
							</a>
						</div>
						<div class="col-md-4" style="text-align:center;margin: 5px 0;">
							<a href="http://sensiblefoods.danielvalenzuela.com.mx/recipes/" class="icon-link"  style="line-height: 60px;">
								<div class="icon-sprite" style="background-image:url(<?php echo get_template_directory_uri(); ?>/img/sf-icon-recipes.png); vertical-align:middle; margin-right:15px;"></div>
								Recipes
							</a>
						</div>
						<div class="col-md-4" style="text-align:center;margin: 5px 0;">
							<a href="http://sensiblefoods.danielvalenzuela.com.mx/contact/" class="icon-link"  style="line-height: 60px;">
								<div class="icon-sprite" style="background-image:url(<?php echo get_template_directory_uri(); ?>/img/sf-icon-newsletter.png); vertical-align:middle; margin-right:15px;"></div>
								Testimonials
							</a>
						</div>
					</div>
				</div>
			</div>
			<?PHP endif;?>
			
			<!-- /header -->
