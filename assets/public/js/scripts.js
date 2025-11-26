"use strict";

($ => {
  $(document).ready(function () {
    $('#uutiset button.load-more').click(function () {
      var button = $(this);
      var uutisetItemsVisible = $('#uutiset div.columns a').length;
      var posts_per_page = $('#uutiset').data("amount");
      var currentCat = $('#uutiset').attr('data-category');
      $.ajax({
        url: DesignHelsinkiAjax.ajax_url,
        data: {
          action: "loadmore",
          "uutisetItemsVisible": uutisetItemsVisible,
          "catName": currentCat,
          "amount": posts_per_page
        },
        type: 'POST',
        dataType: "html",
        beforeSend: function (xhr) {
          button.text('Ladataan...');
        },
        success: function (data) {
          if (data && data != 0) {
            $("#uutiset div.columns").append(data);
            if ($('#uutiset div.columns a').length = 0) {
              button.remove();
            } else {
              button.text('Lataa lisää');
            }
          } else {
            button.remove();
          }
        }
      });
    });
  });
})(jQuery);
($ => {
  $(document).ready(function () {
    $(".menu-toggle").click(function () {
      $(this).next().toggleClass("open");
      $(this).toggleClass("open");
      $(this).children().toggleClass("hds-icon--angle-up");
      $(this).attr("aria-expanded", function (i, attr) {
        return attr == "true" ? "false" : "true";
      });
    });
  });
})(jQuery);
(() => {
  initMobileToggle(document.getElementById('mobile-menu-panel-toggle'));
  function initMobileToggle(menuToggle) {
    if (!menuToggle) {
      return;
    }
    const menuPanel = document.getElementById(menuToggle.getAttribute('aria-controls'));
    if (!menuPanel) {
      return;
    }
    const isToggleExpanded = () => 'true' === menuToggle.getAttribute('aria-expanded');
    const setToggleExpanded = expanded => menuToggle.setAttribute('aria-expanded', expanded ? 'true' : 'false');
    const setPanelOpen = open => open ? menuPanel.classList.add('open') : menuPanel.classList.remove('open');
    const offClickHandler = event => {
      if (menuToggle !== event.target && !menuPanel.contains(event.target)) {
        mobileMenuOpen(false);
      }
    };
    const mobileMenuOpen = open => {
      setPanelOpen(open);
      setToggleExpanded(open);
    };
    menuToggle.addEventListener('click', event => {
      if (isToggleExpanded()) {
        mobileMenuOpen(false);
        document.body.removeEventListener('click', offClickHandler);
      } else {
        mobileMenuOpen(true);
        document.body.addEventListener('click', offClickHandler);
      }
    });
  }
})();

/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
(function () {
  var container, button, menu, links, i, len;
  container = document.getElementById('navigation');
  if (!container) {
    return;
  }
  button = container.getElementsByTagName('button')[0];
  if ('undefined' === typeof button) {
    return;
  }
  menu = container.getElementsByTagName('ul')[0];

  // Hide menu toggle button if menu is empty and return early.
  if ('undefined' === typeof menu) {
    button.style.display = 'none';
    return;
  }
  menu.setAttribute('aria-expanded', 'false');
  if (-1 === menu.className.indexOf('nav-menu')) {
    menu.className += ' nav-menu';
  }
  button.onclick = function () {
    if (-1 !== container.className.indexOf('toggled')) {
      container.className = container.className.replace(' toggled', '');
      button.setAttribute('aria-expanded', 'false');
      menu.setAttribute('aria-expanded', 'false');
    } else {
      container.className += ' toggled';
      button.setAttribute('aria-expanded', 'true');
      menu.setAttribute('aria-expanded', 'true');
    }
  };

  // Get all the link elements within the menu.
  links = menu.getElementsByTagName('a');

  // Each time a menu link is focused or blurred, toggle focus.
  for (i = 0, len = links.length; i < len; i++) {
    links[i].addEventListener('focus', toggleFocus, true);
    links[i].addEventListener('blur', toggleFocus, true);
  }

  /**
   * Sets or removes .focus class on an element.
   */
  function toggleFocus() {
    var self = this;

    // Move up through the ancestors of the current link until we hit .nav-menu.
    while (-1 === self.className.indexOf('nav-menu')) {
      // On li elements toggle the class .focus.
      if ('li' === self.tagName.toLowerCase()) {
        if (-1 !== self.className.indexOf('focus')) {
          self.className = self.className.replace(' focus', '');
        } else {
          self.className += ' focus';
        }
      }
      self = self.parentElement;
    }
  }

  /**
   * Toggles `focus` class to allow submenu access on tablets.
   */
  (function (container) {
    var touchStartFn,
      i,
      parentLink = container.querySelectorAll('.menu-item-has-children > a, .page_item_has_children > a');
    if ('ontouchstart' in window) {
      touchStartFn = function (e) {
        var menuItem = this.parentNode,
          i;
        if (!menuItem.classList.contains('focus')) {
          e.preventDefault();
          for (i = 0; i < menuItem.parentNode.children.length; ++i) {
            if (menuItem === menuItem.parentNode.children[i]) {
              continue;
            }
            menuItem.parentNode.children[i].classList.remove('focus');
          }
          menuItem.classList.add('focus');
        } else {
          menuItem.classList.remove('focus');
        }
      };
      for (i = 0; i < parentLink.length; ++i) {
        parentLink[i].addEventListener('touchstart', touchStartFn, false);
      }
    }
  })(container);
})();
($ => {
  $(document).ready(function () {
    // Owl Carousel DOM Elements
    var carousel1 = '#sync1';
    var carousel2 = '#sync2';

    // Initialize plugin
    var owlCarousel1 = $(carousel1).owlCarousel({
      items: 1,
      margin: 10,
      nav: true,
      navText: ['<div class="hds-icon hds-icon--size-xl hds-icon--arrow-left">', '<div class="hds-icon hds-icon--size-xl hds-icon--arrow-right">']
    });
    var owlCarousel2 = $(carousel2).owlCarousel({
      items: 5,
      margin: 10
    });

    // Sync carousel & add current class
    carouselSyncCurrentClass();

    // On carousel change: Sync carousel & add current class
    owlCarousel1.on('changed.owl.carousel', function () {
      carouselSyncCurrentClass();
    });
    owlCarousel2.on('changed.owl.carousel', function (event) {
      carouselSyncCurrentClass();
    });

    // Thumbs switch click event.
    owlCarousel2.find('.item').click(function () {
      var itemIndex = $(this).parent().index();
      owlCarousel1.trigger('to.owl.carousel', itemIndex);
      carouselSyncCurrentClass();
    });
    function carouselSyncCurrentClass() {
      setTimeout(function () {
        var carousel1ActiveIndex = $('#sync1 .owl-item.active').index();
        $('#sync2 .owl-item').removeClass('current');
        var currentItem = $('#sync2 .owl-item:nth-child(' + (carousel1ActiveIndex + 1) + ')');
        currentItem.addClass('current');
        if (!currentItem.hasClass('active')) {
          if (currentItem.prevAll('.active').length > 0) {
            owlCarousel2.trigger('next.owl.carousel');
          }
          if (currentItem.nextAll('.active').length) {
            owlCarousel2.trigger('prev.owl.carousel');
          }
        }
      }, 100);
    }
  });
})(jQuery);
($ => {
  $(document).ready(function () {
    $(".search-open").click(function () {
      $('.search-box').attr("aria-expanded", function (i, attr) {
        return attr == "true" ? "false" : "true";
      });
      // $('.search-box').toggle('fast');
      $('.search-box').addClass('open');
      $('#s').focus();
      $(".search-open").blur();
      $('.search-open .fa-search, .search-open .fa-times').toggle();
    });
    $('.search-open').keypress(function (e) {
      var key = e.which;
      if (key == 13) {
        $('.search-open').click();
        $(this).addClass('remove-focus');
        // return false;
      }
    });
  });
})(jQuery);

/**
 * File skip-link-focus-fix.js.
 *
 * Helps with accessibility for keyboard only users.
 *
 * Learn more: https://git.io/vWdr2
 */
(function () {
  var isIe = /(trident|msie)/i.test(navigator.userAgent);
  if (isIe && document.getElementById && window.addEventListener) {
    window.addEventListener('hashchange', function () {
      var id = location.hash.substring(1),
        element;
      if (!/^[A-z0-9_-]+$/.test(id)) {
        return;
      }
      element = document.getElementById(id);
      if (element) {
        if (!/^(?:a|select|input|button|textarea)$/i.test(element.tagName)) {
          element.tabIndex = -1;
        }
        element.focus();
      }
    }, false);
  }
})();
($ => {
  $(document).ready(function () {
    $('.home .current-menu-item a').css('font-family', 'HelsinkiGrotesk-Regular, Georgia, sans-serif');
  });
})(jQuery);