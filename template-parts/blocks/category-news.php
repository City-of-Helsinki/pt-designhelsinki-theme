 <?php

/**
 * Category Newas Template.
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
$title = get_field('title');
$image = get_field('image');
$link = get_field('link');
$amount = get_field('amount') ? get_field('amount') : 3;
$button_text = get_field('button_text') ? : 'Lue lisää';

$cat = get_field('select_category');

$args = array(
  'posts_per_page' => $amount,
);

if ($cat) {
 $args['cat'] = $cat;
}


$query = new WP_Query($args);

if ($query->have_posts()) :
  global $post;
  ?> 
  <section id="uutiset" class="section latest zoom" data-category="<?php $cat; ?>" data-amount="<?php echo $amount; ?>">
    <div class="container">
      <h2 class="section-title"><?= $title ?></h2>
      <div class="columns is-multiline">
        <?php while ($query->have_posts()) : 
          $query->the_post(); 
          $ingressi = get_field('ingressi', $post->ID);
          $image_id = get_post_thumbnail_id(get_the_ID());
          $alt_text = get_field('rss_img_alt', $post->ID);

          if (get_field('rss_url', $post->ID)) {
            $link = get_field('rss_url', $post->ID);
          } else {
            $link = get_the_permalink($post->ID);
          }

          ?>

          <a href="<?= $link ?>" class="column is-4 is-12-mobile">
            <div class="element">
            <figure class="image is-3by2">
              <?php if (has_post_thumbnail()) : ?>
                <img class="is-square" src="<?= get_the_post_thumbnail_url( $post->ID, 'large' ); ?>" alt="">
              <?php else : ?>
                <img class="is-square" src="<?php echo get_stylesheet_directory_uri(); ?>/images/helsinki-fi.svg" alt="Helsinki logo">
              <?php endif; ?>
              </figure>
              <div class="text-content">
                <p class="date"><?= get_the_date('d.m.Y'); ?></p>
                <h3 class="title is-4 is-medium"><?php the_title(); ?></h3>
                <p class="excerpt"><?= $ingressi; ?></p>
              </div>
              <div class="hds-icon hds-icon--size-l hds-icon--arrow-right"></div>
            </div>
          </a>

        <?php endwhile; wp_reset_postdata(); ?> 
      </div>

      <?php if(is_page("ajankohtaista") || (is_page("aktuellt") || (is_page("whats-on") ))): ?>
      <button class="load-more button"><?php pll_e('Lataa lisää'); ?></button>
    <?php endif; ?>

  </div>
</section>
<?php endif; ?>



