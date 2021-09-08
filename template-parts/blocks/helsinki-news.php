  <?php

  /**
  * Helsinki API News Block
  */

  $post_amount = get_field('post_amount') ? get_field('post_amount')  : 6;

  // Load values and assign defaults.
  $title = get_field('title');

  $args = array(
    'posts_per_page' => $post_amount,
    'category_name' => 'palvelumuotoilu-ja-design',
  );

  if ($cat) {
   $args['cat'] = $cat;
 }


 $query = new WP_Query($args);

 if ($query->have_posts()) :
  global $post;
  ?> 
  <section id="uutiset" class="section latest zoom">
    <div class="container">
      <h2 class="section-title"><?= $title ?></h2>
      <div class="columns is-multiline">
        <?php while ($query->have_posts()) : 
          $query->the_post(); 
          $ingressi = get_field('ingressi', $post->ID);
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