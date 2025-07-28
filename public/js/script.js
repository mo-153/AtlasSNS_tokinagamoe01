// アコーディオンメニュ

$(function () {
  $('.accordion-header').on('click', function () {
    $(this).find('.allow').toggleClass('rotated');
    $(this).find('.accordion-content').slideToggle();
  });
});




// フォローボタンの切り替え
$(document).on("click", ".follow-toggle", function (event) {
  event.preventDefault();

  var button = $(this);
  var userId = button.data("user-id");
  // ↑event.preventDefault();でクリックしてもページが移動しないようにする

  $.ajax({
    url: "/follow",
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
    },
  });
});



// 投稿の編集のモーダル表示
$(function () {
  $('.js-modal-open').on('click', function () {
    // ↑編集ボタンが押されたら
    $('.js-modal').fadeIn();
    // ↑モーダルの中身の表示
    var post = $(this).attr('post');
    // ↑押されたボタンから投稿内容を取得して変数へ格納
    var post_id = $(this).attr('post_id');
    // ↑押されたボタンから投稿のidを取得して変数へ格納（どの投稿を編集するか特定するのに必要）

    $('.modal_post').val(post);
    // ↑取得した投稿内容をモーダルの中身へ渡す
    $('.modal_id').val(post_id);
    $('.modal-form').attr('action', '/posts/' + post_id);
    // ↑actionを設定
    return false;
    // ↑取得した投稿内容のidをモーダルの中身へ渡す
  });


  $('.js-modal-close').on('click', function () {
    // ↑背景部分、閉じるボタンが押されたら
    $('.js-modal').fadeOut();
    return false;
    // ↑モーダルの中身を非表示する
  });
});

$(document).on("click", "posts-destroy", function (e) {
  if (!confirm("この投稿を削除します。よろしいでしょうか？"));
});
