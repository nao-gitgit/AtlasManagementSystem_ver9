$(function () {
  $('.search_conditions').click(function () {
    $('.search_conditions_inner').slideToggle();

    // 矢印の切り替え
    const arrow = $(this).find('.toggle-arrow');
    arrow.text(arrow.text() === '▲' ? '▽' : '▲');
  });

  $('.subject_edit_btn').click(function () {
    $('.subject_inner').slideToggle();
  });
});
