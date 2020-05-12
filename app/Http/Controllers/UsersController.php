<?php

namespace App\Http\Controllers;
// ==========下の１行を追加する==========
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
  // ==========ここから追加する==========
    public function show($user_id)
    {
        $user = User::where('id', $user_id)
            ->firstOrFail();
            
         // テンプレート「user/show.blade.php」を表示します。
        return view('user/show', ['user' => $user]);
    }
  // ==========ここまで追加する==========
}