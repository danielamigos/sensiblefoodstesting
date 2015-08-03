<?php get_header(); ?>
<!--front-page.php-->

	<div class="div-spacer">&nbsp;</div>
	<main role="main">
		<!-- section -->
		<section>
			<div class="container table-container">
				<div class="row table-row">	
					<div class="col-md-6 front-page-left-column">
						At Sensible Foods, we bring you <br>100% real fruit and vegetable snacks that deliver perfectly delicious, crunch dried taste from nature.
					</div>
					<div class="col-md-6 front-page-right-column" style="padding:0;">
						<?php //get_template_part('loop'); ?>
						
						<?php if (have_posts()): if (have_posts()) : the_post(); ?>

							<!--<h1 class="front-page-title">Latest News | <?php the_time('m.j'); ?></h1>
							<div class="green-dots">&nbsp;</div>-->
							<!-- article -->
							<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

								<h1 class="front-page-title"><?php the_title(); ?></h1>
								<!-- post title
								<h2>
									<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
								</h2>
								<!-- /post title -->

								<!-- post details -->
								<?php the_content(); // Build your custom callback length in functions.php ?>
								<!-- /post details -->
								

								<?php edit_post_link(); ?>

							</article>
							<!-- /article -->

						<?php endif; ?>

						<?php else: ?>

							<!-- article -->
							<article>
								<h2>No news is good news</h2>
							</article>
							<!-- /article -->

						<?php endif; ?>

						<?php get_template_part('pagination'); ?>
					</div>
				</div>
			</div>
		</section>
		<!-- /section -->
	</main>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
