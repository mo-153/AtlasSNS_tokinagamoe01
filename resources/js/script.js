import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// アコーディオンメニュー
$('.accordion-menu').on('click', function () {
  $('.allow').toggleClass('open');
  $(this).next('.accordion-content').slideToggle();

});
