<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bulmascores
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="card-content">



		<header class="entry-header">
			<?php
			if ( is_singular() ) :
				the_title( '<h1 class="main-title is-1">', '</h1>' );
			else :
				the_title( '<h2 class="main-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif;
			?>


			<div class="ote">
				<?php 
				if (get_field('ingressi')) {
					echo get_field('ingressi');
				}
				?>
			</div>


			<div class="main-image">
				<img src="<?= get_the_post_thumbnail_url( $post->ID, 'large' ) ?>" alt="">
				<?php if (get_post(get_post_thumbnail_id())->post_excerpt) {?>
					<div class="featured-image-caption">
						<?php echo wp_kses_post(get_post(get_post_thumbnail_id())->post_excerpt); ?>
					</div>
				<?php } ?>
			</div>

		</header><!-- .entry-header -->


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

			<?php 			
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				if (in_category('Vieraskynä')) {
					comments_template();
				}
			endif;
			?>

			<div class="social-media">
				<a href="http://www.facebook.com/sharer.php?u=<?= rawurlencode( get_the_permalink() ); ?>&t=<?= rawurlencode( get_the_title() ); ?>"><div class="hds-icon hds-icon--size-m hds-icon--facebook"></div></a>
				<a href="<?php echo esc_url('https://www.twitter.com/share?url=' . get_the_permalink() . '&text=' . get_the_title()); ?>"><div class="hds-icon hds-icon--size-m hds-icon--twitter"></div></a>
				<a href="<?php echo esc_url('https://www.linkedin.com/shareArticle?mini=true&url=' . get_the_permalink() . '&title=' . get_the_title()); ?>"><div class="hds-icon hds-icon--size-m hds-icon--linkedin"></div></a>
			</div>

		</div><!-- .entry-content -->

	</div>

</article><!-- #post-<?php the_ID(); ?> -->


