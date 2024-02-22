<div class="contact">
  <h1>お問い合わせフォーム</h1>
  <div class="step">
    <div class="step_bar current">お問い合わせ内容の入力</div>
    <div class="step_bar">確認</div>
    <div class="step_bar">送信完了</div>
  </div>
  <form method="POST" action="{{route('contact.confirm')}}">
    @csrf
    <h2>メールアドレスを入力してください</h2>
    <div class="form">
      <div class="form_input">
        メールアドレス
        <span>必須</span>
      </div>
      <div class="form_input">
        <input type="email" name="email" value="{{old('email')}}"required>
      </div>
    </div>
    <h2>お問い合わせ内容を入力してください</h2>
    <div class="form">
      <div class="form_title">
        お問い合わせ内容
        <span>必須</span>
      </div>
      <div class="form_input">
        <textarea name="body" required></textarea>
      </div>
    </div>
    <div class="submit">
      <input type=submit value="入力内容を確認する">
    </div>
  </form>
  @foreach($errors->all() as $error)
  <li>{{$error}}</li>
  @endforeach
</div>