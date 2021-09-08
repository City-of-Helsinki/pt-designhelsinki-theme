<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Bulmascores
 */

get_header(); ?>



<div id="primary" class="container mt-2 mb-2">
	
	<div class="container">
		<?php
		if ( function_exists('yoast_breadcrumb') ) {
			yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
		}
		?>
	</div>

	<div class="columns is-desktop">

		<div class="column">
			<main id="main" class="site-main mb-2">

				<?php
				while ( have_posts() ) : the_post();
					get_template_part( 'template-parts/content', get_post_type() );
				endwhile; 
				?>

			</main><!-- #main -->

			<div>



			</div>


		</div>
	</div>



</div><!-- #primary -->




<?php 
// Show yellow info-box if filled
if (have_rows('tiesitko_jo')): ?>
	<section class="section info-box yellow">
		<div class="container">
			<h2 class="title is-1" style="text-align: center;">
				<?= get_field('otsikko'); ?>
			</h2>
			<div class="columns">
				<?php
				while( have_rows('tiesitko_jo') ) : the_row(); ?>
					<div class="column">
						<div class="info-number"><?= get_sub_field('luku'); ?></div>
						<p><?= get_sub_field('teksti'); ?></p>
					</div>

				<?php	endwhile;
				?>
			</div>
		</section>
	<?php endif ?>


	<?php 
	$tags = get_tags(array(
		'hide_empty' => false
	));

	// show article tags if not empty
	if ($tags): ?>
		<section class="section grey">
			<div class="container">
				<h2 class="title is-3"><?php pll_e('Asiasanat') ?></h2>
				<div class="columns tags">
					<?php 	
					foreach ($tags as $tag) {
						echo '<div class="tag column">' . $tag->name . '</div>';
					} ?>
				</div>
			</div>
		</section>
	<?php endif ?>



	<?php 

	if( have_rows('sinua_voisi_kiinnostaa') ): ?> 
		<section class="section related">
			<div class="container">
				<h2 class="section-title is-2"><?php pll_e('Sinua voisi kiinnostaa') ?></h2>
				<div class="columns is-multiline">
					<?php while( have_rows('sinua_voisi_kiinnostaa') ) : the_row();

						$title = get_sub_field('otsikko');
						$link = get_sub_field('linkki'); 

						$target = get_sub_field() ? "_blank" : ""; 
						?>
						<div class="column is-6 is-12-mobile">
							<h4 class="related-title is-medium"><a target="<?= $target  ?>" href="<?= $link ?>"><?= $title ?></a></h4>
							<div class="hds-icon hds-icon--size-l hds-icon--arrow-right"></div>
						</div>

					<?php endwhile; ?>
				</div>	
			</div>
		</section>
	<?php endif; ?>


	<?php
	get_footer();
