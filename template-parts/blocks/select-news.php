 <?php

/**
 * Select News Template.
*/

// Create id attribute allowing for custom "anchor" value.
$id = 'news-' . $block['id'];
if( !empty($block['anchor']) ) {
  $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'news';
if( !empty($block['className']) ) {
  $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
  $className .= ' align' . $block['align'];
}

// Load values and assign defaults.
$text = get_field('text');
$image = get_field('image');
$link = get_field('link');
$button_text = get_field('button_text') ? : pll__('Lue lisää');


$news = get_field('select_news', false, false);

$args = array(
  'post__in' => $news,
);

$query = new WP_Query($args);

if ($query->have_posts()) : ?> 

  <section class="section latest zoom">
    <div class="container">
      <h2 class="section-title"><?= get_field('title'); ?></h2>
      <div class="columns is-flex is-multiline">
        <?php while ($query->have_posts()) : 
          $query->the_post(); 
          $ingressi = get_field('ingressi');
          $image_id = get_post_thumbnail_id(get_the_ID());
          $alt_text = get_post_meta($image_id , '_wp_attachment_image_alt', true);
          ?>

          <a href="<?php the_permalink(); ?>" class="column is-4 is-12-mobile">
            <div class="element">
              <figure class="image is-3by2">
                <img class="is-square" src="<?= get_the_post_thumbnail_url( $post->ID, 'large' ); ?>" alt="<?= $alt_text; ?>">
              </figure>
              <div class="text-content">
                <h3 class="title is-4 is-medium"><?php the_title(); ?></h3>
                <p class="excerpt"><?= $ingressi; ?></p>
              </div>
              <div class="hds-icon hds-icon--size-l hds-icon--arrow-right"></div>
            </div>
          </a>

        <?php endwhile; wp_reset_postdata(); ?> 
      </div>
    </div>
  </section>
<?php endif; ?>



