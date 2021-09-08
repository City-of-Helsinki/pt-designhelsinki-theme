 <?php

/**
 * Hero Block Template.
*/


?>

<?php 

$rows = get_field('images');
if( $rows ) : ?>

  <section class="alignwide">
   <div id="sync1" class="owl-carousel owl-theme">

     <?php foreach( $rows as $row ) :
      $image = $row['image']; 
      ?>

      <div class="item">
        <img src="<?= $image['sizes']['large']?>" alt="-">
      </div>


    <?php endforeach; ?>
  </div>

  <div id="sync2" class="owl-carousel owl-theme">
   <?php foreach( $rows as $row ) :
    $image = $row['image']; ?>
    <div class="item">
      <img src="<?= $image['sizes']['medium']?>" alt="-">
    </div>

  <?php endforeach; ?>
</div>
</section>

<?php endif; ?>





