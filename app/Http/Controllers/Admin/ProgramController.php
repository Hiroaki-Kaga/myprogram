<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Program;
use App\History;
use Carbon\Carbon;
use Storage;

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
      $path = Storage::disk('s3')->putFile('/',$form['image'],'public');
      $program->image_path = Storage::disk('s3')->url($path);
        
      } else {
          $news->image_path = null;
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

  public function edit(Request $request)
  {
      // Program Modelからデータを取得する
      $program = Program::find($request->id);
      if (empty($program)) {
        abort(404);    
      }
      return view('admin.program.edit', ['program_form' => $program]);
  }

  public function update(Request $request)
   {
       $this->validate($request, Program::$rules);
       $program = Program::find($request->id);
       $program_form = $request->all();
       if ($request->remove == 'true') {
           $program_form['image_path'] = null;
       } elseif ($request->file('image')) {
           $path = Storage::disk('s3')->putFile('/',$program_form['image'],'public');
           $program->image_path = Storage::disk('s3')->url($path);
       } else {
           $program_form['image_path'] = $program->image_path;
       }

        unset($program_form['_token']);
        unset($program_form['image']);
        unset($program_form['remove']);
        $program->fill($program_form)->save();

        // 以下を追記
        $history = new History;
        $history->program_id = $program->id;
        $history->edited_at = Carbon::now();
        $history->save();

        return redirect('admin/program/');
  }

 // 以下を追記　　
  public function delete(Request $request)
  {
      // 該当するProgram Modelを取得
      $program = Program::find($request->id);
      // 削除する
      $program->delete();
      return redirect('admin/program/');
  }  


 
}

