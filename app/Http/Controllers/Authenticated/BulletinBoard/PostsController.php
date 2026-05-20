<?php

namespace App\Http\Controllers\Authenticated\BulletinBoard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories\MainCategory;
use App\Models\Categories\SubCategory;
use App\Models\Posts\Post;
use App\Models\Posts\PostComment;
use App\Models\Posts\Like;
use App\Models\Users\User;
use App\Http\Requests\BulletinBoard\PostFormRequest;
use App\Http\Requests\BulletinBoard\PostEditFormRequest;
use App\Http\Requests\BulletinBoard\PostCommentFormRequest;
use App\Http\Requests\BulletinBoard\CategoryRequest;
use Auth;

class PostsController extends Controller
{
    public function show(Request $request){
        // 全メインカテゴリーをサブカテゴリー付きで取得
        $main_categories = MainCategory::with('subCategories')->get();

        $like = new Like;
        $post_comment = new Post;

        // キーワード検索
        if(!empty($request->keyword)){
            $keyword = $request->keyword;
            $posts = Post::with('user', 'postComments')
            ->where(function($query)use($keyword){
                $query
                // 投稿タイトル：あいまい検索
                ->where('post_title', 'like', '%' . $keyword . '%')
                // 投稿内容：あいまい検索
                ->orWhere('post', 'like', '%' . $keyword . '%')
                // サブカテゴリー名：完全一致
                ->orWhereHas('subCategories', function ($q) use ($keyword){
                    $q->where('sub_category', $keyword);
                });
            })
            ->get();

        // サブカテゴリー絞り込み
        }else if(!empty($request->sub_category_id)){
            $sub_category_id = $request->sub_category_id;
            $posts = Post::with('user', 'postComments')
            ->whereHas('subCategories', function ($q) use ($sub_category_id){
                $q->where('sub_categories.id', $sub_category_id);
            })
            ->get();

        // いいねした投稿
        }else if($request->like_posts){
            $likes = Auth::user()->likePostId()->get('like_post_id');
            $posts = Post::with('user', 'postComments')
            ->whereIn('id', $likes)->get();

        // 自分の投稿
        }else if($request->my_posts){
            $posts = Post::with('user', 'postComments')
            ->where('user_id', Auth::id())->get();

        // 全件表示
        }else{
            $posts = Post::with('user', 'postComments')->get();
        }

        return view('authenticated.bulletinboard.posts', compact('posts', 'main_categories', 'like', 'post_comment'));
    }

    public function postDetail($post_id){
        $post = Post::with('user', 'postComments')->findOrFail($post_id);
        return view('authenticated.bulletinboard.post_detail', compact('post'));
    }

    public function postInput(){
        $main_categories = MainCategory::with('subCategories')->get();
        return view('authenticated.bulletinboard.post_create', compact('main_categories'));
    }

    public function postCreate(PostFormRequest $request){
        $post = Post::create([
            'user_id' => Auth::id(),
            'post_title' => $request->post_title,
            'post' => $request->post_body
        ]);

        // サブカテゴリー紐付け追加
        $post->subCategories()->attach($request->sub_category_id);

        return redirect()->route('post.show');
    }

    // PostEditFormRequestでバリデーションを適用
    public function postEdit(PostEditFormRequest $request){
        Post::where('id', $request->post_id)->update([
            'post_title' => $request->post_title,
            'post' => $request->post_body,
        ]);
        return redirect()->route('post.detail', ['id' => $request->post_id]);
    }

    // GETからPOSTに変更
    public function postDelete(Request $request){
        Post::findOrFail($request->post_id)->delete();
        return redirect()->route('post.show');
    }

    public function mainCategoryCreate(CategoryRequest $request){
        MainCategory::create([
            'main_category' => $request->main_category_name
        ]);
        return redirect()->route('post.input');
    }

    // サブカテゴリー追加
    public function subCategoryCreate(CategoryRequest $request){
        SubCategory::create([
            'main_category_id' => $request->main_category_id,
            'sub_category' => $request->sub_category_name,
        ]);
        return redirect()->route('post.input');
    }

    public function commentCreate(PostCommentFormRequest $request){
        PostComment::create([
            'post_id' => $request->post_id,
            'user_id' => Auth::id(),
            'comment' => $request->comment
        ]);
        return redirect()->route('post.detail', ['id' => $request->post_id]);
    }

    public function myBulletinBoard(){
        $posts = Auth::user()->posts()->get();
        $like = new Like;
        return view('authenticated.bulletinboard.post_myself', compact('posts', 'like'));
    }

    public function likeBulletinBoard(){
        $like_post_id = Like::with('users')->where('like_user_id', Auth::id())->get('like_post_id')->toArray();
        $posts = Post::with('user')->whereIn('id', $like_post_id)->get();
        $like = new Like;
        return view('authenticated.bulletinboard.post_like', compact('posts', 'like'));
    }

    public function postLike(Request $request){
        $user_id = Auth::id();
        $post_id = $request->post_id;

        $like = new Like;

        $like->like_user_id = $user_id;
        $like->like_post_id = $post_id;
        $like->save();

        return response()->json();
    }

    public function postUnLike(Request $request){
        $user_id = Auth::id();
        $post_id = $request->post_id;

        $like = new Like;

        $like->where('like_user_id', $user_id)
             ->where('like_post_id', $post_id)
             ->delete();

        return response()->json();
    }
}
