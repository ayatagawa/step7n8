@extends('layout')
@section('title','商品一覧')
@section('content')
<div class="row">
     <div class="col-md-12 col-md-offset-2">
        <h2>商品一覧</h2>
        @if (session('err_msg'))
        <p class="text-danger">{{ session('err_msg') }}</p>
        @endif

        <form class="form-inline my-2 my-lg-0 ml-2">
            <div class="form-group">
                <input type="search" class="form-control mr-sm-2" name="search"  value="{{request('search')}}" placeholder="キーワードを入力" aria-label="検索...">
            </div>
            <input type="submit" value="検索" class="btn btn-info">
        </form>
        <br>

        <table class="table table-striped">
            <tr>
                <th>商品番号</th>
                <th>商品画像</th>
                <th>商品名</th>
                <th>値段</th>
                <th>在庫</th>
                <th>メーカー名</th>
                <th></th>
                <th></th>
            </tr>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td><img class="w-25" src="{{ asset('/storage/'.$product->image) }}"></td>
                <td>{{ $product->product_name }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->stock }}</td>
                <td>{{ $product->company_name }}</td>
                <td><button type="button" class="btn btn-primary" onclick="location.href='/product/{{ $product->id }}{{ $product->product_name }}'">詳細</button></td>
                <form method="POST" action="{{ route('delete', $product->id) }}" onSubmit="return checkDelete()">
                @csrf
                <td><button type="submit" class="btn btn-primary" onclick=>削除</button></td>
                </form>
            </tr>
            @endforeach
        </table>
        
    </div>
</div>
<script>
function checkDelete(){
    if(window.confirm('削除してよろしいですか？')){
        return true;
    } else {
        return false;
    }
}
</script>
@endsection