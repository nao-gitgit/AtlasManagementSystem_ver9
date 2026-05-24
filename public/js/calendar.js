$(function () {

  // 予約キャンセルのモーダル表示
  $(document).on('click', 'button[name="delete_date"]', function (e) {
    e.preventDefault();

    const reserveValue = $(this).val();
    const reservePart = $(this).text().trim();

    // 日付のみ取り出す
    const date = reserveValue.replace(/-\d+$/, '');

    // モーダルに値をセット
    $('#modal-date').text(date);
    $('#modal-part').text(reservePart);

    let $input = $('#deleteParts input[name="delete_date"]');
    if ($input.length === 0) {
      $input = $('<input>').attr({ type: 'hidden', name: 'delete_date' });
      $('#deleteParts').append($input);
    }
    $input.val(reserveValue);

    $('#cancelModal').modal('show');
  });

});
