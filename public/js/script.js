// アコーディオンメニュ

$(function () {
  $('.accordion-header').on('click', function () {
    $(this).find('.allow').toggleClass('rotated');
    $(this).find('.accordion-content').slideToggle();
  });
});




// フォローボタンの切り替え
$(document).ready(function () {
  // ↑ページの読み込みが完了したら処理が開始する
  $(".follow-toggle").click(function (event) {
    event.preventDefault();
    // ↑event.preventDefault();でクリックしてもページが移動しないようにする

    var button = $(this);
    var userId = button.data("user-id");
    var isFollowed = button.attr("data-follow") === "true";
    $.ajax({
      url: isFollowed ? "/unfollow" : "/follow",
      // ↑三項演算子（条件式の真偽に応じて２つの値のいずれかを片方に返すこと）
      type: "POST",
      data: {
        user_id: userId,
        _token: $('meta[name="csrf-token"]').attr("content")
      },// ←セキュリティ対策
      success: function (response) {
        if (response.status) {
          button.text("フォロー解除").removeClass("btn-primary").addClass("btn-danger");
          // ↑ボタンの表示を「フォロー解除」に変更
          button.data("follow", "true");
        } else {
          button.text("フォローする").removeClass("btn-danger").addClass("btn-primary");
          // ↑ボタンの表示を「フォローする」に変更

          button.data("follow", "false");
        }
      }
    });
  });
});
