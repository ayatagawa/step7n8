<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //テーブル名
    protected $table = 'companies';

    //可変項目
    protected $fillable =
    [
            'company_name',
            'street_address',
    ];

    //hasMany設定
    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }
}
