$(function () {
  // search.blade用
  $('.search_conditions').click(function () {
    $('.search_conditions_inner').slideToggle();

    const arrow = $(this).find('.toggle-arrow');
    arrow.text(arrow.text() === '∧' ? 'v' : '∧');
  });

  // profile.blade用
  $('.subject_edit_btn').click(function () {
    const $inner = $('.subject_inner');
    const arrow = $(this).find('.toggle-arrow');

    if ($inner.is(':visible')) {
      $inner.slideUp();
      arrow.text('v');
    } else {
      $inner.slideDown();
      arrow.text('∧');
    }
  });
});
