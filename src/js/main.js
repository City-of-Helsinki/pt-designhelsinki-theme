// require('../sass/main.scss');

var Bulmascores = require('./bulmascores/theme');

let demo = new Bulmascores();


// $( document ).ready(function() {

//   $(function() {
//     var resizeTimer;
//     var initialSize = $(window).width();
//     $(window).resize(function() {
//       clearTimeout(resizeTimer);
//       resizeTimer = setTimeout(function() {
//         var delayedSize = $(window).width();
//       // if we resize the page but we don't cross the 650 threshold, do nothing
//       if ((initialSize > 650 && delayedSize > 650) || (initialSize < 650 && delayedSize < 650)) {
//         return
//       }
//       // else if we resize the page and cross the 650 threshold, do something
//       else {
//         if (delayedSize > 650) {
//           $('.navbar-item').unwrap();
//         } else if (delayedSize <= 650) {
//           $('.navbar-item').wrap('<div class="navbar-start"></div>');
//         }
//       }

//       initialSize = delayedSize;
//     }, 250);
//     });
//   });

// });