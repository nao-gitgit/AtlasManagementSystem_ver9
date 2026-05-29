<x-sidebar>
<div class="board_area w-100 m-auto d-flex">

  <!-- 投稿一覧 -->
  <div class="post_view w-75 mt-5">
    @foreach($posts as $post)
    <div class="post_area border w-75 m-auto p-3 mb-3">
      <p class="m-0" style="color:#999; font-size:13px;">
        <span>{{ $post->user->over_name }}</span><span class="ml-1">{{ $post->user->under_name }}</span>さん
      </p>
      <p class="mt-1 mb-2"><a href="{{ route('post.detail', ['id' => $post->id]) }}" style="color:#333; font-weight:bold; text-decoration:none;">{{ $post->post_title }}</a></p>
      <div class="d-flex justify-content-between align-items-center mt-2">
      <div>
      @foreach($post->subCategories as $sub)
        <span class="category_box mr-1" style="background:#29ABE2; font-size:12px; padding:4px 8px;">{{ $sub->sub_category }}</span>
      @endforeach
      </div>
        <div class="d-flex">
          <div class="mr-5">
            <i class="fa fa-comment" style="color:#aaa;"></i><span class="ml-1" style="color:#aaa;">{{ $post->postComments->count() }}</span>
          </div>
          <div>
            @if(Auth::user()->is_Like($post->id))
            <i class="fas fa-heart un_like_btn" style="color:#E2254D;" post_id="{{ $post->id }}"></i><span class="like_counts{{ $post->id }} ml-1" style="color:#aaa;">{{ $like->likeCounts($post->id) }}</span>
            @else
            <i class="fas fa-heart like_btn" style="color:#aaa;" post_id="{{ $post->id }}"></i><span class="like_counts{{ $post->id }} ml-1" style="color:#aaa;">{{ $like->likeCounts($post->id) }}</span>
            @endif
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>

  <!-- 右サイドバー -->
  <div class="other_area w-25 mt-5 pr-3">
    <div class="mb-3">
      <a href="{{ route('post.input') }}" class="btn btn-block" style="background:#29ABE2; color:#fff;">投稿</a>
    </div>
      <div class="d-flex mb-3">
        <input type="text" class="form-control" style="flex:7; border-radius:4px 0 0 4px; border-right:none;" placeholder="キーワードを検索" name="keyword" form="postSearchRequest">
        <input type="submit" class="btn btn-block" style="flex:3; border-radius:0 4px 4px 0; background:#29ABE2; color:#fff;" value="検索" form="postSearchRequest">
      </div>
      <div class="d-flex mb-3">
      <input type="submit" name="like_posts" class="btn mr-1" style="background:#FF6B9D; color:#fff; width:50%;" value="いいねした投稿" form="postSearchRequest">
      <input type="submit" name="my_posts" class="btn" style="background:#F5A623; color:#fff; width:50%;" value="自分の投稿" form="postSearchRequest">
      </div>

        <!-- カテゴリー検索 -->
        <div class="mb-2" style="font-size:13px; color:#555;">カテゴリー検索</div>
        <div class="">
        @foreach($main_categories as $main)
        <!-- メインカテゴリー -->
        <div class="main_category_item">
          <div class="main_category_header" data-target="sub_{{ $main->id }}">
            <span>{{ $main->main_category }}</span>
            <span class="accordion_arrow">^</span>
          </div>
          <!-- サブカテゴリー -->
          <ul id="sub_{{ $main->id }}" class="sub_category_list">
            @foreach($main->subCategories as $sub)
            <li>
              <button type="submit" name="sub_category_id" value="{{ $sub->id }}" form="postSearchRequest">
                {{ $sub->sub_category }}
              </button>
            </li>
            @endforeach
          </ul>
        </div>
        @endforeach
    </div>
  </div>

  <form action="{{ route('post.show') }}" method="get" id="postSearchRequest"></form>
</div>
</x-sidebar>
