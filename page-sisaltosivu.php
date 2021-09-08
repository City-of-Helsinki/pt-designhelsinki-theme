<?php
/**
 * Template Name: Sisältösivu
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

				<div class="container">
					<section class="section">
						<header class="entry-header">
							<?php the_title( '<h1 class="section-title is-1">', '</h1>' ); ?>
							<div class="ote">
								<?php 
								if (get_field('ingressi')) {
									echo get_field('ingressi');
								}
								?>
							</div>
						</header><!-- .entry-header -->
					</section>
				</div>

				<section class="hero alignfull wave-bottom bc-valkoinen" style="background-image:url('<?= get_the_post_thumbnail_url( $post->ID, 'hero-image' ) ?>'); height: 400px;">
				</section>


				<div class="entry-content mb-2">
					<?php
					the_content( sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'bulmascores' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						get_the_title()
					) );

					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'bulmascores' ),
						'after'  => '</div>',
					) );
					?>
					<div class="social-media">
						<a href="/#"><div class="hds-icon hds-icon--size-m hds-icon--facebook"></div></a>
						<a href="/#"><div class="hds-icon hds-icon--size-m hds-icon--twitter"></div></a>
						<a href="/#"><div class="hds-icon hds-icon--size-m hds-icon--linkedin"></div></a>
					</div>
				</div><!-- .entry-content -->

			</main><!-- #main -->


		</div>
	</div>
</div><!-- #primary -->




<?php
get_footer();
