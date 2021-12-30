<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Company;
use Illuminate\Suport\Facades\DB;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{

// テスト

     /**
     * プロダクト一覧を表示する
     * @return view
     */
    public function showList(Request $request)
    {
        $company_name = \DB::table('companies')->get();

        $search = $request->input('search');
        $maker_name = $request->all('company_id');

        if(!empty($search)){
            $products = \DB::table('companies')
            ->join('products','companies.id','=','products.company_id')
            ->orderBy('products.id', 'asc')
            ->where('product_name', 'LIKE', '%'.$search.'%')
            ->get();
        }else if($request->has('company_id')){
            $products = \DB::table('companies')
            ->join('products','companies.id','=','products.company_id')
            ->orderBy('products.id', 'asc')
            ->where('products.company_id', $request->company_id)
            ->get();
        }else if(!empty($search) && $request->has('company_id')){
            $products = \DB::table('companies')
            ->join('products','companies.id','=','products.company_id')
            ->orderBy('products.id', 'asc')
            ->where('product_name', 'LIKE', '%'.$search.'%')
            ->where('products.company_id', $request->company_id)
            ->get();
        }else{
            $products = \DB::table('companies')
            ->join('products','companies.id','=','products.company_id')
            ->orderBy('products.id', 'asc')
            ->get();
        }

        return view('product.list', compact('products', 'search', 'company_name'));   
    }

    /**
     * プロダクト詳細を表示する
     * @param int $id
     * @return view
     */
    public function showDetail($id)
    {
        $product = Product::with('company')->find($id);

        if (is_null($product))
        {
            \Session::flash('err_msg', 'データがありません。');
            return redirect(route('products'));
        } 

        return view('product.detail', ['product' => $product]);
    }

    /**
     * プロダクト登録画面を表示する
     * 
     * @return view
     */
    public function showCreate(){
        $company_name = \DB::table('companies')->get();
        return view('product.form', compact('company_name'));
    }

    /**
     * プロダクトを登録する
     * 
     * @return view
     */
    public function exeStore(ProductRequest $request)
    {
        $product = new Product();

        // 商品のデータを受け取る
        $inputs = $request->all();
        $img = $request->file('image');
        if(!empty($img)){
            $img = $request->file('image')->getPathname();
            $imageName = $request->file('image')->storeAs('', $img, 'public');
        }

        \DB::beginTransaction();
        try {
            // 商品を登録
            Product::create($inputs);
            \DB::commit();
        } catch(\Throwable $e) {
            \DB::rollback();
            throw new \Exception($e->getMessage());
            
        }
        
        \Session::flash('err_msg', '商品を登録しました。');
        return redirect(route('products'));
    }

     /**
     * プロダクト編集フォームを表示する
     * @param int $id
     * @return view
     */
    public function showEdit($id)
    {
        $company_name = \DB::table('companies')->get();
        $product = Product::with('company')->find($id);

        if (is_null($product)) {
            \Session::flash('err_msg', 'データがありません。');
            return redirect(route('products'));
        } 

        return view('product.edit', compact('company_name', 'product'));

    }

    /**
     * プロダクトを更新する
     * 
     */
    public function exeUpdate(ProductRequest $request)
    {
        // 商品のデータを受け取る
        $inputs = $request->all();
        $img = $request->file('image');
        if(!empty($img)){
            $img = $request->file('image')->getPathname();
            $imageName = $request->file('image')->storeAs('', $img, 'public');
        }

        
        \DB::beginTransaction();
        try {
            // 商品を更新
            $product = Product::find($inputs['id']);
            $product->fill([
                'product_name' => $inputs['product_name'],
                'company_id' => $inputs['company_id'],
                'price' => $inputs['price'],
                'stock' => $inputs['stock'],
                'comment' => $inputs['comment'],
                'image' => $inputs['image']
            ]);            
            
            $product->save();
            \DB::commit();
        } catch(\Throwable $e) {
            \DB::rollback();
            throw new \Exception($e->getMessage());
        }
        
        \Session::flash('err_msg', '商品を更新しました。');
        return redirect(route('products'));
    }

    /**
     * ブログ削除
     * @param int $id
     * @return view
     */
    public function exeDelete($id)
    {
        if (empty($id)) {
            \Session::flash('err_msg', 'データがありません。');
            return redirect(route('products'));
        }

        try {
            // ブログを削除
            Product::destroy($id);
        } catch(\Throwable $e) {
            throw new \Exception($e->getMessage());
        }

        \Session::flash('err_msg', '削除しました。');
        return redirect(route('products'));
    }

}
