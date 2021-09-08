 <?php

/**
 * Editor Card Template.
*/

$className = 'contact';
if( !empty($block['className']) ) {
  $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
  $className .= ' align' . $block['align'];
}

$title = get_field('contact_title');
?>





<?php 
if( have_rows('contacts') ): ?>
  <section class="section contact">
    <div class="container">
      <h2 class="section-title"><?= $title ?></h2>
      <div class="columns is-multiline">
        <?php while( have_rows('contacts') ) : the_row(); ?>
          <?php 
          $etunimi = get_sub_field('etunimi');
          $sukunimi = get_sub_field('sukunimi');
          $titteli = get_sub_field('titteli');
          $puhnro = get_sub_field('puhnro');
          ?>

          <div class="column is-3 is-12-mobile content">
            <h4><?= $etunimi ?><br/><?= $sukunimi ?></h4>
            <p><?= $titteli ?></p>
            <p><?= $etunimi.'.'.$sukunimi.'(at)hel.fi'; ?></p>
            <p><?= $puhnro; ?></p>
          </div>

        <?php endwhile; ?>
      </div>
    </div>
  </section>
<?php endif; ?>


