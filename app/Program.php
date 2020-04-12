<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $guarded = array('id');

    // 以下を追記
    public static $rules = array(
        'title' => 'required',
        'body' => 'required',
    );

    // 以下を追記
    // Programモデルに関連付けを行う
    public function histories()
    {
      return $this->hasMany('App\History');

    }
}