<?php /* Template Name: Recipe Archive Template */ get_header(); ?>
	<!--single-recipe.php-->
	<main role="main">
		<!-- section -->
		<section>
			<div class="container-fluid" >
				<div class="row" style="padding:0;    color: #006f43; font-size: 1.5rem;">
					<div class="col-md-12" style="padding:0;">
	
						<h1 class="main-title" style="margin-left: 50px;"><?php the_title(); ?></h1>
						<div class="div-spacer">&nbsp;</div>
						
						<div class="container">
							<div class="row" style="padding: 25px 20px;">
								<div class="col-md-3">
									<ul>
								<?php
									$customPostTaxonomies = get_object_taxonomies('recipe');

									if(count($customPostTaxonomies) > 0)
									{
										foreach($customPostTaxonomies as $tax)
										{
											$args = array(
												'orderby' => 'name',
												'show_count' => 0,
												'pad_counts' => 0,
												'hierarchical' => 1,
												'taxonomy' => $tax,
												'title_li' => ''
												);
									
											wp_list_categories( $args );
										}
									}
																	
								
									/*$args = array(
										'show_option_all'    => '',
										'orderby'            => 'name',
										'order'              => 'ASC',
										'style'              => 'list',
										'show_count'         => 0,
										'hide_empty'         => 1,
										'use_desc_for_title' => 1,
										'child_of'           => 0,
										'feed'               => '',
										'feed_type'          => '',
										'feed_image'         => '',
										'exclude'            => '',
										'exclude_tree'       => '',
										'include'            => '',
										'hierarchical'       => 1,
										'title_li'           => __( 'Categories' ),
										'show_option_none'   => __( '' ),
										'number'             => null,
										'echo'               => 1,
										'depth'              => 0,
										'current_category'   => 0,
										'pad_counts'         => 0,
										'taxonomy'           => 'category',
										'walker'             => null
										);
										wp_list_categories( $args ); */
								?>
									</ul>
								</div>
								<div class="col-md-9">
													
								<?php if (have_posts()): while (have_posts()) : the_post(); ?>
								
								<?php $my_query = new WP_Query('post_type=recipe&nopaging=1'); 
									  if($my_query->have_posts()): while($my_query->have_posts()): $my_query->the_post(); ?>
									  
									  
									  
										<div class="media">
											<?php if ( has_post_thumbnail()) : // Check if thumbnail exists ?>
											<div class="media-left" style="width:220px;">
												<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
													<?php the_post_thumbnail(array(200,200),array( 'class' => 'media-object pull-left') ); // Declare pixel size you need inside the array ?>
												</a>
											</div>
											<?php endif; ?>
											<div class="media-body" style="width:auto" >
												<h2 class="media-heading sub-title" >
													<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
												</h2>											
												<?php html5wp_excerpt('html5wp_index'); // Build your custom callback length in functions.php ?>
										
												<?php edit_post_link(); ?>
											</div>
										</div>							
															
								<?php wp_reset_postdata(); endwhile;  ?>								
								<?php else: ?>
						
									<!-- article -->
									<article>
						
										<h2><?php _e( 'Sorry, nothing to display.', 'sensible' ); ?></h2>
						
									</article>
									<!-- /article -->
						
								<?php endif; ?>
								
								
								<?php endwhile; ?>
								
								<?php else: ?>
								
									<!-- article -->
									<article>
										<h2><?php _e( 'Sorry, nothing to display.', 'sensible' ); ?></h2>
									</article>
									<!-- /article -->
								
								<?php endif; ?>
								
								</div> <!---End Col-->
							</div> <!---End Row-->
						</div><!---End containter -->
						
					</div>
				</div>
			</div>

		</section>
		<!-- /section -->
	</main>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
