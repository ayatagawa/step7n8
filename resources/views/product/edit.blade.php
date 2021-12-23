@extends('layout')
@section('title', '商品編集')
@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <h2>商品編集フォーム</h2>
        <form method="POST" action="{{ route('update') }}" onSubmit="return checkSubmit()" enctype=“multipart/form-data”>
        @csrf
        <input type="hidden" name="id" value="{{ $product->id }}">

            <div class="form-group">
                <label for="product_id">
                    商品番号：{{ $product->id }}
                </label>
            </div>
            
            <div class="form-group">
                <label for="product_name">
                    商品名
                </label>
                <input
                    id="product_name"
                    name="product_name"
                    class="form-control"
                    value="{{ $product->product_name }}"
                    type="text"
                >
                @if ($errors->has('product_name'))
                    <div class="text-danger">
                        {{ $errors->first('product_name') }}
                    </div>
                @endif
            </div>
            
            <div class="form-group">
                <label for="company_id">
                    メーカー名
                </label>

                <select class="form-control" id="company_id" name="company_id">
                    @foreach($company_name as $items)
                        <option id="company_id" name="company_id" value="{{ $items->id }}"
                            @if($items->id === $product->company->id)
                            selected
                            @endif    
                        >{{ $items->company_name }}</option>
                    @endforeach
               </select>
                
                @if ($errors->has('company_name'))
                    <div class="text-danger">
                        {{ $errors->first('company_name') }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="price">
                    値段
                </label>
                <input
                    id="price"
                    name="price"
                    class="form-control"
                    value="{{ $product->price }}"
                    type="text"
                >
                @if ($errors->has('price'))
                    <div class="text-danger">
                        {{ $errors->first('price') }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="stock">
                    在庫数
                </label>
                <input
                    id="stock"
                    name="stock"
                    class="form-control"
                    value="{{ $product->stock }}"
                    type="text"
                >
                @if ($errors->has('stock'))
                    <div class="text-danger">
                        {{ $errors->first('stock') }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="comment">
                    商品詳細
                </label>
                <textarea id="comment" name="comment" class="form-control" rows="4">{{ $product->comment }}</textarea>
                @if ($errors->has('comment'))
                    <div class="text-danger">
                        {{ $errors->first('comment') }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="image">
                    商品画像
                </label>      
                <br>
                    <input type="file" name="image" id="image">     
                <br>
            </div>

            <div class="mb-5">
                <a class="btn btn-secondary" href="/product/{{ $product->id }}">
                戻る
                </a>
                <button type="submit" class="btn btn-primary">
                    更新
                </button>
            </div>
        </form>
    </div>
</div>
<script>
function checkSubmit(){
if(window.confirm('更新してよろしいですか？')){
    return true;
} else {
    return false;
}
}
</script>
@endsection