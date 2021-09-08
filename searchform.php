<?php
/**
 * The template for displaying search forms in Underscores.me
 *
 * @package bulmascores
 */

?>

<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
    <div class="hds-search-input">
        <label for="s" class="hds-search-input__label hidden"><?php pll_e('Hae') ?></label>
        <div class="hds-search-input__input-wrapper">
            <input
            id="s"
            class="hds-search-input__input"
            type="text"
            name="s"
            placeholder="<?php pll_e('Haku') ?>"
            />
            <div class="hds-search-input__buttons">
              <button
              type="button"
              aria-label="Search"
              class="hds-search-input__button"
              >
              <input type="submit" class="hds-icon hds-icon--search hds-icon--size-s" aria-hidden="true"></input>
          </div>
      </div>
  </div>
</form>