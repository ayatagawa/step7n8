@extends('layout')
@section('title','商品詳細')
@section('content')
<div class="row">
     <div class="col-md-8 col-md-offset-2">
        <span>商品番号：{{ $product->id }}</span><br>
        <span>商品画像</span><br>
        <!-- {{ $product->images }} -->
        <br>
        <span>商品名:{{ $product->product_name }}</span><br>
        <span>メーカー:{{ $product->company->company_name }}</span><br>
        <span>値段：{{ $product->price }}円</span><br>
        <span>在庫数：{{ $product->stock }}個</span>
        <p>コメント：{{ $product->comment }}</p>

        <a class="btn btn-secondary" href="{{ route('products') }}">
            戻る
        </a>
        <button type="button" class="btn btn-primary" onclick="location.href='/product/edit/{{ $product->id }}'">
            編集
        </button>

    </div>
</div>
@endsection