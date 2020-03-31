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
}
