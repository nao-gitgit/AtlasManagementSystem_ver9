$(function () {

  // 予約キャンセルのモーダル表示
  $(document).on('click', 'button[name="delete_date"]', function (e) {
    e.preventDefault();

    const reserveValue = $(this).val();
    const reservePart = $(this).text().trim();

    // 日付のみ取り出す
    const [date, part] = reserveValue.split('_');

    // モーダルに値をセット
    $('#modal-date').text(date);
    $('#modal-part').text(reservePart);

    let $input = $('#deleteParts input[name="delete_date"]');
    if ($input.length === 0) {
      $input = $('<input>').attr({ type: 'hidden', name: 'delete_date' });
      $('#deleteParts').append($input);
    }
    $input.val(date);

    // partもhiddenで渡す
    let $partInput = $('#deleteParts input[name="delete_part"]');
    if ($partInput.length === 0) {
      $partInput = $('<input>').attr({ type: 'hidden', name: 'delete_part' });
      $('#deleteParts').append($partInput);
    }
    $partInput.val(part);

    $('#cancelModal').modal('show');
  });

});
