
$(function () {
    let follow = $('.follow-toggle'); //follow-toggleのついたiタグを取得し代入。
    let followReviewId; //変数を宣言（なんでここで？）
    follow.on('click', function () { //onはイベントハンドラー
      let $this = $(this); //this=イベントの発火した要素＝iタグを代入
      followReviewId = $this.data('follow-id'); //iタグに仕込んだdata-review-idの値を取得
      //ajax処理スタート
      $.ajax({
        headers: { //HTTPヘッダ情報をヘッダ名と値のマップで記述
          'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        },  //↑name属性がcsrf-tokenのmetaタグのcontent属性の値を取得
        url: '/follow', //通信先アドレスで、このURLをあとでルートで設定します
        method: 'POST', //HTTPメソッドの種別を指定します。1.9.0以前の場合はtype:を使用。
        data: { //サーバーに送信するデータ
          'artist_id': followReviewId //フォローされたアーティストのidを送る
        },
      })
      //通信成功した時の処理
      .done(function (data) {
        $this.toggleClass('followed'); //followedクラスのON/OFF切り替え。
        $this.next('.follow-counter').html(data.artist_follows_count);
      })
      //通信失敗した時の処理
      .fail(function () {
        console.log('fail'); 
      });
    });
});