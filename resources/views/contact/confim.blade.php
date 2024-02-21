<div class="contact">
  <h1>お問い合わせ</h1>
  <div class="step_bar complete">お問い合わせ内容の入力</div>
  <div class="step_bar current">入力内容の確認</div>
  <div class="step_bar">送信完了</div>
  <form method="POST" action="{{ route('cotact.')}}">
    <div class="form_input">
      メールアドレス
    </div>
    <div class="form_input">
      <input type="hidden" name="email" value="{{$email}}">
    </div>
    <h2>お問い合わせ内容を確認してください</h2>
    <div class="form">
      <div class="form_title">
        <input type="hidden" name="body" value="{{$body}}">
        {!! n12br(e($body)) !!}
      </div>
    </div>
    <div class="submit" value="入力内容を送信する"></div>
  </form>
</div>