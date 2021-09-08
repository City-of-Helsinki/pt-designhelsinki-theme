 <?php

/**
 * Hero Block Template.
*/

// Create id attribute allowing for custom "anchor" value.
$id = 'hero-' . $block['id'];
if( !empty($block['anchor']) ) {
  $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'hero';
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

?>


<section class="<?php echo esc_attr($className); ?> wave-top bc-valkoinen" style="background-image: url('<?= $image ?>')">
  <div class="container">
    <div class="hero-box desktop-only">
      <?= $text; ?>
      <a href="<?= $link ?>" class="button"><?= $button_text ?></a>
    </div>
  </div>
</div>
</section>
<section class="section mobile-hero mobile-only">
  <div class="container hero-box">
    <?= $text; ?>
    <a href="<?= $link ?>" class="button"><?= $button_text ?></a>
  </div>
</section>



