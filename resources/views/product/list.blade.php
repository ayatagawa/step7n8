@extends('layout')
@section('title','商品管理')
@section('content')
<div class="row">
     <div class="col-md-12 col-md-offset-2">
        <h2>商品一覧</h2>
        @if (session('err_msg'))
        <p class="text-danger">{{ session('err_msg') }}</p>
        @endif

            <div class="form-group">
                <input type="text" id="product" class="form-control mr-sm-2" name="search" placeholder="キーワードを入力" aria-label="検索...">
            </div>
            <select class="form-control" id="company_id" name="company_id">
            <option value="" selected>全て表示</option>
            @foreach($company_name as $items)
                <option name="company_id" value="{{ $items->id }}">{{ $items->company_name }}</option>
            @endforeach
            </select>
            <button id="search" class="btn btn-info">検索</button>
        <br>

        <table class="table table-striped" id="product_table">
            <tr><select name="narabi">
    <option value="asc">昇順</option>
    <option value="desc">降順</option>
</select>

                <th><a href="/">商品番号</a></th>
                <th>商品画像</th>
                <th>商品名</th>
                <th>値段</th>
                <th>在庫</th>
                <th>メーカー名</th>
                <th></th>
                <th></th>
            </tr>
            <tbody id="table_content">
            @foreach($products as $product)
            
            <tr class="table-lists">
                <td>{{ $product->id }}</td>
                <td><img class="w-25" src="{{ asset('/storage/'.$product->image) }}"></td>
                <td>{{ $product->product_name }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->stock }}</td>
                <td>{{ $product->company_name }}</td>
                <td><button type="button" class="btn btn-primary" onclick="location.href='/product/{{ $product->id }}{{ $product->product_name }}'">詳細</button></td>
                <form method="POST" action="{{ route('delete', $product->id) }}" onSubmit="return checkSubmit('削除しますか？')">
                @csrf
                <td><button type="submit" class="btn btn-primary" onclick=>削除</button></td>
                </form>
            </tr>
            
            @endforeach
            </tbody>
        </table>
        <div class = "paginate mt-5 mb-5 d-flex justify-content-center">
        </div>
    </div>
</div>
@endsection