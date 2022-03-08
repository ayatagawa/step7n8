<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Suport\Facades\DB;

class Product extends Model {
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
    public function sale() {
        return $this->hasMany('App\Employee\Models\Sale');
    }

    //belongsTo設定
    public function company() {
        return $this->belongsTo('App\Models\Company');
    }

    public function list() {
        $list  = \DB::table('products');
        $list->select('products.id', 'products.image', 'products.product_name', 'products.stock', 'companies.company_name');
        $list->join('companies', 'products.company_id', '=', 'companies.id');
                //  ->get();
        return $list;
    }
    
}
