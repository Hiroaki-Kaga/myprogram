<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Program;

class ProgramController extends Controller
{
  public function add()
  {
      return view('admin.program.create');
  }

  public function create(Request $request)
  {
      // Varidationを行う
      $this->validate($request, Program::$rules);
      $program = new Program;
      $form = $request->all();

      // formに画像があれば、保存する
      if (isset($form['image'])) {
        $path = $request->file('image')->store('public/image');
        $program->image_path = basename($path);
      } else {
          $program->image_path = null;
      }

      unset($form['_token']);
      unset($form['image']);
      // データベースに保存する
      $program->fill($form);
      $program->save();

      return redirect('admin/program/create');
  }

  // 以下を追記
  public function index(Request $request)
  {
      $cond_title = $request->cond_title;
      if ($cond_title != '') {
          // 検索されたら検索結果を取得する
          $posts = Program::where('title', $cond_title)->get();
      } else {
          // それ以外はすべてのニュースを取得する
          $posts = Program::all();
      }
      return view('admin.program.index', ['posts' => $posts, 'cond_title' => $cond_title]);
  }

}