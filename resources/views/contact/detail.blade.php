<article>
  <div class="information-detail__email">
    <p>メールアドレス:{{$contact->email}}</p>
  </div>
  <div class="information-detail__text">{{$contact->body}}</div>
  <div class="information-detail__button">
    <ul><a href="{{route('contact.list')}}">一覧へ戻る</a></ul>
  </div>
</article>