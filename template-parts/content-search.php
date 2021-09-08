<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bulmascores
 */

?>

<div class="column is-3 is-12-mobile">
	<a href="<?php the_permalink(); ?>">
		<figure class="image is-3by2">
			<img class="is-square" src="<?= get_the_post_thumbnail_url( $post->ID, 'large' ); ?>" alt="">
		</figure>
		<div class="text-content">
			<h3 class="title is-4 is-medium"><?php the_title(); ?></h3>
			<div class="hds-icon hds-icon--size-l hds-icon--arrow-right"></div>
		</div>
	</a>
</div>

