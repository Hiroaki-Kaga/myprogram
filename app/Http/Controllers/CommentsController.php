<?php

namespace App\Http\Controllers;
// ==========ここから追加する==========
use App\Comment;
use App\Post;
use Auth;
use Validator;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    // ==========ここから追加する==========
    //コンストラクタ （このクラスが呼ばれると最初にこの処理をする）
    public function __construct()
    {
        // ログインしていなかったらログインページに遷移する（この処理を消すとログインしなくてもページを表示する）
        $this->middleware('auth');
    }
    // ==========ここまで追加する==========
    
    public function store(Request $request)
    {
        // Commentモデル作成
        $comment = new Comment;
        $comment->comment = $request->comment;
        $comment->post_id = $request->post_id;
        $comment->user_id = Auth::user()->id;
        $comment->save();

        // 「/」 ルートにリダイレクト
        return redirect('/');
    }    
   
   // ==========ここから追加する==========
    public function destroy(Request $request)
    {
        $comment = Comment::find($request->comment_id);
        $comment->delete();
        return redirect('/');
    }
    // ==========ここまで追加する==========
}