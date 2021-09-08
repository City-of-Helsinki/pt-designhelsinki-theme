 <?php

/**
 * Editor Card Template.
*/

$className = 'editor-card';
if( !empty($block['className']) ) {
  $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
  $className .= ' align' . $block['align'];
}

$content = get_field('content');
?>


<section class="section <?php echo esc_attr($className); ?>">
  <div class="content">
    <?= $content; ?>
  </div>
</section>




