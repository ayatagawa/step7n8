function checkSubmit(message) {
    return window.confirm(message);
}


// 非同期削除



function deleteProduct(id){
    console.log(id + "を削除します");
    if(!checkSubmit('削除します。よろしいですか？')){
        return false;
    }
    console.log($(this));
    $(this).closest('tr').remove();

    // $.ajax({

    //     headers: {
    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //     },//Headersを書き忘れるとエラーになる
    //     type: 'POST',
    //     url: '/product/delete', //後述するweb.phpのURLと同じ形にする
    //     data: {
    //         'id': id, //ここはサーバーに贈りたい情報。今回は検索ファームのバリューを送りたい。
    //     },
    //     dataType: 'text', 
        

    // }).done(function (data) {
    //     console.log("Ajax成功！");
    //     $(this).closest('.table-lists').remove();

    // }).fail(function(jqXHR, textStatus, errorThrown){
    //     console.log(jqXHR.status);
    // });
}


// 非同期検索

$(function(){

    $(".delete").on("click", function() {
        console.log("削除ボタンがクリックされました。");
    })

    $('#search').on('click', function() {
        $('.table-lists').empty(); //もともとある要素を空にする
        $('.search-null').remove(); //検索結果が0のときのテキストを消す

        let product = $('#product').val();
        let company = $('#company_id').val();
        console.log(company);


    
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },//Headersを書き忘れるとエラーになる
            type: 'POST',
            url: '/', //後述するweb.phpのURLと同じ形にする
            data: {
                'product': product,
                'company': company //ここはサーバーに贈りたい情報。今回は検索ファームのバリューを送りたい。
            },
            dataType: 'json', //json形式で受け取る
            

        }).done(function (data) { //ajaxが成功したときの処理
            
            // console.log(data);
            $('.loading').addClass('display-none'); //通信中のぐるぐるを消す
            let html = '';
            $.each(data, function (index, value) { //dataの中身からvalueを取り出す
                // console.log(index + ': ' + value.id);
                
                // ここの記述はリファクタ可能
                let id = value.product_id;
                let image = "http://localhost:8888/storage/" + value.image;
                let name = value.product_name;
                let price = value.price;
                let stock = value.stock;
                let company_name = value.company_name;
                
                
                // １ユーザー情報のビューテンプレートを作成
                html = `
                        <tr class="table-lists">
                            <td class="col-xs-2 product-id">${id}</td> 
                            <td class="col-xs-2"><img class="w-25" src="${image}"></td>
                            <td class="col-xs-2">${name}</td>
                            <td class="col-xs-2">${price}</td>
                            <td class="col-xs-2">${stock}</td>
                            <td class="col-xs-2">${company_name}</td>}
                            <td class="col-xs-2"><a class="btn btn-primary" href="/product/${id}">詳細</a></td>
                            <td class="col-xs-2"><button class="btn btn-primary delete">削除</button></td>
                       </tr>
                        `
                $('#table_content').append(html);
            })
            $('.table-lists tbody').append(html);//できあがったテンプレートをビューに追加
            console.log($('.delete'));
            // 検索結果がなかったときの処理
            if (data.length === 0) {
                $('#product_table').after('<p class="text-center mt-5 search-null">商品が見つかりません</p>');
                // console.log("商品が見つかりません");
            }
            

        }).fail(function () {
            //ajax通信がエラーのときの処理
            console.log('Ajaxリクエスト失敗');
        })
    });

});

