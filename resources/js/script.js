// アコーディオンメニュ

$(function () {
  $('.accordion-menu').on('click', function () {
    $(this).find('.accordion').toggleClass('open');
    $(this).find('.allow').toggleClass('rotated');
    $(this).find('.accordion-content').slideToggle();
  });
});
