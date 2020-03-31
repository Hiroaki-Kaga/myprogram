<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    //
    public function add()
    {
        return view('admin.pfofile.create');
    }
    
    public function create()
    { 
        return redirect('admin/profile/crete');
    }
    
    public function edit()
    {
        return view('admin/profile.edit');
    }
    
    public function update()
    {
        return redirect('admin/profile/edit');
    }
    
}

