<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProgramController extends Controller
{
    //以下を追記
    public function add()
    {
        return view('admin.program.create');
    }
    
    // 以下を追記
    public function create(Request $request)
    {
      // admin/program/createにリダイレクトする
      //return redirect('admin/program/create');
      
      
        // 以下を追記
       // Varidationを行う
      $this->validate($request, Program::$rules);

      $program = new Program;
      $form = $request->all();

      // フォームから画像が送信されてきたら、保存して、$program->image_path に画像のパスを保存する
      if (isset($form['image'])) {
        $path = $request->file('image')->store('public/image');
        $program->image_path = basename($path);
      } else {
          $program->image_path = null;
      }

      // フォームから送信されてきた_tokenを削除する
      unset($form['_token']);
      // フォームから送信されてきたimageを削除する
      unset($form['image']);

      // データベースに保存する
      $program->fill($form);
      $program->save();

      return redirect('admin/program/create');
  }
}
