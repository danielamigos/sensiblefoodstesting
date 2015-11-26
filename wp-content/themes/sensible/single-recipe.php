<?php get_header(); ?>
	<!--single-recipe.php-->
	<main role="main">
		<!-- section -->
		<section>
			<div class="container-fluid" >
				<div class="row" style="padding:0;    color: #006f43; font-size: 1.5rem;">
					<div class="col-md-12" style="padding:0;">
	
						<h1 class="main-title" style="margin-left: 50px;"><?php the_title(); ?></h1>
						<div class="div-spacer">&nbsp;</div>
			
					<?php if (have_posts()): while (have_posts()) : the_post();  if(has_post_thumbnail()): ?>
			
						
						<div class="container">
							<div class="row" style="padding: 25px 20px;">
								<div class="col-md-6">						
									<?PHP the_post_thumbnail('full'); ?>
								</div>
								<div class="col-md-6">
									<?php the_content(); ?>
									<br/>
									<br/>
									<?php edit_post_link(); ?>
								</div>
							</div>
						</div>
						
			
					<?php else: ?>
					
						<div class="container">
							<div class="row" style="padding: 25px 20px;">
								<div class="col-md-12">
									<?php the_content(); ?>
									<br/>
									<br/>
									<?php edit_post_link(); ?>
								</div>
							</div>
						</div>
						
					<?php endif; endwhile; ?>
			
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
