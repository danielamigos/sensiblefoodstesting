<?php get_header(); ?>
<!--page.php-->
	<main role="main">
		<!-- section -->
		<section>
		<div class="container-fluid" >
			<div class="row" style="padding:0;">
				<div class="col-md-12" style="padding:0;">

			<h1 class="main-title" style="margin-left: 50px;"><?php if ('wpsc-product' == get_post_type() && !is_single()){
                echo wpsc_category_name();  
            } else {  the_title();  
} ?></h1>
			<div class="div-spacer">&nbsp;</div>

		<?php if (have_posts()): while (have_posts()) : the_post(); ?>

			<!-- article -->
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<?php the_content(); ?>

				<?php comments_template( '', true ); // Remove if you don't want comments ?>

				<br class="clear">

				<?php edit_post_link(); ?>

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
