<?php get_header(); ?>
<!--front-page.php-->

	<div class="div-spacer">&nbsp;</div>
	<main role="main">
		<!-- section -->
		<section>
			<div class="container table-container">
				<div class="row table-row green-background">	
					<div class="col-md-4 front-page-left-column">
						<?PHP
							$frontpage_column_1_title = get_field('frontpage_column_1_title','option');
							$frontpage_column_1_content = get_field('frontpage_column_1_content','option');
							$frontpage_column_1_button = get_field('frontpage_column_1_button_text','option');
							$frontpage_column_1_url = get_field('frontpage_column_1_button_url','option');
						?>
						<h2><?PHP echo $frontpage_column_1_title;?></h2>
						<?PHP echo $frontpage_column_1_content; ?>
						<?PHP if($frontpage_column_1_button != "" && $frontpage_column_1_url != ""): ?>
							<a class="btn btn-danger frontpage-column-button" href="<?PHP echo $frontpage_column_1_url; ?>"><?PHP echo $frontpage_column_1_button; ?></a>
						<?PHP endif; ?>
					</div>
					<div class="col-md-4 front-page-left-column">
						
						<?PHP
							$frontpage_column_2_title = get_field('frontpage_column_2_title','option');
							$frontpage_column_2_content = get_field('frontpage_column_2_content','option');
							$frontpage_column_2_button = get_field('frontpage_column_2_button_text','option');
							$frontpage_column_2_url = get_field('frontpage_column_2_button_url','option');
						?>
						<h2><?PHP echo $frontpage_column_2_title;?></h2>
						<?PHP echo $frontpage_column_2_content; ?>
						<?PHP if($frontpage_column_2_button != "" && $frontpage_column_2_url != ""): ?>
							<a class="btn btn-danger frontpage-column-button" href="<?PHP echo $frontpage_column_2_url; ?>"><?PHP echo $frontpage_column_2_button; ?></a>
						<?PHP endif; ?>
					</div>
					<div class="col-md-4 front-page-right-column">
						<?PHP
							$frontpage_column_3_title = get_field('frontpage_column_3_title','option');
							$frontpage_column_3_content = get_field('frontpage_column_3_content','option');
							$frontpage_column_3_button = get_field('frontpage_column_3_button_text','option');
							$frontpage_column_3_url = get_field('frontpage_column_3_button_url','option');
						?>
						<h2><?PHP echo $frontpage_column_3_title;?></h2>
						<?PHP echo $frontpage_column_3_content; ?>
						<?PHP if($frontpage_column_3_button != "" && $frontpage_column_3_url != ""): ?>
							<a class="btn btn-danger frontpage-column-button" href="<?PHP echo $frontpage_column_3_url; ?>"><?PHP echo $frontpage_column_3_button; ?></a>
						<?PHP endif; ?>
					</div>
				</div>
				
				
			</div>
		</section>
		<!-- /section -->
	</main>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
