<x-sidebar>
<div class="search_content w-100 d-flex">
  <div class="reserve_users_area">
    @foreach($users as $user)
    <div class="one_person p-3" style="background:#fff; border-radius:10px; box-shadow: 0 2px 8px rgba(0,0,0,0.08);">
      <div>
        <span>ID : </span><span>{{ $user->id }}</span>
      </div>
      <div><span>名前 : </span>
        <a href="{{ route('user.profile', ['id' => $user->id]) }}" style="color:#29ABE2;">
          <span>{{ $user->over_name }}</span>
          <span>{{ $user->under_name }}</span>
        </a>
      </div>
      <div>
        <span>カナ : </span>
        <span>({{ $user->over_name_kana }}</span>
        <span>{{ $user->under_name_kana }})</span>
      </div>
      <div>
        @if($user->sex == 1)
        <span>性別 : </span><span>男</span>
        @elseif($user->sex == 2)
        <span>性別 : </span><span>女</span>
        @else
        <span>性別 : </span><span>その他</span>
        @endif
      </div>
      <div>
        <span>生年月日 : </span><span>{{ $user->birth_day }}</span>
      </div>
      <div>
        @if($user->role == 1)
        <span>役職 : </span><span>教師(国語)</span>
        @elseif($user->role == 2)
        <span>役職 : </span><span>教師(数学)</span>
        @elseif($user->role == 3)
        <span>役職 : </span><span>講師(英語)</span>
        @else
        <span>役職 : </span><span>生徒</span>
        @endif
      </div>
      <div>
        @if($user->role == 4)
        <span>選択科目 :</span>
        <!-- 選択科目を表示 -->
        @foreach($user->subjects as $subject)
        <span>{{ $subject->subject }}</span>
        @endforeach
        @endif
      </div>
    </div>
    @endforeach
  </div>

  <div class="search_area w-25">
    <label>検索</label>
        <input type="text" class="free_word" name="keyword" placeholder="キーワードを検索" form="userSearchRequest">

        <label>カテゴリ</label>
        <select form="userSearchRequest" name="category" class="form-control mb-3">
          <option value="name">名前</option>
          <option value="id">社員ID</option>
        </select>

        <label>並び替え</label>
        <select name="updown" form="userSearchRequest" class="form-control mb-3">
          <option value="ASC">昇順</option>
          <option value="DESC">降順</option>
        </select>

      <div>
        <p class="m-0 search_conditions">
          <span>検索条件の追加</span>
        <span class="toggle-arrow">v</span>
        </p>
        <div class="search_conditions_inner" style="display: none;">
          <div>
            <label>性別</label>
            <span>男</span><input type="radio" name="sex" value="1" form="userSearchRequest">
            <span>女</span><input type="radio" name="sex" value="2" form="userSearchRequest">
            <span>その他</span><input type="radio" name="sex" value="3" form="userSearchRequest">
          </div>
          <div>
            <label>権限</label>
            <select name="role" form="userSearchRequest" class="form-control engineer">
              <option selected disabled>----</option>
              <option value="1">教師(国語)</option>
              <option value="2">教師(数学)</option>
              <option value="3">教師(英語)</option>
              <option value="4">生徒</option>
            </select>
          </div>
          <div class="selected_engineer">
            <label>選択科目</label>
            <span>国語</span><input type="checkbox" name="subjects[]" value="1" form="userSearchRequest">
            <span>数学</span><input type="checkbox" name="subjects[]" value="2" form="userSearchRequest">
            <span>英語</span><input type="checkbox" name="subjects[]" value="3" form="userSearchRequest">
          </div>
        </div>
      </div>

        <input type="submit" name="search_btn" value="検索" form="userSearchRequest" class="btn_search">
        <input type="reset" value="リセット" form="userSearchRequest" class="btn_reset">

    <form action="{{ route('user.show') }}" method="get" id="userSearchRequest"></form>
  </div>
</div>
</x-sidebar>
