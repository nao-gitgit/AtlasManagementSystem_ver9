<x-sidebar>
<div class="vh-100 pt-5" style="background:#ECF1F6;">
  <div class="border w-75 m-auto pt-5 pb-5" style="border-radius:5px; background:#FFF;">
    <div class="w-75 m-auto border" style="border-radius:5px;">

      <p class="text-center">{{ $calendar->getTitle() }}</p>
      <div class="">
        {!! $calendar->render() !!}
      </div>
    </div>
    <div class="text-right w-75 m-auto">
      <input type="submit" class="btn btn-primary" value="予約する" form="reserveParts">
    </div>
  </div>
</div>

<!-- キャンセル確認モーダル -->
<div class="modal fade" id="cancelModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body pt-4 pb-4 pl-4">
        <p>予約日：<span id="modal-date"></span></p>
        <p>時間：<span id="modal-part"></span></p>
        <p>上記の予約をキャンセルしてもよろしいですか？</p>
      </div>
      <div class="modal-footer border-0">
        <button type="button" class="btn btn-primary" data-dismiss="modal">閉じる</button>
        <button type="submit" class="btn btn-danger" form="deleteParts">キャンセル</button>
      </div>
    </div>
  </div>
</div>
</x-sidebar>
