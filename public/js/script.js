// アコーディオンメニュ
$(function () {
  $('.accordion-header').on('click', function () {
    $(this).find('.allow').toggleClass('rotated');
    $(this).find('.accordion-content').slideToggle();
  });
});
