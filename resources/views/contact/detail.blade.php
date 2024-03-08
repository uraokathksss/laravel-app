<article>
  <head>
    <meta charset="UTF-8">
    <style>
      body {
        display: flex;
        justify-content: center;
        align-items: center;
      }
      .information-detail__email,
      .information-detail__text {
        border: 5px solid rgb(89, 67, 167); /* 枠線のスタイルを指定 */
        padding: 10px; /* 枠内の余白を指定 */
        margin-bottom: 50px; /* 各要素の下部に余白を追加 */
      }
    </style>
  </head>
  <div class="information-detail__email">
    <p>メールアドレス</p>
    {{$contact->email}}
  </div>
  <div class="information-detail__text">
    <p>お問い合わせ内容</p>
    {{$contact->body}}
  </div>
  <div class="information-detail__text">
    <p>添付画像</p>
    <img src="{{$contact->image}}" alt="" width="100%">
  </div>
  <div class="information-detail__button">
    <ul><a href="{{route('contact.delete',$contact->id)}}">削除</a></ul>
  </div>
  <div class="information-detail__button">
    <ul><a href="{{route('contact.list')}}">一覧へ戻る</a></ul>
  </div>
</article>