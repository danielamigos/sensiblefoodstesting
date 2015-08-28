<?php get_header(); ?>
<!--page.php-->
	<main role="main">
		<!-- section -->
		<section>
			<div class="container-fluid" style="min-height:500px;">
				<div class="row">
					<div class="col-md-6">
						<?PHP $image = get_field('productdescriptionimage');
							if( !empty($image) ): ?>
						<div class="hidden-xl hidden-lg hidden-md" style="text-align:center;">
							<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" style="margin-top:60px;" />
							<!--<br><br><br><br><a href="#" class="" style="background-color:<?php the_field('productdescriptionfontcolor'); ?>; border-radius: 2px; padding:15px 20px; color:#ffffff; font-size:22px;">BUY NOW</a>-->
						</div>
						<?PHP endif; ?>
					</div>
					<div class="col-md-6">
			<h2 style="font-family:flyerfontsregular;color:#006E42;"><?php the_field('productdescriptiontype'); ?></h2>
			<div class="green-dots" style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/sf-dashed-line-green.png); background-repeat:repeat-x;">&nbsp;</div>
			<h1 class="main-title" style="font-family:flyerfontsregular;color:<?php the_field('productdescriptionfontcolor'); ?>; margin-top:0;"><?php the_title(); ?></h1>

		<?php if (have_posts()): while (have_posts()) : the_post(); ?>

			<!-- article -->
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<?php the_content(); ?>

				<br class="clear">

			</article>
			<!-- /article -->

		<?php endwhile; ?>

		<?php else: ?>

			<!-- article -->
			<article>

				<h2><?php _e( 'Sorry, nothing to display.', 'sensible' ); ?></h2>

			</article>
			<!-- /article -->

		<?php endif; ?>
					</div>
				</div>
			</div>
		</section>
		<!-- /section -->
	</main>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
