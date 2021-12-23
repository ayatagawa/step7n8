<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //テーブル名
    protected $table = 'products';

    //可変項目
    protected $fillable =
    [
            'company_id',
            'product_name',
            'price',
            'stock',
            'comment',
            'image',
    ];

    //primaryKeyの変更
    protected $primaryKey = "id";

    //hasMany設定
    public function sale()
    {
        return $this->hasMany('App\Employee\Models\Sale');
    }

    //belongsTo設定
    public function company()
    {
        return $this->belongsTo('App\Models\Company');
    }
}
