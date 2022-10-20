<?php
/**
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/
*
* @package Aste
*/

get_header();
?>


<div id="primary" class="content-area">

  <?php get_template_part( 'template-parts/', 'content') ?>


  <?php the_content(); ?>


  <?php get_template_part( 'template-parts/blocks', 'hero' ); ?>



  <?php 

  $args = array(
    'posts_per_page' => 6,
    'post_type' => 'tapahtumat',
    'post_status' => 'publish',
    'meta_query' => array(
      array(
        'key' => 'tapahtuma_pvm',
        'compare' => '>=',
        'type' => 'DATE',
      )
    ),
    'meta_key' => 'tapahtuma_pvm',
    'orderby' => 'meta_value',
    'order' => 'ASC',
  );

  $query = new WP_Query($args);

  if ($query->have_posts()) : 


    ?> 
    <section class="section events">
      <div class="container">
        <h2 class="section-title"><?php pll_e('Tapahtumat') ?></h2>

        <?php while ($query->have_posts()) : 
          $query->the_post(); 
          $date = get_field('tapahtuma_pvm');
          $time = get_field('tapahtuma_alkaa');
          $link = get_field('tapahtuman_linkki');
          ?>
          <div class="columns">

            <div class="column is-2">
              <?php if (!empty($date)): ?>
                <?= $date ?>
              <?php endif ?>
            </div>
            <div class="column is-4">
              <figure class="image">
                <img class="is-rounded" src="<?= get_the_post_thumbnail_url( $post->ID, 'large' ); ?>" alt="">
              </figure>
            </div>
            <div class="column is-6">
              <h3><a href="<?= $link; ?>"><?php the_title(); ?></a></h3>
              <p>
                <?= get_field('ingressi'); ?>
              </p>
              <a href="<?= $link; ?>" class="hds-icon hds-icon--size-l hds-icon--arrow-right"></a>
            </div>
          </div>
        <?php endwhile; wp_reset_postdata(); wp_reset_query(); ?>
      </div>
    </section>
  <?php endif; ?>

  <?php

  $lang = pll_current_language();

  if ($lang == 'fi') {
    $cat = 'uutiset';
  } elseif($lang == 'en') {
    $cat = 'news';
  } else {
    $cat = 'nyheter';
  }

  $args = array(
    'posts_per_page' => 6,
    'category_name' => $cat,
    'post_status' => 'publish',
  );

  $query = new WP_Query($args);

  if ($query->have_posts()) :  ?> 

    <section class="section topical">
      <div class="container">
        <h2 class="section-title"><?php pll_e('Ajankohtaista') ?></h2>
        <div class="columns is-multiline">

          <?php while ($query->have_posts()) : 
            $query->the_post(); 

            if (get_field('rss_url')) {
              $link = get_field('rss_url');
            } else {
              $link = get_the_permalink($post->ID);
            }

            ?>

            <a href="<?= $link; ?>" class="column is-6">
              <h4 class="title is-4"><?php the_title(); ?></h4>
              <span><?= get_the_date('d.m.Y'); ?></span>
            </a>

          <?php endwhile;  wp_reset_postdata(); wp_reset_query();

          if ($lang == 'fi') {
            $link = '/ajankohtaista/#uutiset';
          } elseif($lang == 'en') {
            $link = '/en/whats-on/#uutiset';
          } else {
            $link = '/sv/aktuellt/#uutiset';
          }
          ?>

          <a class="news-link title is-bold is-5" href="<?= $link; ?>">
            <?php pll_e('Kaikki uutiset') ?>
            <div class="hds-icon hds-icon--size-l hds-icon--arrow-right"></div>
          </a>

        </div>
      </div>
    </section>

  <?php endif;

  get_footer();
