<?php
/**
 * Template Name: Yhteystiedot
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bulmascores
 */

get_header(); ?>

<div id="primary" class="mt-2 mb-2">

	<div class="container">
		<?php
		if ( function_exists('yoast_breadcrumb') ) {
			yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
		}
		?>
	</div>
	
	<div class="columns">
		<div class="column">
			<main id="main" class="site-main mb-2">

				<?php
				while ( have_posts() ) : the_post();
					get_template_part( 'template-parts/content', 'page' );
				endwhile; 
				?>


			</main><!-- #main -->


		</div>
	</div>
</div><!-- #primary -->




<?php
get_footer();
